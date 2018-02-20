<?php

namespace App\Repositories;

use App\Models\Feeds;
use InfyOm\Generator\Common\BaseRepository;

class FeedsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'name',
        'url'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Feeds::class;
    }
}
