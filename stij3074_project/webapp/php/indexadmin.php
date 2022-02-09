<?php
include_once ("dbconnect.php");
session_start();
$useremail = "Guest";
if (isset($_SESSION['sessionadmin'])) {
    $useremail = $_SESSION['user_email'];
}else{
   echo "<script>alert('Please login as admin')</script>";
   echo "<script> window.location.replace('loginadmin.php')</script>";
}
$carttotal = 0;
if (isset($_GET['submit']))
{
    include_once ("dbconnect.php");
    if ($_GET['submit'] == "cart")
    {
        if ($useremail != "Guest")
        {
            $itemid = $_GET['itemid'];
            $cartqty = "1";
            $stmt = $conn->prepare("SELECT * FROM tbl_carts WHERE user_email = '$useremail' AND item_id = '$itemid'");
            $stmt->execute();
            $number_of_rows = $stmt->rowCount();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $rows = $stmt->fetchAll();
            if ($number_of_rows > 0)
            {
                foreach ($rows as $carts)
                {
                    $cartqty = $carts['cart_qty'];
                }
                $cartqty = $cartqty + 1;
                $updatecart = "UPDATE `tbl_carts` SET `cart_qty`= '$cartqty' WHERE user_email = '$useremail' AND item_id = '$itemid'";
                $conn->exec($updatecart);
                echo "<script>alert('Cart updated')</script>";
                echo "<script> window.location.replace('index.php')</script>";
            }
            else
            {
                $addcart = "INSERT INTO `tbl_carts`(`user_email`, `item_id`, `cart_qty`) VALUES ('$useremail','$itemid','$cartqty')";
                try
                {
                    $conn->exec($addcart);
                    echo "<script>alert('Success')</script>";
                    echo "<script> window.location.replace('index.php')</script>";
                }
                catch(PDOException $e)
                {
                    echo "<script>alert('Failed')</script>";
                }
            }

        }
        else
        {
            echo "<script>alert('Please login or register')</script>";
            echo "<script> window.location.replace('login.php')</script>";
        }
    }
    if ($_GET['submit'] == "search")
    {
        $search = $_GET['search'];
        $sqlquery = "SELECT * FROM tbl_product WHERE item_title LIKE '%$search%'";
    }
}
else
{
    $sqlquery = "SELECT * FROM tbl_product WHERE item_qty > 0";
}

$stmtqty = $conn->prepare("SELECT * FROM tbl_carts WHERE user_email = '$useremail'");
$stmtqty->execute();
$resultqty = $stmtqty->setFetchMode(PDO::FETCH_ASSOC);
$rowsqty = $stmtqty->fetchAll();
foreach ($rowsqty as $carts)
{
    $carttotal = $carts['cart_qty'] + $carttotal;
}

$results_per_page = 10;
if (isset($_GET['pageno']))
{
    $pageno = (int)$_GET['pageno'];
    $page_first_result = ($pageno - 1) * $results_per_page;
}
else
{
    $pageno = 1;
    $page_first_result = 0;
}

$stmt = $conn->prepare($sqlquery);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);
$sqlquery = $sqlquery . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqlquery);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

function subString($str)
{
    if (strlen($str) > 15)
    {
        return $substr = substr($str, 0, 15) . '...';
    }
    else
    {
        return $str;
    }
}
?>
<!DOCTYPE html>
<html>
<title>Afira Herbs</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../js/script.js"></script>
<style>
/* Create a Parallax Effect */
.bgimg-1 {
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

/* First image (Logo. Full height) */
.bgimg-1 {
  background-image: url('https://github.com/EasyPZ99/271843-stij3074_lab1/blob/main/images/20211105_131145.jpg?raw=true');
  min-height: 20%;
}

.w3-wide {letter-spacing: 10px;}
.w3-hover-opacity {cursor: pointer;}

/* Turn off parallax scrolling for tablets and phones */
@media only screen and (max-device-width: 1600px) {
  .bgimg-1{
    background-attachment: scroll;
    min-height: 100px;
  }
}
</style>
<body>
    <!-- Sidebar (hidden by default) -->
    <nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" style="display:none;z-index:2;width:20%;min-width:200px" id="mySidebar">
        <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button">Close Menu</a>
        <a href="loginadmin.php" onclick="w3_close()" class="w3-bar-item w3-button">Login as Admin</a>
        <a href="registeradmin.php" onclick="w3_close()" class="w3-bar-item w3-button">Register New Admin</a>
        <a href="indexadmin.php" onclick="w3_close()" class="w3-bar-item w3-button">Admin Product (Current Page)</a>
        <a href="index.php" onclick="w3_close()" class="w3-bar-item w3-button"> Product (User Page)</a>
        <a href="addproduct.php" onclick="w3_close()" class="w3-bar-item w3-button">Add New Product</a>
        <a href="logout.php" onclick="w3_close()" class="w3-bar-item w3-button">Logout</a>
    </nav>

    <!-- Top menu -->
    <div class="w3-top">
        <div class="w3-white w3-xlarge" style="max-width:1200px;margin:auto">
            <div class="w3-button w3-padding-16 w3-animate-opacity w3-left" onclick="w3_open()">☰</div>
            <div class="bgimg-1 w3-green w3-center w3-animate-opacity w3-padding-16">AfiraHerbs</div>
        </div>
    </div>
    <div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
    <div class="w3-container w3-center"><p>Welcome <?php echo $user_name?> </p></div>
    <div class="w3-container w3-card w3-padding w3-row w3-round" style="width:100%">
        <form class="w3-container" action="index.php" method="get">
            <div class="w3-twothird"><input class="w3-input w3-border w3-round w3-center" placeholder = "Enter your search term here" type="text" name="search"></div>
            <div class="w3-third"><input class="w3-input w3-border w3-blue w3-round" type="submit" name="submit" value="search"></div>
        </form>
    </div>
    <hr>
        
        <div class="w3-grid-template">
             <?php
             $cart = "cart";
                foreach ($rows as $items){
                    $itemid = $items['item_id'];
                    $item_title = subString($items['item_title']);
                    $item_isbn = $items['item_isbn'];
                    $item_price = $items['item_price'];
                    $item_description = $items['item_description'];
                    $item_qty = $items['item_qty'];
                    $item_date = $items['item_date'];
                    
                    echo "<div class='w3-center w3-padding-small'><div class = 'w3-card w3-round-large'>
                    <div class='w3-padding-small'><img class='w3-container w3-image' 
                    src=../images/items/$item_isbn.jpg onerror=this.onerror=null;this.src='../images/items/default.jpg'></a></div>
                    <b>$item_title</b><br>RM $item_price / $item_qty left<br>
                    <input type='button' class='w3-button w3-blue w3-round' id='button_id' value='Delete Item' onClick='delCart($itemid);'><br><br>
                    </div></div>";
                }
             ?>
        </div>
    </div>
    <?php
    $num = 1;
    if ($pageno == 1) {
        $num = 1;
    } else if ($pageno == 2) {
        $num = ($num) + $results_per_page;
    } else {
        $num = $pageno * $results_per_page - 9;
    }
    echo "<div class='w3-container w3-row'>";
    echo "<center>";
    for ($page = 1; $page <= $number_of_page; $page++) {
        echo '<a href = "indexadmin.php?pageno=' . $page . '" style=
        "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
    }
    echo " ( " . $pageno . " )";
    echo "</center>";
    echo "</div>";
    ?>
    <footer class="w3-row-padding w3-padding-32">
        <hr></hr>
         <p class="w3-center">AFIRA HERBS & BEAUTY Sdn.Bhd&reg;</p>
    
    </footer>
   
 <script>
 function addCart(itemid) {
	jQuery.ajax({
		type: "GET",
		url: "updatecartajax.php",
		data: {
			itemid: itemid,
			submit: 'add',
		},
		cache: false,
		dataType: "json",
		success: function(response) {
		    var res = JSON.parse(JSON.stringify(response));
		    console.log("HELLO ");
			console.log(res.status);
			if (res.status == "success") {
			    console.log(res.data.carttotal);
				//document.getElementById("carttotalida").innerHTML = "Cart (" + res.data.carttotal + ")";
				document.getElementById("carttotalidb").innerHTML = "Cart (" + res.data.carttotal + ")";
				alert("Success");
			}
			if (res.status == "failed") {
			    alert("Please login/register account");
			}
			

		}
	});
}
</script>

</body>

</html>