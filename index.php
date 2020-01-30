<?php
include 'DBController.php';
$db_handle = new DBController();
$productResult = $db_handle->runQuery("select * from feedback1");
 
if (isset($_POST["export"])) {
	
    $filename = "Export_excel_".date("d-m-Y").".xls";
    header("Content-Type: application/vnd.ms-excel");
	
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $isPrintHeader = false;
    if (! empty($productResult)) {
        foreach ($productResult as $row) {
            if (! $isPrintHeader) {
                echo implode("\t", array_keys($row)) . "\n";
                $isPrintHeader = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
    }
    exit();
}
?>
 
<div id="table-container">
    <table id="tab" border="1">
        <thead>
            <tr>
                <th>Purchase Requisition</th>  
                         <th>Material</th>  
                         <th>Short Text</th> 
                <!-- <th width="20%">Average Rating</th> -->
            </tr>
        </thead>
        <tbody>
  
            <?php
            $query = $db_handle->runQuery("select * from feedback1");
            if (! empty($productResult)) {
                foreach ($productResult as $key => $value) {
                    ?>
                  
                     <tr>
                <td><?php echo $productResult[$key]["Purchase Requisition"]; ?></td>
                <td><?php echo $productResult[$key]["Material"]; ?></td>
                <td><?php echo $productResult[$key]["Short Text"]; ?></td>
                
            </tr>
             <?php
                }
            }
            ?>
      </tbody>
    </table>
 
    <div class="btn">
        <form action="" method="post">
            <button type="submit" id="btnExport" name='export'
                value="Export to Excel" class="btn btn-info">Export to
                excel</button>
        </form>
    </div>
</div>