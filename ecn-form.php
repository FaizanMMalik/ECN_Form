
<!DOCTYPE html5>

<html lang="en-us">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport"
			  content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet"
		      href="form-style.css">
			  <link href="assets/css/style.css" rel="stylesheet">
		<script src="form-script.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.5/dist/html2canvas.min.js">
  </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
 <?php
include ("db.php");

if ($result = $conn -> query("DELETE FROM `ecndetails` WHERE jobno IS null AND jobname IS null AND product IS null AND engineer IS null AND changesource IS null AND typeofchange IS null AND departmentsafft IS null AND ncrtype IS null AND ncrno IS null AND drawingchange IS null AND changedesc IS null AND causecode IS null AND causesubcode IS null")) {
	
	
	
  }
  
$a=1;
if(isset($_GET['jobno']))
{
$sql="SELECT * FROM `ecndetails` WHERE jobno='$_GET[jobno]'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	if ($row = $result->fetch_assoc()) {
		$a=0;
	}
}
}
if($a==1)
{
$id=0;
$sql="SELECT max(ecnno) from ecndetails";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	if ($row = $result->fetch_assoc()) {
		$id=(int)$row["max(ecnno)"];
	}
}
$id=$id+1;
$sql = "INSERT INTO ecndetails (ecnno) VALUES ('$id')";

if ($conn->query($sql) === TRUE) {
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
}

?>

		<center><title> New Engineering Change Notice</title></center>
	</head>
	<!--objFocus('job-number');-->
	<body onload="highlightRequired() ; "   >
		<!-- header display - SPS picture and form title -->
		<header id="heading">
			<table style="text-align:center;">
				<tr>
					<!-- <td><img src="spslogo.jfif" alt="SPS Logo"
					         style="width:350px;height:200px;"></td> -->
				</tr>
			</table>
			<center><h1> New Engineering Change Notice</h1></center>
		</header>
		
		<!-- SET ACTION OF THE FORM -->
		<center>
		
			
		<form id="complete-ecn-form" name="complete-ecn-form"  method="post"  >
		<!-- main form container - formats all input areas in a grid structure -->
			<table id="form-container">
				<tr>
					<!-- Job Number text input; ID: job-number ------------------------------------------------------------>
					<td id="job-num-container">
						<label for="job-number"><b>Job #:</b> </label>
						<input type="text"
						       id="job-number"  name="job-number" 
						       autofocus
						       required
						       placeholder="[Job Number]"
						 	  
						 	   onfocus="objFocus(this.id)"
						       onblur="objBlur(this.id)"
						       size="12"
						       maxlength="12"
							   
							   <?php
							   if(isset($row['jobno']))
							   {
								echo "value=$row[jobno]";
							   }
							   ?>>
							   <!-- oninput="fillECNPrimaryNums(this.id, 'primary-num-copy')" -->
							  
					</td>
					<!-- ECN Number text input; ID: ecn-number ------------------------------------------------------------>
					<td>
					
						<b>ECN #:</b><label id="primary-num-copy"
						                    for="ecn-number"></label>
						<input type="text" id="ecn-number" name="ecn-number"
						
						       size="3"
						       maxlength="3"
							   autofocus
						       required
							   disabled
						       onfocus="objFocus(this.id)"
						       onblur="objBlur(this.id)"
							   <?php
							   if(isset($row['ecnno']))
							   {
								echo "value=$row[ecnno]";
							   }
							   else
							   {
								echo "value=$id";
							   }
							   ?>
						/>
							  
					</td>   
					<!-- Date text input; ID: date ------------------------------------------------------------------------>
					<td>
						<label for="date"><b>Date:</b> </label>
						<input type="date"
						       id="date" name="date" 
						
						       onfocus="objFocus(this.id)"
						       onblur="objBlur(this.id)"
							
							   <?php
							   if(isset($row['date']))
							   {							
								echo "value=".date($row['date']);		
					}
							   ?>>

					</td>
				</tr>
				<tr>
				<script type="text/javascript">
$(function(){
    var dtToday = new Date();
 
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
     day = '0' + day.toString();
    var maxDate = year + '-' + month + '-' + day;
    $('#date').attr('min', maxDate);
});
</script>
				<script src="index.js"></script>
				
					<!-- Customer/Project Name text input; ID: customer-project-name -------------------------------------->
					<td colspan="3">
						<label for="customer-project-name"><b>Customer - Project Name:</b> </label>
						<input type="text"
						       id="customer-project-name" name="customer-project-name"
						       required
						       placeholder="[Company - Project]"
						       onfocus="objFocus(this.id)"
						       onblur="objBlur(this.id)"
							   <?php
							   if(isset($row['jobname']))
							   {
								echo "value=$row[jobname]";
							   }
							   ?>>
					</td>
				</tr>
				<tr>
					<!-- Product dropdown input; ID: product -------------------------------------------------------------->
					<td>
						<label for="product"><b>Product:</b> </label>
						<?php $select=1;
								?>
						<select id="product" class="dds"  name="product"
						        required
						        onfocus="objFocus(this.id)"
						        onblur="objBlur(this.id)">
								
            				
							<option value="Bus Duct"
							<?php
							 if(isset($row['product'])&&$row['product']=="Bus Duct")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Bus Duct</option>
            				<option value="Low Voltage Switchgear"
							<?php
							 if(isset($row['product'])&&$row['product']=="Low Voltage Switchgear")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Low Voltage Switchgear</option>
            				<option value="MC/ME Hybrid"
							<?php
							 if(isset($row['product'])&&$row['product']=="MC/ME Hybrid")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>MC/ME Hybrid</option>
            				<option value="Metal Clad"
							<?php
							 if(isset($row['product'])&&$row['product']=="Metal Clad")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Metal Clad</option>
            				<option value="Metal Enclosed"
							<?php
							 if(isset($row['product'])&&$row['product']=="Metal Enclosed")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Metal Enclosed</option>
            				<option value="Padmount"
							<?php
							 if(isset($row['product'])&&$row['product']=="Padmount")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Padmount</option>
            				<option value="PDC"
							<?php
							 if(isset($row['product'])&&$row['product']=="PDC")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>PDC</option>
            				<option value="Relay Racks"
							<?php
							 if(isset($row['product'])&&$row['product']=="Relay Racks")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Relay Racks</option>
							<option disabled hidden="true"
							<?php
							 if($select==1)
							 {
							  echo "selected";
							 }
							?>>[Choose a Product]</option>
          				</select>
					</td>
					<td></td>
					<!-- Engineer dropdown input; ID: engineer ------------------------------------------------------------>
					<td>
						<label for="engineer"><b>Engineer:</b> </label>
						<?php $select=1;
								?>
						<select id="engineer" class="dds"  name="engineer"
						        required
						        onfocus="objFocus(this.id)"
						        onblur="objBlur(this.id)">
								
							<option value="Ben Wenzel" 
							<?php
							 if(isset($row['engineer'])&&$row['engineer']=="Ben Wenzel")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Ben Wenzel</option>
								<option value="Brendan Adolf"
								<?php
							 	 if(isset($row['engineer'])&&$row['engineer']=="Brendan Adolf")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Brendan Adolf</option>
								<option value="Brett Bittner"
								<?php
								 if(isset($row['engineer'])&&$row['engineer']=="Brett Bittner")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Brett Bittner</option>
								<option value="Bronson Foust"
								<?php
								 if(isset($row['engineer'])&&$row['engineer']=="Bronson Foust")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Bronson Foust</option>
								<option value="Chad Foust"
								<?php
								 if(isset($row['engineer'])&&$row['engineer']=="Chad Foust")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Chad Foust</option>
								<option value="Chris McInnis"
								<?php
								 if(isset($row['engineer'])&&$row['engineer']=="Chris McInnis")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Chris McInnis</option>
								<option value="Daisy Gunderson"
								<?php
							 	 if(isset($row['engineer'])&&$row['engineer']=="Daisy Gunderson")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Daisy Gunderson</option>
            				<option value="David Ekholm"
							<?php
								 if(isset($row['engineer'])&&$row['engineer']=="David Ekholm")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>David Ekholm</option>
							<option value="Elliot Waschechek"
							<?php
							 if(isset($row['engineer'])&&$row['engineer']=="Elliot Waschechek")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Elliot Waschechek</option>
            				<option value="Erik Olson"
							<?php
								 if(isset($row['engineer'])&&$row['engineer']=="Erik Olson")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Erik Olson</option>
							<option value="Former SPS Engineer"
							<?php
								 if(isset($row['engineer'])&&$row['engineer']=="Former SPS Engineer")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Former SPS Engineer</option>
							<option value="Ibrahem El Ghetrify" 
							<?php
								 if(isset($row['engineer'])&&$row['engineer']=="Ibrahem El Ghetrify")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Ibrahem El Ghetrify</option>
							<option value="Ivy Wang"
							<?php
								 if(isset($row['engineer'])&&$row['engineer']=="Ivy Wang")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Ivy Wang</option>
							<option value="James Leonard"
							<?php
							 if(isset($row['engineer'])&&$row['engineer']=="James Leonard")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>James Leonard</option>
            				<option value="Jason Sell"
							<?php
								 if(isset($row['engineer'])&&$row['engineer']=="Jason Sell")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Jason Sell</option>
							<option value="Jeremy Ostenson"
							<?php
								 if(isset($row['engineer'])&&$row['engineer']=="Jeremy Ostenson")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Jeremy Ostenson</option>
            				<option value="John Tollefson"
							<?php
								 if(isset($row['engineer'])&&$row['engineer']=="John Tollefson")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>John Tollefson</option>						            			
            				<option value="Josh Bedsole"
							<?php
							 if(isset($row['engineer'])&&$row['engineer']=="Josh Bedsole")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Josh Bedsole</option>
            				<option value="Keith Petit"
							<?php
								 if(isset($row['engineer'])&&$row['engineer']=="Keith Petit")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Keith Petit</option>
							<option value="Mike Pucek"
							<?php
								 if(isset($row['engineer'])&&$row['engineer']=="Mike Pucek")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Mike Pucek</option>
							<option value="Mohammad Alsurhki"
							<?php
								 if(isset($row['engineer'])&&$row['engineer']=="Mohammad Alsurkhi")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Mohammad Alsurhki</option>
							<option value="Mohammad Imad"
							<?php
								 if(isset($row['engineer'])&&$row['engineer']=="Mohammad Imad")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Mohammad Imad</option>
            				<option value="Nick Bouche"
							<?php
								 if(isset($row['engineer'])&&$row['engineer']=="Nick Bouche")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Nick Bouche</option>	
							<option value="Nirav Patel"
							<?php
						 if(isset($row['engineer'])&&$row['engineer']=="Nirav Patel")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Nirav Patel</option>
							<option value="Richard Meilahn"
							<?php
							 if(isset($row['engineer'])&&$row['engineer']=="Richard Meilahn")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Richard Meilahn</option>	
							<option value="Robert Williams"
							<?php
								 if(isset($row['engineer'])&&$row['engineer']=="Robert Williams")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Robert Williams</option>
							<option value="Robert Wozniak"
							<?php
							 if(isset($row['engineer'])&&$row['engineer']=="Robert Wozniak")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Robert Wozniak</option>				
            				<option value="Tyler Kriegel"
							<?php
							 if(isset($row['engineer'])&&$row['engineer']=="Tyler Kriegel")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Tyler Kriegel</option>
							<option disabled hidden="true"	<?php
							 if($select==1)
							 {
							  echo "selected";
							 }
							 
							?>>[Choose an Engineer]</option>
          				</select>
						
					</td>
				</tr>
				<tr>
					<!-- Change Source dropdown input; ID: change-source -------------------------------------------------->
					<td colspan="3"
					    style="border-bottom:2px solid black;">
						<label for="change-source"><b>Change Source:</b> </label>
						<?php $select=1;
								?>
						<select class="dds"id="change-source"  name="change-source"  style="width:800px"
						        required
						        onfocus="objFocus(this.id)"
								
						        onblur="objBlur(this.id); toggleInputLock(this.id, ['if-deviation','if-bom-correction','if-revised-con-release'], 'releases')"
								//onclick="changedd('')"
								>

            				
           					<option value="Application Engineer"
							   <?php
							 if(isset($row['changesource'])&&$row['changesource']=="Application Engineer")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Application Engineer</option>
            				<option value="Electrical Design Engineer"    
							<?php
							 if(isset($row['changesource'])&&$row['changesource']=="Electrical Design Engineer")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Electrical Design Engineer</option>
            				<option value="Electrical Engineer"
							<?php
							 if(isset($row['changesource'])&&$row['changesource']=="Electrical Engineer")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Electrical Engineer</option>
            				<option value="Mechanical Engineer"
							<?php
							 if(isset($row['changesource'])&&$row['changesource']=="Mechanical Engineer")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Mechanical Engineer</option>
							<option value="KA"
							<?php
							 if(isset($row['changesource'])&&$row['changesource']=="KA")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>KA</option>
            				<option value="Project Management"
							<?php
							 if(isset($row['changesource'])&&$row['changesource']=="Project Management")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Project Management</option>
            				<option value="Assembly"
							<?php
							 if(isset($row['changesource'])&&$row['changesource']=="Assembly")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Assembly</option>
            				<option value="Fabrication"
							<?php
							 if(isset($row['changesource'])&&$row['changesource']=="Fabrication")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Fabrication</option>
            				<option value="Sales"
							<?php
							 if(isset($row['changesource'])&&$row['changesource']=="Sales")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Sales</option>
            				<option value="Site As-Built(As-Installed)"
							<?php
							 if(isset($row['changesource'])&&$row['changesource']=="Site As-Built(As-Installed)")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Site As-Built(As-Installed)</option>
            			
            				<option value="Releases (BOM, Initial Construction, Initial Pre-BOM)"
							<?php
							 if(isset($row['changesource'])&&$row['changesource']=="Releases (BOM, Initial Construction, Initial Pre-BOM)")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Releases (BOM, Initial Construction, Initial Pre-BOM)</option>
            				<option value="Testing/As-Built"
							<?php
							 if(isset($row['changesource'])&&$row['changesource']=="Testing/As-Built")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Testing/As-Built</option>
            				<option value="Vendor (Lead time issues, Missing part info, Obsolete part, etc)"
							<?php
							 if(isset($row['changesource'])&&$row['changesource']=="Vendor (Lead time issues, Missing part info, Obsolete part, etc)")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Vendor (Lead time issues, Missing part info, Obsolete part, etc)</option>
							<option disabled  hidden="true" <?php
							 if($select==1)
							 {
							  echo "selected";
							 }
							 
							?>
							>[Choose a Source]</option>
						</select>
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
				$sql="SELECT t.name,t.id from ecntypeofchange e inner JOIN ecndetails d on e.ecn_id=d.ecnno INNER JOIN typeofchange t on t.id=e.typeOfChange_id";
				if(isset($_GET['jobno']))
				{
					$sql=$sql." WHERE d.jobno='$_GET[jobno]'";
				}
				else
				{
					$sql=$sql." WHERE d.jobno='-1'";
				}
				$result3 = $conn->query($sql);
				$arrayresult3=array();
				if($result3->num_rows > 0) {
					while ($r3row = $result3->fetch_assoc()) {
						array_push($arrayresult3,strval($r3row['id']));
					}
				}
				$sql="SELECT t.name,t.id from ecndepartmentaffected e inner JOIN ecndetails d on e.ecn_id=d.ecnno INNER JOIN departmentsaffected t on t.id=e.DepartmentAffected_id";
				if(isset($_GET['jobno']))
				{
					$sql=$sql." WHERE d.jobno='$_GET[jobno]'";
				}
				else
				{
					$sql=$sql." WHERE d.jobno='-1'";
				}
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
						<input type=checkbox id=typeofchange$r1row[id] name=toc[] value=$r1row[id]  ";
                        if (in_array($r1row['id'], $arrayresult3)) {
							echo "checked";
						}
						?>
						onclick="change('<?php echo $r1row['name'];?>','<?php echo $r1row['id'];?>'); ckChange(this); "
						
					   <?php
                        echo   ">
						<label for=typeofchange$r1row[id]>$r1row[name]</label>
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
						<input type=checkbox id=departmentsaffected$r2row[id] name=da[] value=$r2row[id] ";
                        if (in_array($r2row['id'], $arrayresult4)) {
							echo "checked";
						}

                        echo ">
						<label for=departmentsaffected$r2row[id]>$r2row[name]</label>
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
							   <?php $select=1;
								?>
						<select id="ncr" class="dds"  name="ncr"
						
						        required
						        onfocus="objFocus(this.id)"
						        onblur="objBlur(this.id)">
            				
            				<option value="NCR"
							<?php
								 if(isset($row['ncrtype'])&&$row['ncrtype']=="NCR")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>NCR #</option>
            				<option value="FNCR"
							<?php
								 if(isset($row['ncrtype'])&&$row['ncrtype']=="FNCR")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>FNCR #</option>
            				<option value="No NCR"
							<?php
								 if(isset($row['ncrtype'])&&$row['ncrtype']=="No NCR")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>No NCR</option>	
							<option disabled  hidden="true"
							<?php
							if($select==1)
							 {
							  echo "selected";
							 }
							 
							?>
							>[Choose an NCR type ]</option>
          				</select>
						
						  <input type="text"
						  id="ncrno"   name="ncrno"
						  placeholder="[Add NCR #]"
						 
						  <?php
							   if(isset($row['ncrno']))
							   {
								echo "value=$row[ncrno]";
							   }
							   ?>>
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
						       placeholder="[If any drawing changes, enter drawing name(s) and page(s) revised]"
						       required
						       onfocus="objFocus(this.id)"
						       onblur="objBlur(this.id)"
						       size="66"
						       maxlength="66"
							   <?php
							   if(isset($row['drawingchange']))
							   {
								echo "value=$row[drawingchange]";
							   }
							   ?>>
					</td>
				</tr>
				<tr>
					<!-- Change Description text input; ID: change-desc --------------------------------------------------->
					<td colspan="3">
						<label for="change-desc"><b>Change Description</b> (if BOM Change then add part description for line item changes):</label><br>
						<textarea id="change-desc" name="change-desc"
						          required
						          placeholder="[Enter description here]"
						 		  onfocus="objFocus(this.id)"
						 		  onblur="objBlur(this.id)"
								
								>   <?php
							   if(isset($row['changedesc']))
							   {
								echo "$row[changedesc]";
							   }
							   ?></textarea>
					</td>
				</tr>
				<tr>
					<!-- Root Cause text input; ID: root-cause ------------------------------------------------------------>
					<td>
						<label for="causecode"><b>Cause Code :</b> </label>
						<?php $select=1;
								?>
						<select id="causecode" class="dds" name="causecode" style="width:700px"
						        required
						        onfocus="objFocus(this.id)"
						        onblur="objBlur(this.id)">
            				
            				<option value="Customer"
							<?php
								 if(isset($row['causecode'])&&$row['causecode']=="Customer")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Customer</option>
            				<option value="Engineering Error - Not on BOM"
							<?php
								 if(isset($row['causecode'])&&$row['causecode']=="Engineering Error - Not on BOM")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Engineering Error - Not on BOM</option>
            				<option value="Engineering Error - Design(Form / Fit / Function )"
							<?php
								 if(isset($row['causecode'])&&$row['causecode']=="Engineering Error - Design(Form / Fit / Function )")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Engineering Error - Design(Form / Fit / Function )</option>
							<option value="Fabrication"
							<?php
								 if(isset($row['causecode'])&&$row['causecode']=="Fabrication")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Fabrication</option>
            				<option value="Releases"
							<?php
								 if(isset($row['causecode'])&&$row['causecode']=="Releases")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Releases</option>
            				<option value="Software Issues"
							<?php
								 if(isset($row['causecode'])&&$row['causecode']=="Software Issues")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Software Issues</option>
							<option value="Vendor"
							<?php
								 if(isset($row['causecode'])&&$row['causecode']=="Vendor")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Vendor</option>
							<option disabled  hidden="true"
							<?php
							if($select==1)
							 {
							  echo "selected";
							 }
							 
							?>
							>[Enter Category here ]</option>
          				</select>
						
					</td>
					
				</tr>
				<tr>
					<!-- Root Cause text input; ID: root-cause ------------------------------------------------------------>
					<td>
						<label   for="causescode"><b>Cause Sub-Code :</b> </label>
						<?php $select=1;
								?>
						<select id="causescode" class="dds" name="causescode" style="width:700px"
						        required
						        onfocus="objFocus(this.id)"
						        onblur="objBlur(this.id)">
            				
            				<option value="Customer Change"
							<?php
								 if(isset($row['causesubcode'])&&$row['causesubcode']=="Customer Change")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Customer Change</option>
            				<option value="Customer Request"
							<?php
								 if(isset($row['causesubcode'])&&$row['causesubcode']=="Customer Request")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Customer Request</option>
            				<option value="Fabrication Internal Tooling Constraint(s)"
							<?php
								 if(isset($row['causesubcode'])&&$row['causesubcode']=="Fabrication Internal Tooling Constraint(s)")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Fabrication Internal Tooling Constraint(s)</option>
							<option value="Initial BOM Release"
							<?php
								 if(isset($row['causesubcode'])&&$row['causesubcode']=="Initial BOM Release")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Initial BOM Release</option>
            				<option value="Initial BOM / FAB Release"
							<?php
								 if(isset($row['causesubcode'])&&$row['causesubcode']=="Initial BOM / FAB Release")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Initial BOM / FAB Release</option>
            				<option value="Initial Construction Release"
							<?php
								 if(isset($row['causesubcode'])&&$row['causesubcode']=="Initial Construction Release")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Initial Construction Release </option>
							<option value="Initial Pre-BOM Release"
							<?php
								 if(isset($row['causesubcode'])&&$row['causesubcode']=="Initial Pre-BOM Release")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Initial Pre-BOM Release</option>
            				<option value="Engineer Failed to Follow Through"
							<?php
								 if(isset($row['causesubcode'])&&$row['causesubcode']=="Engineer Failed to Follow Through")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Engineer Failed to Follow Through</option>
            				<option value="Engineer Failed to Pick Correct Wire Sizing"
							<?php
								 if(isset($row['causesubcode'])&&$row['causesubcode']=="Engineer Failed to Pick Correct Wire Sizing")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Engineer Failed to Pick Correct Wire Sizing</option>
							<option value="Engineer Failed to read the Qoute"
							<?php
								 if(isset($row['causesubcode'])&&$row['causesubcode']=="Engineer Failed to read the Qoute")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Engineer Failed to read the Qoute</option>
            				<option value="Engineer Missed on Detailing Drawing"
							<?php
								 if(isset($row['causesubcode'])&&$row['causesubcode']=="Engineer Missed on Detailing Drawing")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Engineer Missed on Detailing Drawing</option>
            				<option value="Engineer Missed on the Model"
							<?php
								 if(isset($row['causesubcode'])&&$row['causesubcode']=="Engineer Missed on the Model")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Engineer Missed on the Model</option>
							<option value="Engineer Incorrectly Exported BOM"
							<?php
								 if(isset($row['causesubcode'])&&$row['causesubcode']=="Engineer Incorrectly Exported BOM")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Engineer Incorrectly Exported BOM</option>
            				<option value="Engineer Incorrectly Updated BOM"
							<?php
								 if(isset($row['causesubcode'])&&$row['causesubcode']=="Engineer Incorrectly Updated BOM")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Engineer Incorrectly Updated BOM</option>
            				<option value="Engineer Incorrectly Exported Pre-BOM"
							<?php
								 if(isset($row['causesubcode'])&&$row['causesubcode']=="Engineer Incorrectly Exported Pre-BOM")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Engineer Incorrectly Exported Pre-BOM</option>
							<option value="Engineer Incorrectly Updated Pre-BOM"
							<?php
								 if(isset($row['causesubcode'])&&$row['causesubcode']=="Engineer Incorrectly Updated Pre-BOM")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Engineer Incorrectly Updated Pre-BOM</option>
            				<option value="Missed in Design Reviewing Meeting"
							<?php
								 if(isset($row['causesubcode'])&&$row['causesubcode']=="Missed in Design Reviewing Meeting")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Missed in Design Reviewing Meeting</option>
            				<option value="Missed in Kick-Off Meeting"
							<?php
								 if(isset($row['causesubcode'])&&$row['causesubcode']=="Missed in Kick-Off Meeting")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Missed in Kick-Off Meeting</option>
							<option value="Missed in SUbmittal Review Meeting"
							<?php
								 if(isset($row['causesubcode'])&&$row['causesubcode']=="Missed in SUbmittal Review Meeting")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Missed in SUbmittal Review Meeting</option>
            				<option value="Software EPDM issue"
							<?php
								 if(isset($row['causesubcode'])&&$row['causesubcode']=="Software EPDM issue")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>>Software EPDM issue</option>
            				<option value="Software Solidworks Electrical Issue"
							<?php
								 if(isset($row['causesubcode'])&&$row['causesubcode']=="Software Solidworks Electrical Issue")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Software Solidworks Electrical Issue</option>
							<option value="Software Solidworks Mechanical Issue"
							<?php
								 if(isset($row['causesubcode'])&&$row['causesubcode']=="Software Solidworks Mechanical Issue")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Software Solidworks Mechanical Issue</option>
            				<option value="Vendor provided inaccurate / insuffient information"
							<?php
								 if(isset($row['causesubcode'])&&$row['causesubcode']=="Vendor provided inaccurate / insuffient information")
							 {
							  echo "selected";
							  $select=0;
							 }
							?>
							>Vendor provided inaccurate / insuffient information</option>		
							<option disabled  hidden="true"
							<?php
							if($select==1)
							 {
							  echo "selected";
							 }
							 
							?>
							>[Enter Sub-Category here ]</option>
						</select>
						 
					
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
			
					<table>
						<tr> <td>
						<div class="element" >
						<input type="reset" value="Clear" style=" border-radius: 25px; border: 0;height:50px;width:300px;font-size:20px" class="align-center" onclick="confirmAction()">
					</div>	
							</td><td>
						<div class="element" >
						<input type="button" style=" border: 0;height:50px;width:300px;font-size:20px"value="AutoFill" class="align-center" onclick="redirect()">
					</div>
							</td><td>
							<div class="element" >
						<input type="submit" id="valider" value="Submit Form" class="align-center" onclick="confirmAction()">
							</div>
							
							</td>
						</tr>
					</table>
					
					
							
					<!-- <input type="text" onclick="redirect()" value="AutoFill "> -->					
	</form>
	
	</center>
	<?php
	
	error_reporting(0);
	if($_POST['customer-project-name'])
	{
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
	echo "<a href='display.php?id=$ecno'> See Inserted data </a>";
	echo "<script>

                window.location='display.php?id=$ecno';
			
        </script>";
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;

  }
}

?>

	</body>

</html>

<script>
            const confirmAction = () => {
				
                const response = confirm("Are you sure you want?");
                if (!response) {
					event.preventDefault();
					
                }
				
            }
			const redirect = () => {
				var x=document.getElementById("job-number").value;
                window.location="ecn-form.php?jobno="+x;
            }
			function change(n,id){
				
				if(n=="Pre-BOM Release")
				{
					
				var selectobject = document.getElementById("change-source");
				var chkbox=document.getElementById("typeofchange"+id);
				if(chkbox.checked)
				{
					for (var i=0; i<selectobject.length; i++) {
						if (selectobject.options[i].value != "Releases (BOM, Initial Construction, Initial Pre-BOM)")
						{
							selectobject.remove(i);
							i--;
						}
					}
				}
				else
				{
					const option = ["Application Engineer", "Electrical Design Engineer", "Electrical Engineer","Mechanical Engineer","KA","Project Management","Assembly","Fabrication","Sales","Site As-Built(As-Installed)","Testing/As-Built","Vendor (Lead time issues, Missing part info, Obsolete part, etc)"];
					
					for (var i=0; i<option.length; i++) {
						var newOption = document.createElement('option');
						newOption.innerText = option[i];
						newOption.setAttribute('value', option[i]);
						selectobject.appendChild(newOption);
					}
					
				}



				//cause code
				var selectobject = document.getElementById("causecode");
				if(chkbox.checked)
				{
					for (var i=0; i<selectobject.length; i++) {
						if (selectobject.options[i].value != "Releases")
						{
							selectobject.remove(i);
							i--;
						}
					}
				}
				else
				{
					const option = ["Customer","Engineering Error - Not on BOM","Engineering Error - Design(Form / Fit / Function )","Fabrication","Software Issues","Vendor"];
					
					for (var i=0; i<option.length; i++) {
						var newOption = document.createElement('option');
						newOption.innerText = option[i];
						newOption.setAttribute('value', option[i]);
						selectobject.appendChild(newOption);
					}
					
				}


				//cause sub code
				var selectobject = document.getElementById("causescode");
				if(chkbox.checked)
				{
					for (var i=0; i<selectobject.length; i++) {
						if (selectobject.options[i].value != "Initial Pre-BOM Release" )
						{
							selectobject.remove(i);
							i--;
						}
					}
				}
				else
				{
					const option = ["Customer Change","Customer Request","Fabrication Internal Tooling Constraint(s)","Initial BOM Release","Initial BOM / FAB Release","Initial Construction Release","Engineer Failed to Follow Through","Engineer Failed to Pick Correct Wire Sizing","Engineer Failed to read the Qoute","Engineer Missed on Detailing Drawing","Engineer Missed on the Model","Engineer Incorrectly Exported BOM","Engineer Incorrectly Updated BOM","Engineer Incorrectly Exported Pre-BOM","Engineer Incorrectly Updated Pre-BOM","Missed in Design Reviewing Meeting","Missed in Kick-Off Meeting","Missed in SUbmittal Review Meeting","Software EPDM issue","Software Solidworks Electrical Issue","Software Solidworks Mechanical Issue","Vendor provided inaccurate / insuffient information"];
					
					for (var i=0; i<option.length; i++) {
						var newOption = document.createElement('option');
						newOption.innerText = option[i];
						newOption.setAttribute('value', option[i]);
						selectobject.appendChild(newOption);
					}
					
				}
				}





				//BOM Intial Release
				else if(n=="BOM Initial Release")
				{
					
				var selectobject = document.getElementById("change-source");
				var chkbox=document.getElementById("typeofchange"+id);
				if(chkbox.checked)
				{
					for (var i=0; i<selectobject.length; i++) {
						if (selectobject.options[i].value != "Releases (BOM, Initial Construction, Initial Pre-BOM)")
						{
							selectobject.remove(i);
							i--;
						}
					}
				}
				else
				{
					const option = ["Application Engineer", "Electrical Design Engineer", "Electrical Engineer","Mechanical Engineer","KA","Project Management","Assembly","Fabrication","Sales","Site As-Built(As-Installed)","Testing/As-Built","Vendor (Lead time issues, Missing part info, Obsolete part, etc)"];
					
					for (var i=0; i<option.length; i++) {
						var newOption = document.createElement('option');
						newOption.innerText = option[i];
						newOption.setAttribute('value', option[i]);
						selectobject.appendChild(newOption);
					}
					
				}



				//cause code
				var selectobject = document.getElementById("causecode");
				if(chkbox.checked)
				{
					for (var i=0; i<selectobject.length; i++) {
						if (selectobject.options[i].value != "Releases")
						{
							selectobject.remove(i);
							i--;
						}
					}
				}
				else
				{
					const option = ["Customer","Engineering Error - Not on BOM","Engineering Error - Design(Form / Fit / Function )","Fabrication","Software Issues","Vendor"];
					
					for (var i=0; i<option.length; i++) {
						var newOption = document.createElement('option');
						newOption.innerText = option[i];
						newOption.setAttribute('value', option[i]);
						selectobject.appendChild(newOption);
					}
					
				}


				//cause sub code
				var selectobject = document.getElementById("causescode");
				if(chkbox.checked)
				{
					for (var i=0; i<selectobject.length; i++) {
						if (selectobject.options[i].value != "Initial BOM Release" && selectobject.options[i].value != "Initial BOM / FAB Release")
						{
							selectobject.remove(i);
							i--;
						}
					}
				}
				else
				{
					const option = ["Customer Change","Customer Request","Fabrication Internal Tooling Constraint(s)","Initial Construction Release","Initial Pre-BOM Release","Engineer Failed to Follow Through","Engineer Failed to Pick Correct Wire Sizing","Engineer Failed to read the Qoute","Engineer Missed on Detailing Drawing","Engineer Missed on the Model","Engineer Incorrectly Exported BOM","Engineer Incorrectly Updated BOM","Engineer Incorrectly Exported Pre-BOM","Engineer Incorrectly Updated Pre-BOM","Missed in Design Reviewing Meeting","Missed in Kick-Off Meeting","Missed in SUbmittal Review Meeting","Software EPDM issue","Software Solidworks Electrical Issue","Software Solidworks Mechanical Issue","Vendor provided inaccurate / insuffient information"];
					
					for (var i=0; i<option.length; i++) {
						var newOption = document.createElement('option');
						newOption.innerText = option[i];
						newOption.setAttribute('value', option[i]);
						selectobject.appendChild(newOption);
					}
					
				}
				}
              // FAB Initial Release
               else if(n=="Fabricated Parts List Release")
				{
					
				var selectobject = document.getElementById("change-source");
				var chkbox=document.getElementById("typeofchange"+id);
				if(chkbox.checked)
				{
					for (var i=0; i<selectobject.length; i++) {
						if (selectobject.options[i].value != "Releases (BOM, Initial Construction, Initial Pre-BOM)")
						{
							selectobject.remove(i);
							i--;
						}
					}
				}
				else
				{
					const option = ["Application Engineer", "Electrical Design Engineer", "Electrical Engineer","Mechanical Engineer","KA","Project Management","Assembly","Fabrication","Sales","Site As-Built(As-Installed)","Testing/As-Built","Vendor (Lead time issues, Missing part info, Obsolete part, etc)"];
					
					for (var i=0; i<option.length; i++) {
						var newOption = document.createElement('option');
						newOption.innerText = option[i];
						newOption.setAttribute('value', option[i]);
						selectobject.appendChild(newOption);
					}
					
				}



				//cause code
				var selectobject = document.getElementById("causecode");
				if(chkbox.checked)
				{
					for (var i=0; i<selectobject.length; i++) {
						if (selectobject.options[i].value != "Releases")
						{
							selectobject.remove(i);
							i--;
						}
					}
				}
				else
				{
					const option = ["Customer","Engineering Error - Not on BOM","Engineering Error - Design(Form / Fit / Function )","Fabrication","Software Issues","Vendor"];
					
					for (var i=0; i<option.length; i++) {
						var newOption = document.createElement('option');
						newOption.innerText = option[i];
						newOption.setAttribute('value', option[i]);
						selectobject.appendChild(newOption);
					}
					
				}


				//cause sub code
				var selectobject = document.getElementById("causescode");
				if(chkbox.checked)
				{
					for (var i=0; i<selectobject.length; i++) {
						if (selectobject.options[i].value != "Initial BOM Release" && selectobject.options[i].value != "Initial BOM / FAB Release")
						{
							selectobject.remove(i);
							i--;
						}
					}
				}
				else
				{
					const option = ["Customer Change","Customer Request","Fabrication Internal Tooling Constraint(s)","Initial Construction Release","Initial Pre-BOM Release","Engineer Failed to Follow Through","Engineer Failed to Pick Correct Wire Sizing","Engineer Failed to read the Qoute","Engineer Missed on Detailing Drawing","Engineer Missed on the Model","Engineer Incorrectly Exported BOM","Engineer Incorrectly Updated BOM","Engineer Incorrectly Exported Pre-BOM","Engineer Incorrectly Updated Pre-BOM","Missed in Design Reviewing Meeting","Missed in Kick-Off Meeting","Missed in SUbmittal Review Meeting","Software EPDM issue","Software Solidworks Electrical Issue","Software Solidworks Mechanical Issue","Vendor provided inaccurate / insuffient information"];
					
					for (var i=0; i<option.length; i++) {
						var newOption = document.createElement('option');
						newOption.innerText = option[i];
						newOption.setAttribute('value', option[i]);
						selectobject.appendChild(newOption);
					}
					
				}
				}



				//Initial Construction Release
					
				else if(n=="Initial Construction Release")
				{
					
				var selectobject = document.getElementById("change-source");
				var chkbox=document.getElementById("typeofchange"+id);
				if(chkbox.checked)
				{
					for (var i=0; i<selectobject.length; i++) {
						if (selectobject.options[i].value != "Releases (BOM, Initial Construction, Initial Pre-BOM)")
						{
							selectobject.remove(i);
							i--;
						}
					}
				}
				else
				{
					const option = ["Application Engineer", "Electrical Design Engineer", "Electrical Engineer","Mechanical Engineer","KA","Project Management","Assembly","Fabrication","Sales","Site As-Built(As-Installed)","Testing/As-Built","Vendor (Lead time issues, Missing part info, Obsolete part, etc)"];
					
					for (var i=0; i<option.length; i++) {
						var newOption = document.createElement('option');
						newOption.innerText = option[i];
						newOption.setAttribute('value', option[i]);
						selectobject.appendChild(newOption);
					}
					
				}



				//cause code
				var selectobject = document.getElementById("causecode");
				if(chkbox.checked)
				{
					for (var i=0; i<selectobject.length; i++) {
						if (selectobject.options[i].value != "Releases")
						{
							selectobject.remove(i);
							i--;
						}
					}
				}
				else
				{
					const option = ["Customer","Engineering Error - Not on BOM","Engineering Error - Design(Form / Fit / Function )","Fabrication","Software Issues","Vendor"];
					
					for (var i=0; i<option.length; i++) {
						var newOption = document.createElement('option');
						newOption.innerText = option[i];
						newOption.setAttribute('value', option[i]);
						selectobject.appendChild(newOption);
					}
					
				}


				//cause sub code
				var selectobject = document.getElementById("causescode");
				if(chkbox.checked)
				{
					for (var i=0; i<selectobject.length; i++) {
						if (selectobject.options[i].value != "Initial Construction Release" )
						{
							selectobject.remove(i);
							i--;
						}
					}
				}
				else
				{
					const option = ["Customer Change","Customer Request","Initial Pre-BOM Release","Fabrication Internal Tooling Constraint(s)","Initial BOM Release","Initial BOM / FAB Release","Engineer Failed to Follow Through","Engineer Failed to Pick Correct Wire Sizing","Engineer Failed to read the Qoute","Engineer Missed on Detailing Drawing","Engineer Missed on the Model","Engineer Incorrectly Exported BOM","Engineer Incorrectly Updated BOM","Engineer Incorrectly Exported Pre-BOM","Engineer Incorrectly Updated Pre-BOM","Missed in Design Reviewing Meeting","Missed in Kick-Off Meeting","Missed in SUbmittal Review Meeting","Software EPDM issue","Software Solidworks Electrical Issue","Software Solidworks Mechanical Issue","Vendor provided inaccurate / insuffient information"];
					
					for (var i=0; i<option.length; i++) {
						var newOption = document.createElement('option');
						newOption.innerText = option[i];
						newOption.setAttribute('value', option[i]);
						selectobject.appendChild(newOption);
					}
					
				}
				}



				//BOM Revision

				else if(n=="BOM Revision")
				{
					
				var selectobject = document.getElementById("change-source");
				var chkbox=document.getElementById("typeofchange"+id);
				if(chkbox.checked)
				{
					for (var i=0; i<selectobject.length; i++) {
						if (selectobject.options[i].value != "Application Engineer" && selectobject.options[i].value != "Electrical Design Engineer" && selectobject.options[i].value != "Electrical Engineer" && selectobject.options[i].value != "Mechanical Engineer" && selectobject.options[i].value != "KA" && selectobject.options[i].value != "Project Management" && selectobject.options[i].value != "Assembly" && selectobject.options[i].value != "Fabrication" && selectobject.options[i].value != "Sales" && selectobject.options[i].value != "Site As-Built(As-Installed)" && selectobject.options[i].value != "Vendor (Lead time issues, Missing part info, Obsolete part, etc)")
						{
							selectobject.remove(i);
							i--;
						}
					}
				}
				else
				{
					const option = ["Releases ", "Testing/As-Built & Site As-Built"];
					
					for (var i=0; i<option.length; i++) {
						var newOption = document.createElement('option');
						newOption.innerText = option[i];
						newOption.setAttribute('value', option[i]);
						selectobject.appendChild(newOption);
					}
					
				}



				//cause code
				var selectobject = document.getElementById("causecode");
				if(chkbox.checked)
				{
					for (var i=0; i<selectobject.length; i++) {
						if (selectobject.options[i].value != "Customer"  && selectobject.options[i].value != "Fabrication" && selectobject.options[i].value != "Software Issues" && selectobject.options[i].value != "Vendor" && selectobject.options[i].value != "Engineering Error - Not on BOM"  && selectobject.options[i].value != "Engineering Error - Design(Form / Fit / Function )" )
						{
							selectobject.remove(i);
							i--;
						}
					}
				}
				else
				{
					const option = ["Releases"];
					
					for (var i=0; i<option.length; i++) {
						var newOption = document.createElement('option');
						newOption.innerText = option[i];
						newOption.setAttribute('value', option[i]);
						selectobject.appendChild(newOption);
					}
					
				}


				//cause sub code
				var selectobject = document.getElementById("causescode");
				if(chkbox.checked)
				{
					for (var i=0; i<selectobject.length; i++) {
						if (selectobject.options[i].value !="Customer Change" && selectobject.options[i].value !="Fabrication Internal Tooling Constraint(s)" && selectobject.options[i].value !="Customer Request"  && selectobject.options[i].value !="Engineer Failed to Follow Through" && selectobject.options[i].value !="Engineer Failed to Pick Correct Wire Sizing" && selectobject.options[i].value !="Engineer Failed to read the Qoute" && selectobject.options[i].value !="Engineer Missed on Detailing Drawing" && selectobject.options[i].value !="Engineer Missed on the Model" && selectobject.options[i].value !="Engineer Incorrectly Exported BOM" && selectobject.options[i].value !="Engineer Incorrectly Updated BOM" && selectobject.options[i].value !="Engineer Incorrectly Exported Pre-BOM" && selectobject.options[i].value !="Engineer Incorrectly Updated Pre-BOM" && selectobject.options[i].value !="Missed in Design Reviewing Meeting" && selectobject.options[i].value !="Missed in Kick-Off Meeting" && selectobject.options[i].value !="Missed in SUbmittal Review Meeting" && selectobject.options[i].value !="Software EPDM issue" && selectobject.options[i].value !="Software Solidworks Electrical Issue" && selectobject.options[i].value !="Software Solidworks Mechanical Issue" && selectobject.options[i].value !="Vendor provided inaccurate / insuffient information")
						{
							selectobject.remove(i);
							i--;
						}
						
					}
				}
				else
				{
					const option = ["Initial Pre-BOM Release","Initial BOM Release","Initial BOM / FAB Release","Initial Construction Release"];
					
					for (var i=0; i<option.length; i++) {
						var newOption = document.createElement('option');
						newOption.innerText = option[i];
						newOption.setAttribute('value', option[i]);
						selectobject.appendChild(newOption);
					}
					
				}
				}
					//FAB Revison
					else if(n=="Fabricated Parts List Revision")
				{
					
				var selectobject = document.getElementById("change-source");
				var chkbox=document.getElementById("typeofchange"+id);
				if(chkbox.checked)
				{
					for (var i=0; i<selectobject.length; i++) {
						if (selectobject.options[i].value != "Application Engineer" && selectobject.options[i].value != "Electrical Design Engineer" && selectobject.options[i].value != "Electrical Engineer" && selectobject.options[i].value != "Mechanical Engineer" && selectobject.options[i].value != "KA" && selectobject.options[i].value != "Project Management" && selectobject.options[i].value != "Assembly" && selectobject.options[i].value != "Fabrication" && selectobject.options[i].value != "Sales" && selectobject.options[i].value != "Site As-Built(As-Installed)" && selectobject.options[i].value != "Vendor (Lead time issues, Missing part info, Obsolete part, etc)")
						{
							selectobject.remove(i);
							i--;
						}
					}
				}
				else
				{
					const option = ["Releases ", "Testing/As-Built & Site As-Built"];
					
					for (var i=0; i<option.length; i++) {
						var newOption = document.createElement('option');
						newOption.innerText = option[i];
						newOption.setAttribute('value', option[i]);
						selectobject.appendChild(newOption);
					}
					
				}



				//cause code
				var selectobject = document.getElementById("causecode");
				if(chkbox.checked)
				{
					for (var i=0; i<selectobject.length; i++) {
						if (selectobject.options[i].value != "Customer"  && selectobject.options[i].value != "Fabrication" && selectobject.options[i].value != "Software Issues" && selectobject.options[i].value != "Vendor" && selectobject.options[i].value != "Engineering Error - Not on BOM"  && selectobject.options[i].value != "Engineering Error - Design(Form / Fit / Function )" )
						{
							selectobject.remove(i);
							i--;
						}
					}
				}
				else
				{
					const option = ["Releases"];
					
					for (var i=0; i<option.length; i++) {
						var newOption = document.createElement('option');
						newOption.innerText = option[i];
						newOption.setAttribute('value', option[i]);
						selectobject.appendChild(newOption);
					}
					
				}


				//cause sub code
				var selectobject = document.getElementById("causescode");
				if(chkbox.checked)
				{
					for (var i=0; i<selectobject.length; i++) {
						if (selectobject.options[i].value !="Customer Change" && selectobject.options[i].value !="Fabrication Internal Tooling Constraint(s)" && selectobject.options[i].value !="Customer Request"  && selectobject.options[i].value !="Engineer Failed to Follow Through" && selectobject.options[i].value !="Engineer Failed to Pick Correct Wire Sizing" && selectobject.options[i].value !="Engineer Failed to read the Qoute" && selectobject.options[i].value !="Engineer Missed on Detailing Drawing" && selectobject.options[i].value !="Engineer Missed on the Model" && selectobject.options[i].value !="Engineer Incorrectly Exported BOM" && selectobject.options[i].value !="Engineer Incorrectly Updated BOM" && selectobject.options[i].value !="Engineer Incorrectly Exported Pre-BOM" && selectobject.options[i].value !="Engineer Incorrectly Updated Pre-BOM" && selectobject.options[i].value !="Missed in Design Reviewing Meeting" && selectobject.options[i].value !="Missed in Kick-Off Meeting" && selectobject.options[i].value !="Missed in SUbmittal Review Meeting" && selectobject.options[i].value !="Software EPDM issue" && selectobject.options[i].value !="Software Solidworks Electrical Issue" && selectobject.options[i].value !="Software Solidworks Mechanical Issue" && selectobject.options[i].value !="Vendor provided inaccurate / insuffient information")
						{
							selectobject.remove(i);
							i--;
						}
						
					}
				}
				else
				{
					const option = ["Initial Pre-BOM Release","Initial BOM Release","Initial BOM / FAB Release","Initial Construction Release"];
					
					for (var i=0; i<option.length; i++) {
						var newOption = document.createElement('option');
						newOption.innerText = option[i];
						newOption.setAttribute('value', option[i]);
						selectobject.appendChild(newOption);
					}
					
				}
				}

				//REvised COnstruction release

				else if(n=="Revised Construction Release")
				{
					
				var selectobject = document.getElementById("change-source");
				var chkbox=document.getElementById("typeofchange"+id);
				if(chkbox.checked)
				{
					for (var i=0; i<selectobject.length; i++) {
						if (selectobject.options[i].value != "Application Engineer" && selectobject.options[i].value != "Electrical Design Engineer" && selectobject.options[i].value != "Electrical Engineer" && selectobject.options[i].value != "Mechanical Engineer" && selectobject.options[i].value != "KA"  && selectobject.options[i].value != "Testing/As-Built & Site As-Built" && selectobject.options[i].value != "Project Management" && selectobject.options[i].value != "Assembly" && selectobject.options[i].value != "Fabrication" && selectobject.options[i].value != "Sales" && selectobject.options[i].value != "Site As-Built(As-Installed)" && selectobject.options[i].value != "Vendor (Lead time issues, Missing part info, Obsolete part, etc)")
						{
							selectobject.remove(i);
							i--;
						}
					}
				}
				else
				{
					const option = ["Releases "];
					
					for (var i=0; i<option.length; i++) {
						var newOption = document.createElement('option');
						newOption.innerText = option[i];
						newOption.setAttribute('value', option[i]);
						selectobject.appendChild(newOption);
					}
					
				}



				//cause code
				var selectobject = document.getElementById("causecode");
				if(chkbox.checked)
				{
					for (var i=0; i<selectobject.length; i++) {
						if (selectobject.options[i].value != "Customer"  && selectobject.options[i].value != "Fabrication" && selectobject.options[i].value != "Software Issues" && selectobject.options[i].value != "Vendor" && selectobject.options[i].value != "Engineering Error - Not on BOM"  && selectobject.options[i].value != "Engineering Error - Design(Form / Fit / Function )" )
						{
							selectobject.remove(i);
							i--;
						}
					}
				}
				else
				{
					const option = ["Releases"];
					
					for (var i=0; i<option.length; i++) {
						var newOption = document.createElement('option');
						newOption.innerText = option[i];
						newOption.setAttribute('value', option[i]);
						selectobject.appendChild(newOption);
					}
					
				}


				//cause sub code
				var selectobject = document.getElementById("causescode");
				if(chkbox.checked)
				{
					for (var i=0; i<selectobject.length; i++) {
						if ( selectobject.options[i].value !="Customer Change" && selectobject.options[i].value !="Fabrication Internal Tooling Constraint(s)" && selectobject.options[i].value !="Customer Request"  && selectobject.options[i].value !="Engineer Failed to Follow Through" && selectobject.options[i].value !="Engineer Failed to Pick Correct Wire Sizing" && selectobject.options[i].value !="Engineer Failed to read the Qoute" && selectobject.options[i].value !="Engineer Missed on Detailing Drawing" && selectobject.options[i].value !="Engineer Missed on the Model" && selectobject.options[i].value !="Engineer Incorrectly Exported BOM" && selectobject.options[i].value !="Engineer Incorrectly Updated BOM" && selectobject.options[i].value !="Engineer Incorrectly Exported Pre-BOM" && selectobject.options[i].value !="Engineer Incorrectly Updated Pre-BOM" && selectobject.options[i].value !="Missed in Design Reviewing Meeting" && selectobject.options[i].value !="Missed in Kick-Off Meeting" && selectobject.options[i].value !="Missed in SUbmittal Review Meeting" && selectobject.options[i].value !="Software EPDM issue" && selectobject.options[i].value !="Software Solidworks Electrical Issue" && selectobject.options[i].value !="Software Solidworks Mechanical Issue" && selectobject.options[i].value !="Vendor provided inaccurate / insuffient information")
						{
							selectobject.remove(i);
							i--;
						}
						
					}
				}
				else
				{
					const option = ["Initial Pre-BOM Release","Initial BOM Release","Initial BOM / FAB Release","Initial Construction Release"];
					
					for (var i=0; i<option.length; i++) {
						var newOption = document.createElement('option');
						newOption.innerText = option[i];
						newOption.setAttribute('value', option[i]);
						selectobject.appendChild(newOption);
					}
					
				}
				}

				

            }

$(document).on('ready', function () {

 $("#change-source").on('change', function () {
	var el = $(this);
	var selectobject = document.getElementById("causecode");
			if (el.val() === "Application Engineer" || el.val() === "Electrical Design Engineer" || el.val() === "Electrical Engineer" || el.val() === "Mechanical Engineer" ) {
				for (var i=0; i<selectobject.length; i++) {
						if (selectobject.options[i].value !="Engineering Error - Not on BOM" && selectobject.options[i].value !="Engineering Error - Design(Form / Fit / Function )" )
						{
							selectobject.remove(i);
							i--;
						}
					}
	     }
	
				
				
				else
				{
					const option = ["Customer","Releases","Fabrication","Software Issues","Vendor"];
					
					for (var i=0; i<option.length; i++) {
						var newOption = document.createElement('option');
						newOption.innerText = option[i];
						newOption.setAttribute('value', option[i]);
						selectobject.appendChild(newOption);
					}
					
				}
       
				var selectobject = document.getElementById("causescode");
				if (el.val() === "Application Engineer" || el.val() === "Electrical Design Engineer" || el.val() === "Electrical Engineer" || el.val() === "Mechanical Engineer" ) 
				{
					for (var i=0; i<selectobject.length; i++) {
						if (selectobject.options[i].value != "Engineer Failed to Follow Through"  && selectobject.options[i].value !="Engineer Failed to Pick Correct Wire Sizing"&& selectobject.options[i].value !="Engineer Failed to read the Qoute"&& selectobject.options[i].value !="Engineer Missed on Detailing Drawing"&& selectobject.options[i].value !="Engineer Missed on the Model"&& selectobject.options[i].value !="Engineer Incorrectly Exported BOM"&& selectobject.options[i].value !="Engineer Incorrectly Updated BOM"&& selectobject.options[i].value !="Engineer Incorrectly Exported Pre-BOM"&& selectobject.options[i].value !="Engineer Incorrectly Updated Pre-BOM"&& selectobject.options[i].value !="Missed in Design Reviewing Meeting"&& selectobject.options[i].value !="Missed in Kick-Off Meeting"&& selectobject.options[i].value !="Missed in SUbmittal Review Meeting"&& selectobject.options[i].value !="Software EPDM issue"&& selectobject.options[i].value !="Software Solidworks Electrical Issue"&& selectobject.options[i].value !="Software Solidworks Mechanical Issue"  )
						{
							selectobject.remove(i);
							i--;
						}
					}
				}
				else
				{
					const option = ["Customer Change","Initial Pre-BOM Release","Customer Request","Fabrication Internal Tooling Constraint(s)","Initial BOM Release","Initial BOM / FAB Release","Initial Construction Release",,"Vendor provided inaccurate / insuffient information"];
					
					for (var i=0; i<option.length; i++) {
						var newOption = document.createElement('option');
						newOption.innerText = option[i];
						newOption.setAttribute('value', option[i]);
						selectobject.appendChild(newOption);
					}
					
				}
			
 });
 
});


function ckChange(ckType){
    var ckName = document.getElementsByName(ckType.name);
    var checked = document.getElementById(ckType.id);

    if (checked.checked) {
      for(var i=0; i < ckName.length; i++){

          if(!ckName[i].checked){
              ckName[i].disabled = true;
          }else{
              ckName[i].disabled = false;
          }
      } 
    }
    else {
      for(var i=0; i < ckName.length; i++){
        ckName[i].disabled = false;
      } 
    }    
}
</script>