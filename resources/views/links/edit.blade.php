@include('public/header')
@include('public/left')

<div style="margin-top: 10px"></div>
<form class="layui-form" action="{{url('/links/update').'/'.$res->l_id}}" method="post">
    @csrf
    <div class="layui-form-item">
        <label class="layui-form-label">链接名称</label>
        <div class="layui-input-inline">
            <input type="text" name="l_name" required  lay-verify="required" value="{{$res->l_name}}"
                   placeholder="请输入链接名称" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">网址</label>
        <div class="layui-input-inline">
            <input type="text" name="l_url" required  lay-verify="required" value="{{$res->l_url}}"
                   placeholder="请输入网址" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <input type="submit" value="修改" class="layui-btn" lay-submit lay-filter="formDemo">
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>


@include('public/footer')
