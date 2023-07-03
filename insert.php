<?php
include ("db.php");
 
$ecno=$_POST['ecn-number'];
  $jobno=$_POST['job-number'];
  $date=$_POST['date'];
  $jobname=$_POST['customer-project-name'];
  $product=$_POST['product'];
  $engineer=$_POST['engineer'];
  $changesource=$_POST['change-source'];
  $typeofchange=implode($_POST['toc']);
  $departmentsafft=implode($_POST['da']);
  $ncrtype=$_POST['ncr'];
  $ncrno=$_POST['ncrno'];
  $drawingchange=$_POST['drawing-change'];
  $changedesc=$_POST['change-desc'];
  $causecode=$_POST['causecode'];
  $causesubcode=$_POST['causescode'];
  $chk0=""; 
  $chk00=""; 
    for($i=0;$i<sizeof($_POST['toc']);$i++)
    {
      $sql = "INSERT INTO `ecntypeofchange`(`ecn_id`, `typeOfChange_id`) VALUES ('$ecno','".$_POST['toc'][$i]."')";
      $conn->query($sql);
    }
    for($i=0;$i<sizeof($_POST['da']);$i++)
    {
      $sql = "INSERT INTO `ecndepartmentaffected`( `ecn_id`,`DepartmentAffected_id`) VALUES ('$ecno','".$_POST['da'][$i]."')";
      $conn->query($sql);
    }
      $sql = "UPDATE `ecndetails` SET `jobno`='$jobno',`date`='$date',`jobname`='$jobname',`product`='$product',`engineer`='$engineer',`changesource`='$changesource',`ncrtype`='$ncrtype',`ncrno`='$ncrno',`drawingchange`='$drawingchange',`changedesc`='$changedesc',`causecode`='$causecode',`causesubcode`='$causesubcode' WHERE ecnno ='$ecno'";
   
if ($conn->query($sql) === TRUE) {

    echo "New record created successfully <br>";
  
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;

  }
?>

<html><body>
<a href="display.php?id=<?php echo $ecno?>"> See Inserted data </a>

</body></html>






