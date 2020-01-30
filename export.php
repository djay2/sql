
<?php  
//export.php  
$connect = mysqli_connect("localhost", "root", "", "test",3308);
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT * FROM feedback1";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table">  <thead>
                    <tr>  
                         <th>Purchase Requisition</th>  
                         <th>Material</th>  
                         <th>Short Text</th>  
       <th>User Remarks</th>
       <th>Status</th>
                    </tr></thead><tbody>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                         <td>'.$row["Purchase Requisition"].'</td>  
                         <td>'.$row["Material"].'</td>  
                         <td>'.$row["Short Text"].'</td>  
       <td>'.$row["User Remarks"].'</td>  
       <td>'.$row["Status"].'</td>
                    </tr>
   ';
  }
  $output .= '</tbody></table>';
  header('Content-Type: application/vnd.ms-exel');
  header('Content-Disposition: attachment; filename=download.xls');
  
  echo $output;
 }
}
?>