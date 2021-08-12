<?php

use Illuminate\Database\Seeder;
use App\Models\{User, Customer, Menu, VisitedRecord, AnnotationTitle, AnnotationContent};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create();
        factory(Customer::class, 100)->create();
        factory(Menu::class, 100)->create();
        factory(VisitedRecord::class, 300)->create();
        factory(AnnotationTitle::class, 50)->create();
        factory(AnnotationContent::class, 150)->create();
    }
}
