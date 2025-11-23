<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'check_in',
        'many_room',
        'check_out',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'transaction_id', 'id');
    }

    public function getRoomNumbersAttribute()
    {
        if (!$this->room_id) return null;
        $roomIds = explode(', ', $this->room_id);
        return \App\Models\Room::whereIn('id', $roomIds)->pluck('number')->implode(', ');
    }

    public function getRoomTypesAttribute()
    {
        if (!$this->room_id) return null;
        $roomIds = explode(', ', $this->room_id);
        return \App\Models\Room::whereIn('id', $roomIds)
            ->with('roomType')
            ->get()
            ->pluck('roomType.name')
            ->implode(', ');
    }
}
