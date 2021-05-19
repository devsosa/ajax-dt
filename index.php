<?php
    include_once 'db/con.php';
    $obj = new Conexion();
    $conection = $obj->Conect();

    $query = "SELECT id, name, country, age FROM persons";
    $result = $conection->prepare($query);
    $result->execute();

    $data = $result->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="#">
    <title>Index</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="datatables/datatables.min.css">
    <link rel="stylesheet" href="datatables/dataTables.bootstrap4.min.css">
</head>
<body>
    <header class="bg-secondary py-2" >
        <h3 class="text-center text-light">CRUD <span class="badge badge-danger">Datatables AJAX</span></h3>
    </header>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <button type="button" class="btn btn-success px-5" id="btnNew">New</button>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table id="person" class="table table-striped">
                        <thead class="text-center">
                            <tr>
                                <td>Id</td>
                                <td>Nombre</td>
                                <td>Pais</td>
                                <td>Edad</td>
                                <td>Accion</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($data as $d){
                            ?>
                            <tr>
                                <td><?php echo $d['id'] ?></td>
                                <td><?php echo $d['name'] ?></td>
                                <td><?php echo $d['country'] ?></td>
                                <td><?php echo $d['age'] ?></td>
                                <td>
                                    <div class="text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-primary btnEdit mr-2">EDIT</button>
                                            <button class="btn btn-danger btnDel">DELETE</button>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCrud" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleM"></h5>
                    <button class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="" id="formPerson">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Nombre</label>
                            <input id="name" class="form-control" type="text" name="">
                        </div>
                        <div class="form-group">
                            <label for="country" class="col-form-label">Pais</label>
                            <input id="country" class="form-control" type="text" name="">
                        </div>
                        <div class="form-group">
                            <label for="age" class="col-form-label">Edad</label>
                            <input id="age" class="form-control" type="number" name="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-dark" id="btnSave">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="datatables/datatables.min.js"></script>
    <!-- <script src="js/popper.min.js"></script> -->
    <script src="js/main.js"></script>
</body>
</html>