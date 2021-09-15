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
        $this->app->bind(SurveyDataService::class, function ($app) {
            return new SurveyDataService(Auth::id());
        });

        $this->app->bind(ShowDataService::class, function ($app) {
            return new ShowDataService(new CustomerDataService, new VisitedRecordDataService, $this->app->make(SurveyDataService::class), new SalesHistoryDataService);
        });
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
