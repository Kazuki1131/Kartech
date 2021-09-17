<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\{Customer, VisitedRecord, SalesHistory};
use Auth;

final class CustomersIndexDataService
{
    /**
     * @var \Illuminate\Database\Eloquent\Collection
     */
    private $customers;

    //ログインユーザーに紐づく顧客をすべて取得
    private function getAllCustomersInTheShop()
    {
        return $this->customers = Customer::where('shop_id', Auth::id())->paginate(10);
    }

    //来店日を取得（ログインユーザーに紐づく顧客すべて）
    private function getAllCustomersVisitedAtsInTheShop(): array
    {
        if ($this->customers->count()) {
            foreach ($this->customers as $customer) {
                if (VisitedRecord::where('customer_id', $customer->id)->exists()) {
                    $visitedAts[$customer->id] = VisitedRecord::where('customer_id', $customer->id)
                        ->orderBy('visited_at', 'desc')
                        ->pluck('visited_at');
                } else {
                    $visitedAts[$customer->id] = [];
                }
            }
            return $visitedAts;
        }
        return [];
    }

    //ログインユーザーに紐づく顧客すべての平均単価を取得
    private function getAvgSellingPriceForAllCustomersInTheShop(): array
    {
        if ($this->customers->count()) {
            foreach ($this->customers as $customer) {
                $totalSellingPrice = SalesHistory::where('customer_id', $customer->id)->sum('price_sold');
                $numberOfVisits = VisitedRecord::where('customer_id', $customer->id)->count();
                if ($numberOfVisits !== 0) {
                    $avgSellingPrice[$customer->id] = intval($totalSellingPrice / $numberOfVisits);
                } else {
                    $avgSellingPrice[$customer->id] = 0;
                }
            }
            return $avgSellingPrice;
        }
        return [];
    }

    public function allCustomersDataList(): array
    {
        return [
            'customers' => $this->getAllCustomersInTheShop(),
            'visitedDates' => $this->getAllCustomersVisitedAtsInTheShop(),
            'avgSellingPrices' => $this->getAvgSellingPriceForAllCustomersInTheShop(),
        ];
    }

    public function searchedCustomersDataList($request)
    {
        if ($request->searchColumn === 'name') {
            $this->customers = Customer::where([
                    ['shop_id', Auth::id()],
                    [$request->searchColumn, 'like', '%' . $request->keyword . '%']
                ])->orWhere (function ($query) use ($request) {
                    $query->where([
                        ['shop_id', Auth::id()],
                        ['name_kana', 'like', '%' . $request->keyword . '%']
                    ]);
                })->paginate(10);
        } else {
            $this->customers = Customer::where([
                ['shop_id', Auth::id()],
                [$request->searchColumn, $request->keyword]
                ])->paginate(10);
        }
        return [
            'customers' => $this->customers,
            'visitedDates' => $this->getAllCustomersVisitedAtsInTheShop(),
            'avgSellingPrices' => $this->getAvgSellingPriceForAllCustomersInTheShop()
        ];
    }
}
