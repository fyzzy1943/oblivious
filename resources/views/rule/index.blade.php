@extends('layout')

@section('style')
<link href="//cdn.bootcss.com/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet"
      xmlns:v-on="http://www.w3.org/1999/xhtml">
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
          <th data-width="15%">一级类别</th>
          <th data-width="15%">二级类别</th>
          <th>网址</th>
          <th data-width="20%">序列号</th>
          <th data-width="10%">自动更新</th>
          <th data-width="18%" data-orderable="false">操作</th>
        </tr>
        </thead>
        <tbody>
          @foreach($rules as $rule)
          <tr>
            <td>{{$rule->first}}</td>
            <td>{{$rule->second}}</td>
            <td>{{$rule->list_url}}</td>
            <td>{{$rule->serial}}</td>
            <td>{{$rule->auto == 1 ? '开启' : '关闭'}}</td>
            <td>
              <a href="{{url('rules/'.$rule->id)}}">详情</a>
              |
              <a href="{{url('rules/'.$rule->id.'/edit')}}">修改</a>
              |
              <a href="#" v-on:click="rDestroy({{$rule->id}}, '{{$rule->first.'-'.$rule->second}}')">删除</a>
              |
              <a href="/articles/serial/{{$rule->serial}}">文章</a>
              |
              <a href="/update/{{$rule->serial}}">更新</a>
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
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">删除确认</h4>
      </div>
      <div class="modal-body">
        <p>真的要删除 <b>@{{rule_name}}</b> 吗？</p>
      </div>
      <div class="modal-footer">
        <form action="/rules/@{{ rule_id }}" method="POST">
          {{csrf_field()}}
          {{method_field('DELETE')}}

          <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          <button type="submit" class="btn btn-danger">删除</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

@section('script')
<script src="//cdn.bootcss.com/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="//cdn.bootcss.com/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="//cdn.bootcss.com/vue/1.0.27/vue.min.js"></script>

<script>
  $(document).ready( function () {
    $('#table_id').DataTable({
      'order': []
    });
  });

  var vm = new Vue({
    el: 'body',
    data: {
      rule_id: '',
      rule_name: ''
    },
    methods: {
      rDestroy: function(id, name) {
        this.rule_id = id;
        this.rule_name = name;
        $('#destroy_modal').modal('show');
      }
    }
  });
</script>
@endsection
