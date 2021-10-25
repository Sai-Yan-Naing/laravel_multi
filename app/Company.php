<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'address'
    ];
    public function employees()
    {
        return $this->hasMany('App\Employee','company_id');
    }
}
