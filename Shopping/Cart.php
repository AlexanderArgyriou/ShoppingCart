<?php
    session_start();

    require_once("./PHP_Funcs_Classes/Funcs.php");
    require_once("./PHP_Funcs_Classes/CreatDB_OO.php");

    $DB = new DB_Creator("", "localhost", "root", "Products", "ProductTable");

    if(isset($_POST["remove"]))
        if($_GET["action"] == "remove")
            foreach($_SESSION["Cart"] as $key => $val)
                if($val["pid"] == $_GET["id"])
                {
                    unset($_SESSION["Cart"][$key]);
                    echo "<script>alert('Product has been Removed')</script>";
                    echo "<script>window.location='Cart.php'</script>";
                }   // if
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Cart</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- My Styles -->
    <link rel="stylesheet" href="MainStyle.css"/>
</head>
<body class="bg-light">
    <?php
        require_once("./PHP_Funcs_Classes/Header.php")
    ?>

    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <div class="shopping-cart">
                    <hr>
                    <?php
                        $Total = 0.0;
                        if(isset($_SESSION["Cart"]))
                        {
                            $pid = array_column($_SESSION["Cart"], "pid");
                            $Result = $DB->GetData();
                            while($Row = mysqli_fetch_assoc($Result))
                            {
                                foreach($pid as $id)
                                {
                                    if($Row["id"] == $id)
                                    {
                                        CreateCartProduct($Row["id"], $Row["pimage"],
                                            $Row["pname"], $Row["pprice"]);
                                        $Total += (float)$Row["pprice"];
                                    }   // if
                                }   // foreach
                            }   // while
                        }   // if
                        else
                        {
                            echo("Emprty Cart");
                        }   // else
                    ?>
                </div>
            </div>
            <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
                <div class="pt-4">
                    <h6>PRICE DETAILS</h6>
                    <hr>
                    <div class="row price-details">
                        <div class="col-md-6">
                            <?php
                                if (isset($_SESSION['cart']))
                                {
                                    $Count  = count($_SESSION['cart']);
                                    echo "<h6>Price ($Count items)</h6>";
                                }   // if
                                else
                                {
                                    echo("<h6>Price (0 items)</h6>");
                                }   // else
                            ?>
                            <h6>Delivery Charges</h6>
                            <hr>
                            <h6>Amount</h6>
                        </div>
                        <div class="col-md-6">
                            <h6>$<?php echo $Total; ?></h6>
                            <h6 class="text-success">FREE</h6>
                            <hr>
                            <h6>
                                $<?php
                                    echo("$Total");
                                ?>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
