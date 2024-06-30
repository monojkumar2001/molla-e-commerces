<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $categories = Category::with(['subCategories.subSubCategories'])->get();
            $view->with(compact('categories'));
        });
    }
}
