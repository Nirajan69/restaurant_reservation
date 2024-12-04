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
    public function index(Request $request)
    {
        // Get the search query
        $search = $request->query('search');

        // Fetch menus based on the search query
        $menus = Menu::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%') // Search by name
                             ->orWhere('description', 'like', '%' . $search . '%'); // Search by description
            })
            ->get();

        // Return the view with menus
        return view('customer.menus', compact('menus'));
    }
}
