<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use App\Models\Request as Req;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {


        App::setLocale(Session::get('locale', config('app.locale')));

        $count = Req::where(function ($query) {
            $query->whereNull('status')
                ->orWhere('status', 'waiting');
        })->count();

        // Hamma view-larga `$globalRequestCount` o'zgaruvchisini ulash
        View::share('count', $count);


    }
}
