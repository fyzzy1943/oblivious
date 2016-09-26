@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
          <div class="panel-heading">
            修改规则
          </div>
          <div class="panel-body">
            <form class="form-horizontal" action="{{url('rules/'.$id)}}" method="POST">
              {{csrf_field()}}
              {{method_field('PUT')}}

              <div class="form-group">
                <label for="serial" class="col-sm-2 control-label">序列号</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="serial" name="serial" value="{{$serial ?? ''}}" readonly>
                </div>
              </div>

              @include('rule._form')
              <div class="form-group">
                <label class="col-sm-2 control-label">自动更新</label>
                <div class="col-sm-9">
                  <label class="radio-inline">
                    <input type="radio" name="auto" value="1" @if($auto) checked @endif> 开启
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="auto" value="0" @if(!$auto) checked @endif> 关闭
                  </label>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-9">
                  <div class="pull-right">
                    <a href="#" onclick="history.back(-1);" class="btn btn-default">返回</a>
                    <button type="submit" class="btn btn-primary">修改</button>
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
