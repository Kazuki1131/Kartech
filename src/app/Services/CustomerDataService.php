<?php

namespace App\Services;

use App\Models\{Customer, BizRecord, AnnotationTitle, AnnotationContent};
use Illuminate\Support\Facades\Auth;

final class CustomerDataService
{
    //顧客レコードをログインユーザーに紐づくものすべて取得
    private function getCustomers()
    {
        $customers = Customer::where('user_id', 3)->paginate(10);
        return $customers;
    }

    //顧客レコードをリクエストされたものだけ取得
    private function getRequestCustomer(int $request)
    {
        $customer = Customer::where([
            ['user_id', 3],
            ['id', $request],
        ])->first();
        return $customer;
    }

    //来店日を取得（ログインユーザーに紐づく顧客すべて）
    private function allVisitedAts(): array
    {
        foreach ($this->getCustomers() as $customer) {
            $visitedAts[$customer->id] = BizRecord::where('customer_id', $customer->id)
            ->orderBy('visited_at', 'desc')->pluck('visited_at');
        }
        return $visitedAts;
    }

    //来店日を取得（リクエストされた顧客のみ）
    private function requestVisitedAts(int $request)
    {
        $customer = $this->getRequestCustomer($request);
        if(empty($customer->id)){
            return [];
        }
        $visitedAts = BizRecord::where('customer_id', $customer->id)
        ->orderBy('visited_at', 'desc')->pluck('visited_at');

        return $visitedAts;
    }

    //最終来店日を取得（ログインユーザーに紐づく顧客すべて）
    private function allLastVisitDates(): array
    {
        foreach ($this->getCustomers() as $customer) {
            $visitedAts = $this->allVisitedAts();
            $lastVisitDates[$customer->id] = $visitedAts[$customer->id][0];
        }
        return $lastVisitDates;
    }

    //総来店回数を取得（ログインユーザーに紐づく顧客すべて）
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
    private function requestAveragePurchasePrice(int $request): int
    {
        $customer = $this->getRequestCustomer($request);
        if(empty($customer->id)){
            return 0;
        }
        $notRoundedAveragePurchasePrice = BizRecord::select('price')
            ->join('menus', function ($join) use ($request) {
                $join->on('menus.id', 'biz_records.menu_id')
                ->where('customer_id', $request);
            })->avg('price');

        return intval(round($notRoundedAveragePurchasePrice));
    }

    //ログインユーザーに紐づく顧客補足情報のタイトルをすべて取得
    private function requestAnnotationTitles()
    {
        return AnnotationTitle::where('user_id', 3)->get();
    }

    //リクエストされた顧客の補足情報をすべて取得
    private function requestAnnotationContents(int $request)
    {
        return AnnotationContent::where('customer_id', $request)->get();
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

    public function detailDataList(int $request): array
    {
        return [
            'customer' => $this->getRequestCustomer($request),
            'lastVisitDate' => $this->requestVisitedAts($request)[0] ?? null,
            'visitedTimes' => count($this->requestVisitedAts($request)),
            'averagePurchasePrices' => $this->requestAveragePurchasePrice($request),
            'annotationTitles' => $this->requestAnnotationTitles(),
            'annotationContents' => $this->requestAnnotationContents($request),
        ];
    }
}
