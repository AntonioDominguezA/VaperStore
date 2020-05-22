<?php
  session_start();

  require 'conexion.php';

  if (isset($_SESSION['id_user'])) {
    $records = $conn->prepare('SELECT id_user,username,password,tipo FROM user WHERE id_user = :id');
    $records->bindParam(':id',$_SESSION['id_user']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0)
        $user = $results;
    }

  if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $records = $conn->prepare("SELECT product.*, provider.id_provider, provider.name as namep FROM product, provider WHERE id_producto = '$id' and product.id_provider = provider.id_provider");
    $records->execute();

    if($results = $records->fetch()) {
      $nombre = $results['name'];
      $precio = $results['price'];
      $cantidad = $results['quantity'];
      $id_proveedor = $results['id_provider'];
      $nombrep = $results['namep'];
      $url = $results['picture'];
    }
  }

  if (isset($_POST['save_product'])) {
    $id = $_GET['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $id_proveedor = $_POST['id_proveedor'];
    $foto = $_FILES['foto'];
    $ruta = "";

    if(!empty($foto['name'])) {
      $ruta = 'img/'.$foto['name'];
    } else {
      $ruta = $url;
    }

    $message = "";

    $records = $conn->prepare("SELECT id_provider FROM provider WHERE id_provider = '$id_proveedor'");
    $records->execute();
    $results = $records->fetch();

    $id_validate = $results['id_provider'];

    if($id_proveedor == $id_validate) {

      $consulta = "UPDATE product SET name = '$nombre', price = '$precio', quantity = '$cantidad', picture = '$ruta', id_provider = '$id_proveedor' WHERE id_producto = '$id'";

      $stmt = $conn->prepare($consulta);

      if($stmt->execute()) {
        $message = 'Successfully';
      } else {
        $message = 'Sorry there must have been an issue';
      }

      header('Location: menu.php');
    } else {
      $message = 'Sorry the provider does not exist';
    }
  }
 ?>

<?php require 'includes/header.php'; ?>

<div class="container-fluid" style="margin-top:20px">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Editar producto</h5>
      <div class="container">
        <div class="row">
          <div class="col-6 mx-auto">
            <div class="card card-body">
              <form action="edit_product.php?id=<?php echo $_GET['id']?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="text" name="nombre" value="<?php echo $nombre; ?>" class="form-control" placeholder="Nombre del producto" data-validation="alphanumeric" data-validation-allowing=" ">
                </div>
                <div class="form-group">
                  <input type="text" name="precio" value="<?php echo $precio; ?>" class="form-control" placeholder="Precio" data-validation="number">
                </div>
                <div class="form-group">
                    <input type="number" name="cantidad" value="<?php echo $cantidad; ?>" class="form-control" value="0" data-validation="number">
                </div>
                <div class="form-group">
                  <input type="text" name="id_proveedor" value="<?php echo $id_proveedor; ?>" class="form-control" placeholder="ID proveedor" data-validation="number">
                </div>
                <fieldset disabled>
                  <div class="form-group">
                    <input type="text" name="nombre_proveedor" value="<?php echo $nombrep; ?>" class="form-control" placeholder="Nombre del proveedor" >
                  </div>
                </fieldset>
                <div class="form-group">
                  <p>Directorio imagen actual <?php echo $url; ?></p>
                  <img src="<?php echo $url; ?>" alt="" width="30%" height="30%">
                  <br>
                  <label for="exampleFormControlFile1">Elige una imagen</label>
                  <input type="file" name="foto" class="form-control-file" id="exampleFormControlFile1">
                </div>
                <button type="submit" name="save_product" class="btn btn-success btn-block">Editar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php require 'includes/footer.php'; ?>
