<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
        <ul class="layui-nav layui-nav-tree"  lay-filter="test">
            <li class="layui-nav-item layui-nav-itemed">
                <a class="" href="javascript:;">商品管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="{:url('/business_admin/Goods/goodsList')}">商品列表</a></dd>
                    <dd><a href="{:url('/business_admin/Goods/goodsAdd')}">商品添加</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">解决方案</a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;">列表一</a></dd>
                    <dd><a href="javascript:;">列表二</a></dd>
                    <dd><a href="">超链接</a></dd>
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