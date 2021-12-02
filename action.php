<?php
    session_start();
    include ('config.php');

    if (isset($_POST['add'])){
        $typ = $_POST['typ'];
        $todo = $_POST['todo'];
        $poznamka = $_POST['poznamka'];
        $deadline = $_POST['deadline'];

        $query = "INSERT INTO list(typ,todo,poznamka,deadline) VALUES (?,?,?,?)";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("ssss",$typ,$todo,$poznamka,$deadline);
        $stmt->execute();

        header('location:index.php');
        $_SESSION['response'] = "Successfully Inserted to the Database!";
        $_SESSION['res_type'] = "success";
    }
?>
