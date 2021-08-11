<?php

namespace App\Services;

use App\Models\{Customer, VisitedRecord, AnnotationTitle, AnnotationContent};
use Auth;

final class CustomerDataService
{
    /**
     * @var bool
     */
    private $customerExists = true;

    //顧客レコードをログインユーザーに紐づくものすべて取得
    private function getCustomers()
    {
        if (Customer::where('user_id', Auth::id())->exists()) {
            return Customer::where('user_id', Auth::id())->paginate(10);
        }
        return $this->customerExists = false;
    }

    //顧客レコードをリクエストされたものだけ取得
    private function getRequestCustomer(int $request)
    {
        $customer = Customer::where([
            ['user_id', Auth::id()],
            ['id', $request],
        ])->first();
        return $customer;
    }

    //来店日を取得（ログインユーザーに紐づく顧客すべて）
    private function allVisitedAts(): array
    {
        if ($this->customerExists) {
            foreach ($this->getCustomers() as $customer) {
                if (VisitedRecord::where('customer_id', $customer->id)->exists()) {
                    $visitedAts[$customer->id] = VisitedRecord::where('customer_id', $customer->id)
                        ->orderBy('visited_at', 'desc')->pluck('visited_at');
                } else {
                    $visitedAts[$customer->id] = null;
                }
            }
            return $visitedAts;
        }
        return [];
    }

    //来店日を取得（リクエストされた顧客のみ）
    private function requestVisitedAts(int $request)
    {
        $customer = $this->getRequestCustomer($request);
        if (empty($customer->id)) {
            return [];
        }
        return VisitedRecord::where('customer_id', $customer->id)->orderBy('visited_at', 'desc')->pluck('visited_at');
    }

    //最終来店日を取得（ログインユーザーに紐づく顧客すべて）
    private function allLastVisitDates(): array
    {
        if ($this->customerExists) {
            foreach ($this->getCustomers() as $customer) {
                $visitedAts = $this->allVisitedAts();
                $lastVisitDates[$customer->id] =  $visitedAts[$customer->id][0] ?? null;
            }
            return $lastVisitDates;
        }
        return [];
    }

    //総来店回数を取得（ログインユーザーに紐づく顧客すべて）
    private function allVisitedTimes(): array
    {
        if ($this->customerExists) {
            foreach ($this->getCustomers() as $customer) {
                $visitedAts = $this->allVisitedAts();
                $visitedTimes[$customer->id] = $visitedAts[$customer->id] ? count($visitedAts[$customer->id]) : 0;
            }
            return $visitedTimes;
        }
        return [];
    }

    /**
     * ログインユーザーに紐づく顧客すべての平均単価を取得
     * 要修正：メニューの金額を変更すると平均単価に影響してしまう
     */
    private function allAvgPurchasePrices(): array
    {
        if ($this->customerExists) {
            foreach ($this->getCustomers() as $customer) {
                if (VisitedRecord::where('customer_id', $customer->id)->exists()) {
                    $rawAvgPurchasePrice = VisitedRecord::select('price')
                        ->join('menus', function ($join) use ($customer) {
                            $join->on('menus.id', 'biz_records.menu_id')
                                ->where('customer_id', $customer->id);
                        })->avg('price');

                    $roundedAvgPurchasePrices[$customer->id] = intval(round($rawAvgPurchasePrice));
                } else {
                    $roundedAvgPurchasePrices[$customer->id] = 0;
                }
            }
            return $roundedAvgPurchasePrices;
        }
        return [];
    }

    /**
     * リクエストされた顧客の平均単価を取得
     * 要修正：メニューの金額を変更すると平均単価に影響してしまう
     */
    private function requestAvgPurchasePrice(int $request): int
    {
        $customer = $this->getRequestCustomer($request);
        if (empty($customer->id)) {
            return 0;
        }
        $rawAvgPurchasePrice = VisitedRecord::select('price')
            ->join('menus', function ($join) use ($request) {
                $join->on('menus.id', 'biz_records.menu_id')
                    ->where('customer_id', $request);
            })->avg('price');

        return intval(round($rawAvgPurchasePrice));
    }

    //ログインユーザーに紐づく顧客補足情報のタイトルをすべて取得
    private function AnnotationTitles()
    {
        return AnnotationTitle::where('user_id', 3)->get();
    }

    //リクエストされた顧客の補足情報をすべて取得
    private function requestAnnotationContents(int $request)
    {
        return AnnotationContent::where('customer_id', $request)->get();
    }

    public function indexDataList(): array
    {
        return [
            'customers' => $this->getCustomers(),
            'lastVisitDates' => $this->allLastVisitDates(),
            'visitedTimes' => $this->allVisitedTimes(),
            'avgPurchasePrices' => $this->allAvgPurchasePrices(),
        ];
    }

    public function showDataList(int $request): array
    {
        return [
            'customer' => $this->getRequestCustomer($request),
            'lastVisitDate' => $this->requestVisitedAts($request)[0] ?? null,
            'visitedTimes' => count($this->requestVisitedAts($request)),
            'avgPurchasePrices' => $this->requestAvgPurchasePrice($request),
            'annotationTitles' => $this->AnnotationTitles(),
            'annotationContents' => $this->requestAnnotationContents($request),
        ];
    }
}
