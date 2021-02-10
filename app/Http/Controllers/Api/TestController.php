<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\FCMController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Razorpay\Api\Api;

class TestController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function test()
    {
        $token = "czSX0Jo1Tfy57xa7-JJ0tw:APA91bEddFAmH-8B25GlTnLVqCsVND_VsCAt7rGPqUUw4Hiox3T22YkEOGbUF7In--NmwJcWOPDGzU6skz07G5XFPCUDshIPJqOB7pXgtHVvJrGKrMu_sqfXFDN7QvjqGs7eFvIJoj1O";
        $title = "Title";
        $body = "Body";
        return FCMController::sendMessage($title,$body,$token);

        return "Working";
    }
}
/*
public function index()
{

}

public function create()
{

}


public function store(Request $request)
{

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


public function destroy($id){

}
*/
