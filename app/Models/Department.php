<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable  = [
        'name_uz',
        'name_en',
        'name_ru',
    ];

    public function positions()
    {
        return $this->hasMany(Position::class,'department_id','id');
    }

     public function requests()
    {
        return $this->hasMany(Request::class,'department_id','id');
    }
}
