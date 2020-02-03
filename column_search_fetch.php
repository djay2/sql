<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "test",3308);
$column = array("`Purchase Requisition`", "Material", "`Short Text`", "`User Remarks`","Status");
$query = "
 SELECT * FROM penpr
";
$query .= " WHERE ";

if(isset($_POST["is_category"]))
{
 $query .= "`Short Text` = '".$_POST["is_category"]."' AND ";
}
if(isset($_POST["search"]["value"]))
{
 $query .= '(`Purchase Requisition` LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR Material LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR `Short Text` LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR `User Remarks` LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR Status LIKE "%'.$_POST["search"]["value"].'%" )';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY `Purchase Requisition` DESC ';
}

$query1 = '';

if($_POST["length"] != 1)
{
 $query1 .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = $row["Purchase Requisition"];
 $sub_array[] = $row["Material"];
 $sub_array[] = $row["Short Text"];
 $sub_array[] = $row["User Remarks"];
 $sub_array[] = $row["Status"];

 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM penpr";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>