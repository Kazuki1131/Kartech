<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\{SalesHistory, VisitedRecord};

final class SalesHistoryDataService
{
    public function getServicesSoldOnTheRequestedDate($request)
    {
        if (SalesHistory::where('customer_id', $request)->exists()) {
            $visitedRecordIdList = VisitedRecord::where('customer_id', $request)->pluck('id');
            foreach ($visitedRecordIdList as $visitedRecordId) {
                $servicesSold = SalesHistory::select('visited_id', 'menu_name', 'price_sold')->where('visited_id', $visitedRecordId)->get();
            }
            return $servicesSold;
        }
        return [];
    }
}
