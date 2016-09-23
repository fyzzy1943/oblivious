@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel @if (count($errors)>0) panel-danger @else panel-info @endif">
          <div class="panel-heading">
            更新规则添加@if(!empty($first)) {!!'-><b>'.$first.'</b>'!!} @endif @if(!empty($second)) {!!'-><b>'.$second.'</b>'!!} @endif
          </div>
          <div class="panel-body">
            <form class="form-horizontal" action="{{url('system/rules')}}" method="POST">
              {{csrf_field()}}

              <div class="form-group">
                <label for="serial" class="col-sm-2 control-label">序列号</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="serial" name="serial" value="{{old('serial', $serial ?? '')}}" readonly>
                </div>
              </div>
              <div class="form-group">
                <label for="url" class="col-sm-2 control-label">网址</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="url" name="url" value="{{old('url')}}">
                </div>
              </div>
              <div class="form-group">
                <label for="regex_area" class="col-sm-2 control-label">网址区域</label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="regex_area" name="regex_area"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="regex_url" class="col-sm-2 control-label">网址获取规则</label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="regex_url" name="regex_url"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="regex_article" class="col-sm-2 control-label">内容区域</label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="regex_article" name="regex_article"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="regex_title" class="col-sm-2 control-label">标题规则</label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="regex_title" name="regex_title"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="regex_date" class="col-sm-2 control-label">日期规则</label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="regex_date" name="regex_date"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="regex_text" class="col-sm-2 control-label">正文规则</label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="regex_text" name="regex_text"></textarea>
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
                <div class="col-sm-offset-2 col-sm-9">
                  <div class="pull-right">
                    <a href="#" onclick="history.back(-1);" class="btn btn-default">返回</a>
                    <button type="submit" class="btn btn-primary">确定</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
