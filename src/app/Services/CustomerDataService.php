<?php

namespace App\Services;

use App\Models\{Customer, BizRecord, AnnotationTitle, AnnotationContent};
use Illuminate\Support\Facades\Auth;

final class CustomerDataService
{
    //ログインユーザーに紐づく顧客レコードをすべて取得
    private function getCustomers()
    {
        $customers = Customer::where('user_id', 3)->paginate(10);
        return $customers;
    }

    //リクエストされた顧客レコードのみ取得
    private function getRequestCustomer($request)
    {
        $customer = Customer::where([
            ['user_id', '=', 3],
            ['id', '=', $request->id],
        ])->first();
        return $customer;
    }

    //ログインユーザーに紐づく顧客すべての来店日を取得
    private function allVisitedAts(): array
    {
        foreach ($this->getCustomers() as $customer) {
            $visitedAts[$customer->id] = BizRecord::where('customer_id', $customer->id)
            ->orderBy('visited_at', 'desc')->pluck('visited_at');
        }
        return $visitedAts;
    }

    //リクエストされた顧客の来店日を取得
    private function requestVisitedAts($request)
    {
        $visitedAts = BizRecord::where('customer_id', $request->id)
        ->orderBy('visited_at', 'desc')->pluck('visited_at');

        return $visitedAts;
    }

    //ログインユーザーに紐づく顧客すべての最終来店日を取得
    private function allLastVisitDates(): array
    {
        foreach ($this->getCustomers() as $customer) {
            $visitedAts = $this->allVisitedAts();
            $lastVisitDates[$customer->id] = $visitedAts[$customer->id][0];
        }
        return $lastVisitDates;
    }

    //ログインユーザーに紐づく顧客すべての総来店回数を取得
    private function allVisitedTimes(): array
    {
        foreach ($this->getCustomers() as $customer) {
            $visitedAts = $this->allVisitedAts();
            $visitedTimes[$customer->id] = count($visitedAts[$customer->id]);
        }
        return $visitedTimes;
    }

    /*
     * ログインユーザーに紐づく顧客すべての平均単価を取得
     * 要修正：メニューの金額を変更すると平均単価に影響してしまう
     */
    private function allAveragePurchasePrices(): array
    {
        foreach ($this->getCustomers() as $customer) {
            $notRoundedAveragePurchasePrice = BizRecord::select('price')
                ->join('menus', function ($join) use ($customer) {
                    $join->on('menus.id', 'biz_records.menu_id')
                    ->where('customer_id', $customer->id);
                })->avg('price');

            $roundedAveragePurchasePrices[$customer->id] = intval(round($notRoundedAveragePurchasePrice));
        }
        return $roundedAveragePurchasePrices;
    }

    //リクエストされた顧客の平均単価を取得
    private function requestAveragePurchasePrice($request)
    {
        $notRoundedAveragePurchasePrice = BizRecord::select('price')
            ->join('menus', function ($join) use ($request) {
                $join->on('menus.id', 'biz_records.menu_id')
                ->where('customer_id', $request->id);
            })->avg('price');

        return intval(round($notRoundedAveragePurchasePrice));
    }

    //ログインユーザーに紐づく顧客補足情報のタイトルをすべて取得
    private function requestAnnotationTitles()
    {
        return AnnotationTitle::where('user_id', 3)->get();
    }

    //リクエストされた顧客の補足情報をすべて取得
    private function requestAnnotationContents($request)
    {
        return AnnotationContent::where('customer_id', $request->id)->get();
    }

    public function customerDataLists(): array
    {
        return [
            'customers' => $this->getCustomers(),
            'lastVisitDates' => $this->allLastVisitDates(),
            'visitedTimes' => $this->allVisitedTimes(),
            'averagePurchasePrices' => $this->allAveragePurchasePrices(),
        ];
    }

    public function detailDataList($request): array
    {
        return [
            'customer' => $this->getRequestCustomer($request),
            'lastVisitDate' => $this->requestVisitedAts($request)[0],
            'visitedTimes' => count($this->requestVisitedAts($request)),
            'averagePurchasePrices' => $this->requestAveragePurchasePrice($request),
            'annotationTitles' => $this->requestAnnotationTitles(),
            'annotationContents' => $this->requestAnnotationContents($request),
        ];
    }
}
