@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel @if (count($errors)>0) panel-danger @else panel-info @endif">
          <div class="panel-heading">
            修改类别
          </div>
          <div class="panel-body">
            <form class="form-horizontal" action="/system/category/{{$id}}" method="POST">
              {{method_field('PUT')}}
              {{csrf_field()}}

              <div class="form-group">
                <label for="first" class="col-sm-2 control-label">一级类别</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="first" name="first" value="{{old('first', $first)}}">
                </div>
              </div>
              <div class="form-group">
                <label for="second" class="col-sm-2 control-label">二级类别</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="second" name="second" value="{{old('second', $second)}}">
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
