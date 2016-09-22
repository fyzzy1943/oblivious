@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-info">
          <div class="panel-heading">
            更新规则
          </div>
          <div class="panel-body">
            {{$url}}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
