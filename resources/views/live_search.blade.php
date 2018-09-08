@extends('layouts.app')
@section('content') 

<!DOCTYPE html>
<html>
 <head>
  <title>Live search in laravel using AJAX</title>
  
 </head>
 <body>
  <br />
  <div class="container box">
   <h3 align="center">Live search in laravel using AJAX</h3><br />
   <div class="panel panel-default">
    <div class="panel-heading">Search Customer Data</div>
    <div class="panel-body">
     <div class="form-group">
      <input type="text" name="search" id="search" class="form-control" placeholder="Search Customer Data" />
     </div>
    <div class="table-responsive">
      <h3 align="center">Total Data : <span id="total_records"></span></h3>
      <div id="search-results-ajax">

      </div>
     </div>
    </div>    
   </div>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){

 fetch_customer_data();

 function fetch_customer_data(query = '')
 {
  $.ajax({
   url:"{{ route('live_search.action') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('#search-results-ajax').html(data.table_data);
    $('#total_records').text(data.total_data);
   },
   error: function(data){
    console.log(data.responseJSON);
   }
  })
 }

 $(document).on('keyup', '#search', function(){
  var query = $(this).val();
  fetch_customer_data(query);
 });
});
</script>
@endsection