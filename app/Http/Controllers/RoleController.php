<?php

namespace App\Http\Controllers;

use App\Models\PowerNodeModel;
use App\Models\RoleModel;
use App\Models\RolePowerNodeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * 角色的添加
     */
    public function roleAdd( Request $request )
    {
        # 如果是提交数据，把数据入库
        if( $request -> ajax() && $request -> method() == 'POST' )
        {
//            dd($request->all());
            # 接受数据，把数据写入数据库
            $role_name = $request -> post('role_name')??'';

            # 判断数据是否为空
            if( empty( $role_name ) ){
                return $this -> fail('角色名称不能为空');
            }
            # 判断状态是不是为空
            $role_status = $request -> post('status')??2;
            if( empty( $role_status ) ){
                return $this -> fail('请选择状态');
            }
            # 接受权限节点
            $power_node = $request -> post('like')??'';
            if( empty($power_node) ){
                return $this -> fail('请选择该角色对应对权限节点');
            }
            # 把数据库入库 1、写入角色的数据  2、写入角色和权限节点的数据
            # 开启事务  try catch 是php关于异常处理
            try{
                # 开启事务
                DB::beginTransaction();
                # 写入角色表的数据
                $role_model = new RoleModel();
                $role_model -> role_name = $role_name;
                $role_model -> status = $role_status;
                $role_model -> ctime = time();
                if( $role_model -> save()){
                    $role_id = $role_model -> role_id;
                }else{
                    throw new \Exception('写入角色表失败');
                }
                # 写入角色和权限节点的数据
                foreach( $power_node as $k => $v )
                {
                    $model = new RolePowerNodeModel();
                    $model -> role_id = $role_id;
                    $model -> power_node_id = $v;

                    if( !$model -> save() ){
                        throw new \Exception('写入角色表失败');
                    }
                }
                # 提交事务
                DB::commit();
                return $this -> success();
            }catch (\Exception $e){
                # 回滚事务
                DB::rollBack();
                # 取出错误信息
//                return $this -> fail( $e -> getMessage() );
            }
        }
        # 获取当前所有的权限节点
        $power_node = $this ->getAllPowerNode();
        return view('role.add',[
            'all_node' => $power_node
        ]);
    }
    /**
     * 获取所有的权限节点
     */
    private function getAllPowerNode( )
    {
        $power_node_model = new PowerNodeModel();
        $where = [
            [ 'status' , '=' , 1 ]
        ];
        $obj = $power_node_model -> where( $where ) -> get();
        $power_node_list = collect( $obj ) -> toArray();
        $all_node = [];
        foreach( $power_node_list as $k => $v ){
            if( $v['power_node_pid'] == 0 ){
                $all_node[$v['power_node_id']] = $v;
            }else{
                $all_node[$v['power_node_pid']]['son'][] = $v;
            }
        }
        return $all_node;
    }
    public function roleList( Request $request)
    {
        if( $request -> ajax() )
        {
            $power = new RoleModel();
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
        return view('role.list');
    }
}
