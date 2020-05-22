<?php
  session_start();

  require 'conexion.php';

  if (isset($_SESSION['id_user'])) {
    $records = $conn->prepare('SELECT id_user,id_empleado,username,password,tipo FROM user WHERE id_user = :id');
    $records->bindParam(':id',$_SESSION['id_user']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
        $user = $results;
    }
  }
 ?>

<?php require 'includes/header.php'; ?>
  <br>
  <?php if(!empty($user)): ?>
<div class="container-fluid mt-4">
  <div class="card">
    <div class="card-body">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-body">
              <form action="create_venta.php" method="post">
                <div class="row">
                  <div class="col-8">
                    <input type="text" name="id_producto" class="form-control" placeholder="Id del producto" autofocus>
                  </div>
                  <div class="col-4">
                    <input type="submit" class="btn btn-success" name="save_venta" value="Agregar a venta">
                  </div>
                </div>
              </form>

              <div class="row mt-4">
                <div class="col-sm-6">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>ID producto</th>
                          <th>Nombre del producto</th>
                          <th>Costo</th>
                          <th>Eliminar</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $records = $conn->prepare("SELECT * FROM venta");
                          $records->execute();

                          while ($row = $records->fetch()) { ?>
                            <tr>
                              <td><?php echo $row['id_producto']; ?></td>
                              <td><?php echo $row['nombre']; ?></td>
                              <td><?php echo $row['precio']; ?></td>
                              <td>
                                <a href="delete_venta.php?id=<?php echo $row['id_venta'] ?>" class="btn btn-danger">
                                  <i class="far fa-trash-alt"></i>
                                </a>
                              </td>
                            </tr>
                         <?php } ?>
                      </tbody>
                    </table>
                </div>
                <div class="col-sm-6">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Total</th>
                          <th>Vender</th>
                          <!--<th>Factura</th>-->
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $records2 = $conn->prepare("SELECT SUM(precio) FROM venta");
                          $records2->execute();

                          $row2 = $records2->fetch() ?>

                          <td><?php echo $row2['SUM(precio)'] ?></td>
                          <td>
                            <a href="do_sell.php?id=<?php echo $results['id_empleado'] ?>&total=<?php echo $row2['SUM(precio)'] ?>&product=<?php $row['id_producto'] ?>" class="btn btn-success">
                              <i class="fas fa-shopping-cart"></i>
                            </a>
                          </td>
                          <!--<td>
                            <a href="#" class="btn btn-primary">
                              <i class="fas fa-file-invoice-dollar"></i>
                            </a>
                          </td>-->
                      </tbody>
                    </table>
                </div>
              </div>


            </div>
          </div>
        </div>
    </div>
  </div>
</div>


  <?php else: ?>
    header("Location: /Proyecto");
  <?php endif; ?>

<?php require 'includes/footer.php'; ?>
