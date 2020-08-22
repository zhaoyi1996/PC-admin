<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\AdminRoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function adminAdd( Request $request){
//        dd(11);
        if( $request -> ajax() && $request -> method() == 'POST' )
        {
            # 对参数进行校验
            $admin_name = $request -> post('admin_name')??'';
            if( empty( $admin_name ) ){
                return $this -> fail('管理员名字不能为空');
            }
            $real_name = $request -> post('real_name')??'';
            if( empty( $real_name ) ){
                return $this -> fail('管理员真实名字不能为空');
            }
            $pwd = $request -> post('pwd')??'';
            if( empty( $pwd ) ){
                return $this -> fail('密码不能为空');
            }
            $phone = $request -> post('phone')??'';
            if( empty( $phone ) ){
                return $this -> fail('手机号不能为空');
            }
            $email = $request -> post('email')??'';
            if( empty( $email ) ){
                return $this -> fail('管理员邮箱不能为空');
            }
            $admin_type = $request -> post('admin_type')??2;

            $role = $request ->post('role')??[];
            if( $admin_type  == 2 ){
                if( empty( $role ) ){
                    return $this -> fail('请选择管理员对应的角色');
                }
            }
            # 判断管理员密码不能为空
            $where = [
                [ 'admin_name' , '=' ,$admin_name  ]
            ];

            $admin_model = new AdminModel();

            if( $admin_model -> where( $where ) -> count() > 0 )
            {

                return [
                    'msg' => 1111,
                    'data' => "管理员名字重复，请确认～"
                ];
            }
            $salt = rand(1000,9999);
            $now = time();
            try{
                DB::beginTransaction();
                $admin_new_model = new AdminModel();
                $admin_new_model -> admin_name = $admin_name;
                $admin_new_model -> admn_phone = $phone;
                $admin_new_model -> admin_email = $email;
                $admin_new_model -> admin_pwd = md5($pwd.$salt);
                $admin_new_model -> salt = $salt;
                $admin_new_model -> status = 1;
                $admin_new_model -> ctime = $now;
                $admin_new_model -> admin_type = $admin_type;
                # 保存管理员
                $admin_new_model -> save();
                $admin_id = $admin_new_model -> admin_id;
                if( !$admin_id  )
                {
                    throw new \Exception('管理员表写入失败');
                }
                # 写入管理员和角色的关联关系
                if( $admin_type == 2 ){
                    foreach( $role as $k => $v )
                    {
                        $admin_role_model = new AdminRoleModel();
                        $admin_role_model -> admin_id = $admin_id;
                        $admin_role_model -> role_id = $v;
                        if( !$admin_role_model -> save() ){
                            throw new \Exception('关联表写入失败');
                        }
                    }
                }
                # 提交事务
                DB::commit();
                return [

                    'msg' => 200,
                    'data' => "成功"
                ];
            }catch ( \Exception $e ){
                # 回滚事务
                DB::rollBack();
                $msg = $e ->getMessage();
                 return [
                    'msg' => 10001,
                    'data' => "添加失败"
                ];
            }
        }
        # 需要取出来现在所有的角色和对应的权限
        $role_where = [
            [
                'r.status' , '=' , 1
            ]
        ];

        $role_list = DB::table('rbac_role as r')
            -> where( $role_where )
            -> join( 'rbac_role_power_relation as rpnr', 'r.role_id' , '=' , 'rpnr.role_id' )
            -> join( 'rbac_power_node as rpn', 'rpnr.power_node_id' , '=' , 'rpn.power_node_id' )
            -> get()
            -> toArray();
        $role_list = json_decode(json_encode( $role_list ) , true  );

        $role_new = [];

        foreach( $role_list as $k => $v ){
            if( $v['power_node_level'] == 1 )
            {
                if( !isset($role_new[$v['role_id']])){
                    $role_new[$v['role_id']] = $v;
                }else{
                    $role_new[$v['role_id']]['power_list'][] = $v;
                }
            }else{
                $role_new[$v['role_id']]['power_list'][] = $v;
            }
        }
//        echo '<hr/>';
//        print_r($role_new);
//        exit;
        return view( 'admin.add' , [
            'role_list' => $role_new
        ]);
    }
    public function adminList( Request $request){
//        dd(111);
        if( $request -> ajax() )
        {
            $power = new AdminModel();
            $power_node_list = $power -> paginate( $request -> get('limit') );
            $power_node_list = collect( $power_node_list ) -> toArray();
            $count = $power-> count();
            if( !empty($power_node_list['data']) )
            {
                foreach( $power_node_list['data'] as $k => $v  )
                {
                    $power_node_list['data'][$k]['create_date'] = date('Y-m-d H:i:s' , $v['ctime']);
                    if( $v['status'] == 1 )
                    {
                        $power_node_list['data'][$k]['status_desc'] = '正常' ;
                    }else{
                        $power_node_list['data'][$k]['status_desc'] = '已删除' ;
                    }
                }
            }
            $list = [
                'code' => 0 ,
                'msg' => 'success',
                'count' => $count,
                'data' =>$power_node_list['data']
            ];
            return $list;
        }
        return view('admin.list');
    }
}
