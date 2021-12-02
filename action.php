<?php
    session_start();
    include ('config.php');

    $update=false;
    $id="";
    $typ="";
    $todo="";
    $poznamka="";
    $deadline="";

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

    if (isset($_GET['delete'])){
        $id=$_GET['delete'];

        $query="DELETE FROM list WHERE id=?";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("i",$id);
        $stmt->execute();

        header('location:index.php');
        $_SESSION['response'] = "Successfully Deleted!";
        $_SESSION['res_type'] = "danger";
    }

    if (isset($_GET['edit'])){
        $id=$_GET['edit'];

        $query="SELECT * FROM list WHERE id=?";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row=$result->fetch_assoc();

        $id=$row['id'];
        $typ=$row['typ'];
        $todo=$row['todo'];
        $poznamka=$row['poznamka'];
        $deadline=$row['deadline'];

        $update=true;
    }

    if (isset($_POST['update'])){
        $id=$_POST['id'];
        $typ = $_POST['typ'];
        $todo = $_POST['todo'];
        $poznamka = $_POST['poznamka'];
        $deadline = $_POST['deadline'];

        $query="UPDATE list SET typ=?, todo=?, poznamka=?, deadline=? WHERE id=?";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("ssssi",$typ,$todo,$poznamka,$deadline,$id);
        $stmt->execute();

        $_SESSION['response'] = "Updated Successfully!";
        $_SESSION['res_type'] = "primary";
        header('location:index.php');
    }

    if (isset($_GET['detail'])){
        $id=$_GET['detail'];

        $query="SELECT * FROM list WHERE id=?";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row=$result->fetch_assoc();

        $vid=$row['id'];
        $vtyp=$row['typ'];
        $vtodo=$row['todo'];
        $vpoznamka=$row['poznamka'];
        $vdeadline=$row['deadline'];
    }
?>
