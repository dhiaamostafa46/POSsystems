<?php

namespace App\Providers;

use App\Models\Organization;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use App\Models\Page;
use App\Models\Packagecatagury;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

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
        if(empty(session('dateFrom'))){
            session()->put('dateFrom',Carbon::now()->subDays(30)->format('Y-m-d'));
            session()->put('dateTo',Carbon::now()->addDays(1)->format('Y-m-d'));
            session()->put('locale', 'ar');
            app()->setLocale(session()->get('locale'));
            App::setLocale('ar');
        }
        view()->composer('*', function($view)
        {
            $pages = Page::where('status',1)->get();
              $packge=Packagecatagury::where('status',1)->get();
            $view->with('pages', $pages)->with('package',  $packge);
        });
        view()->composer('layouts.eCommerceMasterPage', function($view)
        {
            $sum = 0;
            if(!empty(session('products')))
            {
                foreach(session('products') as $product){
                    $sum = $sum + $product['qnty'];
                }
            }
            $shop = Organization::where('status',1)->first();
            $view->with('shop', $shop)->with('sum',$sum);
        });
    }
}
