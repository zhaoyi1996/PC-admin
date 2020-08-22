<?php

namespace App\Http\Controllers\api;
/**
 * 所有控制器的父类
 */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\ApiException;
class CommonController extends Controller
{
    //接口调用成功后 返回的状态信息
    public function success($data = [],$status = 200 ,$msg = 'success'){
        return [
            'status'=>$status,
            'data'=>$data,
            'msg'=>$msg
        ];
    }
    public function checkApiParam($key){
        $request=request();
        if(empty($value=$request->post($key))){
            throw new ApiException("缺少参数".$key);
        }
        return $value;
    }
    //检测用户的令牌
    public function CheckUserToken(){
        $request=request();
        $user_id=$request->post('user_id');
        $token=$request->post('token');
        if(empty($user_id)) {
            throw new ApiException('用户ID不能为空');
        }
    }
}
