@extends('layout')

@section('style')
  <link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
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
        <table id="table_id" class="table table-striped table-bordered">
          <thead>
          <tr>
            <th data-width="50%">标题</th>
            <th data-width="15%">分类</th>
            <th data-width="10%">日期</th>
            <th data-width="10%">更新时间</th>
            <th data-width="15%" data-orderable="false">操作</th>
          </tr>
          </thead>
          <tbody>
          @foreach($articles as $article)
            <tr>
              <td title="{{$article->title}}">{{str_limit($article->title, 65, ' [...]')}}</td>
              <td>{{$article->first.'-'.$article->second}}</td>
              <td>{{ltrim($article->date, '发布时间：')}}</td>
              <td>{{$article->created_at->format('Y-m-d')}}</td>
              <td>
                <a href="/articles/{{$article->id}}/review">审查</a>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection

@section('script')
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
  <script>
    $(document).ready( function () {
      $('#table_id').DataTable({
        'order': []
      });
    } );
  </script>
@endsection
