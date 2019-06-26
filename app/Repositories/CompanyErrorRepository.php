<?php

namespace App\Repositories;

use App\Models\CompanyError;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CompanyErrorRepository
 * @package App\Repositories
 * @version March 26, 2018, 1:29 am UTC
 *
 * @method CompanyError findWithoutFail($id, $columns = ['*'])
 * @method CompanyError find($id, $columns = ['*'])
 * @method CompanyError first($columns = ['*'])
*/
class CompanyErrorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'reason',
        'company_id',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CompanyError::class;
    }
}
