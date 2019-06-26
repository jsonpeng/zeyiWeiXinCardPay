<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserLevel
 * @package App\Models
 * @version March 19, 2018, 6:49 am UTC
 *
 * @property string name
 * @property integer amount
 * @property float price
 * @property integer rate
 */
class UserLevel extends Model
{
    use SoftDeletes;

    public $table = 'user_levels';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'amount',
        'price',
        'rate',
        'is_delete'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'amount' => 'integer',
        'price' => 'float',
        'rate' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'amount' => 'required',
        'price' => 'required',
        'rate' => 'required'
    ];

    //用户
    public function users(){
        return $this->hasMany('App\User','id','user_level');
    }

    public function getUsersListAttribute(){
        $users=$this->users()->get();
        $str='';
        if(count($users)){
            foreach ($users as $k => $v) {
                $str .=$v->nickname.',';
            }
        }else{
            return $str;
        }
    }
    
}
