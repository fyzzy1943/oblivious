@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel @if (count($errors)>0) panel-danger @else panel-info @endif">
          <div class="panel-heading">
            添加更新规则
          </div>
          <div class="panel-body">
            <form class="form-horizontal" action="/rules" method="POST">
              {{csrf_field()}}
              <div class="form-group">
                <label for="serial" class="col-sm-2 control-label">序列号</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="serial" name="serial" value="{{old('serial')}}">
                </div>
              </div>
              <div class="form-group">
                <label for="url" class="col-sm-2 control-label">网址</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="url" name="url" value="{{old('url')}}">
                </div>
              </div>
              <div class="form-group">
                <label for="url_area" class="col-sm-2 control-label">网址区域</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="url_area" name="url_area" value="{{old('url_area')}}">
                </div>
              </div>
              <div class="form-group">
                <label for="url_rule" class="col-sm-2 control-label">网址获取规则</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="url_rule" name="url_rule" value="{{old('url_rule')}}">
                </div>
              </div>
              <div class="form-group">
                <label for="content_area" class="col-sm-2 control-label">内容区域</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="content_area" name="content_area" value="{{old('content_area')}}">
                </div>
              </div>
              <div class="form-group">
                <label for="title_rule" class="col-sm-2 control-label">标题规则</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="title_rule" name="title_rule" value="{{old('title_rule')}}">
                </div>
              </div>
              <div class="form-group">
                <label for="date_rule" class="col-sm-2 control-label">日期规则</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="date_rule" name="date_rule" value="{{old('date_rule')}}">
                </div>
              </div>
              <div class="form-group">
                <label for="article_rule" class="col-sm-2 control-label">文章规则</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="article_rule" name="article_rule" value="{{old('article_rule')}}">
                </div>
              </div>
              @if (count($errors) > 0)
                <div class="alert alert-danger col-md-9 col-md-offset-2">
                  <strong>错误!</strong>
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-default">确定</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
