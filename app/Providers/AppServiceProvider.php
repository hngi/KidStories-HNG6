<?php

namespace App\Providers;

use App\Tag;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $tags = [
        'create-story',
        'admin.stories.create',
        'admin.stories.edit'
    ];
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
        \Schema::defaultStringLength(191);

        if (env('APP_ENV') != 'local') {
            URL::forceScheme('https');
        }

        \View::composer($this->tags, function ($view) {
            $view->with('tags', Tag::all());
        });

        Resource::withoutWrapping();
    }
}
