
<?php

session_start();

require_once("php/DBConnection.php");
require_once ("php/component.php");

$db = new DBConnection("Productdb", "Producttb");

if(isset ($_POST['remove'])){
    $idd = $_GET['id'];
    echo "<script>alert('You are removing product')</script>";
    $db->removeById($idd);
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

<?php
    require_once ('php/header.php');
?>

<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart ">
                <h6>My Cart</h6>
                <hr>

                <?php

                $total = 0;

                $sql = "SELECT id_product ,COUNT(id_product) AS cnt FROM carts group by id_product";
                $con= getConnection();
                $result = mysqli_query($con, $sql);

                $carr =$result->fetch_all(MYSQLI_ASSOC);
                 $count=mysqli_num_rows($result);
                $total=0;
                if($count==0){
                    echo "<h2>Your cart is empty</h2>";
                }

                else {
                    foreach ($carr as $car) {
                        $idk = $car['id_product'];

                        $ans = $db->getById($idk);
                        $i = 0;
                        foreach ($ans as $an) {
                            cartElement($an['product_image'], $an['product_name'], $an['product_price'], $an['id'], $car['cnt']);
                            $total += $car['cnt'] * $an['product_price'];
                            $i++;
                            if ($i == 1) {
                                break;
                            }

                        }

                    }
                }
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

                            $sql = "SELECT * FROM carts";
                            $con= getConnection();
                            $result = mysqli_query($con, $sql);

                            $count=mysqli_num_rows($result);
                                $cc=$count  ;
                                echo "<h6>Price ($cc items)</h6>";

                        ?>
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h6>Amount Payable</h6>
                    </div>
                    <div class="col-md-6">
                        <h6>$<?php echo $total; ?></h6>
                        <h6 class="text-success">FREE</h6>
                        <hr>
                        <h6>$<?php
                            echo $total;
                            ?></h6>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require_once ("php/footer.php"); ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
