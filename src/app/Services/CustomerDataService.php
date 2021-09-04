<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\{Customer, VisitedRecord};
use Auth;

final class CustomerDataService
{
    /**
     * @var bool
     */
    private $customerExists = false;

    /**
     * @var \Illuminate\Database\Eloquent\Collection
     */
    private $customers;
    private $orderedCustomer;
    private $visitedAts;

    //ログインユーザーに紐づく顧客をすべて取得
    private function getCustomers()
    {
        if (Customer::where('user_id', Auth::id())->exists()) {
            $this->customerExists = true;
            return $this->customers = Customer::where('user_id', Auth::id())->paginate(10);
        }
        return $this->customerExists;
    }

    //リクエストされた顧客だけ取得
    public function getOrderedCustomer(int $request)
    {
        return $this->orderedCustomer = Customer::where([
            ['user_id', Auth::id()],
            ['id', $request],
        ])->first();
    }

    //来店日を取得（ログインユーザーに紐づく顧客すべて）
    private function allVisitedAts(): array
    {
        if ($this->customerExists) {
            foreach ($this->customers as $customer) {
                if (VisitedRecord::where('customer_id', $customer->id)->exists()) {
                    $this->visitedAts[$customer->id] = VisitedRecord::where('customer_id', $customer->id)
                        ->orderBy('visited_at', 'desc')->pluck('visited_at');
                } else {
                    $this->visitedAts[$customer->id] = null;
                }
            }
            return $this->visitedAts;
        }
        return [];
    }

    //来店日を取得（リクエストされた顧客のみ）
    public function requestVisitedAts()
    {
        if (empty($this->orderedCustomer)) {
            return [];
        }
        return VisitedRecord::where('customer_id', $this->orderedCustomer->id)->orderBy('visited_at', 'desc')->pluck('visited_at');
    }

    //最終来店日を取得（ログインユーザーに紐づく顧客すべて）
    private function allLastVisitDates(): array
    {
        if ($this->customerExists) {
            foreach ($this->customers as $customer) {
                $lastVisitDates[$customer->id] =  $this->allVisitedAts()[$customer->id][0] ?? null;
            }
            return $lastVisitDates;
        }
        return [];
    }

    //総来店回数を取得（ログインユーザーに紐づく顧客すべて）
    private function allVisitedTimes(): array
    {
        if ($this->customerExists) {
            foreach ($this->customers as $customer) {
                $visitedTimes[$customer->id] = $this->visitedAts[$customer->id] ? count($this->visitedAts[$customer->id]) : 0;
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
            foreach ($this->customers as $customer) {
                if (VisitedRecord::where('customer_id', $customer->id)->exists()) {
                    $rawAvgPurchasePrice = VisitedRecord::select('price')
                        ->join('menus', function ($join) use ($customer) {
                            $join->on('menus.id', 'visited_records.menu_id')
                                ->where('customer_id', $customer->id);
                        })->avg('price');

                    $roundedAvgPurchasePrices[$customer->id] = intval(round($rawAvgPurchasePrice ?? 0));
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
    public function requestAvgPurchasePrice(int $request): int
    {
        if (empty($this->orderedCustomer->id)) {
            return 0;
        }
        $rawAvgPurchasePrice = VisitedRecord::select('price')
            ->join('menus', function ($join) use ($request) {
                $join->on('menus.id', 'visited_records.menu_id')
                    ->where('customer_id', $request);
            })->avg('price');

        return intval(round($rawAvgPurchasePrice ?? 0));
    }

    public function getControlNumberToSet(): int
    {
        $controlNumberExist = Customer::select('control_number')
            ->where('user_id', Auth::id())
            ->exists();
            // ddd($controlNumberExist);
        if ($controlNumberExist) {
            return Customer::where('user_id', Auth::id())->max('control_number') + 1;
        } else {
            return 1;
        }
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
}
