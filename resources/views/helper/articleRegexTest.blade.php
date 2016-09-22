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
                  <textarea class="form-control" id="html_code" rows="3" placeholder="文章页源代码"></textarea>
                </div>
                <div class="form-group">
                  <input class="form-control" id="area_regex" placeholder="文章区域正则">
                </div>
                <div class="form-group">
                  <input class="form-control" id="title_regex" placeholder="标题正则">
                </div>
                <div class="form-group">
                  <input class="form-control" id="date_regex" placeholder="日期正则">
                </div>
                <div class="form-group">
                  <input class="form-control" id="text_regex" placeholder="正文正则">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <textarea class="form-control" id="area_code" rows="5" placeholder="区域源代码"></textarea>
                </div>
                <button type="button" class="btn btn-default" id="area_test">区域测试</button>
              </div>
            </div>
            <div class="form-group">
              <textarea class="form-control" id="result" placeholder="结果"></textarea>
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
      $.post('/regex/article/area_test', {
        _token: '{{csrf_token()}}',
        html: $('#html_code').val(),
        regex: $('#area_regex').val()
      }, function(data, status){
        if (data.message == 'success') {
          $('#area_code').val(data.result);
        } else {
          alert(data.message);
        }
      }, 'json');
    });
  });
</script>
@endsection
