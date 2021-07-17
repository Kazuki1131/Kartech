<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Auth, DB};

final class CustomerDataService
{
    public function customerList(): array
    {
        //ログインユーザーに紐ずくcustomersテーブルのレコードを取得
        $customers = $this->where('user_id', 6)->paginate(10);

        //顧客ごとに最終来店日、総来店回数、平均単価を取得
        foreach ($customers as $customer) {
            $visitedAts[$customer->id] = BizRecord::where('customer_id', $customer->id)
                ->orderBy('visited_at', 'desc')->pluck('visited_at');

            $lastVisitDates[$customer->id] = $visitedAts[$customer->id][0];

            $visitedTimes[$customer->id] = count($visitedAts[$customer->id]);

            $notRoundedAveragePurchasePrice = DB::table('biz_records')
                ->select('price')
                ->join('menus', function ($join) use ($customer) {
                    $join->on('menus.id', 'biz_records.menu_id')
                    ->where('customer_id', $customer->id);
                })->avg('price');

            $roundedAveragePurchasePrices[$customer->id] = intval(round($notRoundedAveragePurchasePrice));
        }

        return [
            'customers' => $customers,
            'lastVisitDates' => $lastVisitDates,
            'visitedTimes' => $visitedTimes,
            'averagePurchasePrices' => $roundedAveragePurchasePrices,
        ];
    }
}
