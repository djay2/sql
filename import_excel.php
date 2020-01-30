<?php
/**
 * Created by PhpStorm.
 * User: Aravinth
 * Date: 10-09-2017
 * Time: 12:30 PM
 */

use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

require_once ('connect.php');
require_once ('Spout/Autoloader/autoload.php');

$qry="DROP TABLE IF EXISTS Penpr1";
$res1=mysqli_query($con,$qry);

$qry = "ALTER TABLE Penpr RENAME TO Penpr1";
                    $res2 = mysqli_query($con,$qry);
					
$qry="CREATE TABLE Penpr (
`Purchase Requisition` VARCHAR(30) PRIMARY KEY,
Material VARCHAR(30) NOT NULL,
`Short Text` VARCHAR(30) NOT NULL,
`User Remarks` VARCHAR(50) NOT NULL,
Status  VARCHAR(50) NOT NULL,
Date  VARCHAR(50) NOT NULL,
Time VARCHAR(50) NOT NULL
)";					

$res2 = mysqli_query($con,$qry);
					
if(!empty($_FILES['excelfile']['name']))
{
    // Get File extension eg. 'xlsx' to check file isShort Text excel sheet
    $pathinfo = pathinfo($_FILES['excelfile']['name']);

    // check file has extension xlsx, xls and also check
    // file is not empty
    if (($pathinfo['extension'] == 'xlsx' || $pathinfo['extension'] == 'xls')
        && $_FILES['excelfile']['size'] > 0 )
    {
        $file = $_FILES['excelfile']['tmp_name'];

        // Read excel file by using ReadFactory object.
        $reader = ReaderFactory::create(Type::XLSX);

        // Open file
        $reader->open($file);
        $count = 0;

        // Number of sheet in excel file
        foreach ($reader->getSheetIterator() as $sheet)
        {

            // Number of Rows in Excel sheet
            foreach ($sheet->getRowIterator() as $row)
            {

                // It reads data after header. In the my excel sheet,
                // header is in the first row.
                if ($count > 0) {

                    // Data of excel sheet
                    $pr = $row[0];
                    $m = $row[1];
					$st = $row[2];

                    //Here, You can insert data into database.
                    $qry = "INSERT INTO `Penpr`(`Purchase Requisition`, `Material`,`Short Text`) VALUES ('$pr','$m','$st')";
                    $res = mysqli_query($con,$qry);

				
                }
                $count++;
            }
        }

        if($res)
        {
            echo "Your file Uploaded Successfull";
        }
        else
        {
            echo "Your file Uploaded Failed";
        }

        // Close excel file
        $reader->close();
    }
    else
    {
        echo "Please Choose only Excel file";
    }
}
else
{
    echo "File is Empty"."<br>";
    echo "Please Choose Excel file";
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Excel to mysql</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<form method="post" action="update_penpr.php" enctype="multipart/form-data">

                <div class="form-group">
                    <button class="btn btn-info">Update Penpr</button>
                </div>

            </form>
</body>
</html>



