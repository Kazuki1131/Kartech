<?php

namespace App\Providers;

use App\Services\{CustomerDataService, SurveyDataService, ShowDataService, VisitedRecordDataService, SalesHistoryDataService};
use Illuminate\Support\ServiceProvider;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
