<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'description', 'ingredients', 'is_veg', 'image','rating',
    ];

    // Reservations relationship
    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'menu_reservation', 'menu_id', 'reservation_id')
                    ->withTimestamps();
    }

    // Feedbacks relationship
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'menu_id', 'id'); // Foreign key: menu_id
    }

    // Calculate average rating
    // public function getAverageRatingAttribute()
    // {
    //     $menuRatings = $this->feedbacks->pluck('menu_ratings'); // JSON ratings field
    //     $ratings = collect();

    //     foreach ($menuRatings as $menuRating) {
    //         $decoded = json_decode($menuRating, true); // Decode JSON
    //         if (is_array($decoded) && isset($decoded[$this->id])) {
    //             // Add rating only if for this menu
    //             $ratings->push($decoded[$this->id]);
    //         }
    //     }

    //     return $ratings->avg() ?: 'No Ratings'; // Return average or default
    // }


}
