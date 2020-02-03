<?php 
$connect = mysqli_connect("localhost", "root", "", "test",3308);
$query = "SELECT * FROM penpr ORDER BY `Purchase Requisition` ASC";
$result = mysqli_query($connect, $query);
?>
<html>
 <head>
  <title>Datatables Individual column searching using PHP Ajax Jquery</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
  
 </head>
 <body>
  <div class="container">
   <h1 align="center">Datatables Individual column searching using PHP Ajax Jquery</h1>
   <br/>
   
   <div class="table-responsive">
    <table id="product_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>Purchase Requisition</th>
       <th>Material</th>
       <th>Short Text
        <select name="category" id="category" class="form-control">
         <option value="">Show All</option>
         <?php 
         while($row = mysqli_fetch_array($result))
         {
          echo '<option value="'.$row["Short Text"].'">'.$row["Short Text"].'</option>';
         }
         ?></th>
        </select>
       </th>
       <th>User Remarks</th>
       <th>Status</th>
	  </tr>
     </thead>
    </table>
   </div>
  </div>
 </body>
</html>



<script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 load_data();

 function load_data(is_category)
 {
  var dataTable = $('#product_data').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":{
    url:"column_search_fetch.php",
    type:"POST",
    data:{is_category:is_category}
   },
   "columnDefs":[
    {
     "targets":[],
     "orderable":false,
    },
   ],
  });
 }

 $(document).on('change', '#category', function(){
  var category = $(this).val();
  $('#product_data').DataTable().destroy();
  if(category != '')
  {
   load_data(category);
  }
  else
  {
   load_data();
  }
 });
});
</script>