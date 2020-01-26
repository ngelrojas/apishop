<?php

use App\User;
use App\Product;
use App\Category;
use App\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Category::truncate(); 
        Product::truncate(); 
        Transaction::truncate(); 
        DB::table('category_product')->truncate();

        $userQuantity = 200;
        $categoryQuantity = 30;
        $productsQuantity = 1000;
        $transactionQuantity = 1000;

        factory(User::class, $userQuantity)->create();
        factory(Category::class, $categoryQuantity)->create();
        factory(Product::class, $productsQuantity)->create()->each(
            function($product){
                $categories = Category::all()->random(mt_rand(1, 5))->pluck('id');
                $product->categories()->attach($categories);
            } 
        );
        factory(Transaction::class, $transactionQuantity)->create();
    }
}
