@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="panel-title">修改用户</div>
          </div>
          <div class="panel-body">
            <form class="form-horizontal" action="/system/users/{{$id}}" method="POST">
              {{method_field('PUT')}}
              {{csrf_field()}}

              <div class="form-group">
                <label for="first" class="col-sm-2 control-label">昵称</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="first" name="first" value="{{old('nickname')}}">
                </div>
              </div>
              <div class="form-group">
                <label for="second" class="col-sm-2 control-label">账号</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="second" name="second" value="{{old('name')}}">
                </div>
              </div>
              @if (count($errors) > 0)
                <div class="alert alert-danger col-md-9 col-md-offset-2">
                  <strong>warning!</strong>
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary">确定</button>
                  <a href="/system/category" class="btn btn-default">返回</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
