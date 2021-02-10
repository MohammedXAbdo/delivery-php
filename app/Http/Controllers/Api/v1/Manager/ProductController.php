<?php

namespace App\Http\Controllers\Api\v1\Manager;

use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Manager\ProductItemController;
use App\Http\Controllers\Manager\ShopRevenueController;
use App\Models\Cart;
use App\Models\DeliveryBoyReview;
use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ShopReview;
use App\Models\UserCoupon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //TODO : validation in authentication order
    public function index()
    {

        $shop = auth()->user()->shop;
        if($shop) {
            return Product::with('productImages', 'productItems', 'productItems.productItemFeatures')
                ->where('shop_id', '=', $shop->id)
                ->orderBy('updated_at', 'DESC')->get();
        }
        return response(['errors' => ['You have not any shop yet']], 504);

    }

    public function create()
    {

    }


    public function store(Request $request)
    {
        $shop = auth()->user()->shop;
        if (!$shop) {
            return response(['errors' => ['You have not any shop yet']], 504);
        }

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'items' => 'required'
        ]);
       // return $request->get('items');

        $items = array_values(json_decode($request->get('items'), true));
        if (self::validateItems($items)) {
            $product = new Product();
            $product->name = $request->get('name');
            $product->description = $request->get('description');
            $product->category_id = $request->get('category');

            if (isset($request->offer))
                $product->offer = $request->get('offer');
            else
                $product->offer = 0;

            $product->shop_id = $shop->id;
            $product->save();
            ProductItemController::addItemsWithClear($product->id, $items);
            return response(['message' => ['Product created']], 200);
        } else {
            return response(['errors' => ['Product items are not valid (same feature with single item is not allow)']], 403);
        }
    }



    static function validateItems($items): bool
    {
        foreach ($items as $item) {
            $productItemFeatures = $item['product_item_features'];
            for ($i = 0; $i < sizeof($productItemFeatures); $i++) {
                for ($j = $i+1; $j < sizeof($productItemFeatures); $j++) {
                    if ($productItemFeatures[$i]["feature"] === $productItemFeatures[$j]["feature"])
                        return false ;
                }
            }

        }
        return true;
    }

    public function show($id)
    {

        return Product::with('productImages', 'productItems','productItems.productItemFeatures')->find($id);

    }


    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {

        $order = Order::find($id);

        if(isset($request->status)) {
            if (Order::isCancelStatus($request->status)) {
                if (Order::isCancellable($order->status)) {
                    $order->status = $request->status;
                    if ($order->save()) {
                        TransactionController::addTransaction($id);
                        return response(['message' => ['Order status changed']], 200);
                    } else {
                        return response(['errors' => ['Order status is not changed']], 403);
                    }

                } else {
                    return response(['errors' => ['Order is already accepted. you can\'t cancel']], 403);
                }
            }
        }

        $order->status = $request->status;
        if ($order->save()) {
            return response(['message' => ['Status updated']], 200);
        }
        else
            return response(['errors' => ['Something wrong']], 403);
    }


    public function destroy($id)
    {

    }

    public function showReviews($id)
    {
        $user_id = auth()->user()->id;
        $order =  Order::with('carts', 'coupon', 'address', 'carts.product', 'carts.product.productImages', 'shop', 'orderPayment','deliveryBoy','carts.productItem','carts.productItem.productItemFeatures')
            ->find($id);

        $productReviews = ProductReview::where('order_id','=',$order->id)->get();
        $shopReview = ShopReview::where('user_id','=',$user_id)->first();
        $deliveryBoyReview = DeliveryBoyReview::where('order_id','=',$order->id)->first();

        $order['product_reviews'] = $productReviews;
        $order['shop_review'] = $shopReview;
        $order['delivery_boy_review'] = $deliveryBoyReview;


        return $order;

    }

}
