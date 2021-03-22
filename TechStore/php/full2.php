<?php
session_start();

require_once('DBConnection.php');
require_once ('component.php');

    $idd =$_GET['id'];
//    echo $idd;
//    $database->addCart($idd);
$database = new DBConnection("Productdb", "Producttb");

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">

</head>
<body>
<?php require_once('headerForAdmin.php');

$result = $database->getById2($idd);
//print_r($result);
?>
    <h1 class="text-center "><?php
            foreach($result as $one){
                 echo $one['product_name'];
            }
        ?> </h1>
    <div class="d-flex" style="border:1px solid  black;">
        <div class="container" style="border:1px solid  black;" >
            <img class="ml-2"src="<?php
            foreach($result as $one){
                echo $one['product_image'];
            }?>" alt="Imag">

        </div>
        <div class="container " style="border:1px solid  black;">
            <span ><?php
                foreach($result as $one){
                    echo $one['description'];
                }
                ?></span><br>
            <h2 class="text-center">$<?php
                foreach($result as $one){
                    echo $one['product_price'];
                }
                ?></h2><br>
            <form action='/NurbolatGabidenFinalProjectWEB/index.php' method='post'>

                <input type='hidden' name='product_id' value='<?php echo $idd ?>'>
<!--                echo -->
            </form>
        </div>
    </div>
<?php require_once ("footer.php"); ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
