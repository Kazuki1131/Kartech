<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\{Customer, VisitedRecord, SalesHistory};
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
    private function getAllCustomersInTheShop()
    {
        if (Customer::where('shop_id', Auth::id())->exists()) {
            $this->customerExists = true;
            return $this->customers = Customer::where('shop_id', Auth::id())->paginate(10);
        }
        return $this->customerExists;
    }

    //リクエストされた顧客だけ取得
    public function getOrderedCustomer(int $request)
    {
        return $this->orderedCustomer = Customer::where([
            ['shop_id', Auth::id()],
            ['id', $request],
        ])->first();
    }

    //来店日を取得（ログインユーザーに紐づく顧客すべて）
    private function getAllCustomersVisitedAtsInTheShop(): array
    {
        if ($this->customerExists) {
            foreach ($this->customers as $customer) {
                if (VisitedRecord::where('customer_id', $customer->id)->exists()) {
                    $this->visitedAts[$customer->id] = VisitedRecord::where('customer_id', $customer->id)
                        ->orderBy('visited_at', 'desc')
                        ->pluck('visited_at');
                }
            }
            return $this->visitedAts;
        }
        return [];
    }

    //ログインユーザーに紐づく顧客すべての平均単価を取得
    private function getAllCustomersAvgPurchasePriceInTheShop(): array
    {
        if ($this->customerExists) {
            foreach ($this->customers as $customer) {
                $rawAvgPurchasePrice = SalesHistory::where('customer_id', $customer->id)->avg('price_sold');
                $roundedAvgPurchasePrices[$customer->id] = intval(round(intval($rawAvgPurchasePrice ?? 0)));
            }
            return $roundedAvgPurchasePrices;
        }
        return [];
    }

    //リクエストされた顧客の平均単価を取得
    public function requestAvgPurchasePrice(int $request): int
    {
        if (empty($this->orderedCustomer->id)) {
            return 0;
        }
        $rawAvgPurchasePrice = SalesHistory::where('customer_id', $request)->avg('price_sold');

        return intval(round(intval($rawAvgPurchasePrice ?? 0)));
    }

    public function getControlNumberToSet(): int
    {
        $controlNumberExist = Customer::select('control_number')
            ->where('shop_id', Auth::id())
            ->exists();
        if ($controlNumberExist) {
            return Customer::where('shop_id', Auth::id())->max('control_number') + 1;
        } else {
            return 1;
        }
    }

    public function indexDataList(): array
    {
        return [
            'customers' => $this->getAllCustomersInTheShop(),
            'visitedDates' => $this->getAllCustomersVisitedAtsInTheShop(),
            'avgPurchasePrices' => $this->getAllCustomersAvgPurchasePriceInTheShop(),
        ];
    }
}
