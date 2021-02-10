<?php

namespace App\Helpers;


class AppSetting
{


    static $allLanguageCode = ['en', 'es', 'fr', 'hi', 'zh'];
    static $allLanguage = ['English', 'Spanish', 'France', 'Hindi', 'Chinese'];

    static $currencySign = "$";
    static $currencyCode = "USD";

    //--- set timezone ----------//

    //static $timezone = "UTC";
    static $timezone = "GMT+5:30";



    //--------- Razorpay API (https://dashboard.razorpay.com/app/dashboard) ----------//
    //TODO : add your own razorpay payment keys
    static $RAZORPAY_ID = "";
    static $RAZORPAY_SECRET = "";


    //Firebase Cloud Messaging (FCM) Server key
    //TODO: add your own Firebase Cloud Messaging developer key
    static $FCM_SERVER_KEY = "";

}

