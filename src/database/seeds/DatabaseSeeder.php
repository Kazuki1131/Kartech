<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Customer;
use App\Menu;
use App\BizRecord;
use App\AnnotationTitle;
use App\AnnotationContent;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 100)->create();
        factory(Customer::class, 1000)->create();
        factory(Menu::class, 1000)->create();
        factory(BizRecord::class, 3000)->create();
        factory(AnnotationTitle::class, 500)->create();
        factory(AnnotationContent::class, 1500)->create();
    }
}
