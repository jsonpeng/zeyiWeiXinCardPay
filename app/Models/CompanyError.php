<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CompanyError
 * @package App\Models
 * @version March 26, 2018, 1:29 am UTC
 *
 * @property string reason
 * @property number company_id
 */
class CompanyError extends Model
{
    use SoftDeletes;

    public $table = 'company_errors';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'reason',
        'company_id',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'reason' => 'string',
        'company_id' =>'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function company(){

        return $this->hasOne('App\Models\Caompany','id','company_id');
        
    }



    
}
