<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable=[
        'supName',
        'email',
        'address',
        'telephone',
    ];

    public function stocks(){
        return $this->hasMany(Stock::class);
    }

}
