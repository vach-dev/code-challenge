<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'Purchases';

    protected $fillable = ['customerName', 'offeringID', 'quantity'];
}
