<?php

namespace App\Providers;

use Auth;
use Carbon\Carbon;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        if (!Auth::check()) {
          view()->composer('partials.sidebar', function($view) {
            $view->with('startDate', '10th June 2017');
            $view->with('totalDeposits', \App\Deposit::where('status', true)->sum('amount'));
            $view->with('totalWithdrawals', \App\Withdrawal::where('status', true)->sum('amount'));
            $view->with('totalAccounts', \App\User::count());
            $view->with('activeAccounts', \App\User::where('block', false)->count());
          });

          view()->composer('partials.sidebar', function($view) {
              $start = Carbon::parse('2017-6-10');
              $now = Carbon::now();

              $days = $start->diffInDays($now);

              $view->with('days', $days);
          });

          //Load news.
          view()->composer('partials.sidebar', function($view) {
            $news = \App\News::latest('created_at')->first();
            $view->with('news', $news);
          });

        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
