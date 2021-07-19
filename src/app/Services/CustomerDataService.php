<?php

namespace App\Services;

use App\Models\{Customer, BizRecord};
use Illuminate\Support\Facades\Auth;

final class CustomerDataService
{
    //ログインユーザーに紐ずくcustomersテーブルのレコードを取得
    private function getCustomers()
    {
        $customers = Customer::where('user_id', 6)->paginate(10);
        return $customers;
    }

    //顧客ごとの来店日を取得
    private function visitedAts(): array
    {
        foreach ($this->getCustomers() as $customer) {
            $visitedAts[$customer->id] = BizRecord::where('customer_id', $customer->id)
            ->orderBy('visited_at', 'desc')->pluck('visited_at');
        }
        return $visitedAts;
    }

    //顧客ごとの最終来店日を取得
    private function lastVisitDates(): array
    {
        foreach ($this->getCustomers() as $customer) {
            $visitedAts = $this->visitedAts();
            $lastVisitDates[$customer->id] = $visitedAts[$customer->id][0];
        }
        return $lastVisitDates;
    }

    //顧客ごとの総来店回数を取得
    private function visitedTimes(): array
    {
        foreach ($this->getCustomers() as $customer) {
            $visitedAts = $this->visitedAts();
            $visitedTimes[$customer->id] = count($visitedAts[$customer->id]);
        }
        return $visitedTimes;
    }

    //顧客ごとの平均単価を取得
    private function averagePurchasePrices(): array
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

    public function customerDataLists(): array
    {
        return [
            'customers' => $this->getCustomers(),
            'lastVisitDates' => $this->lastVisitDates(),
            'visitedTimes' => $this->visitedTimes(),
            'averagePurchasePrices' => $this->averagePurchasePrices(),
        ];
    }
}
