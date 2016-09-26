@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
          <div class="panel-heading">
            新建规则
          </div>
          <div class="panel-body">
            <form class="form-horizontal" action="{{url('rules')}}" method="POST">
              {{csrf_field()}}

              @include('rule._form')

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-9">
                  <div class="pull-right">
                    <a href="#" onclick="history.back(-1);" class="btn btn-default">返回</a>
                    <button type="submit" class="btn btn-primary">新建</button>
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
