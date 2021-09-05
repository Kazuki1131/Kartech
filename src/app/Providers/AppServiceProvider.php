<?php

namespace App\Providers;

use App\Services\{CustomerDataService, QuestionnaireDataService, ShowDataService, VisitedRecordDataService};
use Illuminate\Support\ServiceProvider;
use Auth;
use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(QuestionnaireDataService::class, function ($app) {
            return new QuestionnaireDataService(Auth::id());
        });

        $this->app->bind(ShowDataService::class, function ($app) {
            return new ShowDataService(new CustomerDataService, new VisitedRecordDataService, $this->app->make(QuestionnaireDataService::class));
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
