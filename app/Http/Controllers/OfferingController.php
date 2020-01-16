<?php

namespace App\Http\Controllers;

use App\Offering;
use Illuminate\Http\Request;

class OfferingController extends Controller
{
    public function index()
    {
        $offerings = Offering::all();
        return response($offerings->toJson());
    }
}
