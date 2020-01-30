<?php
//`Purchase Requisition`,Material,`Short Text`,`User Remarks`,Status,Date,Time
require_once ('connect.php');

$qry="UPDATE penpr p, penpr1 p1 SET p.`User Remarks`=p1.`User Remarks`,p.Status=p1.Status,p.Date=p1.Date,p.Time=p1.Time WHERE p.`Purchase Requisition`=p1.`Purchase Requisition`";
$res1=mysqli_query($con,$qry);


?>