@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel @if (count($errors)>0) panel-danger @else panel-info @endif">
          <div class="panel-heading">
            修改@if(!empty($first)) {!!'-><b>'.$first.'</b>'!!} @endif @if(!empty($second)) {!!'-><b>'.$second.'</b>'!!} @endif
          </div>
          <div class="panel-body">
            <form class="form-horizontal" action="/system/rules/{{$id}}" method="POST">
              {{csrf_field()}}
              {{method_field('PUT')}}

              @include('rule._form')

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
