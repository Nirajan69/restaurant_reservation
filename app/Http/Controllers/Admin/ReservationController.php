<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // public function index()
    // {
    //     $reservations = Reservation::all();
    //     return view('admin.reservations.index', compact('reservations'));
    // }

    public function index()
{
    $reservations = Reservation::all();  // Retrieve all reservations with feedback
    return view('admin.reservations.index', compact('reservations'));
}


    public function create()
{
    // Fetch the menus from the database
    $menus = Menu::all();

    // Dump the $menus variable to check if it has data
    // dd($menus);

    // Return the view and pass the $menus variable
    return view('customer.reservation.create', compact('menus'));
}

// public function createReservation() {
//     $menus = Menu::all();  // Get all menu items from the database
//     return view('customer.reservation.create', compact('menus'));  // Pass the data to the view
// }


public function createReservation() {
    $menus = Menu::all();  // Fetch menus from the database
    return view('customer.reservation.create', compact('menus'));  // Pass the menus to the view
}


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'phone' => 'required|string|max:15',
    //         'date' => 'required|date|after_or_equal:today',
    //         'time' => 'required',
    //         'guests' => 'required|integer|min:1',
    //     ]);

    //     Reservation::create($request->all());

    //     return redirect()->route('admin.reservations.index')->with('success', 'Reservation created successfully!');
    // }




//     public function store(Request $request)
// {
//     // Validate the request data
//     $request->validate([
//         'name' => [
//             'required',
//             'string',
//             'max:255',
//             'regex:/^[a-zA-Z\s]+$/', // Only allows alphabets and spaces
//         ],
//         'email' => 'required|email|max:255',
//         'phone' => [
//             'required',
//             'string',
//             'max:15',
//             'regex:/^\+?[0-9]{10,15}$/', // Allows digits with optional + prefix (e.g., +1234567890)
//         ],
//         'date' => 'required|date|after_or_equal:today', // Ensures reservation is for today or later
//         'time' => [
//             'required',
//             'regex:/^(?:0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/', // Validates HH:MM format
//         ],
//         'guests' => 'required|integer|min:1|max:20', // Limits guests between 1 and 20
//     ], [
//         'name.regex' => 'The name may only contain letters and spaces.',
//         'phone.regex' => 'The phone number format is invalid. It should contain 10-15 digits, optionally starting with +.',
//         'time.regex' => 'The time must be in the format HH:MM.',
//     ]);

//     // Create a new reservation with validated data
//     Reservation::create($request->all());

//     // Redirect to the reservations index page with a success message
//     return redirect()->route('admin.reservations.index')->with('success', 'Reservation created successfully!');
// }


public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        // Validation rules for name, email, phone, date, time, and guests (from the first store method)
        'name' => [
            'required',
            'string',
            'max:255',
            'regex:/^[a-zA-Z\s]+$/', // Only allows alphabets and spaces
        ],
        'email' => 'required|email|max:255',
        'phone' => [
            'required',
            'string',
            'max:15',
            'regex:/^\+?[0-9]{10,15}$/', // Allows digits with optional + prefix (e.g., +1234567890)
        ],
        'date' => 'required|date|after_or_equal:today', // Ensures reservation is for today or later
        'time' => [
            'required',
            'regex:/^(?:0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/', // Validates HH:MM format
        ],
        'guests' => 'required|integer|min:1|max:20', // Limits guests between 1 and 20

        // Validation rule for reserved_menu (from the second store method)
        'reserved_menu' => 'required', // Validate reserved_menu
    ], [
        // Custom error messages
        'name.regex' => 'The name may only contain letters and spaces.',
        'phone.regex' => 'The phone number format is invalid. It should contain 10-15 digits, optionally starting with +.',
        'time.regex' => 'The time must be in the format HH:MM.',
    ]);

    // Create a new reservation with validated data
    Reservation::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'date' => $request->date,
        'time' => $request->time,
        'guests' => $request->guests,
        'reserved_menu' => $request->reserved_menu, // Save selected menus
    ]);

    // Redirect to the reservations index page with a success message
    return redirect()->route('admin.reservations.index')->with('success', 'Reservation created successfully!');
}

public function edit($id)
{
    // Find the reservation by id
    $reservation = Reservation::find($id);

    // If reservation does not exist, redirect back with an error
    if (!$reservation) {
        return redirect()->route('admin.reservations.index')->with('error', 'Reservation not found');
    }

    // Show the edit view with the reservation data
    return view('admin.reservations.edit', compact('reservation'));
}

public function update(Request $request, $id)
{
    // Find the reservation
    $reservation = Reservation::find($id);

    // If reservation does not exist, redirect back with an error
    if (!$reservation) {
        return redirect()->route('admin.reservations.index')->with('error', 'Reservation not found');
    }

    // Validate the feedback input
    $validated = $request->validate([
        'feedback' => 'nullable|string|max:1000',  // Allow text feedback
    ]);

    // Update feedback field in reservation
    $reservation->feedback = $validated['feedback'] ?? $reservation->feedback;
    $reservation->save();

    // Redirect back to the reservations index with a success message
    return redirect()->route('admin.reservations.index')->with('success', 'Feedback updated successfully');
}




public function destroy($id)
{
    $reservation = Reservation::findOrFail($id);
    $reservation->delete();

    return redirect()->route('admin.reservations.index')->with('success', 'Reservation deleted successfully!');
}


}
