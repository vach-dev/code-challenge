<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offering extends Model
{
    protected $table = 'Offerings';

    public function purchases() {
        return $this->hasMany(Purchase::class, 'offeringID');
    }

}
