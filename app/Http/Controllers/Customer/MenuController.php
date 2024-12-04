<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function showTopRatedMenus()
    {
        // Fetch the top 3 highest-rated menus based on the 'rating' column in descending order
        $topRatedMenus = Menu::orderBy('rating', 'desc')  // Order menus by rating in descending order
                             ->take(3)  // Limit the result to top 3
                             ->get();

        // Pass the fetched top-rated menus to the view
        return view('customer.menus.index', compact('topRatedMenus'));
    }
}
