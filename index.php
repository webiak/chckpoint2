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
                <a class="nav-link" href="motivation.html">Motivacia</a>
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
                <input type="hidden" name="id" value="<?= $id; ?>">
                <div class="form-group">
                    <input type="text" name="typ" value="<?= $typ;?>" class="form-control" placeholder="Zadaj typ" required>
                </div>
                <div class="form-group">
                    <input type="text" name="todo" value="<?= $todo;?>" class="form-control" placeholder="Zadaj todo" required>
                </div>
                <div class="form-group">
                    <input type="text" name="poznamka" value="<?= $poznamka;?>" class="form-control" placeholder="Zadaj poznamku">
                </div>
                <div class="form-group">
                    <input type="text" name="deadline" value="<?= $deadline;?>" class="form-control" placeholder="Zadaj DeadLine">
                </div>
                <div class="form-group">
                    <?php if ($update==true){ ?>
                        <input type="submit" name="update" class="btn btn-success btn-block" value="Aktualizuj zaznam">
                    <?php } else{ ?>
                        <input type="submit" name="add" class="btn btn-primary btn-block" value="Pridaj zaznam">
                    <?php } ?>
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
                <?php while($row=$result->fetch_assoc()){?>
                <tbody>
                <tr>
                    <td><?= $row['id'];?></td>
                    <td><?= $row['typ'];?></td>
                    <td><?= $row['todo'];?></td>
                    <td><?= $row['poznamka'];?></td>
                    <td><?= $row['deadline'];?></td>
                    <td>
                        <a href="detail.php?detail=<?= $row['id'];?>" class="badge badge-primary p-2">Detail</a> |
                        <a href="action.php?delete=<?= $row['id'];?>" class="badge badge-danger p-2" onclick="return confirm('Chces vymazat tento zaznam?');">Zmazat</a> |
                        <a href="index.php?edit=<?= $row['id'];?>" class="badge badge-success p-2">Upravit</a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</head>

</html>


