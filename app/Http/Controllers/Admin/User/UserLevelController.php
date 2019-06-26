<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Requests\CreateUserLevelRequest;
use App\Http\Requests\UpdateUserLevelRequest;
use App\Repositories\UserLevelRepository;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Carbon\Carbon;

/**
 * 包含用户管理及会员管理
 */
class UserLevelController extends AppBaseController
{
    /** @var  UserLevelRepository */
    private $userLevelRepository;
    private $userRepository;
    public function __construct(UserLevelRepository $userLevelRepo,UserRepository $userRepo)
    {
        $this->userLevelRepository = $userLevelRepo;
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the UserLevel.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->userLevelRepository->pushCriteria(new RequestCriteria($request));
        $userLevels=$this->defaultSearchState($this->userLevelRepository->model());        
        $input=$request->all();
        $input =array_filter( $input, function($v, $k) {
            return $v != '';
        }, ARRAY_FILTER_USE_BOTH );
        $tools=$this->varifyTools($input);

        if(array_key_exists('name', $input)){
            $userLevels=$userLevels->where('name','like','%'.$input['name'].'%');
        }
        if(array_key_exists('amount_start',$input)){
            $userLevels = $userLevels->where('amount', '>=', $input['amount_start']);
        }
        if(array_key_exists('amount_end',$input)){
            $userLevels = $userLevels->where('amount', '<=', $input['amount_end']);
        }
        if(array_key_exists('price_start',$input)){
            $userLevels = $userLevels->where('price', '>=', $input['price_start']);
        }
        if(array_key_exists('price_end',$input)){
            $userLevels = $userLevels->where('price', '<=', $input['price_end']);
        }
        #删除和没被删除过的
        if(!array_key_exists('is_delete',$input)){
            $userLevels = $userLevels->where('is_delete',null);
        }else{
            $userLevels = $userLevels->where('is_delete',1);
        }

        $userLevels = $this->descAndPaginateToShow($userLevels);
        return view('admin.user_levels.index')
               ->with('userLevels', $userLevels)
               ->with('tools',$tools)
               ->with('input',$input);
    }

    //用户列表
    public function userIndex(Request $request){
        $users=$this->defaultSearchState($this->userRepository->model()); 
        $userLevels=$this->userLevelRepository->all();       
        $input=$request->all();
        $input =array_filter( $input, function($v, $k) {
            return $v != '';
        }, ARRAY_FILTER_USE_BOTH );
        $tools=$this->varifyTools($input);

        if(array_key_exists('name', $input)){
            $users=$users->where('nickname','like','%'.$input['name'].'%');
        }

        if(array_key_exists('user_level',$input)){
            if(!empty($input['user_level'])){
            $users=$users->where('user_level',$input['user_level']);
        }
        }

         if(array_key_exists('mobile', $input)){
            $users=$users->where('mobile','like','%'.$input['mobile'].'%');
        }

        if(array_key_exists('distribut_money',$input)){
            if(!empty($input['distribut_money'])){
                $users=$users->orderBy('distribut_money',$input['distribut_money']);
            }
        }

        $users = $this->descAndPaginateToShow($users);
        return view('admin.user.index')
               ->with('users', $users)
               ->with('tools',$tools)
               ->with('input',$input)
               ->with('userLevels',$userLevels);
    }


    //编辑用户
    public function userEdit(Request $request,$user_id){
        $users=$this->userRepository->findWithoutFail($user_id);        
        $user_levels=$this->userLevelRepository->all();
        $input = $request->all();
        #分享人 购买人
        $share_users=$this->userRepository->shareAndBuyUserListPaginate($users,'share');
        $buy_users=$this->userRepository->shareAndBuyUserListPaginate($users,'buy');
        
        return view('admin.user.edit')
               ->with('user_levels',$user_levels)
               ->with('users', $users)
               ->with('share_users',$share_users)
               ->with('buy_users',$buy_users)
               ->with('input',$input);
    }

    //更新用户操作
    public function userUpdate(Request $request,$user_id){
       $input=$request->all();
       $user = $this->userRepository->findWithoutFail($user_id);
       $userLevel = $this->userLevelRepository->findWithoutFail($input['user_level']);

       if (empty($user) || empty($userLevel)) {
            Flash::error('没有找到该用户');
            return redirect(route('users.index'));
        }

        #如果更新了会员等级了的话 更新时间
        if($user->user_level != $input['user_level'] && $userLevel->name !='注册会员'){
            app('user')->updateUserLevel($user,$input['user_level']);
        }

        #如果取消会员 重置时间
        if($userLevel->name == '注册会员'){
          app('user')->resetUserLevel($user);
        }

        //dd($input);

        $user=$user->update($input);

        Flash::success('更新成功.');
        
        return redirect(route('users.index'));
    }

    //删除用户操作
    public function userDelete(Request $request,$user_id){
        $user = $this->userRepository->findWithoutFail($user_id);
        if (empty($user)) {
            Flash::error('没有找到该用户');

            return redirect(route('users.index'));
        }
        $this->userRepository->delete($user_id);

        Flash::success('删除成功');

        return redirect(route('users.index'));
    }

    /**
     * Show the form for creating a new UserLevel.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.user_levels.create');
    }

    /**
     * Store a newly created UserLevel in storage.
     *
     * @param CreateUserLevelRequest $request
     *
     * @return Response
     */
    public function store(CreateUserLevelRequest $request)
    {
        $input = $request->all();

        $userLevel = $this->userLevelRepository->create($input);

        Flash::success('创建成功.');

        return redirect(route('userLevels.index'));
    }

    /**
     * Show the form for editing the specified UserLevel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userLevel = $this->userLevelRepository->findWithoutFail($id);

        if (empty($userLevel)) {
            Flash::error('没有找到该会员');

            return redirect(route('userLevels.index'));
        }

        return view('admin.user_levels.edit')->with('userLevel', $userLevel);
    }

    /**
     * Update the specified UserLevel in storage.
     *
     * @param  int              $id
     * @param UpdateUserLevelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserLevelRequest $request)
    {
        $userLevel = $this->userLevelRepository->findWithoutFail($id);

        if (empty($userLevel)) {
            Flash::error('没有找到该会员');

            return redirect(route('userLevels.index'));
        }

        $userLevel = $this->userLevelRepository->update($request->all(), $id);

        Flash::success('更新成功');

        return redirect(route('userLevels.index'));
    }

    /**
     * Remove the specified UserLevel from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy(Request $request,$id)
    {
        $userLevel = $this->userLevelRepository->findWithoutFail($id);

        //$input=$request->all();

        if (empty($userLevel)) {
            Flash::error('没有找到该会员');

            return redirect(route('userLevels.index'));
        }

      
    
         $this->userLevelRepository->actionUserLevelDelOrRec($userLevel);
         Flash::success('删除成功,可通过下方恢复列表恢复');
         return redirect(route('userLevels.index'));
        
        

        
    }

    public function recorver($id){
         $userLevel = $this->userLevelRepository->findWithoutFail($id);

          

            if (empty($userLevel)) {
                Flash::error('没有找到该会员');

            return redirect(route('userLevels.index'));
            }
              $this->userLevelRepository->actionUserLevelDelOrRec($userLevel,'add');
              Flash::success('恢复成功,请在会员列表查看');
             return redirect(route('userLevels.index').'?is_delete=true');
    }
}
