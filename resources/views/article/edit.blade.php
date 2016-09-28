@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            修改文章
          </div>
          <div class="panel-body">
            <form class="form-horizontal" action="/articles/{{$id}}" method="POST">
              {{method_field('PUT')}}
              {{csrf_field()}}

              <div class="form-group">
                <label for="first" class="col-sm-2 control-label">标题</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="first" name="first" value="{{$title or ''}}">
                </div>
              </div>
              <div class="form-group">
                <label for="second" class="col-sm-2 control-label">日期</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="second" name="second" value="{{$date or ''}}">
                </div>
              </div>
              <div class="form-group">
                <label for="text" class="col-sm-2 control-label">正文</label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="text" name="text" rows="10">{{htmlspecialchars($article)}}</textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary">确定</button>
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
