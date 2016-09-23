<div class="form-group">
  <label for="serial" class="col-sm-2 control-label">序列号</label>
  <div class="col-sm-9">
    <input type="text" class="form-control" id="serial" name="serial" value="{{$serial ?? ''}}" readonly>
  </div>
</div>
<div class="form-group">
  <label for="url" class="col-sm-2 control-label">网址</label>
  <div class="col-sm-9">
    <input type="text" class="form-control" id="url" name="url" value="{{$url ?? ''}}">
  </div>
</div>
<div class="form-group">
  <label for="url_area" class="col-sm-2 control-label">网址区域</label>
  <div class="col-sm-9">
    <input type="text" class="form-control" id="url_area" name="url_area" value="{{$url_area ?? ''}}">
  </div>
</div>
<div class="form-group">
  <label for="url_rule" class="col-sm-2 control-label">网址获取规则</label>
  <div class="col-sm-9">
    <input type="text" class="form-control" id="url_rule" name="url_rule" value="{{$url_rule ?? ''}}">
  </div>
</div>
<div class="form-group">
  <label for="content_area" class="col-sm-2 control-label">内容区域</label>
  <div class="col-sm-9">
    <textarea class="form-control" id="content_area" name="content_area">{{$content_area ?? ''}}</textarea>
  </div>
</div>
<div class="form-group">
  <label for="title_rule" class="col-sm-2 control-label">标题规则</label>
  <div class="col-sm-9">
    <textarea class="form-control" id="title_rule" name="title_rule">{{$title_rule ?? ''}}</textarea>
  </div>
</div>
<div class="form-group">
  <label for="date_rule" class="col-sm-2 control-label">日期规则</label>
  <div class="col-sm-9">
    <textarea class="form-control" id="date_rule" name="date_rule">{{$date_rule ?? ''}}</textarea>
  </div>
</div>
<div class="form-group">
  <label for="article_rule" class="col-sm-2 control-label">正文规则</label>
  <div class="col-sm-9">
    <textarea class="form-control" id="article_rule" name="article_rule">{{$article_rule ?? ''}}</textarea>
  </div>
</div>