<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roster extends Model
{
    use HasFactory;

    function room() {
        return $this->hasOne(Room::class, "id", 'room_id');
    }
    
    function user() {
        return $this->hasOne(User::class, "id", 'admin_id');
        
    }
}
