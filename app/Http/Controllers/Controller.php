<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use InfyOm\Generator\Utils\ResponseUtil;
use Response;
use Illuminate\Support\Facades\Artisan;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //清空缓存
    public function clearCache()
    {
    Artisan::call('cache:clear');
    return ['status'=>true,'msg'=>''];
    }

    //前端用户信息
    public function user(){

    	return auth('web')->user();

    }

    //当前前端用户访问金额
    public function amount(){

    	return $this->user()->userlevel()->first()->amount;

    }

    //会员等级
    //如果没买会员（是默认的注册会员返回false）
    //如果买过会员 提示升级返回true
    public function userlevel(){

        $userlevel=$this->user()->userlevel()->first();

        if($userlevel->name=='注册会员'){
            return false;
        }else{
            return true;
        }
    }

  /**
    * 默认ajax操作通过Repository对象
    * @param  [object]   $repo_obj [Repository对象]
    * @param  [array]    $input    [input的提交vale]
    * @param  [string]   $action   [动作(store添加 update更新 delete删除)]
    * @param  [int]      $id       [需要操作的id]
    */
   public function defaultAjaxActionByRepo($repo_obj,$input,$action='store',$id=null,$admin=false){
    #过滤管理员操作及点赞踩
    if(!$admin && !array_key_exists('dianzan', $input) && !array_key_exists('cai', $input)){
            $input['user_id']=$this->user()->id;
    }
    
    $input =array_filter($input, function($v, $k) {
            return $v != '';
        }, ARRAY_FILTER_USE_BOTH);
  
        #创建操作
        if($action=='store'){
            $create_success_obj=($repo_obj->model())::create($input);

            #如果涉及到图片添加
            
             #企业图片
             if(array_key_exists('company_images',$input)){
                 if(!empty($input['company_images'])){
                    $repo_obj->syncImages($input['company_images'],$create_success_obj->id);
                }
            }

            #项目图片
            if(array_key_exists('project_images',$input)){
                  if(!empty($input['project_images'])){
                    $repo_obj->syncImages($input['project_images'],$create_success_obj->id);
                }
            }

            return ['code'=>0,'message'=>'操作成功'];
        }

        $obj=$repo_obj->findWithoutFail($id);
        if(!empty($obj)){
            #更新操作
            if($action=='update'){
                $obj->update($input);

                #如果涉及到图片更新
                
                    #企业图片
                    if(array_key_exists('company_images',$input)){
                        if(!empty($input['company_images'])){
                            $repo_obj->syncImages($input['company_images'],$id,true);
                        }

                    }

                    #项目图片
                    if(array_key_exists('project_images',$input)){
                          if(!empty($input['project_images'])){
                                $repo_obj->syncImages($input['project_images'],$id,true);
                        }
                    }

            }

            #删除操作
            if($action=='delete'){
                $repo_obj->delete($id);
            }

            if($action=='show'){
                return ['code'=>0,'message'=>$obj];
            }

            #如果涉及到行业选择
            if(array_key_exists('industries',$input)){
              if(!empty($input['industries'])){
                  $obj->industries()->sync([$input['industries']]);
              }
            }

            return ['code'=>0,'message'=>'操作成功'];

        }else{

            return ['code'=>1,'message'=>'没有找到相关信息'];

        }
   }

   //获取错误信息列表
   public function getErrorList(){
      $list= preg_replace("/\n|\r\n/", "_",getSettingValueByKey('error_info_list'));
      $list_arr = explode('_',$list);
      return $list_arr;
   }
   
}
