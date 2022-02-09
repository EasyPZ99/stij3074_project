<?php
include_once("dbconnect.php");
session_start();
$useremail = "Guest";
if (isset($_SESSION['sessionadmin'])) {
    $useremail = $_SESSION['user_email'];
}else{
   echo "<script>alert('Please login as Admin')</script>";
   echo "<script> window.location.replace('loginadmin.php')</script>";
}
if (isset($_POST["submit"])) {
    include_once("dbconnect.php");
    $title = addslashes($_POST["title"]);
    $isbn = $_POST["isbn"];
    $price = $_POST["price"];
    $qty = $_POST["qty"];
    $description = addslashes($_POST["description"]);
    $sqlinsert = "INSERT INTO `tbl_product`(`item_title`, `item_isbn`, `item_price`, `item_qty`, `item_description`) VALUES ('$title', '$isbn', $price, $qty, '$description')";
    
    try {
        $conn->exec($sqlinsert);
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
            uploadImage($isbn);
        }
        echo "<script>alert('Registration successful')</script>";
        echo "<script>window.location.replace('addproduct.php')</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Registration failed')</script>";
        echo "<script>window.location.replace('addproduct.php')</script>";
    }
}

function uploadImage($id)
{
    $target_dir = "../images/items/";
    $target_file = $target_dir . $id . ".jpg";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}


?>


<!DOCTYPE html>
<html>
<title>Afira Herbs</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
<link rel="stylesheet" type="text/css" href="../css/style.css">
<script src="../js/script.js"></script>

<body>
    <!-- Sidebar (hidden by default) -->
    <nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" style="display:none;z-index:2;width:40%;min-width:300px" id="mySidebar">
        <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button">Close Menu</a>
        <a href="index.php" onclick="w3_close()" class="w3-bar-item w3-button">Product Page</a>
        <a href="indexadmin.php" onclick="w3_close()" class="w3-bar-item w3-button">Admin Product Page</a>
        <a href="logout.php" onclick="w3_close()" class="w3-bar-item w3-button">Logout</a>
    </nav>

    <!-- Top menu -->
    <div class="w3-top">
        <div class="w3-green w3-xlarge" style="max-width:1200px;margin:auto">
            <div class="w3-button w3-padding-16 w3-left" onclick="w3_open()">☰</div>
            <div class="w3-center w3-padding-16">AfiraHerbs</div>
        </div>
    </div>
    <div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">

        <form class="w3-container" action="addproduct.php" method="post" enctype="multipart/form-data" onsubmit="return confirmDialog()">
            <div class="w3-container w3-blue">
                <h2>Add New Product</h2>
            </div>
            <div class="w3-container w3-border w3-center w3-padding">
                <img class="w3-image w3-round w3-margin" src="../images/profile.jpg" style="height:100%;width:100%;max-width:330px"><br>
                <input type="file" onchange="previewFile()" name="fileToUpload" id="fileToUpload"><br>
            </div>
            <br>
            <label>Title</label>
            <input class="w3-input" name="title" id="idtitle" type="text" required>

            <label>Item ID</label>
            <input class="w3-input" name="isbn" id="idisbn" type="text" required>

            <label>Price</label>
            <input class="w3-input" name="price" id="idprice" type="number" step="any"required>

            <label>Quantity</label>
            <input class="w3-input" name="qty" id="idqty" type="number" step="any"required>

            <p>
                <label>Description</label>
                <textarea class="w3-input w3-border" id="iddesc" name="description" rows="4" cols="50" width="100%" placeholder="Item Description" required></textarea>
            </p>
            <div class="w3-row">
                <input class="w3-input w3-border w3-block w3-blue w3-round" type="submit" name="submit" value="Submit">
            </div>

        </form>

    </div>
    <footer class="w3-row-padding w3-padding-32">
        <hr>
        </hr>
        <p class="w3-center">AFIRA HERBS & BEAUTY Sdn.Bhd&reg;</p>

    </footer>


</body>

</html>