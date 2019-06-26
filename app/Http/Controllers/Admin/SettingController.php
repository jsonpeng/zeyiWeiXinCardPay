<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Repositories\SettingRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Setting;
use Config;

use App\Models\Admin;

class SettingController extends AppBaseController
{
    /** @var  SettingRepository */
    private $settingRepository;

    public function __construct(SettingRepository $settingRepo)
    {
        $this->settingRepository = $settingRepo;
    }

    /**
     * 打开网站设置页面
     * @return [type] [description]
     */
    public function setting()
    {
        return view('admin.common.settings.index');
    }
    
    /**
     * 更新设置信息
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function update(Request $request)
    {
        try {
            $inputs = $request->all();
            if(array_key_exists('consume_credits',$inputs)){
                if($inputs['consume_credits']>100){
                    return ['code' => 1, 'message' => '比例不可以大于100'];
                }
            }
            if(array_key_exists('credits_max',$inputs)){
                if($inputs['credits_max']>100){
                    return ['code' => 1, 'message' => '比例不可以大于100'];
                }
            }
            // modifyEnv(['PROMPS_PAGE'=>$page_list]);
            //return $inputs;
            foreach ($inputs as $key => $value) {
                $setting = $this->settingRepository->settingByKey($key);
                if(strpos($key,'email')!==false && $key!='order_notify_email'){
                    modifyEnv([autoVarifyMailName($key)=>$value]);
                }
                $setting->update(['value' => $value]);
            }
            return ['code' => 0, 'message' => '成功'];
        } catch (Exception $e) {
            return ['code' => 1, 'message' => '未知错误'];
        }
        
    }
    
    public function edit_pwd(){
        $user=Admin::find(1);
        return view('admin.edit_pwd.index')
                ->with('user',$user);
    }

    public function edit_pwd_api($id,Request $request){
        $user=Admin::find($id);
        $pwd=$request->get('passwords');
        $pwd_re=$request->get('newpassword');
        if($pwd==$pwd_re){
            $user->update(['password'=>\Hash::make($pwd)]);
            Flash::success('密码修改成功');

            return redirect('/zcjy');
        }else{
            Flash::error('两次密码输入不一致');
            return redirect(route('settings.edit_pwd'));
        }
    }


}
