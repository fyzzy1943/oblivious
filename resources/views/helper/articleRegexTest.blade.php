@extends('layout')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            文章正则测试
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
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <textarea class="form-control" id="html_code" rows="5" placeholder="源代码" autofocus></textarea>
                </div>
                <div class="form-group">
                  <textarea class="form-control" id="area_regex" placeholder="区域正则"></textarea>
                </div>
                <div class="form-group">
                  <textarea class="form-control" id="title_regex" placeholder="标题正则"></textarea>
                </div>
                <div class="form-group">
                  <textarea class="form-control" id="date_regex" placeholder="日期正则"></textarea>
                </div>
                <div class="form-group">
                  <textarea class="form-control" id="text_regex" placeholder="正文正则"></textarea>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <textarea class="form-control" id="area_code" rows="9" placeholder="区域源代码" readonly></textarea>
                </div>
                <div class="form-group">
                  <button type="button" class="btn btn-default" id="area_test">区域测试</button>
                </div>
                <div class="form-group">
                  <button type="button" class="btn btn-default" id="title_test">标题测试</button>
                  <button type="button" class="btn btn-default" id="date_test">日期测试</button>
                  <button type="button" class="btn btn-default" id="text_test">正文测试</button>
                </div>
              </div>
            </div>
            <div class="form-group">
              <textarea class="form-control" id="result" rows="7" placeholder="结果" readonly></textarea>
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
    $('#area_test').click(function(){
      $('#result').val('');
      $.post('{{url('regex/article/area_test')}}', {
        _token: '{{csrf_token()}}',
        html: $('#html_code').val(),
        regex: $('#area_regex').val()
      }, function(data, status){
        if (data.message == 'success') {
          $('#area_code').val(data.result);
        } else if (data.message == 'failed') {
          alert(data.result);
        } else {
          alert('failed');
        }
      }, 'json');
    });

    $('#title_test').click(function(){
      $('#result').val('');
      $.post('{{url('regex/article/title_test')}}', {
        _token: '{{csrf_token()}}',
        html: $('#area_code').val(),
        regex: $('#title_regex').val()
      }, function(data, status){
        if (data.message == 'success') {
          $('#result').val(data.result);
        } else if (data.message == 'failed') {
          alert(data.result);
        } else {
          alert('failed');
        }
      }, 'json');
    });

    $('#date_test').click(function(){
      $('#result').val('');
      $.post('{{url('regex/article/date_test')}}', {
        _token: '{{csrf_token()}}',
        html: $('#area_code').val(),
        regex: $('#date_regex').val()
      }, function(data, status){
        if (data.message == 'success') {
          $('#result').val(data.result);
        } else if (data.message == 'failed') {
          alert(data.result);
        } else {
          alert('failed');
        }
      }, 'json');
    });

    $('#text_test').click(function(){
      $('#result').val('');
      $.post('{{url('regex/article/text_test')}}', {
        _token: '{{csrf_token()}}',
        html: $('#area_code').val(),
        regex: $('#text_regex').val()
      }, function(data, status){
        if (data.message == 'success') {
          $('#result').val(data.result);
        } else if (data.message == 'failed') {
          alert(data.result);
        } else {
          alert('failed');
        }
      }, 'json');
    });
  });
</script>
@endsection
