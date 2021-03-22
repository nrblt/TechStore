<?php
function component($productname, $productprice, $productimg, $productid){

    $element = "
    
    <div class=\"col-md-3 col-sm-6 my-3 my-md-0 pb-2\">
                <form action=\"index.php\" method=\"post\">
                    <div class=\"card shadow\">
                        <div>
                        <a href='php/full.php?id=$productid' name='llik'>
                            <img src=\"$productimg\" alt=\"Image1\"  class=\"img-fluid card-img-top\">
                            </a>
                            
                        </div>
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$productname</h5>
                            <h6>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"far fa-star\"></i>
                            </h6>
                            <p class=\"card-text\">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque dolore dolorum eveniet numquam omnis 
                            </p>
                            <h5>
                                <small><s class=\"text-secondary\">$519</s></small>
                                <span class=\"price\">$$productprice</span>
                            </h5>

                            <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
                             <input type='hidden' name='product_id' value='$productid'>
                        </div>
                    </div>
                </form>
            </div>
    ";


    echo $element;
}

function component2($productname, $productprice, $productimg, $productid){

    $element = "
    
    <div class=\"col-md-3 col-sm-6 my-3 my-md-0 pb-2\">
                <form action=\"index.php\" method=\"post\">
                    <div class=\"card shadow\">
                        <div>
                        <a href='php/full2.php?id=$productid' name='llik'>
                            <img src=\"$productimg\" alt=\"Image1\"  class=\"img-fluid card-img-top\">
                            </a>
                            
                        </div>
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$productname</h5>
                            <h6>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"far fa-star\"></i>
                            </h6>
                            <p class=\"card-text\">
                                Some quick example text to build on the card.
                            </p>
                            <h5>
                                <small><s class=\"text-secondary\">$519</s></small>
                                <span class=\"price\">$$productprice</span>
                            </h5>

                             <input type='hidden' name='product_id' value='$productid'>
                             <a class='text-success'href='/NurbolatGabidenFinalProjectWEB/edit_product.php?id=$productid'>Edit</a><br>
                             <a class='text-danger'href='/NurbolatGabidenFinalProjectWEB/delete_product.php?id=$productid'>Delete</a>
                        </div>
                    </div>
                </form>
            </div>
    ";


    echo $element;
}
function cartElement($productimg, $productname, $productprice, $productid, $cnt){
    $element = "
     
    <form action=\"cart.php?action=remove& id=$productid\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white p-2 \" >
                            <div class=\"col-md-3 pl-0\">
                                <img src=$productimg alt=\"Image1\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-6\">
                                <h5 class=\"pt-2\">$productname</h5>
                                
                                <h5 class=\"pt-2\">$$productprice</h5>

                                <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                            </div>
                            <div class=\"col-md-3 py-5\">
                                <div>
                                    <h1 class='my-3'>$cnt</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
    
    ";
    echo  $element;
}

function searchInDB($login, $pass) {
    $conn = getConnection();
    $sql = 'SELECT * FROM admins WHERE login="'. $login .'" AND pass="'. $pass .'"';
    $res = $conn->query($sql);
    if ($conn->error) {
        print_r($conn->error);
    }
    $user = $res->fetch_assoc();
    if($user==null){
        return false;
    }
    if ($login == $user['login'] && $pass == $user['pass']) {
        return $user;
    }
    return false;
}

function getUsers() {
    $conn = getConnection();
    $sql = "SELECT * from admins";
    $res = $conn->query($sql);
    return $res->fetch_all(MYSQLI_ASSOC);
}

function createPost($title, $content, $img_url, $price) {
    $conn = getConnection();
    $img_url = ($img_url) ? $img_url : NULL;
    $sql = <<<SQL
        insert into Producttb(product_name,product_price,product_image,description) values(

            "$title", "$price", "$img_url", "$content"
        )
        SQL;
    $res = $conn->query($sql);

    if ($conn->error) {
        echo $conn->error;
    } else {
        header("Location: indexForAdmin.php");
    }
}

function renderEditing($idd) {
    $post_id = $idd;

    $post = getPostByID($post_id);
    $title = $post['product_name'];
    $img = $post['product_image'];
    $content = $post['description'];
    $price = $post['product_price'];
    echo <<<hmtlblock
        <div class="container">
            <form action="edit_product.php?" method="get">
                <h3>Product editing</h3>
                <input type="text" class="" name="post_id" value="$post_id" style="display: none;">
                <div class="mt-2">
                  <input type="text" name="title" placeholder="Title" value="$title">
                </div>
                <div class="mt-2">
                  <input type="text" name="img" placeholder="Image url" value="$img">
                 </div>
                 <div class="mt-2">
                  <input type="text" name="price" placeholder="Price" value="$price">
                </div>
                <div class="mt-2">
                  <textarea name="content" id="content-area" cols="30" rows="10">$content</textarea>
                </div>
                <input type='hidden' name='id' value='$post_id'>
                <button type="submit" class="btn bg-success mt-2" >Edit post!</button>
                
            </form>
        </div>
        hmtlblock;
}


function getPostByID($id) {
    $conn = getConnection();

    $sql = 'SELECT * from Producttb WHERE id = "'.$id.'"';
    $res = $conn->query($sql);
    return $res->fetch_assoc();
}

function updatePostByID($id, $title, $content, $img_url, $price) {
    $conn = getConnection();
    $sql = <<<SQL
        UPDATE Producttb SET product_name="$title", description="$content", product_image="$img_url", product_price=$price WHERE id = "$id"
        SQL;

    $res = $conn->query($sql);
    echo $conn->error;
    header("Location: indexForAdmin.php");
}


function deletePost ($post_id) {
    $conn = getConnection();
    $sql = <<< SQL
    DELETE FROM Producttb WHERE id=$post_id
    SQL;

    $res = $conn->query($sql);
    echo $conn->error;
    header("Location: indexForAdmin.php");

}

function getConnection() {
    $host = 'localhost';
    $db = 'Productdb';
    $user = 'root';
    $pass = 'root';

    $conn = mysqli_connect($host, $user, $pass, $db);

    if (mysqli_connect_error()) {

        echo mysqli_connect_errno().": ".mysqli_connect_error();
        exit;
    }
    return $conn;
}
