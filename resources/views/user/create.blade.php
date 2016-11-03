@extends('layout')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-info">
        <div class="panel-heading">
          <div class="panel-title">添加用户</div>
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

            @include('user._form')
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
