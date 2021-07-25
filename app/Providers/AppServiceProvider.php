<?php

namespace App\Providers;

use App\Models\ProductCategory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categories = ProductCategory::select('id', 'name', 'icon', 'parent_id', 'slug')->with('children:id,name,icon,parent_id,slug')->where('parent_id', null)->get();
        view()->share('product_categories', $categories);
    }
}
