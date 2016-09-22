@extends('layout')

@section('style')
<link href="//cdn.bootcss.com/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      @if (session('info'))
        <div class="alert alert-info col-md-8 col-md-offset-2">
          <strong>提示!</strong>
          <ul>
            @foreach (session('info') as $i)
              <li>{{ $i }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <table id="table_id" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th>一级类别</th>
          <th>二级类别</th>
          <th>序列号</th>
          <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
          <tr>
            <td>{{$category->first}}</td>
            <td>{{$category->second}}</td>
            <td>{{$category->serial}}</td>
            <td>
              <a href="/system/category/{{$category->id}}/edit">修改</a>
              |
              <a href="/system/category/{{$category->id}}">删除</a>
              |
              <a href="/system/rules/create/{{$category->serial}}/{{$category->first}}/{{$category->second}}">规则</a>
              |
              <a href="/system/articles/serial/{{$category->serial}}">文章</a>
              |
              <a href="/update/{{$category->serial}}">更新</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection

@section('script')
<script src="//cdn.bootcss.com/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="//cdn.bootcss.com/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script>
  $(document).ready(function () {
    $('#table_id').DataTable({
      'order': []
    });
  });
</script>
@endsection
