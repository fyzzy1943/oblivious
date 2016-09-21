@extends('layout')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-info">
        <div class="panel-heading">
          添加用户
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
          <form class="form-horizontal" action="/system/users" method="POST">
            {{csrf_field()}}

            <div class="form-group">
              <label for="nickname" class="col-sm-2 control-label">昵称</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="nickname" name="nickname" value="{{old('nickname')}}">
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">账号</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
              </div>
            </div>
            <div class="form-group">
              <label for="password" class="col-sm-2 control-label">密码</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="password" name="password">
              </div>
            </div>
            <div class="form-group">
              <label for="repeat" class="col-sm-2 control-label">密码确认</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="repeat" name="repeat">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">角色</label>
              <div class="col-sm-9">
                <div class="radio">
                  <label>
                    <input type="radio" name="role" value="user" @if (check_value(old('role'), 'user|')) checked @endif>
                    普通用户
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="role" value="regex" @if ('regex'==old('role')) checked @endif>
                    更新管理员
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="role" value="admin" @if ('admin'==old('role')) checked @endif>
                    管理员
                  </label>
                </div>
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