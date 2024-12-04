<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Show the customer dashboard view.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('customer.home'); // This points to the customer dashboard view
    }

    /**
     * Show the menu view for customers.
     *
     * @return \Illuminate\View\View
     */
    public function menu()
    {
        return view('customer.menu'); // This points to the customer menu view
    }
    public function index()
    {
        $menus = Menu::all(); // Fetch all menus
        // $topRatedMenus = Menu::where('is_top_rated', true)->take(3)->get(); // Fetch top 3 rated menus

        // return view('customer.index', compact('menus', 'topRatedMenus'));
        return view('customer.home', compact('menus'));

    }
}
