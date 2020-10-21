<?php
    session_start();

    require_once("./PHP_Funcs_Classes/Funcs.php");
    require_once("./PHP_Funcs_Classes/CreatDB_OO.php");

    $DB = new DB_Creator("", "localhost", "root", "Products", "ProductTable");

    if(isset($_POST["Add"]))
    {
        if(isset($_SESSION["Cart"]))
        {
            $ItemIdArray = array_column($_SESSION["Cart"], "pid");
            if(in_array($_POST["pid"], $ItemIdArray))
            {
                echo("<script>alert('Product already in your cart')</script>");
                echo("<script>window.location='index.php'</script>");
            }   // if
            else
            {
                $ItemArr = array("pid" => $_POST["pid"]);
                $Count = count($_SESSION["Cart"]);
                $_SESSION["Cart"][$Count] = $ItemArr;
            }   // else
        }   // if
        else
        {
            $ItemArr = array("pid" => $_POST["pid"]);
            $_SESSION["Cart"][0] = $ItemArr;
        }   // else
    }   // if
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- My Styles -->
    <link rel="stylesheet" href="MainStyle.css"/>
</head>
<body>
    <?php
        require_once("./PHP_Funcs_Classes/Header.php")
    ?>
    
    <div class="container">
        <div class="row text-center py-3">
            <?php
                $Result = $DB->GetData();
                while($Row = mysqli_fetch_assoc($Result))
                {
                    CreateProduct($Row["pname"], "Old Price", 
                    $Row["pprice"], $Row["pimage"], 
                    $Row["pdescription"], $Row["id"]);
                }   // while
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
