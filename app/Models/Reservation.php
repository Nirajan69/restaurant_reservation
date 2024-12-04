<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',      // Customer name
        'email',     // Customer email
        'phone',     // Customer phone
        'date',      // Reservation date
        'time',      // Reservation time
        'guests',    // Number of guests
'table_id',
    ];

    // app/Models/Reservation.php

public function table()
{
    return $this->belongsTo(Table::class);
}
public function menus()
{
    return $this->belongsToMany(Menu::class, 'menu_reservation', 'reservation_id', 'menu_id')
                ->withTimestamps();
}




}
