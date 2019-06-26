<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Log;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'nickname',
        'mobile',
        'user_level',
        'openid',
        'head_image',
        'member_buy_time',
        'member_end_time',
        'share_qcode',
        'distribut_money',
        'is_distribute',
        'leader1',
        'distribute_time',
        'share_time'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //收藏的项目
    public function projects(){
         return $this->belongsToMany('App\Models\Project', 'project_user', 'user_id','project_id');
    }
    
    //发布的项目
    public function project(){
        return $this->hasMany('App\Models\Project');
    }

    //发布的企业
    public function caompany(){
        return $this->hasMany('App\Models\Caompany');
    }

    //收藏的企业
    public function caompanys(){
        return $this->belongsToMany('App\Models\Caompany','caompany_user','user_id','caompany_id');
    }

    //会员等级
    public function userlevel(){
        return $this->belongsTo('App\Models\UserLevel','user_level','id');
    }



    //分享二维码
    public function getErweimaAttribute(){

        $path='qrcodes/'.$this->id.'.png';

        if(!file_exists(public_path($path))){
            $url='http://'.$_SERVER['HTTP_HOST'].'?share_id='.$this->id;
            Log::info($url);
            \QrCode::format('png')->size(300)->generate($url,public_path($path));
        }

        return  '/'.$path;
    }

  
     

}
