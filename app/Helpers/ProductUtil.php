<?php
namespace App\Helpers;


class ProductUtil {

    static function getProductItemFeatures($item){
        return view('components.product-item-features')->with([
            'item'=>$item
        ]);
    }



}

