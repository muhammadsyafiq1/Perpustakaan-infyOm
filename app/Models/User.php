<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 * @package App\Models
 * @version July 10, 2020, 2:09 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $borrows
 * @property string $name
 * @property string $email
 * @property string|\Carbon\Carbon $email_verified_at
 * @property string $password
 * @property string $remember_token
 */
class User extends Model
{
    use SoftDeletes;

    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'nationality',
        'no_hp',
        'bod',
        'current_school',
        'registered',
        'exp_resgiter',
        'age',
        'address',
        'class',
        'roles',
        'image',
        'gender'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'remember_token' => 'string',
        'nationality' =>'string',
        'no_hp'  => 'string',
        'bod' => 'date',
        'current_school' => 'string',
        'registered' => 'date',
        'exp_resgiter' => 'date',
        'age' => 'integer',
        'address' => 'string',
        'class' => 'string',
        'image' => 'string',
        'gender' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required',
        'no_hp'  => 'required',
        'age' => 'required',
        'address' => 'required',
        'gender' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function borrows()
    {
        return $this->hasMany(\App\Models\Borrow::class, 'user_id');
    }
}
