<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rules\Unique;

/**
 * Class Book
 * @package App\Models
 * @version July 9, 2020, 8:41 am UTC
 *
 * @property \App\Models\Category $category
 * @property integer $category_id
 * @property string $title
 * @property string $author
 * @property string $cover
 * @property string $description
 * @property integer $stock
 */
class Book extends Model
{
    use SoftDeletes;

    public $table = 'books';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'category_id',
        'title',
        'author',
        'description',
        'stock',
        'cover',
        'created_by',
        'updated_by',
        'slug',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'title' => 'string',
        'author' => 'string',
        'description' => 'string',
        'stock' => 'integer',
        'cover' => 'string',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'slug' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'category_id' => 'required',
        'title' => 'required|unique:books',
        'author' => 'required',
        'description' => 'required',
        'stock' => 'required',
        'status' => 'in:active,inactive',
        'cover' => 'mimes:png,jpg,jpeg'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }
}
