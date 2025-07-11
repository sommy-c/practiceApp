<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class ProductController extends Controller
{
    // display  upload blade
      public function showUpload(){
    return view('upload');
   }

//    display product blade
   public function showProduct($id){
    $product = Product::findorfail($id);
    return view('product', compact('product'));
   }
// display edit product blade
public function showEdit($id){
    $product = Product::with('user')->findorfail($id);
    if(Auth::id() !=$product->user->id){
        abort(403,'fuck off');
    }

    return view('edit', compact('product'));
}
//    Upload products function

    public function upload(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'price' => 'required|numeric',
            'description' => 'required|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }
         $data['user_id'] = Auth::id();

        Product::create($data);

        return redirect()->route('product')->with('success', 'Product uploaded successfully!');
    }

    // edit product function
    public function updateProduct( $id,Request $request){
        $data = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',

        ]);


         $product =Product::find($id);
        if ($request->hasFile('image')) {
          $data['image'] = $request->file('image')->store('products', 'public');
           } else {
           $data['image']= $product->image;
     }

         $data['user_id'] = Auth::id();


        $product->update($data);
        return redirect()->route('product')->with('success', 'Product updated successfully');


    }
    // delete product function
    public function deleteProduct($id){
        $product = Product::with('user')->find($id);
        if(Auth::id() !=$product->user->id){
        abort(403,'fuck off');
    }
        $product->delete();
        return redirect()->route('product')->with('success', 'Product deleted successfully');
    }
    // search function
   public function search(Request $request)
{
    $search = $request->input('search');

    $query = Product::query();

    if (!empty($search)) {
        $query->where('name', 'like', "%{$search}%")
              ->orWhere('category', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
    }

    $products = $query->paginate(10)->appends(['search' => $search]);

    return view('dashboard', compact('products', 'search'));
}


}
