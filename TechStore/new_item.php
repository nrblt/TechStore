<?php
require_once 'php/component.php';

session_start();
$session = $_SESSION['users'];
$login = $session['login'];
if (!empty($_GET['title']) &&
!empty($_GET['content'])) {

    createPost($_GET['title'], $_GET['content'], $_GET['img'], $_GET['price']);
}

?>

<!doctype html>
<html lang="en">
<head>

    <title>Post editing</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>

<div class="container">
    <form action="new_item.php" method="get">
        <h3>Product creation</h3>
        <input type="text" name="post_id" style="display: none;">
        <div class="mt-2">
            <input type="text" name="title" placeholder="Title">
        </div>
        <div class="mt-2">
            <input type="text" cols="10"name="img" placeholder="Image url">
        </div>
        <div class="mt-2">
            <input type="text" cols="10"name="price" placeholder="Price">
        </div>
        <div class="mt-2">
            <textarea name="content" id="content-area" cols="30" rows="10"></textarea>
        </div>
        <button type="submit" class="btn bg-success mt-2">Create post!</button>
    </form>
</div>

</body>
</html>
