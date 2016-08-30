@extends('layout')

@section('style')
<link href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <table id="table_id" class="row-border">
        <thead>
        <tr>
          <th>Column 1</th>
          <th>Column 2</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>Row 1 Data 1</td>
          <td>Row 1 Data 2</td>
        </tr>
        <tr>
          <td>Row 2 Data 1</td>
          <td>Row 2 Data 2</td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection

@section('script')
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready( function () {
    $('#table_id').DataTable();
  } );
</script>
@endsection
