<?php
$connect = mysqli_connect("localhost", "root", "", "ecn");
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM ecndetails
	WHERE ecnno LIKE '%".$search."%'
	OR jobno LIKE '%".$search."%'
	OR jobname LIKE '%".$search."%'
	OR product LIKE '%".$search."%'
	OR engineer LIKE '%".$search."%'
	";
}
else
{
	$query = "
	SELECT * FROM ecndetails ORDER BY ECNNO LIMIT 50 ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
						<th>Job No</th>
						<th>Job Name</th>
						<th>ECN No</th>
						<th>Product Type</th>
						<th>Engineer</th>
						<th>Search</th>
						</tr>';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			<tr>
			<td>'.$row["jobno"].'</td>
				<td>'.$row["jobname"].'</td>
				<td>'.$row["ecnno"].'</td>
				<td>'.$row["product"].'</td>
				<td>'.$row["engineer"].'</td>
                <td><a href="display.php?id='.$row["ecnno"].'">Search</a></td>
			</tr>
		';
	}
	echo $output;
}
else
{
	echo 'Data Not Found';
}
?>