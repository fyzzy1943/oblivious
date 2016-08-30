@extends('layout')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-info">
        <div class="panel-heading">
          添加人员
        </div>
        <div class="panel-body">
          <form class="form-horizontal">
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">姓名</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="name" name="name">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">确定</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection