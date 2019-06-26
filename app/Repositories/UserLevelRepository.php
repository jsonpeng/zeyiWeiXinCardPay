<?php

namespace App\Repositories;

use App\Models\UserLevel;
use InfyOm\Generator\Common\BaseRepository;
use Carbon\Carbon;
use App\User;

/**
 * Class UserLevelRepository
 * @package App\Repositories
 * @version March 19, 2018, 6:49 am UTC
 *
 * @method UserLevel findWithoutFail($id, $columns = ['*'])
 * @method UserLevel find($id, $columns = ['*'])
 * @method UserLevel first($columns = ['*'])
*/
class UserLevelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'amount',
        'price',
        'rate'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserLevel::class;
    }

    /**
     * 获取会员列表 默认忽略注册会员
     * @return [type] [description]
     */
    public function getMemberList(){
        return UserLevel::where('name','<>','注册会员')->where('is_delete',null)->orderBy('price','asc')->get();
    }

    /**
     * 获取升级的会员列表通过当前的访问金额
     * @param  [type] $amount [description]
     * @return [type]         [description]
     */
    public function getUpdateListByAmount($amount){
         return UserLevel::where('amount','>',$amount)->where('is_delete',null)->orderBy('price','asc')->get();
    }


    /**
     * [获取升级的会员列表通过当前的访问金额细则]
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
    public function getUpdateListDetail($amount,$user){
        $list=UserLevel::where('amount','>',$amount)->where('is_delete',null)->orderBy('price','asc')->get();
        if(count($list)){
            #购买的时间
            $buy_time= $user->member_buy_time;
            
            #过期时间
            $end_time=$user->member_end_time;

            #已经使用的天数
            $days=Carbon::parse($buy_time)->diffInDays(Carbon::now());

            #过期的天数 大于0等于0就过期不计算
            $guoqi=Carbon::parse($end_time)->diffInDays(Carbon::now(),false);

            //$days= round((strtotime("now") - strtotime($buy_time))/60/60/24);
            $old_userlevel=UserLevel::find($user->user_level);
            

            #如果过期或者没有的话
            if(empty($old_userlevel) || $guoqi>=0){
                 #原来会员的价格重置为0
                 $old_userlevel_price=0;
            }else{
                #原来会员的价格
                $old_userlevel_price=$old_userlevel->price;
            }

            //dd($old_userlevel_price);

            #折算比例
            $bili=round(((365-$days)/365),4);
                

            #折算价格
            $count_price=$old_userlevel_price*$bili;

            $list=$list->toArray();

            foreach ($list as $k => $v) {
                $list[$k]['old_price']=$list[$k]['price'];
                $list[$k]['count_price']=round($count_price);
                # 升级的价格
                $list[$k]['price'] -=$count_price;
                $list[$k]['price'] =round($list[$k]['price']);
            }
           return $list;
        }else{
            return [];
        }
    }

    /**
     * 恢复或者删除会员
     * @param  [type] $user_level    [description]
     * @return [type]                [description]
     */
    public function actionUserLevelDelOrRec($user_level,$action='delete'){
        $user_level_id=$user_level->id;
        $delete_status=1;
        $users=User::where('user_level',$user_level_id)->get();

        #删除
        if($action=='delete'){

            if(count($users)){

                 foreach ($users as $k => $user) {
              
                    app('user')->resetUserLevel($user);
                      
                }

            }

        }
        else{
           #恢复
            if(count($users)){
                foreach ($users as $k => $user) {
              
                app('user')->updateUserLevel($user,$user_level_id);

                }
            }

             $delete_status=null;

        }

        return $user_level->update([
            'is_delete'=>$delete_status
        ]);


    }
}
