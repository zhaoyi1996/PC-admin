<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
        <ul class="layui-nav layui-nav-tree"  lay-filter="test">
            <li class="layui-nav-item layui-nav-itemed">
                <a class="" href="javascript:;">权限管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="{{url('/powerNode/add')}}">权限添加</a></dd>
                    <dd><a href="{{url('/powerNode/list')}}">权限列表</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item layui-nav-itemed">
                <a class="" href="javascript:;">角色管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="{{url('/role/add')}}">角色添加</a></dd>
                    <dd><a href="{{url('/role/list')}}">角色列表</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item layui-nav-itemed">
                <a class="" href="javascript:;">管理员管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="{{url('/admin/add')}}">管理员添加</a></dd>
                    <dd><a href="{{url('/admin/list')}}">管理员列表</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="">云市场</a></li>
            <li class="layui-nav-item"><a href="">发布商品</a></li>
            <li class="layui-nav-item">
                <a href="javascript:;">友情链接</a>
                <dl class="layui-nav-child">
                    <dd><a href="/links/create">链接添加</a></dd>
                    <dd><a href="/links/index">链接列表</a></dd>
                </dl>
            </li>
        </ul>
    </div>
</div>
<div class="layui-body">
    <!-- 内容主体区域 -->
