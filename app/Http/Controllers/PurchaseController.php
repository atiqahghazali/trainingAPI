<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, House $house)
    {
        // dd($house);
        //store
        $purchase = Purchase::create([
            'user_id' => auth()->user()->id,
            'house_id' => $house->id,
            'amount' => $house->price
        ]);

        //create bill
        $url = 'https://dev.toyyibpay.com/index.php/api/createBill';
        $body = [
            'userSecretKey'=>'pocwtko3-rpzd-2j7p-bbki-wykbxyr7ob62',
            'categoryCode'=>'bjldxwbf',
            'billName'=> $house->type,
            'billDescription'=>'Rumah Pertama',
            'billAmount'=> $purchase->amount,
            'billReturnUrl'=>'http://127.0.0.1:8000/return/url',
            'billCallbackUrl'=>'http://127.0.0.1:8000/return/url',
            'billExternalReferenceNo' => $purchase->id,
            'billTo'=> auth()->user()->name,
            'billEmail'=> auth()->user()->email,
            'billPhone'=>'0194342411',
            'billPriceSetting'=>1,
        ];

        $response = Http::asForm()->post($url, $body);
        // dd($response->body());
        $bill_code = $response->object()['0']->BillCode;
        //update purchase with bill code
        $purchase->update(['toyyibpay_bill_code' => $bill_code]);
        //return to show purchase
        // return $purchase;
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //show purchase details with payment link
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
