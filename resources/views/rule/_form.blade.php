<div class="form-group">
  <label for="first" class="col-sm-2 control-label">一级类别</label>
  <div class="col-sm-9">
    <input type="text" class="form-control" id="first" name="first" value="{{htmlspecialchars($first ?? '')}}">
  </div>
</div>
<div class="form-group">
  <label for="second" class="col-sm-2 control-label">二级类别</label>
  <div class="col-sm-9">
    <input type="text" class="form-control" id="second" name="second" value="{{htmlspecialchars($second ?? '')}}">
  </div>
</div>
<div class="form-group">
  <label for="list_url" class="col-sm-2 control-label">列表网址</label>
  <div class="col-sm-9">
    <input type="text" class="form-control" id="list_url" name="list_url" value="{{htmlspecialchars($list_url ?? '')}}">
  </div>
</div>
<div class="form-group">
  <label for="regex_url_area" class="col-sm-2 control-label">网址区域正则</label>
  <div class="col-sm-9">
    <input type="text" class="form-control" id="regex_url_area" name="regex_url_area" value="{{htmlspecialchars($regex_url_area ?? '')}}">
  </div>
</div>
<div class="form-group">
  <label for="regex_url_list" class="col-sm-2 control-label">网址列表正则</label>
  <div class="col-sm-9">
    <input type="text" class="form-control" id="regex_url_list" name="regex_url_list" value="{{htmlspecialchars($regex_url_list ?? '')}}">
  </div>
</div>
<div class="form-group">
  <label for="regex_article" class="col-sm-2 control-label">文章区域正则</label>
  <div class="col-sm-9">
    <textarea class="form-control" id="regex_article" name="regex_article">{{htmlspecialchars($regex_article ?? '')}}</textarea>
  </div>
</div>
<div class="form-group">
  <label for="regex_title" class="col-sm-2 control-label">标题正则</label>
  <div class="col-sm-9">
    <textarea class="form-control" id="regex_title" name="regex_title">{{htmlspecialchars($regex_title ?? '')}}</textarea>
  </div>
</div>
<div class="form-group">
  <label for="regex_date" class="col-sm-2 control-label">日期正则</label>
  <div class="col-sm-9">
    <textarea class="form-control" id="regex_date" name="regex_date">{{htmlspecialchars($regex_date ?? '')}}</textarea>
  </div>
</div>
<div class="form-group">
  <label for="regex_text" class="col-sm-2 control-label">正文正则</label>
  <div class="col-sm-9">
    <textarea class="form-control" id="regex_text" name="regex_text">{{htmlspecialchars($regex_text ?? '')}}</textarea>
  </div>
</div>