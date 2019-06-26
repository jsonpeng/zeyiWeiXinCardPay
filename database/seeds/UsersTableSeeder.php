<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\UserLevel;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('user_levels')->delete();

        $user_level1 = UserLevel::create([
            'name' => '注册会员',
            'amount' => 0,
            'price' => 100,
            'rate' => 10,
        ]);

        $user2 = User::create([
            'name' => '管理员测试用户',
            'nickname' => '管理员',
            'mobile' => '18717160163',
            'email' => '18717160163@qq.com',
            'openid' => 'odh7zsgI75iT8FRh0fGlSojc9PWM',
            'password'=>Hash::make('123456*'),
            'user_level' => $user_level1->id
        ]);
    }
}
