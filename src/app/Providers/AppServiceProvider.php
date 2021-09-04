<?php

namespace App\Providers;

use App\Services\{CustomerDataService, QuestionnaireDataService, ShowDataService, VisitedRecordDataService};
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection; //ページネーション実装に必要なため追記
use Illuminate\Pagination\LengthAwarePaginator; //ページネーション実装に必要なため追記
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
        //ページネーション実装に必要なため追記
        /**
         * Paginate a standard Laravel Collection.
         *
         * @param int $perPage
         * @param int $total
         * @param int $page
         * @param string $pageName
         * @return array
         */
        Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator(
                $this->forPage($page, $perPage)->values(),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                    'query' => $queryParams, //クエリパラメーターをURLに渡すために追記
                ]
            );
        });
    }
}
