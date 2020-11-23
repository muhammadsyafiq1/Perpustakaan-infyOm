<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Borrow
 * @package App\Models
 * @version July 10, 2020, 9:24 am UTC
 *
 * @property \App\Models\Book $book
 * @property \App\Models\User $user
 * @property integer $user_id
 * @property integer $book_id
 * @property string $date
 */
class Borrow extends Model
{
    use SoftDeletes;

    public $table = 'borrow';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    static function announ()
    {
        $borrow = Borrow::where(['status' => 'inapprove'])->count();
        if($borrow > 0) {
            return $borrow;
        }
    }

    public $fillable = [
        'user_id',
        'book_id',
        'date',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'book_id' => 'integer',
        'date' => 'date',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'book_id' => 'required',
        'date' => 'required',
        'status' => 'in:approve,inapprove'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function book()
    {
        return $this->belongsTo(\App\Models\Book::class, 'book_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
