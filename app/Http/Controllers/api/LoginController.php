<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\aliyun_sms\api_demo\SmsDemo;
use App\Http\api\CommonController;
use App\ParamMsg\Error;
use App\Model\User;
class LoginController extends Controller
{

    //执行登录
    public function login(Request $request)
    {
        $phone=$this->checkParamIsEmpty('phone');
        $password=$this->checkParamIsEmpty('password');
//        dump($password);
//        dump($phone);die;
        $res=User::where('phone',$phone)->first();
        if($res){
            if($res['password']!=$password){
                $err=[
                    'status'=>100,
                    'msg'=>"账号密码错误",
                ];
                return $err;
            }else{
                //密码正确 返回200状态码,将用户id和token存入session
                $token=md5(time());
                $success=[
                    'status'=>200,
                    'msg'=>"登陆成功",
                    "uid"=>$res['uid'],
                    "token"=>$token
                ];
                //更新用户token
                $upd_token=User::where('uid',$res['uid'])->update(['token'=>$token]);
                //将用户ID和TOKEN存入session
                $userInfo=[
                    "uid"=>$res['uid'],
                    "token"=>$token
                ];
                session(['userInfo'=>$userInfo]);
                return $success;
            }
        }else{
            $err=[
                'status'=>100,
                'msg'=>"账号密码错误",
            ];
            return $err;
        }
    }
    protected function checkParamIsEmpty( $key )
    {

        # 接受客户端传递的参数
        $request_data = request() -> all();

        # 判断是否传递参数
        if( empty( $request_data[$key] ) ){

            # 给出对应的提示
            return $this -> fail( $this -> getErrorMsg( $key ), 1000 );

        }else{

            # 没有问题的时候，返回对应的值
            return $request_data[$key];
        }

    }
    /**
     * 获取对应的错误提示信息
     */
    public function getErrorMsg( $key )
    {
        $error_all = Error::MSG;

        if( isset( $error_all[$key]) ){
            $error_msg = $error_all[$key];
        }else{
            $error_msg = '出现错误了';
        }
        return $error_msg;
    }

    protected function  fail( $msg = 'fail' , $status = 1 , $data = [] )
    {
        $arr =  $this -> jsonOutPut( $status , $msg , $data );

//        return response( $arr );
//        return response($arr);
        echo json_encode($arr ,  JSON_UNESCAPED_UNICODE );
        exit;
    }

    private function jsonOutPut( $status , $msg , $data )
    {

        return [
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        ];
    }
}
