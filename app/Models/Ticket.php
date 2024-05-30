<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'client', 
        'ticket_type', 
        'description', 
        'assign_to', 
        'labels'
    ];
}
