@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <form>
          <div class="form-group">
            <textarea class="form-control" readonly>{{$title}}</textarea>
          </div>
          <div class="form-group">
            <textarea class="form-control" readonly>{{$date}}</textarea>
          </div>
          <div class="form-group">
            <textarea class="form-control" rows="20" readonly>{{$article}}</textarea>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
