<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Step 1: Show the reservation form (name, email, phone, date, time, guests).
     */
    public function stepOne()
    {
        return view('customer.reservation.stepOne');
    }
    public function create()
{
    return redirect()->route('customer.reservation.stepOne');
}


    /**
     * Step 1: Store the reservation data (name, email, phone, date, time, guests).
     */
    // public function storeStepOne(Request $request)
    // {
    //     // Validate the incoming data
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'phone' => 'required|string|max:15',
    //         'date' => 'required|date|after_or_equal:today',
    //         'time' => 'required',
    //         'guests' => 'required|integer|min:1',
    //     ]);

    //     // Create a new reservation with the provided details
    //     $reservation = Reservation::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'date' => $request->date,
    //         'time' => $request->time,
    //         'guests' => $request->guests,
    //     ]);

    //     // Redirect to the next step (menu selection page)
    //     return redirect()->route('customer.reservation.stepTwo', $reservation->id);
    // }

    // Inside ReservationController

public function storeStepOne(Request $request)
{
    $request->validate([
        // 'name' => 'required|string|max:255',
        // 'email' => 'required|email|max:255',
        // 'phone' => 'required|string|max:15',
        'date' => 'required|date|after_or_equal:today',
        'time' => 'required',
        'guests' => 'required|integer|min:1',
    ]);

    // Store reservation data
    $reservation = Reservation::create([
        'name' => Auth::user()->name,  // Logged-in user's name
        'email' => Auth::user()->email,  // Logged-in user's email
        'phone' => 'N/A',  // Default phone number, you can change this as needed
        'date' => $request->date,
        'time' => $request->time,
        'guests' => $request->guests,
    ]);

    // Redirect to Step 2 with the reservationId
    return redirect()->route('customer.reservation.stepTwo', ['reservationId' => $reservation->id]);
}


    /**
     * Step 2: Show the menu selection page.
     */
    // public function stepTwo($reservationId)
    // {
    //     // Fetch the reservation and available menus
    //     $reservation = Reservation::findOrFail($reservationId);
    //     $menus = Menu::all(); // Get all menus

    //     return view('customer.reservation.stepTwo', compact('reservation', 'menus'));
    // }


    // Inside ReservationController

// public function stepTwo($reservationId)
// {
//     // Fetch the reservation and available menus
//     $reservation = Reservation::findOrFail($reservationId);
//     $menus = Menu::all();  // Fetch all menus

//     // Pass the reservation and menus to the view
//     return view('customer.reservation.stepTwo', compact('reservation', 'menus'));
// }


// app/Http/Controllers/Customer/ReservationController.php

public function stepTwo($reservationId)
{
    // Fetch the reservation
    $reservation = Reservation::findOrFail($reservationId);




    // $tables = Table::all();
    // return view('customer.reservation.stepTwo', compact('tables', 'menus'));


    // Get the number of guests for the reservation
    $guests = $reservation->guests;

    // Fetch tables that can accommodate the number of guests or more
    $tables = Table::where('members', '>=', $guests)->get(); // Use 'members' instead of 'number_of_members'

    $menus = Menu::all(); // Fetch menus

    // Pass the reservation and tables to the view
    return view('customer.reservation.stepTwo', compact('reservation', 'tables', 'menus'));
}




    /**
     * Step 2: Store selected menus for the reservation.
     */
    // public function storeStepTwo(Request $request, $reservationId)
    // {
    //     // Find the reservation
    //     $reservation = Reservation::findOrFail($reservationId);

    //     // Validate the selected menus
    //     $request->validate([
    //         'reserved_menu' => 'required|array|min:1', // Ensure at least one menu is selected
    //     ]);

    //     // Sync the selected menus with the reservation (many-to-many relationship)
    //     $reservation->menus()->sync($request->reserved_menu);

    //     // Redirect to the thank you page after completing the reservation
    //     return redirect()->route('customer.reservation.thankyou', $reservationId);
    // }


    // Inside ReservationController

    // public function storeStepTwo(Request $request, $reservationId)
    // {
    //     // Find the reservation
    //     $reservation = Reservation::findOrFail($reservationId);

    //     // Validate the table selection
    //     $request->validate([
    //         'table_id' => 'required|exists:tables,id',  // Assuming your table table name is 'tables'
    //     ]);

    //     // Store the selected table in the reservation
    //     $reservation->table_id = $request->table_id;
    //     $reservation->save();

    //     // Redirect to the confirmation page or next step
    //     return redirect()->route('customer.reservation.thankyou', $reservation->id);
    // }



    // app/Http/Controllers/Customer/ReservationController.php

// public function storeStepTwo(Request $request, $reservationId)
// {
//     // Find the reservation
//     $reservation = Reservation::findOrFail($reservationId);

//     // Validate the table selection
//     $request->validate([
//         'table_id' => 'required|exists:tables,id',  // Ensure the table exists in the 'tables' table
//     ]);

//     // Store the selected table in the reservation
//     $reservation->table_id = $request->table_id;
//     $reservation->save();  // Save the table selection

//     // Redirect to the Thank You page (we're not going to Step 3)
//     return redirect()->route('customer.reservation.thankyou', $reservation->id);
// }


// public function storeStepTwo(Request $request, $reservationId)
// {
//     // Find the reservation
//     $reservation = Reservation::findOrFail($reservationId);

//     // Validate the table selection and ensure the selected menus are passed correctly
//     $request->validate([
//         'table_id' => 'required|exists:tables,id',  // Ensure the table exists in the 'tables' table
//         'selected_menus' => 'required|string',     // Ensure menus are passed as a string (JSON)
//     ]);

//     // Store the selected table in the reservation
//     $reservation->table_id = $request->table_id;

//     // Decode the selected menus JSON string
//     $selectedMenus = json_decode($request->selected_menus, true);

//     // Validate that the decoded selected menus are an array and not empty
//     if (!is_array($selectedMenus) || empty($selectedMenus)) {
//         return redirect()->back()->withErrors(['selected_menus' => 'Please select at least one menu.']);
//     }

//     // Attach the selected menus to the reservation
//     foreach ($selectedMenus as $menu) {
//         $reservation->menus()->attach($menu['id']);  // Attach each menu using its ID
//     }

//     // Save the reservation with the table selection
//     $reservation->save();

//     // Redirect to the Thank You page
//     return redirect()->route('customer.reservation.thankyou', $reservation->id);
// }

public function storeStepTwo(Request $request, $reservationId)
{
    // Find the reservation
    $reservation = Reservation::findOrFail($reservationId);

    // Validate the table selection and ensure the selected menus are passed correctly
    $request->validate([
        'table_id' => 'required|exists:tables,id',  // Ensure the table exists in the 'tables' table
        'selected_menus' => 'required|string',     // Ensure menus are passed as a string (JSON)
    ]);

    // Store the selected table in the reservation
    $reservation->table_id = $request->table_id;

    // Decode the selected menus JSON string
    $selectedMenus = json_decode($request->selected_menus, true);

    // Validate that the decoded selected menus are an array and not empty
    if (!is_array($selectedMenus) || empty($selectedMenus)) {
        return redirect()->back()->withErrors(['selected_menus' => 'Please select at least one menu.']);
    }

    // Sync the selected menus with the reservation
    $reservation->menus()->sync(array_column($selectedMenus, 'id'));

    // Save the reservation with the table selection
    $reservation->save();

    // Redirect to the Thank You page
    return redirect()->route('customer.reservation.thankyou', $reservation->id);
}



    /**
     * Thank you page after reservation is successfully made.
     */
    // public function thankyou($id)
    // {
    //     // Fetch the reservation from the database
    //     $reservation = Reservation::findOrFail($id);

    //     // Display the thank you page with the reservation details
    //     return view('customer.reservation.thankyou', compact('reservation'));
    // }


    public function thankyou($id)
{
    // Fetch the reservation along with associated menus using Eager Loading
    $reservation = Reservation::with('menus')->findOrFail($id);

    // Display the thank you page with the reservation details and menus
    return view('customer.reservation.thankyou', compact('reservation'));
}




}
