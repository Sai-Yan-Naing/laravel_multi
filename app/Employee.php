<?php

    namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;

    class Employee extends Authenticatable
    {
        use Notifiable;

        protected $guard = 'employee';

        protected $fillable = [
            'staffid','first_name', 'last_name', 'email', 'password', 'department', 'phone', 'address','company_id'
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
        public function full_name()
        {
           return "{$this->first_name} {$this->last_name}";
        }
        public function company()
        {
            return $this->belongsTo('App\Company','company_id');
        }
    }
