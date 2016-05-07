<?php

use App\Accounts\Profile;
use Illuminate\Database\Seeder;

class MarketItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Accounts\User', 10)->create()->each(function($u) {
            Profile::create([
                'user_id' => $u->id,
                'username' => str_random(7)
            ]);

            for($x=0; $x<3; $x++) {
                $u->marketitem()->save(factory('App\MarketItem')->make());
            }
        });
    }
}
