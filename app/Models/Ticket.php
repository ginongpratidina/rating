<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'noticket';  //it's important to initiate PK if your PK's name doesn't meet the name convention 
}
