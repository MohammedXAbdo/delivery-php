<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use App\Rules\RatingRule;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function index()
    {

    }

    public function create()
    {

    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'order_id' => 'required',
            'product_id' => 'required',
            'rating' => [
                'required',
                new RatingRule()
            ],
        ]);

        $user_id = auth()->user()->id;
        $order = Order::find($request->order_id);
        $product = Product::find($request->product_id);

        if ($order && $product) {
            $productReview = ProductReview::where('order_id', '=', $order->id)->where('product_id', '=', $product->id)->get();
            if ($productReview->count() > 0) {
                return response(['errors' => ['This order is already reviewed']], 403);
            }

            $review = new ProductReview();
            $total_rating = $product->total_rating;
            $product->rating = ($product->rating * $total_rating + $request->rating) / ($total_rating + 1);
            $product->total_rating = $total_rating+1;


            $review->rating = $request->rating;
            $review->review = $request->review;
            $review->product_id = $product->id;
            $review->user_id = $user_id;
            $review->order_id = $request->order_id;
            $review->shop_id = $product->shop_id;
            if($review->save() && $product->save())
                return response(['message' => ['This product is been reviewed']], 200);
        }else {
            return response(['errors' => ['This product is not available']], 403);
        }
        return response(['message' => ['There is something wrong']], 403);
    }

    public function show($id)
    {
    }


    public function edit($id)
    {

    }


    public function update(Request $request)
    {

    }


    public function destroy($id)
    {

    }


}
