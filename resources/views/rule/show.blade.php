@extends('layout')

@section('style')
<style>
  th,.panel-heading{text-align:center;}
</style>
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
          <div class="panel-heading" style="font-weight: bold">
            {{$first}} - {{$second}} - {{$serial}}
          </div>
          <div class="panel-body">
            <table class="table table-bordered">
              <thead>
              <tr>
                <th colspan="2">列表页信息</th>
              </tr>
              </thead>
              <tr>
                <td>网址</td>
                <td>{{$list_url}}</td>
              </tr>
              <tr>
                <td>区域正则</td>
                <td>{{$regex_url_area}}</td>
              </tr>
              <tr>
                <td>列表正则</td>
                <td>{{$regex_url_list}}</td>
              </tr>
            </table>

            <table class="table table-bordered">
              <thead>
              <tr>
                <th colspan="2">内容页信息</th>
              </tr>
              </thead>
              <tr>
                <td>区域正则</td>
                <td>{{$regex_article}}</td>
              </tr>
              <tr>
                <td>标题正则</td>
                <td>{{$regex_title}}</td>
              </tr>
              <tr>
                <td>日期正则</td>
                <td>{{$regex_date}}</td>
              </tr>
              <tr>
                <td>文章正则</td>
                <td>{{$regex_text}}</td>
              </tr>
            </table>

            <table class="table table-bordered">
              <thead>
              <tr>
                <th colspan="4">相关人员信息</th>
              </tr>
              </thead>
              <tr>
                <td>创建人</td>
                <td>{{get_username_by_uid($created_uid)}}</td>
                <td>最后更新人</td>
                <td>{{get_username_by_uid($updated_uid)}}</td>
              </tr>
              <tr>
                <td>创建时间</td>
                <td>{{$created_at}}</td>
                <td>最后更新时间</td>
                <td>{{$updated_at}}</td>
              </tr>
              <tr>
                <td>审核负责人</td>
                <td>{{get_username_by_uid($review_uid)}}</td>
                <td>更新负责人</td>
                <td>{{get_username_by_uid($update_wheel_uid)}}</td>
              </tr>
            </table>

            <table class="table table-bordered">
              <thead>
              <tr>
                <th colspan="4">其他信息</th>
              </tr>
              </thead>
              <tr>
                <td>总计抓取次数</td>
                <td>{{$regex_times}} 次</td>
                <td>总计更新次数</td>
                <td>{{$update_times}} 次</td>
              </tr>
              <tr>
                <td>文章总数</td>
                <td>{{$articles_count}} 篇</td>
                <td colspan="2"></td>
              </tr>
            </table>

            <table class="table table-bordered">
              <thead>
              <tr>
                <th>操作</th>
              </tr>
              </thead>
              <tr>
                <td style="text-align: center">
                  <a href="#" class="btn btn-primary">修改</a>
                  <a href="#" class="btn btn-primary">测试</a>
                  <a href="#" onclick="history.back()" class="btn btn-primary">返回</a>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
