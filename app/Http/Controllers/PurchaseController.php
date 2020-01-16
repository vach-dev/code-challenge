<?php

namespace App\Http\Controllers;

use App\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function showPurchases() {
        $purchases = Purchase::all();
        return response()->json($purchases);
    }

    public function makePurchase(Request $request)
    {
        $input =$request->all();
        $purchase = new Purchase();
        $purchase->quantity = $input['quantity'];
        $purchase->offeringID = $input['id'];
        $purchase->customerName = 'testUser';
        if($purchase->save()) {
            return response()->json(['message' => 'Your purchase made successfully']);
        }
        return response()->json(['message' => 'Your purchase failed']);
    }
}
