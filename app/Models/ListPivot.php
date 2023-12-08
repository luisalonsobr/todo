<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListPivot extends Model
{
    use HasFactory;
    use Uuids;

    protected $fillable = ['list_id', 'user_id'];

}
