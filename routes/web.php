<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function(){
    return 'test from web';
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/purchase-house/{house}', [App\Http\Controllers\PurchaseController::class, 'store'])->name('purchase:store');

Route::get('/return/url', function (Request $request){
// dd($request->all());

 $purchase = App\Models\Purchase::where('toyyibpay_bill_code',$request->billcode)->first();
 if($purchase){
     //validation if order id = bill_code else show invalid
     if($purchase->id == $request->order_id){
         //update purchase
         $purchase->update(['payment_status' => 1]);
            //show tq receipt/invoice page
         return 'thank you, payment succcessfully updated';
     }
 }else{
     return 'please check your response';
 }


});