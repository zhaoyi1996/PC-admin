<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Link;

class LinkController extends Controller
{
    /**
     * 赵燕晴
     * 友情链接添加页面展示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('links/create');
    }

    /**
     * zhaoyanqing
     * 友情链接列表展示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $list = Link::get();
        return view('links/index',['list'=>$list]);
    }

    public function add(Request $request){
        $res = request()->post('token');
        $data = [
            'l_name'=>request()->post('l_name'),
            'l_url'=>request()->post('l_url')
        ];
        $res = Link::insert($data);
        if($res){
            echo "添加成功";
            return redirect('/links/index');
        }else{
            echo "添加失败";
            return redirect('/links/create');
        }
    }

    public function del($id){
        $id = request()->get('id');
        $res = Link::where([['l_id'=>$id]])->delete();
        if($res){
            echo "删除成功";
            return redirect("/links/index");
        }else{
            echo "删除失败";
            return redirect("/links/index");
        }
    }

    public function edit($id)
    {
        $res = Link::where(['l_id'=>$id])->first();
        return view("/links/edit",['res'=>$res]);
    }

    public function update(Request $request, $id)
    {
        $l_name = $request->post('l_name');
        $l_url = $request->post('l_url');
        $data = [
            'l_name'=>$l_name,
            'l_url'=>$l_url,
        ];
        $res = Link::where(['l_id'=>$id])->update($data);
        //dd($res);
        if($res){
            return redirect("/links/index");
        }
    }
}
