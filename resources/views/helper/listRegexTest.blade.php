@extends('layout')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading">
          列表正则测试
        </div>
        <div class="panel-body">
          @if(count($errors) > 0)
            <div class="alert alert-warning col-md-8 col-md-offset-2">
              <strong>warning!</strong>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <div class="col-md-6">

            <div class="form-group">
              <input type="text" class="form-control" id="url" placeholder="网址">
            </div>
            <div class="form-group">
              <textarea class="form-control" id="html_code" placeholder="html源代码" rows="10"></textarea>
            </div>
            <div class="form-group input-group">
              <input type="text" class="form-control" id="area_regex" placeholder="区域正则">
              <span class="input-group-btn">
                <button class="btn btn-default" id="area_test" type="button">区域测试</button>
              </span>
            </div>
            <div class="form-group input-group">
              <input type="text" class="form-control" id="list_regex" placeholder="列表正则">
              <span class="input-group-btn">
                <button class="btn btn-default" id="list_test" type="button">列表测试</button>
              </span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <textarea class="form-control" id="area_code" placeholder="区域结果" rows="8" readonly></textarea>
            </div>
            <div class="form-group">
              <textarea class="form-control" id="list_result" placeholder="列表结果" rows="8" readonly></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script>
  $(document).ready(function () {
    $('#area_test').click(function () {
      $.post('{{url('regex/list/area_test')}}', {
        _token: '{{csrf_token()}}',
        html: $('#html_code').val(),
        regex: $('#area_regex').val()
      }, function (data, status) {
        if (data.message == 'success') {
          $('#area_code').val(data.result);
        } else {
          alert(data.message);
        }
      }, 'json');
    });

    $('#list_test').click(function () {
      $.post('{{url('regex/list/list_test')}}', {
        _token: '{{csrf_token()}}',
        url: $('#url').val(),
        html: $('#area_code').val(),
        regex: $('#list_regex').val()
      }, function (data, status) {
        if (data.message == 'success') {
          $('#list_result').val(data.result);
        } else {
          alert(data.message);
        }
      }, 'json');
    });
  });
</script>
@endsection
