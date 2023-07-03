ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

foreach($typeofchange as $chk1)  
     {  
        $chk0 .= $chk1.",";  
     }  
  
     
  foreach($departmentsafft as $chk2)  
     {  
        $chk00 .= $chk2.",";  
     }   include ("db.php");
function insecn(){      
   $sql = "INSERT INTO ecndetails (ecnno)";

$sql1="  Select ecnno from ecndetails where jobno=$jobno  ";

}
  $sql1=$fecn;
  <a href="" onclick="insecn()" >Gen ecn no</a>
  id="ecn-number" name="ecn-number" VALUES="<?php echo $id;?>"
						       required
							   disabled
						       autofocus
						       size="3"
						       maxlength="3"
						       onfocus="objFocus(this.id)"
						       onblur="objBlur(this.id)">

                         <?php
  if (isset($_POST['ecn-number'])) {
    $q = "SELECT  `jobno`, `date`, `jobname`, `product`, `engineer`, `changesource`, `typeofchange`, `departmentsafft`, `ncrtype`, `ncrno`, `drawingchange`, `changedesc`, `causecode`, `causesubcode` FROM `ecndetails` WHERE ecnno ='$ecno'";
    $result = $conn->query($q);



    if ($result->num_rows > 0) {
        echo "
        Job Number =  ". $row["jobno"] ."
        Date =  ". $row["date"] ."
        Job Name =  " .$row["jobname"] ."
        Prodcut=  ". $row["product"]. "
        Engineer =  ".$row["engineer"]. "
        Change Source =  ".$row["changesource"]."
        Type of Change =  ".$row["typeofchange"]."
        Departments Affected =  ".$row["departmentsafft"]."
        Ncr Type =  ".$row["ncrtype"]."
        Ncr Number =  ".$row["ncrno"]."
        Drawing Change =  ".$row["drawingchange"]."
        Change Description =  ".$row["changedesc"]."
        Cause Code =  ".$row["causecode"]."
        Cause SubCode =  ".$row["causesubcode"]."
        
        ";   
        }    else {
        echo "0 results";
    }
    }
    echo "
    "<br>"
    Job Number = $jobno
    "<br>"
    Date =   $date
    "<br>" 
    Job Name = $jobno
    "<br>"
    Product=  $product
    "<br>"
    Engineer = $engineer
    "<br>"
    Change Source =  $changesource
    "<br>"
    Type of Change =  $typeofchange
    "<br>"
    Departments Affected =  $departmentsafft
    "<br>"
    Ncr Type =  $ncrtype
    "<br>"
    Ncr Number = $ncrno
    "<br>"
    Drawing Change =  $drawingchange
    "<br>"
    Change Description = $changedescp
    "<br>"
    Cause Code =  $causecode
    "<br>"
    Cause SubCode =  $causesubcode
    "<br>"
    
    ";   
  ?>


echo "Job Number = $jobno";
    
    echo "Date = $date";
  
    echo "Job Name = $jobno";
    
    echo "Product= $product";
   
    echo "Engineer = $engineer";
  
    echo "Change Source = $changesource";
  
    echo "Type of Change = $typeofchange";

    echo "Departments Affected = $departmentsafft";

    echo "Ncr Type = $ncrtype";

    echo "Ncr Number = $ncrno";

    echo "Drawing Change = $drawingchange";
    
    echo "Change Description = $changedesc";
    
    echo "Cause Code = $causecode";
    
    echo "Cause SubCode = $causesubcode";

    echo "
      ECN Number = $ecno
      <br>
    Job Number = $jobno
    <br>
    Date =   $date
    <br>
    Job Name = $jobno
    <br>
    Product=  $product
    <br>
    Engineer = $engineer
    <br>
    Change Source =  $changesource
    <br>
    Type of Change =  $typeofchange
    <br>
    Departments Affected =  $departmentsafft
    <br>
    Ncr Type =  $ncrtype
    <br>
    Ncr Number = $ncrno
    <br>
    Drawing Change =  $drawingchange
    <br>
    Change Description = $changedesc
    <br>
    Cause Code =  $causecode
    <br>
    Cause SubCode =  $causesubcode
    
    
    "; 
    <br>
  <a href="mailto:">  
    <input type="Send an Email"/>  

    SELECT d.ecnno,t.name from ecntypeofchange e inner JOIN ecndetails d on e.ecn_id=d.ecnno INNER JOIN typeofchange t on t.id=e.typeOfChange_id