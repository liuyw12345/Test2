<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Admin extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable ;

    protected $table="admin";
    protected $fillable = [
        'account','password','quanxian'
    ];
    /**
     * 获取会储存到 jwt 声明中的标识
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * 返回包含要添加到 jwt 声明中的自定义键值对数组
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return ["role"=>"admins"];
    }

    /**
     * 查询该工号是否已经注册
     * @param $request
     * @return false
     */
    public static function checknumber($account)
    {
        try{
            $count = Admin::select('account')
                ->where('account',$account)
                ->count();
            return $count;
        }catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }

    /**
     * @param $account
     * @return false|void
     */
    public static function createUser($registeredInfo)
    {
        try {
            $student_id = Admin::create([
                'account' => $registeredInfo['account'],
                'password' => $registeredInfo['password'],
                'quanxian' => $registeredInfo['quanxian'],
            ])->id;
            return $student_id;
        } catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }


}
