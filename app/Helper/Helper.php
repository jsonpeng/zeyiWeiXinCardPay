<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;
use App\Models\Cities;
use App\Models\Setting;
use App\Models\Project;

function getSettingValueByKey($key){
     // $setting=Setting::where('name',$key)->first();
     // if (empty($setting)) {
     //        $setting = Setting::create(['name' => $key, 'value' => '', 'group' => '', 'des' => '']);
     // }
     // return $setting->value;
     return app('setting')->valueOfKey($key);
}

function getSettingValueByKeyCache($key){
    return Cache::remember('getSettingValueByKey'.$key, Config::get('web.cachetime'), function() use ($key){
        return getSettingValueByKey($key);
    });
}


function funcOpen($func_name)
{
    $config  = Config::get('web.'.$func_name);
    return empty($config) ? false : $config;
}

function funcOpenCache($func_name)
{
    return Cache::remember('funcOpen'.$func_name, Config::get('web.cachetime'), function() use ($func_name){
        return funcOpen($func_name);
    });
}

function arrayToString($re1){
    $str = "";
    $cnt = 0;
    foreach ($re1 as $value)
    {
        if($cnt == 0) {
            $str = $value;
        }
        else{
            $str = $str.','.$value;
        }
        $cnt++;
    }
}

//修改env
function modifyEnv(array $data)
{
    $envPath = base_path() . DIRECTORY_SEPARATOR . '.env';

    $contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));

    $contentArray->transform(function ($item) use ($data){
        foreach ($data as $key => $value){
            if(str_contains($item, $key)){
                return $key . '=' . $value;
            }
        }
        return $item;
    });

    $content = implode($contentArray->toArray(), "\n");

    \File::put($envPath, $content);
}

function array_remove($arr, $key){
    if(!array_key_exists($key, $arr)){
        return $arr;
    }
    $keys = array_keys($arr);
    $index = array_search($key, $keys);
    if($index !== FALSE){
        array_splice($arr, $index, 1);
    }
    return $arr;

}

function get_page_custom_value_by_key($page,$key){
    return Cache::remember('zcjy_custom_page_'.$key.'_'.$page->id, Config::get('web.cachetime'), function() use ($page,$key) {
        $pageItems = $page->pageItems();
        if (empty($pageItems->get())) {
            return '';
        } else {
            if (empty($pageItems->where('key', $key)->first())) {
                return '';
            } else {
                return $pageItems->where('key', $key)->first()->value;
            }
        }
    });
}

function get_post_custom_value_by_key($post,$key){
    return Cache::remember('zcjy_custom_post_'.$key.'_'.$post->id, Config::get('web.cachetime'), function() use ($post,$key) {
        $postItems = $post->items();
        if (empty($postItems->get())) {
            return '';
        } else {
            if (empty($postItems->where('key', $key)->first())) {
                return '';
            } else {
                return $postItems->where('key', $key)->first()->value;
            }
        }
    });
}


//通过admin对象验证路由权限
function varifyAllRouteByAdminObj($admin,$uri){
    $roles=$admin->roles()->get();
    $status=false;
    if(!empty($roles)) {
        foreach ($roles as $item) {
            $perms = $item->perms()->where('name','like','%'.'*'.'%')->get();
            //dd($perms);
            if(!empty($perms)){
                foreach($perms as $perm){
                    //|| strpos($uri,substr($perm->name,0,strlen($perm->name)-5))!==false
                    if(strpos($uri,substr($perm->name,0,strlen($perm->name)-2))!==false){
                        $status=true;
                    }
                }
            }
        }
        return $status;
    }else{
        return false;
    }
}

//通过路由名验证当前登录管理员是否有权限
function varifyAdminPermByRouteName($route_name){
    $admin=Auth::guard('admin')->user();
    $status_perm=true;
    if (!$admin->can($route_name)) {
           // if(!varifyAllRouteByAdminObj($admin,$route_name)) {
                $status_perm=false;
           // }
    }
    return $status_perm;
}

//自动根据tid匹配功能分组或者返回功能个数
function autoMatchRoleGroupNameByTid($tid,$get_length=true){
    $group_func=Config::get('rolesgroupfunc');
    $match_attr=[];
    $length=1;
    foreach ($group_func as $item){
        if($item['tid']==$tid){
            array_push($match_attr,$item['word']);
            $length=$item['length'];
        }
    }
    if($get_length) {
        return $length;
    }else{
        return count($match_attr)?$match_attr[0]:'未命名';
    }
}

function autoReturnGroupByModal($modal_name,$times){
    if($times>1){
        return;
    }
    $group_func=Config::get('rolesgroupfunc');
    $match_word=[];
    foreach ($group_func as $item){
        if($item['modal']==$modal_name){
            array_push($match_word,$item['word']);
        }
        return $match_word;
    }

}

//根据pid获取上级地区的路由
function varifyPidToBackByPid($pid){
    $parent_cities=Cities::find($pid);
    if($parent_cities->level==1){
        return route('cities.index');
    }else{
        $back_cities=Cities::find($pid)->ParentCitiesObj;
        if(!empty($back_cities)) {
            return route('cities.child.index', [$back_cities->id]);
        }
    }
}

//根据地区id返回对应运费模板信息
function getFreightInfoByCitiesId($cities_id){
    $city=Cities::find($cities_id);
    if(!empty($city)) {
        $freigt_tem = $city->freightTems()->get();
        if (!empty($freigt_tem)) {
            $freigt_tem_arr = [];
            $i = 0;
            foreach ($freigt_tem as $item) {
                $freight_type = $item->pivot->freight_type;
                $freight_first_count = $item->pivot->freight_first_count;
                $the_freight = $item->pivot->the_freight;
                $freight_continue_count = $item->pivot->freight_continue_count;
                $freight_continue_price = $item->pivot->freight_continue_price;
                $freigt_tem_arr[$i] = ['name'=>$item->name,'use_default'=>$item->SystemDefault,'freight_type' => $freight_type, 'freight_first_count' => $freight_first_count, 'the_freight' => $the_freight, 'freight_continue_count' => $freight_continue_count, 'freight_continue_price' => $freight_continue_price];
                $i++;
            }
            return $freigt_tem_arr;
        } else {
            return null;
        }
    }else{
        return null;
    }
}

/**
 * 指定位置插入字符串
 * @param $str  原字符串
 * @param $i    插入位置
 * @param $substr 插入字符串
 * @return string 处理后的字符串
 */
function insertToStr($str, $i, $substr){
    //指定插入位置前的字符串
    $startstr="";
    for($j=0; $j<$i; $j++){
        $startstr .= $str[$j];
    }

    //指定插入位置后的字符串
    $laststr="";
    for ($j=$i; $j<strlen($str); $j++){
        $laststr .= $str[$j];
    }

    //将插入位置前，要插入的，插入位置后三个字符串拼接起来
    $str = $startstr . $substr . $laststr;

    //返回结果
    return $str;
}


function getCitiesNameById($cities_id)
{
    $city=Cities::find($cities_id);
    if(!empty($city)) {
        return $city->name;
    }else{
        return null;
    }
}

/**
 * 验证是否展开
 * @return [int] [是否展开tools 0不展开 1展开]
 */
function varifyTools($input,$order=false){
    $tools=0;
    if(count($input)){
        $tools=1;
        if(array_key_exists('page', $input) && count($input)==1) {
            $tools = 0;
        }
        if($order){
            if(array_key_exists('menu_type', $input) && count($input)==1) {
                $tools = 0;
            }
        }
    }
    return $tools;
}

/**
 * 倒序分页显示
 * @parameter [object]
 * @return [array] [desc]
 */
function descAndPaginateToShow($obj){
    if(!empty($obj)){
      return  $obj->orderBy('created_at','desc')->paginate(defaultPage());
    }else{
        return [];
    }
}

/**
 * 默认分页数量
 * @parameter []
 * @return [int] [每页显示数量]
 */
function defaultPage(){
    return empty(getSettingValueByKey('records_per_page')) ? 15 : getSettingValueByKey('records_per_page');
}


//截取内容
function sub_content($str, $num=120){
        global $Briefing_Length;
        mb_regex_encoding("UTF-8");
        $Foremost = mb_substr($str, 0, $num);
        $re = "<(\/?) 
    (P|DIV|H1|H2|H3|H4|H5|H6|ADDRESS|PRE|TABLE|TR|TD|TH|INPUT|SELECT|TEXTAREA|OBJECT|A|UL|OL|LI| 
    BASE|META|LINK|HR|BR|PARAM|IMG|AREA|INPUT|SPAN)[^>]*(>?)";
        $Single = "/BASE|META|LINK|HR|BR|PARAM|IMG|AREA|INPUT|BR/i";

        $Stack = array(); $posStack = array();

        mb_ereg_search_init($Foremost, $re, 'i');

        while($pos = mb_ereg_search_pos()){
            $match = mb_ereg_search_getregs();

            if($match[1]==""){
                $Elem = $match[2];
                if(mb_eregi($Single, $Elem) && $match[3] !=""){
                    continue;
                }
                array_push($Stack, mb_strtoupper($Elem));
                array_push($posStack, $pos[0]);
            }else{
                $StackTop = $Stack[count($Stack)-1];
                $End = mb_strtoupper($match[2]);
                if(strcasecmp($StackTop,$End)==0){
                    array_pop($Stack);
                    array_pop($posStack);
                    if($match[3] ==""){
                        $Foremost = $Foremost.">";
                    }
                }
            }
        }

        $cutpos = array_shift($posStack) - 1;
        $Foremost =  mb_substr($Foremost,0,$cutpos,"UTF-8");
        return strip_tags($Foremost);

}

//截取内容中的图片
function get_content_img($text){   
  
    //取得所有img标签，并储存至二维数组 $match 中   
    preg_match_all('/<img[^>]*>/i', $text, $match);   
      
    return $match;
}

//是否受到限制
function limit($amount,$project_money){

    return $amount < $project_money ? true : false;
}

//替换上传图片的url
function replace_img_url($image_attr){

   return str_replace("../../","/",implode('', $image_attr));
}

/**
 * 获取企业、项目的收藏状态
 * @param  [string] $type        [获取类型]
 * @param  [int]    $id          [对应id]
 * @return [int]                 [状态位]
 */
function getCollectionStatus($type,$id){
    $user = auth('web')->user();
    if($type=='project'){
        return $user->projects()->whereRaw('projects.id = '.$id)->count();
    }else{
        return $user->caompanys()->whereRaw('caompanies.id = '.$id)->count();
    }
}

/**
 * 纠错信息的选项 多少个
 */
function getErrorList(){
      $list= preg_replace("/\n|\r\n/", "_",getSettingValueByKey('error_info_list'));
      $list_arr = explode('_',$list);
      return $list_arr;
}

/**
 * 项目金额的选项 多少个
 */
function projectMoneyList(){
      $list= preg_replace("/\n|\r\n/", "_",getSettingValueByKey('project_money_list'));
      $list_arr = explode('_',$list);
      return $list_arr;
}

function getFrontDefaultPage(){
    return empty(getSettingValueByKey('front_take'))?16:getSettingValueByKeyCache('front_take');
}


function iconv_system($str){   
    global $config; 
    $result = iconv($config['app_charset'], 
    $config['system_charset'], $str); 
      if (strlen($result)==0) {  
           $result = $str; 
       }   
       return $result;
}

