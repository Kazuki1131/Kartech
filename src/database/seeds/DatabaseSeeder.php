<?php

use Illuminate\Database\Seeder;
use App\Models\{Shop, Customer, Menu, VisitedRecord};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Shop::class, 10)->create();
        factory(Customer::class, 100)->create();
        factory(Menu::class, 100)->create();
        factory(VisitedRecord::class, 300)->create();
    }
}
