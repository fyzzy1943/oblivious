@extends('admin')

@section('body-class', 'hold-transition skin-blue sidebar-mini')

@section('style')
<link href="{{elixir('css/board.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="wrapper">
  <header class="main-header">
    <a href="/" class="logo">
      <span class="logo-lg"><b>内容更新系统</b></span>
    </a>
    <nav class="navbar navbar-static-top">

    </nav>
  </header>

  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      123
    </section>
  </aside>

</div>
@endsection
