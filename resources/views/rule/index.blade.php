@extends('layout')

@section('style')
  <link href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <table id="table_id" class="row-border">
          <thead>
          <tr>
            <th>一级类别</th>
            <th>二级类别</th>
            <th>网址</th>
            <th>序列号</th>
            <th>操作</th>
          </tr>
          </thead>
          <tbody>
          @foreach($rules as $rule)
            <tr>
              <td>{{$rule->category->first}}</td>
              <td>{{$rule->category->second}}</td>
              <td>{{$rule->url}}</td>
              <td>{{$rule->serial}}</td>
              <td>详情|修改|删除</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection

@section('script')
  <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready( function () {
      $('#table_id').DataTable();
    } );
  </script>
@endsection
