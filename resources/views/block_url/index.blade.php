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
        <a href="/block_urls/create" class="btn btn-primary">新建</a><hr>
        <table id="table_id" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>网址</th>
            <th>创建人</th>
            <th>创建时间</th>
            <th>是否启用</th>
            <th>操作</th>
          </tr>
          </thead>
          <tbody>
          @foreach($blocks as $block)
            <tr>
              <td>{{$block->url}}</td>
              <td>{{get_username_by_uid($block->uid)}}</td>
              <td>{{$block->created_at}}</td>
              <td>{{$block->enabled}}</td>
              <td>
                <a href="#" onclick="user_destroy({{$block->id}}, '{{$block->url}}')">删除</a>
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
      $('#destroy_form').attr('action', '/block_urls/'+id);
      $('#destroy_modal').modal('show');
    }
  </script>
@endsection
