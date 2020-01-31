<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductDiscount;
use App\ProductReview;
use App\Quantity;
use Illuminate\Http\Request;
use App\Http\Requests\AddReview;

class ReviewController extends Controller
{
    public function addReview(AddReview $request, int $id)
    {
        $value = $request->validated();
        $review = new ProductReview;
        $review->product_id = $id;
        $review->reviewer_name = $value['name'];
        $review->message = $value['review'];
        $review->rating = $value['rating'];
        $review->save();

        return back()->with('message', 'Review added');
    }

}
