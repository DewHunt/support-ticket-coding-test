<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {
    use HasFactory;

    protected $table = "tickets";

    protected $fillable = ['user_id', 'title', 'description', 'status'];

    protected $hidden = ['created_at', 'updated_at'];
}
