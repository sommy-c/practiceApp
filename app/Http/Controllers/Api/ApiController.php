<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ApiController extends Controller
{
    public function displayProduct(){
        $products = Product::all();
        return $products;
    }

    public function showProduct(Product $product ){
    return $product;
   }

   public function uploadProduct(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'price' => 'required|numeric',
            'description' => 'required|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }
         $data['user_id'] = Auth::user()->id;


         $product = Product::create($data);

        return $product;
    }
     public function displayUsers(){
        $users = User::with('product')->get();
        return $users;
    }
    public function updateProduct($id, Request $request){
    $product = Product::findOrFail($id);

    $data = $request->validate([
        'name' => 'sometimes|string|max:255',
        'category' => 'sometimes|string|max:255',
        'price' => 'sometimes|numeric',
        'description' => 'sometimes|string',
        'image' => 'sometimes|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
         dd($request->file('image'));
        $data['image'] = $request->file('image')->store('products', 'public');
    } else {
        $data['image'] = $product->image;
    }

    $data['user_id'] = Auth::id();

    $product->update($data);

    return response()->json([
        'message' => 'Product updated successfully',
        'image_path' => asset('storage/' . $data['image']),
        'product' => $product
    ]);
}

    public function deleteProduct($id){
        $product = Product::find($id);
        $product->delete();
        return response()->json([
            'message'=>'product deleted successfully'
        ]);
    }

    public function login(Request $request) {
        $data = $request->validate([
            "email" =>"required|email" ,
            "password" =>"required|string",
        ]);
        if (!Auth::attempt($data)) {
            return response()->json([
                "message"=> "invalid Account"
            ]);
            }
   $user =Auth::user();
   $token =$user->createToken('api-token')->plainTextToken;
   return response()->json([
    "Token" =>$token,
    "user"=>$user,
   ]);
}


    public function register(Request $request) {
        $data =$request->validate([
            "name" =>"required|string|min:3|max:255",
            "email" =>"required|string|min:3|max:255|unique:users,email",
            "password"=>"required|string|min:3|confirmed",

        ]);

         $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),

    ]);
    $token =$user->createToken('api-token')->plainTextToken;
     return response()->json([
    "Token" =>$token,
    "user"=>$user,
   ]);

        // Auth::login($user);
        //  Mail::to($request->email)->send(new WelcomeEmail($user));
        // return redirect()->route('login')->with('success', 'signup complete');

    }

    public function logout(){
    $user = Auth::user();
    $user->tokens()->delete();
    return response()->json([
        'message'=>'user logged out'
    ]);

   }
}
