@extends('layout')

@section('style')
<link href="//cdn.bootcss.com/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      @if (session('info'))
        <div class="row">
          <div class="alert alert-info col-md-8 col-md-offset-2">
            <strong>提示!</strong>
            <ul>
              @foreach (session('info') as $i)
                <li>{{ $i }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif
      <table id="table_id" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th>昵称</th>
          <th>账号</th>
          <th>邮箱</th>
          <th>权限</th>
          <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
          <tr>
            <td>{{$user->nickname}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role}}</td>
            <td>
              <a href="/system/users/{{$user->id}}/edit">修改</a>
              |
              <a href="#" onclick="user_destroy({{$user->id}}, '{{$user->name}}')">删除</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="destroy_modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        删除确认
      </div>
      <div class="modal-body">
        <p>真的要删除 <span id="destroy_span" class="label label-default"></span> 吗？</p>
      </div>
      <div class="modal-footer">
        <form id="destroy_form" action="" method="POST">
          {{csrf_field()}}
          {{method_field('DELETE')}}

          <button type="submit" class="btn btn-danger pull-right">删除</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

@section('script')
<script src="//cdn.bootcss.com/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="//cdn.bootcss.com/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>

<script>
  $(document).ready( function () {
    $('#table_id').DataTable();
  });

  function user_destroy(id, name) {
    $('#destroy_span').text(name);
    $('#destroy_form').attr('action', '/system/users/'+id);
    $('#destroy_modal').modal('show');
  }
</script>
@endsection
