<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Menu;
use Auth;

final class MenuDataService
{
    public function getAllMenusInTheShop()
    {
        if (Menu::where('shop_id', Auth::id())->exists()) {
            return Menu::where('shop_id', Auth::id())->get();
        }
        return [];
    }
}
