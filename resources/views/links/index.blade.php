@include('public/header')
@include('public/left')

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 基本的表格</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<table class="table">
    <caption></caption>
    <thead>
    <tr>
        <th>链接ID</th>
        <th>链接名称</th>
        <th>网址</th>
        <th>操作</th>
    </tr>
    </thead>
    @foreach($list as $k => $v)
    <tbody>
    <tr>
        <td>{{$v->l_id}}</td>
        <td>{{$v->l_name}}</td>
        <td>{{$v->l_url}}</td>
        <td><a href="{{url('/links/del/'.$v->l_id)}}">删除</a>
            <a href="{{url('/links/edit/'.$v->l_id)}}">编辑</a>
        </td>
    </tr>
    </tbody>
    @endforeach
</table>

</body>
</html>

@include('public/footer')
