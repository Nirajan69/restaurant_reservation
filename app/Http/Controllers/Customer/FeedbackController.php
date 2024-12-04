<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'restaurant_rating' => 'required|integer|between:1,5',
            'restaurant_feedback' => 'required|string',
        ]);

        $menuRatings = [];
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'rating_')) {
                $menuId = str_replace('rating_', '', $key);
                $menuRatings[$menuId] = $value;
            }
        }

        $feedback = Feedback::create([
            'reservation_id' => $validated['reservation_id'],
            'restaurant_rating' => $validated['restaurant_rating'],
            'restaurant_feedback' => $validated['restaurant_feedback'],
            'menu_ratings' => !empty($menuRatings) ? json_encode($menuRatings) : null,
        ]);

        return redirect()->route('customer.feedback.confirm', ['feedback' => $feedback->id]);
    }

    public function confirm($id)
    {
        $feedback = Feedback::with('reservation')->findOrFail($id);
        return view('customer.reservation.confirm', compact('feedback'));
    }
}
