@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
           审核文章
          </div>
          <div class="panel-body">
            <form class="form-horizontal" action="/articles/{{$id}}/review" method="POST">
              {{method_field('PUT')}}
              {{csrf_field()}}

              <div class="form-group">
                <label for="title" class="col-sm-2 control-label">标题</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="title" name="title" value="{{$title or ''}}">
                </div>
              </div>
              <div class="form-group">
                <label for="date" class="col-sm-2 control-label">日期</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="date" name="date" value="{{$date or ''}}">
                </div>
              </div>
              <div class="form-group">
                <label for="article" class="col-sm-2 control-label">正文</label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="article" name="article" rows="10">{{htmlspecialchars($article)}}</textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary">审核</button>
                  <a href="#" onclick="history.back(-1)" class="btn btn-default">返回</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
