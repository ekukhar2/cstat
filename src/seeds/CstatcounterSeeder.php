<?php

use Illuminate\Database\Seeder;
use Eugen\Cstat\Models\Cstatcounter;
use Carbon\Carbon;
class CstatcounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uniuser = Cstatcounter::firstOrCreate(['id' => 'uniuser']);
        $uniuser->todaydate=Carbon::today('Europe/Kiev');
        $uniuser->save();
        $alluser = Cstatcounter::firstOrCreate(['id' => 'alluser']);
    }
}
