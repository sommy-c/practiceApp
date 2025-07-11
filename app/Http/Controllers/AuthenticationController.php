<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product;


class AuthenticationController extends Controller
{
    public function showDashboard(Request $request) {
    $category = $request->input('category');

    $query = Product::query();

    if ($category && $category !== 'All') {
        $query->where('category', $category);
    }

    $products = $query->latest()->paginate(5)->appends(['category' => $category]);

    return view('dashboard', compact('products', 'category'));
}

    public function showLogin() {
        return view('login');
    }
    public function showSignUp() {
        return view('signup');
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

        // Auth::login($user);
         Mail::to($request->email)->send(new WelcomeEmail($user));
        return redirect()->route('login')->with('success', 'signup complete');

    }

    public function uploadImage(Request $request){
        $data = $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);
        $path = $request->file('profile_image')->store('profile','public');
        $data['profile_image'] = $path;
        $userId =Auth::user()->id;
        $user = User::find($userId);
        $user->update($data);
        return redirect()->route('dashboard');
    }



    public function login(Request $request) {
        $data = $request->validate([
            "email" =>"required|email" ,
            "password" =>"required|string",
        ]);
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
        return redirect()->route('dashboard');
    }
     return back()->with('error', 'Invalid credentials.');

   }

   public function logout(Request $request){
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    Auth::logout();
    return redirect()->route('dashboard');
   }




}
