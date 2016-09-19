@extends('layout')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            文章正则测试
          </div>
          <div class="panel-body">
            @if(count($errors) > 0)
              <div class="alert alert-warning col-md-8 col-md-offset-2">
                <strong>warning!</strong>
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form method="post" action="/helper/regex/article">
              {{csrf_field()}}

              <div class="form-group">
                <textarea class="form-control" name="html" placeholder="html源代码" rows="5">{{old('html')}}</textarea>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="area_regex" placeholder="区域正则">{{old('area_regex')}}</textarea>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="title_regex" placeholder="标题">{{old('title_regex')}}</textarea>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="date_regex" placeholder="日期">{{old('date_regex')}}</textarea>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="text_regex" placeholder="正文">{{old('text_regex')}}</textarea>
              </div>
              <div class="form-group">
                <textarea class="form-control" placeholder="抓取结果" rows="5" readonly>{{ $result or '' }}</textarea>
              </div>
              <div class="form-group">
                <button class="btn btn-primary pull-right">测试</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection