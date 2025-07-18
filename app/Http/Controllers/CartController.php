<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // view cart
    public function viewCart(){
        // list of things in cart
    $cart = session()->get('cart', []);
    // gets product IDs from the session.
    $productIds = array_keys($cart);
     // Count total quantity of items in cart
    $totalItems = array_sum(array_column($cart, 'quantity'));
    // Fetches only the products in the cart from the database.
    $products = Product::whereIn('id', $productIds)->get();

    return view('addtocart', compact('products', 'cart', 'totalItems'));
}




    //  add products to cart

   public function addToCart(Request $request, $id){
    $product = Product::findOrFail($id);

    // Retrieve existing cart from session or initialize empty array
    $cart = session()->get('cart', []);

    // If product already in cart, increase quantity
    if (isset($cart[$id])) {
        $cart[$id]['quantity'] += $request->input('quantity', 1);
    } else {
        // Otherwise, add product to cart
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => $request->input('quantity', 1),
            "price" => $product->price,
            "image" => $product->image,
            "description"=>$product->description,
        ];
    }

    // Save updated cart to session
    session(['cart' => $cart]);

    return redirect()->back()->with('show_cart_prompt', 'Product added to cart!');
}

}
