<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountId extends Model
{
    use HasFactory;

    protected $fillable = ['current_id','current_landlord_id'];
}
