<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure only authenticated users can access
        $this->middleware('admin')->only('create', 'store', 'edit', 'update', 'destroy'); // Admin-only routes
    }

    /**
     * Display a listing of menus (For Admin).
     */
    public function index()
    {
        $menus = Menu::all(); // Fetch all menus
        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new menu (For Admin).
     */
    public function create()
    {
        return view('admin.menus.add');
    }

    /**
     * Store a newly created menu (For Admin).
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|max:500',
            'ingredients' => 'required|string|max:1000',
            'is_veg' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $dbName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $dbName = 'menu-image-' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/menus'), $dbName);
        }

        Menu::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'is_veg' => $request->is_veg,
            'image' => $dbName,
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu added successfully!');
    }

    /**
     * Display menus for customers (Customer View).
     */
    public function indexForCustomer()
    {

        $menus = Menu::all(); // Fetch all menus

        return view('customer.menus.index', compact('menus'));
    }

    /**
     * Show the form for editing the menu (For Admin).
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id); // Find the menu or throw a 404
        return view('admin.menus.edit', compact('menu'));
    }

    /**
     * Update an existing menu (For Admin).
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id); // Find the menu or throw a 404

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:500',
            'ingredients' => 'nullable|string|max:1000',
            'is_veg' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'manual_rating' => 'nullable|numeric|min:1|max:5', // Optional manual rating field
        ]);

        // Update menu fields
        $menu->fill($validated);

        // Handle manual rating input
        if ($request->has('manual_rating')) {
            $menu->manual_rating = $validated['manual_rating'];
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($menu->image && file_exists(public_path('uploads/menus/' . $menu->image))) {
                unlink(public_path('uploads/menus/' . $menu->image));
            }

            $image = $request->file('image');
            $menu->image = 'menu-image-' . $menu->id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/menus'), $menu->image);
        }

        $menu->save(); // Save the updated menu

        return redirect()->route('admin.menus.index')->with('success', 'Menu item updated successfully');
    }

    /**
     * Delete a menu (For Admin).
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id); // Find the menu or throw a 404

        // Delete the associated image if it exists
        if ($menu->image && file_exists(public_path('uploads/menus/' . $menu->image))) {
            unlink(public_path('uploads/menus/' . $menu->image));
        }

        $menu->delete(); // Delete the menu

        return redirect()->route('admin.menus.index')->with('success', 'Menu item deleted successfully');
    }

    /**
     * Fetch and display menus with ratings for customers.
     */
    // public function showMenu()
    // {
    //     // Fetch all menus
    //     $menus = Menu::all();

    //     // Fetch the highest-rated menu(s)
    //     $topRatedMenus = Menu::orderBy('rating', 'desc')->take(1)->get(); // Fetch the highest-rated menu

    //     // Pass the data to the view
    //     return view('customer.menus.index', compact('menus', 'topRatedMenus'));
    // }

   // Method to display the top-rated menus in the admin view
//    public function showTopRatedMenus()
//    {
//        // Fetch the top 3 highest-rated menus by ordering by 'rating' in descending order
//        $topRatedMenus = Menu::orderBy('rating', 'desc')  // Order by rating in descending order
//                             ->take(3)  // Limit the result to top 3
//                             ->get();

//        // Return the customer view with the top-rated menus
//        return view('customer.menus.index', compact('topRatedMenus'));
//    }

//    public function showMenusWithRatings()
// {
//     // Fetch the 3 menus with the highest ratings
//     $menusWithRatings = Menu::select('*')
//                             ->orderByDesc('rating') // Sort by rating in descending order
//                             ->limit(3) // Fetch the top 3
//                             ->get();

//     // Pass the data to the customer menu view
//     return view('customer.menus.index', ['menusWithRatings' => $menusWithRatings]);
// }

}
