<?php
  session_start();

  require 'conexion.php';

  if (isset($_SESSION['id_user'])) {
    $records = $conn->prepare('SELECT id_user,username,password,tipo FROM user WHERE id_user = :id');
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

    <?php if(!empty($user)): ?>
      <div class="container-fluid" style="margin-top:20px">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Menú Administrador</h5>
            <div class="container-fluid">
              <ul class="nav nav-tabs">
                <li class="nav-item hovern">
                  <a class="nav-link active" data-toggle="tab" href="#tabs-1">Empleados</a>
                </li>
                <li class="nav-item hovern">
                  <a class="nav-link" data-toggle="tab" href="#tabs-2">Productos</a>
                </li>
                <li class="nav-item hovern">
                  <a class="nav-link" data-toggle="tab" href="#tabs-3">Proveedores</a>
                </li>
                <?php if($user['tipo'] == "root"): ?>
                <li class="nav-item hovern">
                  <a class="nav-link" data-toggle="tab" href="#tabs-4">Usuarios</a>
                </li>
                <?php endif; ?>
              </ul>
              <div class="tab-content bg-light">
                <div class="tab-pane fade active show" id="tabs-1">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-3">
                        <div class="card card-body" style="margin-top:20px">
                          <form action="save_employee.php" method="POST">
                            <div class="form-group">
                              <input type="text" name="nombre_empleado" class="form-control" placeholder="Nombre del empleado" autofocus data-validation="alphanumeric" data-validation-allowing=" ">
                            </div>
                            <div class="form-group">
                              <input type="text" name="apellido_empleado" class="form-control" placeholder="Apellido del empleado" data-validation="alphanumeric" data-validation-allowing=" ">
                            </div>
                            <div class="form-group">
                                <input type="text" name="rfc" class="form-control" placeholder="RFC del empleado" data-validation="alphanumeric" data-validation-length="min13">
                            </div>
                            <div class="form-group">
                              <label for="type_employee">Tipo de empleado</label>
                              <select class="form-control" name="tipo_empleado" id="type_employee" data-validation="required">
                                <option>Cajero</option>
                                <option>Soporte</option>
                                <option>Vendedor</option>
                                <option>Gerente</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <input type="text" name="escolaridad" class="form-control" placeholder="Escolaridad" data-validation="alphanumeric">
                            </div>
                            <div class="form-group">
                              <input type="text" name="direccion" class="form-control" placeholder="Direccion del empleado" data-validation="alphanumeric" data-validation-allowing=" ">
                            </div>
                            <div class="form-group">
                              <input type="text" name="cell-phone" class="form-control" placeholder="Telefono del empleado" data-validation="number">
                            </div>
                            <div class="form-group">
                              <input type="text" name="email" class="form-control" placeholder="Email del empleado" data-validation="email">
                            </div>
                            <input type="submit" class="btn btn-success btn-block" name="save_employee" value="Guardar Empleado">
                          </form>
                        </div>
                      </div>
                      <div class="col-9" style="margin-top:20px">
                        <table class="table table-bordered bg-white">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Nombre</th>
                              <th>RFC</th>
                              <th>Puesto</th>
                              <th>Escolaridad</th>
                              <th>Direccion</th>
                              <th>Telefono</th>
                              <th>Email</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                                $records = $conn->prepare("SELECT * FROM employee");
                                $records->execute();

                                while ($row = $records->fetch()) { ?>
                                  <tr>
                                    <td><?php echo $row['id_employee']; ?></td>
                                    <td><?php echo $row['name']; ?> <?php echo $row['last_name']; ?></td>
                                    <td><?php echo $row['RFC']; ?></td>
                                    <td><?php echo $row['type_employee']; ?></td>
                                    <td><?php echo $row['scholarship']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td><?php echo $row['phone']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td>
                                      <a href="edit_employee.php?id=<?php echo $row['id_employee'] ?>" class="btn btn-secondary">
                                        <i class="fa fa-edit"></i>
                                      </a>
                                      <a href="delete_employee.php?id=<?php echo $row['id_employee'] ?>" class="btn btn-danger">
                                        <i class="fa fa-trash-alt"></i>
                                      </a>
                                    </td>
                                  </tr>
                          <?php }
                             ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="tabs-2">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-3">
                        <div class="card card-body" style="margin-top:20px">
                          <form action="save_product.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                              <input type="text" name="nombre" class="form-control" placeholder="Nombre del producto" autofocus data-validation="alphanumeric" data-validation-allowing=" ">
                            </div>
                            <div class="form-group">
                              <input type="text" name="precio" class="form-control" placeholder="Precio" data-validation="number">
                            </div>
                            <div class="form-group">
                              <input class="form-control" type="number" value="0" name="cantidad" data-validation="number">
                            </div>
                            <div class="form-group">
                              <input type="text" name="id_proveedor" class="form-control" placeholder="ID del proveedor" data-validation="number">
                            </div>
                            <div class="form-group">
                              <label for="exampleFormControlFile1">Elige una imagen</label>
                              <input type="file" name="foto" class="form-control-file" id="exampleFormControlFile1">
                            </div>
                            <input type="submit" class="btn btn-success btn-block" name="save_product" value="Guardar Producto">
                          </form>
                        </div>
                      </div>
                      <div class="col-9" style="margin-top:20px">
                        <table class="table table-bordered bg-white">
                          <thead>
                            <tr>
                              <th>ID producto</th>
                              <th>Imagen</th>
                              <th>Nombre del producto</th>
                              <th>Precio</th>
                              <th>Cantidad</th>
                              <th>ID proveedor</th>
                              <th>Proveedor</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                                $records = $conn->prepare("SELECT product.*, provider.id_provider as id_p, provider.name as namep FROM product, provider WHERE product.id_provider = provider.id_provider");
                                $records->execute();

                                while ($row = $records->fetch()) { ?>
                                  <tr>
                                    <td><?php echo $row['id_producto']; ?></td>
                                    <td><img src="<?php echo $row['picture']; ?>" alt="<?php echo $row['name']; ?>" width="40%"></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td>$<?php echo $row['price']; ?></td>
                                    <td><?php echo $row['quantity']; ?></td>
                                    <td><?php echo $row['id_provider']; ?></td>
                                    <td><?php echo $row['namep']; ?></td>
                                    <td>
                                      <a href="edit_product.php?id=<?php echo $row['id_producto'] ?>" class="btn btn-secondary">
                                        <i class="fa fa-edit"></i>
                                      </a>
                                      <a href="delete_product.php?id=<?php echo $row['id_producto'] ?>" class="btn btn-danger">
                                        <i class="fa fa-trash-alt"></i>
                                      </a>
                                    </td>
                                  </tr>
                          <?php }
                             ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="tabs-3">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-3">
                        <div class="card card-body" style="margin-top:20px">
                          <form action="save_provider.php" method="POST">
                            <div class="form-group">
                              <input type="text" name="nombre_proveedor" class="form-control" placeholder="Nombre del proveedor" autofocus data-validation="alphanumeric" data-validation-allowing=" ">
                            </div>
                            <div class="form-group">
                              <input type="text" name="rfc" class="form-control" placeholder="RFC del proveedor" data-validation="alphanumeric" data-validation-length="min13">
                            </div>
                            <div class="form-group">
                              <input type="text" name="cell-phone" class="form-control" placeholder="Telefono del proveedor" data-validation="number">
                            </div>
                            <div class="form-group">
                              <input type="text" name="direccion" class="form-control" placeholder="Direccion del proveedor" data-validation="alphanumeric" data-validation-allowing=" ">
                            </div>
                            <div class="form-group">
                              <input type="text" name="email" class="form-control" placeholder="Email del proveedor" data-validation="email">
                            </div>
                            <input type="submit" class="btn btn-success btn-block" name="save_provider" value="Guardar Proveedor">
                          </form>
                        </div>
                      </div>
                      <div class="col-9" style="margin-top:20px">
                        <table class="table table-bordered bg-white">
                          <thead>
                            <tr>
                              <th>ID Proveedor</th>
                              <th>Nombre</th>
                              <th>RFC</th>
                              <th>Telefono</th>
                              <th>Direccion</th>
                              <th>Email</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $records = $conn->prepare("SELECT * FROM provider");
                            $records->execute();

                            while ($row = $records->fetch()) { ?>
                            <tr>
                              <td><?php echo $row['id_provider']; ?></td>
                              <td><?php echo $row['name']; ?></td>
                              <td><?php echo $row['RFC']; ?></td>
                              <td><?php echo $row['phone']; ?></td>
                              <td><?php echo $row['address']; ?></td>
                              <td><?php echo $row['email']; ?></td>
                              <td>
                                <a href="edit_provider.php?id=<?php echo $row['id_provider'] ?>" class="btn btn-secondary">
                                  <i class="fa fa-edit"></i>
                                </a>
                                <a href="delete_provider.php?id=<?php echo $row['id_provider'] ?>" class="btn btn-danger">
                                  <i class="fa fa-trash-alt"></i>
                                </a>
                              </td>
                            </tr>
                          <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="tabs-4">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-3">
                        <div class="card card-body" style="margin-top:20px">
                          <form action="save_user.php" method="POST">
                            <div class="form-group">
                              <input type="text" name="id_empleado" class="form-control" placeholder="ID empleado" autofocus data-validation="number">
                            </div>
                            <div class="form-group">
                              <input type="text" name="nombre_usuario" class="form-control" placeholder="Nombre de usuario" data-validation="alphanumeric" data-validation-allowing="-_">
                            </div>
                            <div class="form-group">
                              <input type="password" name="pass_confirmation" class="form-control" placeholder="Ingresa la contraseña" data-validation="length" data-validation-length="min8">
                            </div>
                            <div class="form-group">
                              <input type="password" name="pass" class="form-control" placeholder="Verificar contraseña" data-validation="confirmation">
                            </div>
                            <div class="form-group">
                              <label for="type_user">Tipo de usuario</label>
                              <select class="form-control" name="tipo_usuario" id="type_user" data-validation="required">
                                <option>root</option>
                                <option>Administrador</option>
                                <option>normal</option>
                              </select>
                            </div>
                            <input type="submit" class="btn btn-success btn-block" name="save_user" value="Guardar Usuario">
                          </form>
                        </div>
                      </div>
                      <div class="col-9" style="margin-top:20px">
                        <table class="table table-bordered bg-white">
                          <thead>
                            <tr>
                              <th>ID usuario</th>
                              <th>ID empleado</th>
                              <th>Nombre de usuario</th>
                              <th>Tipo de usuario</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $records = $conn->prepare("SELECT * FROM user");
                            $records->execute();

                            while ($row = $records->fetch()) { ?>
                            <tr>
                              <td><?php echo $row['id_user']; ?></td>
                              <td><?php echo $row['id_empleado']; ?></td>
                              <td><?php echo $row['username']; ?></td>
                              <td><?php echo $row['tipo']; ?></td>
                              <td>
                                <a href="edit_user.php?id=<?php echo $row['id_user'] ?>" class="btn btn-secondary">
                                  <i class="fa fa-edit"></i>
                                </a>
                                <a href="delete_user.php?id=<?php echo $row['id_user'] ?>" class="btn btn-danger">
                                  <i class="fa fa-trash-alt"></i>
                                </a>
                              </td>
                            </tr>
                          <?php } ?>
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
        </div>
      </div>



    <?php else: ?>
      header('Location: /Proyecto');
    <?php endif; ?>
</body>
</html>
