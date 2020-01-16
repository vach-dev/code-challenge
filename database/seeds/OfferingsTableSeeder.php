<?php

use Illuminate\Database\Seeder;

class OfferingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($i = 1; $i< 10; $i++) {
            $offering = new \App\Offering();
            $offering->title = 'Offering-'.$i;
            $offering->price = rand(10,100);
            $offering->quantity = rand(10, 100);
            $offering->save();
        }
    }
}
