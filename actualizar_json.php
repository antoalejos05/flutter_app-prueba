<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Aquí se incluyen todos los métodos permitidos, incluido PUT
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header('Content-Type: application/json');

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT') { 
   $con=new mysqli($servidor, $user, $clave, $bd);
   if($con->connect_error) {
     die("Conexion fallida: " . $con->connect_error);
   }
   $json=file_get_contents('php://input');
   $data=json_decode($json);

   $id = $data->{'id_producto'};
   $nomprodu = $data->{'nomprodu'};
   $descripcion = $data->{'descripcion'};
   $precio = $data->{'precio'};
   $stock = $data->{'stock'};


   $sql =  "SELECT id_producto FROM Productos WHERE id_producto='$id'";
   $res =  $con->query($sql);
   $tot =	$res->num_rows;

   if ($tot > 0) {
        $sql = "UPDATE Productos 
                SET nomprodu='$nomprodu',
                    descripcion='$descripcion', 
                    precio='$precio', 
                    stock='$stock'
                WHERE id_producto='$id'";
        $res = $con->query($sql);
        if (!$res) {
            $mensaje = "ERROR: " . $con->error;
        } else {
            $mensaje = "ACTUALIZADO";
        }

        @mysqli_free_result($res);
        @mysqli_close($con);

        $response = array("resultado" => $mensaje);
        echo json_encode($response);
    } else {

        $response = array("resultado" => "Producto no encontrado");
        echo json_encode($response);
    }
}
?>
