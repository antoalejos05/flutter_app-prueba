<?php
header('Cache-Control: no-cache, must-revalidate');
header('Access-Control-Allow-Origin: *');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

    $connection = mysqli_connect("localhost","root","","vbtecnologi") 
		or die("Error " . mysqli_error($connection));

    $sql = "select nomprodu,descripcion,precio,stock from productos 
	 WHERE nomprodu='".$_GET['nomprodu']."'";
    $res = mysqli_query($connection, $sql) or die("Error " . mysqli_error($connection));

    $tot = $res->num_rows;
    $result = array();
    if($tot>0){        
        while($row =mysqli_fetch_row($res)) {
	array_push($result, array(
		'nomprodu'=>$row[0],
		'descripcion'=>$row[1],
		'precio'=>$row[2],
    'stock'=>$row[3]));
       }
        echo json_encode($result);
    }
    else{
         array_push($result, array(
		'nomprodu'=>'0',
		'descripcion'=>'0',
		'precio'=>'0',
    'stock'=>'0'));
    }
    @mysqli_close($connection);
?>