<?php

namespace App\Http\Controllers;

use App\Offering;
use App\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function showPurchases() {

        $purchases = Purchase::with(['offering'])->get();
        return response()->json($purchases);
    }

    public function makePurchase(Request $request)
    {
        $items = $request->input('offerings');
        foreach ($items as $key => $item) {
            $purchase = new Purchase();
            $purchase->quantity = $item['purchaseQuantity'];
            $purchase->offeringID = $item['id'];
            $purchase->customerName = $item['customerName'];
            if($purchase->save()) {
                $offering = $purchase->offering;
                $offering->quantity -= $item['purchaseQuantity'];
                $offering->save();
            }
        }
        return response()->json(['message' => 'Your purchase has made successfully']);
    }
}
