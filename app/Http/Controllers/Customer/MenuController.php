<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Add this for HTTP client

class MenuController extends Controller
{
    public function index(Request $request)
    {
        // Get the search query
        $search = $request->query('search');

        // If there's a search query, call the external API
        if ($search) {
            $response = Http::post('http://127.0.0.1:8000/api/result', [
                'title' => $search, // Send the search term as the title
            ]);

            // Check if the API call was successful
            if ($response->successful()) {
                // Get the data from the response
                $menus = $response->json();

                // Return the view with the fetched data
                return view('customer.menus', compact('menus'));
            } else {
                // If the API call fails, you can return an error or handle it as needed
                return view('customer.menus', ['error' => 'Recommendation not availabe at the moment']);
            }
        }

        // If there's no search query, fetch all menus from the database
        $menus = Menu::all();

        // Return the view with all menus
        return view('customer.menus', compact('menus'));
    }
}
