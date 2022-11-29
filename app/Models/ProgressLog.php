<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressLog extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'ticket_id->enabled',
    ];    
}
