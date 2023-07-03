
<!DOCTYPE html5>

<html lang="en-us">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport"
			  content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet"
		      href="form-style.css">
		<script src="jquery-3.6.0.min.js"></script>
		<script src="form-script.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.5/dist/html2canvas.min.js">
  </script>
 
 <?php
 error_reporting(0);
	
include ("db.php");
$sql="SELECT * FROM `ecndetails`";
if(isset($_GET['id'])&&$_GET['id']!="")
{
	$sql=$sql." WHERE ecnno='$_GET[id]'";
}
else
{
	$sql=$sql." WHERE jobno='$_GET[jobid]'";
}
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	if ($row = $result->fetch_assoc()) {
	}
}
?>

		<center><title>Engineering Change Notice</title></center>
	</head>
	<!--objFocus('job-number');-->
	<body onload="highlightRequired() ; "  >
		<!-- header display - SPS picture and form title -->
        <form action="">
        <input type="text" STYLE="color: #FFFFFF; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #72A4D2;" placeholder="Search by Ecn no." name="id" value=<?php echo $_GET['id'];?>></input>
		<input type="text" STYLE="color: #FFFFFF; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #72A4D2;" placeholder="Search by Job no." name="jobid" value=<?php echo $_GET['jobid'];?>></input>
        <input type="submit" name="Search" value="Search" />
    </form>
       
		<header id="heading">
			<table style="text-align:center;">
				<tr>
					<!-- <td><img src="spslogo.jfif" alt="SPS Logo"
					         style="width:350px;height:200px;"></td> -->
				</tr>
			</table>
			<center><h1>Engineering Change Notice</h1></center>
		</header>
		
		<!-- SET ACTION OF THE FORM -->
		<center>
		
			
		<form id="complete-ecn-form" name="complete-ecn-form"  action=""  method="post">
		<!-- main form container - formats all input areas in a grid structure -->
			<table id="form-container">
				<tr>
					<!-- Job Number text input; ID: job-number ------------------------------------------------------------>
					<td id="job-num-container">
						<label for="job-number"><b>Job #:</b> </label>
						<input type="text"
						       id="job-number"
						       disabled
						       onblur="objBlur(this.id)"
						       size="12"
						       maxlength="12" value="<?php echo $row["jobno"];?>">
                               
							   <!-- oninput="fillECNPrimaryNums(this.id, 'primary-num-copy')" -->
					</td>
					<!-- ECN Number text input; ID: ecn-number ------------------------------------------------------------>
					<td>
						
						<b>ECN #:</b><label id="primary-num-copy"
						                    for="ecn-number"></label>
						<input type="text" id="ecn-number" name="ecn-number" value="<?php echo $row["ecnno"];?>"
						
						       size="3"
						       maxlength="3"
							   disabled
						       onfocus="objFocus(this.id)"
						       onblur="objBlur(this.id)"
						/>
							  
					</td>   
					<!-- Date text input; ID: date ------------------------------------------------------------------------>
					<td>
						<label for="date"><b>Date:</b> </label>
						<input type="date"
						       id="date" name="date"
                               value="<?php echo $row["date"];?>"
							   disabled
						       onfocus="objFocus(this.id)"
						       onblur="objBlur(this.id)">
					</td>
				</tr>
				<tr>
					<!-- Customer/Project Name text input; ID: customer-project-name -------------------------------------->
					<td colspan="3">
						<label for="customer-project-name"><b>Customer - Project Name:</b> </label>
						<input type="text"
						       id="customer-project-name" name="customer-project-name"
                               value="<?php echo $row["jobname"];?>"
							   disabled
						       onfocus="objFocus(this.id)"
						       onblur="objBlur(this.id)">
					</td>
				</tr>
				<tr>
					<!-- Product dropdown input; ID: product -------------------------------------------------------------->
					<td>
						<label for="product"><b>Product:</b> </label>
						<input type="text"
						       disabled
                               value="<?php echo $row["product"];?>"
						       onfocus="objFocus(this.id)"
						       onblur="objBlur(this.id)">
					</td>
					<td></td>
					<!-- Engineer dropdown input; ID: engineer ------------------------------------------------------------>
					<td>
						<label for="engineer"><b>Engineer:</b> </label>
						<input type="text" disabled
						       id="customer-project-name" name="customer-project-name"
                               value="<?php echo $row["engineer"];?>"
					</td>
				</tr>
				<tr>
					<!-- Change Source dropdown input; ID: change-source -------------------------------------------------->
					<td colspan="3"
					    style="border-bottom:2px solid black;">
						<label for="change-source"><b>Change Source:</b> </label>
						<input type="text"
						disabled
						       id="customer-project-name" name="customer-project-name"
                               value="<?php echo $row["changesource"];?>"
          			</td>
				</tr>
				<tr>
					<!-- Type of Change column header -->
					<td><b>Type of Change:</b></td>
					<!-- Departments Affected column header -->
					<td><b>Departments Affected:</b></td>
					
				</tr>

				<?php
				$sql="SELECT * FROM `typeofchange`";
				$result1 = $conn->query($sql);
				$sql="SELECT * FROM `departmentsaffected`";
				$result2 = $conn->query($sql);
				$a=0;
				$b=0;
				$sql="SELECT t.name,t.id from ecntypeofchange e inner JOIN ecndetails d on e.ecn_id=d.ecnno INNER JOIN typeofchange t on t.id=e.typeOfChange_id WHERE d.ecnno=$_GET[id]";
				$result3 = $conn->query($sql);
				$arrayresult3=array();
				if($result3->num_rows > 0) {
					while ($r3row = $result3->fetch_assoc()) {
						array_push($arrayresult3,strval($r3row['id']));
					}
				}
				$sql="SELECT t.name,t.id from ecndepartmentaffected e inner JOIN ecndetails d on e.ecn_id=d.ecnno INNER JOIN departmentsaffected t on t.id=e.DepartmentAffected_id WHERE d.ecnno=$_GET[id]";
				$result4 = $conn->query($sql);
				$arrayresult4=array();
				if($result4->num_rows > 0) {
					while ($r4row = $result4->fetch_assoc()) {
						array_push($arrayresult4,strval($r4row['id']));
					}
				}
				while($a==0||$b==0)
				{

					echo "<tr>";
					if ($result1->num_rows > 0) {
						if ($r1row = $result1->fetch_assoc()) {
							echo "<td>
						<input type=checkbox id=if-pre-bom-release name=toc[] value=$r1row[id] disabled ";
                        if (in_array($r1row['id'], $arrayresult3)) {
							echo "checked";
						}

                        echo ">
						<label for=if-pre-bom-release>$r1row[name]</label>
					</td>";
					
						}
						else
					{
						$a=1;
					}
					}
					
					else
					{
						$a=1;
					}
					
					if ($result2->num_rows > 0) {
						if ($r2row = $result2->fetch_assoc()) {
							echo "<td>
						<input type=checkbox id=if-sourcing-fab name=da[] value=$r2row[id] disabled ";
                        if (in_array($r2row['id'], $arrayresult4)) {
							echo "checked";
						}

                        echo ">
						<label for=if-sourcing-fab>$r2row[name]</label>
					</td>";
					
						}
						else
						{
							$b=1;
						}
					}
					else
					{
						$b=1;
					}
					
					
				echo "</tr>";
				}
				?>
				
				<tr>
					<!-- NCR # checkbox input; ID: if-ncr ----------------------------------------------------------------->
					<td>
						<!-- <input type="checkbox"
						       id="if-ncr"
						       onclick="toggleRequired('if-ncr-num'), toggleDisabled('if-ncr-num')">
						<label for="if-ncr">NCR #</label>
						<input type="text"
						       id="if-ncr-num"
						       disabled
						       class="not-allowed"
						       placeholder="[Add NCR #]"
						       onfocus="objFocus(this.id)"
						       onblur="objBlur(this.id)"> -->
							   <label for="ncr"><b>NCR :</b> </label>
                               <input type="text" disabled
						       id="ncr" 
                               value="<?php echo $row["ncrtype"];?>">
                               <input type="text" disabled
						       id="ncrno" 
                               value="<?php echo $row["ncrno"];?>">
					</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<!-- Drawing Change text input; ID: drawing-change ---------------------------------------------------->
					<td colspan="3">
						<label for="drawing-change"><b>Drawing Change:</b> </label>
						<input type="text"
						       id="drawing-change" name="drawing-change"
							   disabled
						       value="<?php echo $row["drawingchange"];?>"
						    >
					</td>
				</tr>
				<tr>
					<!-- Change Description text input; ID: change-desc --------------------------------------------------->
					<td colspan="3">
					<label for="changedesc"><b>Change Description :</b> </label>
					<input type="text"
						       id="changedesc" 
                               value="<?php echo $row["changedesc"];?>">
					</td>
				</tr>
				<tr>
					<!-- Root Cause text input; ID: root-cause ------------------------------------------------------------>
					<td>
						<label for="causecode"><b>Cause Code :</b> </label>
						<input type="text"
						       id="customer-project-name" name="customer-project-name"
                               value="<?php echo $row["causecode"];?>">
					</td>
					
				</tr>
				<tr>
					<!-- Root Cause text input; ID: root-cause ------------------------------------------------------------>
					<td>
						<label for="causescode"><b>Cause Sub-Code :</b> </label>
						<input type="text"
						disabled
						       id="customer-project-name" name="customer-project-name"
                               value="<?php echo $row["causesubcode"];?>">
					</td>					
				</tr>
			
			</table>
			
			<!-- Send ECN divider -->
			<!-- <div class="parent-container">
				<div class="child-container">
					<h2>Send ECN</h2>
					<div class="element">
						<label id="to" class="align-left">to:</label>
						<input id="to" type="text" class="align-left">
					</div>
					<div class="element">
						<label for="cc" class="align-left" value="ecn@switchgearpower.com">cc:</label>
						<input id="cc" type="text" class="align-left">
					</div> -->
					
					<div class="element" >
					<a href="ecn-form.php">Go back / Enter new form
						
						</a> 
					
					</div>
					
	</form>
	
	</center>
	</body>

</html>
