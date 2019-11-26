<?php

// Set parameters
$apikey = 'f3ea58bc-f845-47ce-abc2-d2006e1db4da';

$cont = '';

$data = json_decode(file_get_contents("php://input"));

$name = $data->name;
$id = $data->id;
$phnno = $data->phnno;
$billno = $data->billno;
$date = $data->date;
$time = $data->time;

$cont = $cont.'Name : '.$name.'<br>';
$cont = $cont.'CustomerId : '.$id.'<br>';
$cont = $cont.'Phone No. : '.$phnno.'<br>';
$cont = $cont.'Bill No. : '.$billno.'<br>';
$cont = $cont.'Date : '.$date.'<br>';
$cont = $cont.'Time : '.$time.'<br>';
$cont = $cont.'<br>';

$arr = $data->prod;

$i = 0;
$list = '';
while ($i < count($arr)) {
    $row = get_object_vars($arr[$i]);
    $list = $list.'<tr>';
    $list = $list.'<td>'.($i+1).'</td>';
    $list = $list.'<td>'.$row['pname'].'</td>';
    $list = $list.'<td>'.$row['rpppu'].'</td>';
    $list = $list.'<td>'.$row['pppu'].'</td>';
    $list = $list.'<td>'.$row['pnum'].'</td>';
    $list = $list.'<td>'.$row['pprice'].'</td>';
    $list = $list.'</tr>';
    $i++;   
}

$tot = $data->total;
$total = '';
$total = $total.'<div style="text-align:right;width:500px;zoom:203%">';
$total = $total.'<br>';
$total = $total.'Total = Rs.'.$tot;
$total = $total.'</div>';

if(empty($name) || empty($id) || empty($phnno) || empty($billno) || empty($date) || empty($time) || empty($arr) || empty($tot))
	exit();

$value = '<div style="text-align:center;width:500px;zoom:203%">'.$cont.'
				<table style="width:500px;">

					<col width="44">
					<col >
		  			<col width="87">
		  			<col width="100">
					<col width="44">
					<col width="42">

					<tr>
						<th>S.No.</th>
						<th>Product Name</th>
						<th>Retail PPU</th>
						<th>PricePerUnit</th>
						<th>Units</th>
						<th>Price</th>
					</tr>'.$list.'</tr>
				</table>
			</div>'.$total; // can aso be a url, starting with http..
 
// Convert the HTML string to a PDF using those parameters.  Note if you have a very long HTML string use POST rather than get.  See example #5
$result = file_get_contents("http://api.html2pdfrocket.com/pdf?apikey=" . urlencode($apikey) . "&value=" . urlencode($value));
 
// Save to root folder in website
file_put_contents('../bills/'.$billno.'.pdf', $result);

//header("Location: ../billing.php?bill=success&disp");
//exit();

echo 1;

?>