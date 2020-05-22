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
    <div class="container-fluid mt-4 ">
      <div class="card">
          <div class="card-body">
            <h5 class="card-title">Tickets</h5>
            <div class="row text-center">
              <div class="col-9">
                <table class="table table-bordered bg-white">
                  <thead>
                    <tr>
                      <th>Código del ticket</th>
                      <th>Fecha de realización</th>
                      <th>Ver ticket</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $records = $conn->prepare("SELECT ticket.*,employee.id_employee,employee.name as namet,employee.last_name as lname FROM ticket, employee WHERE ticket.id_empleado = employee.id_employee");
                      $records->execute();

                        while ($row = $records->fetch()) { ?>
                          <!-- Button trigger modal -->
                          <tr>
                            <td><?php echo $row['id_ticket']; ?></td>
                            <td><?php echo $row['fecha']; ?></td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#h<?php echo $row['id_ticket']; ?>modal">
                              <i class="fa fa-eye"></i>
                            </button></td>
                          </tr>


                          <!-- Modal -->
                          <div class="modal fade" id="h<?php echo $row['id_ticket']; ?>modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Ticket #<?php echo $row['id_ticket']; ?></h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <br>
                          				<img src="includes/img/logo.PNG" class="rounded mx-auto d-block" alt="Vaper" style="width: 20%;height:20%">
                          				<br>
                          				<h1>VAPERSTORE</h1>
                          				<p>Ticket de venta #<?php echo $row['id_ticket']; ?></p>
                          				<p>Direccion: Direccion de prueba #1234, Col. Colonia chida, Guadalajara, Jalisco, Mexico</p>
                          				<p>RFC: 1234567890</p>
                                  <p>Lo atendió: <?php echo $row['namet']." "; echo $row['lname']; ?></p>
                          				<p>Fecha: <?php echo $row['fecha']; ?></p>
                          				<p>Descripcion: </p>
                          				<hr>
                          				<div class="container">
                                    <p class="h3"><?php echo $row['descripcion']; ?></p>
                          				</div>
                          				<hr>
                          				<b class="h3" style="float: right;">Total: <?php echo $row['total']; ?></b>
                          				<br>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <!--<button type="button" class="btn btn-primary" href="">See in PDF</button>-->
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div>
    </div>

  <?php else: ?>
    header("Location: /Proyecto");
  <?php endif; ?>



<?php require 'includes/footer.php'; ?>
