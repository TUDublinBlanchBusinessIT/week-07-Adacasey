<?php

namespace App\Repositories;

use App\Models\permissions;
use App\Repositories\BaseRepository;

/**
 * Class permissionsRepository
 * @package App\Repositories
 * @version April 29, 2026, 11:24 pm UTC
*/

class permissionsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'guard_name'
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
        return permissions::class;
    }
}
