@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-info">
          <div class="panel-heading">
            <div class="panel-title">添加黑名单</div>
          </div>
          <div class="panel-body">
            <div class="row">
              @if (count($errors) > 0)
                <div class="alert alert-danger col-md-10 col-md-offset-1">
                  <strong>错误!</strong>
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
            </div>
            <form class="form-horizontal" action="/block_urls" method="POST">
              {{csrf_field()}}

              <div class="form-group">
                <label for="url" class="col-sm-2 control-label">网址</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="url" name="url" value="{{old('url')}}">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-9">
                  <button type="submit" class="btn btn-primary">确定</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
