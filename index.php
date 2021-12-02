<?php
    include 'action.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>TODO List App</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="#">TODO List App</a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
        </ul>
    </div>
    <form class="form-inline" action="/action_page.php">
        <input class="form-control mr-sm-2" type="text" placeholder="Search">
        <button class="btn btn-primary" type="submit">Search</button>
    </form>
</nav>
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-10">
        <h3 class="text-center text-dark mt-2"> "Each day I will accomplish one thing on my todo list."</h3>
        <hr>
        <?php if (isset($_SESSION['response'])){?>
        <div class="alert alert-<?= $_SESSION['res_type'];?> alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?= $_SESSION['response']; ?>
        </div>
        <?php } unset($_SESSION['response']);?>
    </div>
  </div>
    <div class="row">
        <div class="col-md-4">
            <h3 class="text-center text-info">Pridaj ulohu</h3>
            <form action="action.php" method="post">
                <div class="form-group">
                    <input type="text" name="typ" class="form-control" placeholder="Zadaj typ" required>
                </div>
                <div class="form-group">
                    <input type="text" name="todo" class="form-control" placeholder="Zadaj todo" required>
                </div>
                <div class="form-group">
                    <input type="text" name="poznamka" class="form-control" placeholder="Zadaj poznamku">
                </div>
                <div class="form-group">
                    <input type="text" name="deadline" class="form-control" placeholder="Zadaj DeadLine">
                </div>
                <div class="form-group">
                    <input type="submit" name="add" class="btn btn-primary btn-block" value="Pridaj zaznam">
                </div>
            </form>
        </div>
        <div class="col-md-8">
            <?php
                $query="SELECT * FROM list";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result=$stmt->get_result();
            ?>
            <h3 class="text-center text-info">Aktualny ToDo List</h3>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Typ</th>
                    <th>TODO</th>
                    <th>Poznamka</th>
                    <th>DeadLine</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Skola</td>
                    <td>Odovzdaj semestralku</td>
                    <td>blablabla</td>
                    <td>2.12.2021</td>
                    <td>
                        <a href="#" class="badge badge-primary p-2">Detail</a> |
                        <a href="#" class="badge badge-danger p-2">Zmazat</a> |
                        <a href="#" class="badge badge-success p-2">Upravit</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</head>

</html>


