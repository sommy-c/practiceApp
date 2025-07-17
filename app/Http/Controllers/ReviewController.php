<?php

namespace App\Http\Controllers;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function createReview( $id, Request $request){
         $data = $request->validate([
            'message' => 'required',

        ]);
        $data['user_id'] = Auth::user();
        $data['product_id'] =$id;
        $review=Review::create($data);
        return $review;
    }

    public function viewReview($id){

        $product =Product::with('review.user')->findorfail($id);
        return $product;

    }
}
