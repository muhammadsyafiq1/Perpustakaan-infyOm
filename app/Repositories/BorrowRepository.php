<?php

namespace App\Repositories;

use App\Models\Borrow;
use App\Repositories\BaseRepository;

/**
 * Class BorrowRepository
 * @package App\Repositories
 * @version July 10, 2020, 9:24 am UTC
*/

class BorrowRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'book_id',
        'date'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Borrow::class;
    }
}
