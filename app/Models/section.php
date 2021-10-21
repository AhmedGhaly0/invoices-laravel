<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class section extends Model
{
    use HasFactory;
    protected $table = 'sections';
    protected $fillable =[
        'name',
        'desc',
        'created_by',
    ];
    // public function product(){
    //     return $this->hasMany(Products::class);
    // }
}
