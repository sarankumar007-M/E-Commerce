<?php

// include connect file
// include('./includes/connect.php');

// getting products
function getproducts(){
    global $con;

    // condition to check isset or not
    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){
    $select_query="Select * from `products` order by rand() LIMIT 0,9";
    $result_query=mysqli_query($con,$select_query);
    // $row=mysqli_fetch_assoc($result_query);
    // echo $row['product_title'];
    while($row=mysqli_fetch_assoc($result_query)){
     $product_id=$row['product_id'];
     $product_title=$row['product_title'];
     $product_description=$row['product_description'];
     $product_image1=$row['product_image1'];
     $product_price=$row['product_price'];
     $category_id=$row['category_id'];
     $brand_id=$row['brand_id'];
     echo "<div class='col-md-4 mb-2'>
   <div class='card'>
<img src='./admin_area/product_images/$product_image1'class='card-img-top' alt='$product_title'>
<div class='card-body'>
 <h5 class='card-title'>$product_title</h5>
 <p class='card-text'> $product_description</p>
 <p class='card-text'>Price: $product_price/-</p>
 <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
 <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
</div>
</div>
</div>";
    }
}
}
}

// getting all products
function get_all_products(){
    global $con;

    // condition to check isset or not
    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){
    $select_query="Select * from `products` order by rand()";
    $result_query=mysqli_query($con,$select_query);
    // $row=mysqli_fetch_assoc($result_query);
    // echo $row['product_title'];
    while($row=mysqli_fetch_assoc($result_query)){
     $product_id=$row['product_id'];
     $product_title=$row['product_title'];
     $product_description=$row['product_description'];
     $product_image1=$row['product_image1'];
     $product_price=$row['product_price'];
     $category_id=$row['category_id'];
     $brand_id=$row['brand_id'];
     echo "<div class='col-md-4 mb-2'>
   <div class='card'>
<img src='./admin_area/product_images/$product_image1'class='card-img-top' alt='$product_title'>
<div class='card-body'>
 <h5 class='card-title'>$product_title</h5>
 <p class='card-text'> $product_description</p>
  <p class='card-text'>Price: $product_price/-</p>
 <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
 <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
</div>
</div>
</div>";
    }
}
}
}


// getting unique categories

function get_unique_categories(){
    global $con;
    // condition to check isset or not
    if(isset($_GET['category'])){
        $category_id=$_GET['category'];
    $select_query="Select * from `products` where category_id=$category_id";
    $result_query=mysqli_query($con,$select_query);
    $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows==0){
        echo "<h2 class='text-center text-danger'>No stock for this category</h2>";
    }
    while($row=mysqli_fetch_assoc($result_query)){
     $product_id=$row['product_id'];
     $product_title=$row['product_title'];
     $product_description=$row['product_description'];
     $product_image1=$row['product_image1'];
     $product_price=$row['product_price'];
     $category_id=$row['category_id'];
     $brand_id=$row['brand_id'];
     echo "<div class='col-md-4 mb-2'>
   <div class='card'>
<img src='./admin_area/product_images/$product_image1'class='card-img-top' alt='$product_title'>
<div class='card-body'>
 <h5 class='card-title'>$product_title</h5>
 <p class='card-text'> $product_description</p>
  <p class='card-text'>Price: $product_price/-</p>
 <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
 <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
</div>
</div>
</div>";
    }
}
}



// getting unique categories


function get_unique_brands(){
    global $con;
    // condition to check isset or not
    if(isset($_GET['brand'])){
        $brand_id=$_GET['brand'];
    $select_query="Select * from `products` where brand_id=$brand_id";
    $result_query=mysqli_query($con,$select_query);
    $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows==0){
        echo "<h2 class='text-center text-danger'>This brand is not available for service</h2>";
    }
    while($row=mysqli_fetch_assoc($result_query)){
     $product_id=$row['product_id'];
     $product_title=$row['product_title'];
     $product_description=$row['product_description'];
     $product_image1=$row['product_image1'];
     $product_price=$row['product_price'];
     $category_id=$row['category_id'];
     $brand_id=$row['brand_id'];
     echo "<div class='col-md-4 mb-2'>
   <div class='card'>
<img src='./admin_area/product_images/$product_image1'class='card-img-top' alt='$product_title'>
<div class='card-body'>
 <h5 class='card-title'>$product_title</h5>
 <p class='card-text'> $product_description</p>
  <p class='card-text'>Price: $product_price/-</p>
 <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
 <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
</div>
</div>
</div>";
    }
}
}



// displaying brands in sidenav
function getbrands(){
    global $con;
    $select_brands="Select * from `brands`";
$result_brands=mysqli_query($con,$select_brands);

while($row_data=mysqli_fetch_assoc($result_brands)){
  $brand_title=$row_data['brand_title'];
  $brand_id=$row_data['brand_id'];
  echo " <li class='nav-item'>
  <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
  </li>";
}
}
// displaying categories in sidenav
function getcategories(){
    global $con;
$select_categories="Select * from `categories`";
$result_categories=mysqli_query($con,$select_categories);
while($row_data=mysqli_fetch_assoc($result_categories)){
  $category_title=$row_data['category_title'];
  $category_id=$row_data['category_id'];
  echo " <li class='nav-item'>
  <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
  </li>";
}
}
// searching products function


function search_product(){
    global $con;
    if(isset($_GET['search_data_product'])){
        $search_data_value=$_GET['search_data'];
    $search_query="Select * from `products` where product_keywords like '%$search_data_value%'";
    $result_query=mysqli_query($con,$search_query);
    $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows==0){
        echo "<h2 class='text-center text-danger'>No results match. No products found on this category!</h2>";
    }
    while($row=mysqli_fetch_assoc($result_query)){
     $product_id=$row['product_id'];
     $product_title=$row['product_title'];
     $product_description=$row['product_description'];
     $product_image1=$row['product_image1'];
     $product_price=$row['product_price'];
     $category_id=$row['category_id'];
     $brand_id=$row['brand_id'];
     echo "<div class='col-md-4 mb-2'>
   <div class='card'>
<img src='./admin_area/product_images/$product_image1'class='card-img-top' alt='$product_title'>
<div class='card-body'>
 <h5 class='card-title'>$product_title</h5>
 <p class='card-text'> $product_description</p>
  <p class='card-text'>Price: $product_price/-</p>
 <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
 <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
</div>
</div>
</div>";
    }
}
}


// view details functions
function view_details(){
    global $con;

    // condition to check isset or not
    if(isset($_GET['product_id'])){
    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){
            $product_id=$_GET['product_id'];
    $select_query="Select * from `products` where product_id=$product_id";
    $result_query=mysqli_query($con,$select_query);
    while($row=mysqli_fetch_assoc($result_query)){
     $product_id=$row['product_id'];
     $product_title=$row['product_title'];
     $product_description=$row['product_description'];
     $product_image1=$row['product_image1'];
     $product_image2=$row['product_image2'];
     $product_image3=$row['product_image3'];
     $product_price=$row['product_price'];
     $category_id=$row['category_id'];
     $brand_id=$row['brand_id'];
     echo "<div class='col-md-4 mb-2'>
   <div class='card'>
<img src='./admin_area/product_images/$product_image1'class='card-img-top' alt='$product_title'>
<div class='card-body'>
 <h5 class='card-title'>$product_title</h5>
 <p class='card-text'> $product_description</p>
  <p class='card-text'>Price: $product_price/-</p>
 <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
 <a href='index.php' class='btn btn-secondary'>Go home</a>
</div>
</div>
</div>

 <div class='col-md-8'>
         <div class='row'>
            <div class='col-md-12'>
                <h4 class='text-center text-info mb-5'>Related products</h4>
            </div>
            <div class='col-md-6'>
                <img src='./admin_area/product_images/$product_image2' class='card-img-top' alt='$product_title'>
            </div>
            <div class='col-md-6'>
                <img src='./admin_area/product_images/$product_image3' class='card-img-top' alt='$product_title'>
            </div>
         </div>
     </div>";
    }
}
}
    }
}


// get ip address function
function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;


// cart function
function cart(){
if(isset($_GET['add_to_cart'])){
    global $con;
    $get_ip_add = getIPAddress();
    $get_product_id=$_GET['add_to_cart'];

 $select_query="Select * from `cart_details` where ip_address='$get_ip_add' and product_id=$get_product_id";
     $result_query=mysqli_query($con,$select_query);
     $num_of_rows=mysqli_num_rows($result_query);
     if($num_of_rows>0){
        echo "<script>alert('This item is already present inside cart')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }else{
        $insert_query="insert into `cart_details` (product_id,ip_address,quantity) values ($get_product_id,'$get_ip_add',0)";
        $result_query=mysqli_query($con,$insert_query);
        echo "<script>alert('Item is added to cart')</script>";
        echo "<script>window.open('index.php','_self')</script>";
     } 
}
}

// function to get cart item numbers
function cart_item(){
    if(isset($_GET['add_to_cart'])){
        global $con;
        $get_ip_add = getIPAddress();
     $select_query="Select * from `cart_details` where ip_address='$get_ip_add'";
         $result_query=mysqli_query($con,$select_query);
         $count_cart_items=mysqli_num_rows($result_query);
        }else{
            global $con;
            $get_ip_add = getIPAddress();
            $select_query="Select * from `cart_details` where ip_address='$get_ip_add'";
            $result_query=mysqli_query($con,$select_query);
            $count_cart_items=mysqli_num_rows($result_query);
         } 
         echo $count_cart_items;
    }


    // total price function
    function total_cart_price(){
        global $con;
        $get_ip_add = getIPAddress();
        $total_price = 0;
        $cart_query = "SELECT * FROM `cart_details` where ip_address='$get_ip_add'";
        $result = mysqli_query($con, $cart_query);
        
        // Loop through cart items
        while ($row = mysqli_fetch_array($result)) {
            $product_id = $row['product_id'];
            $select_products = "Select * from `products` where product_id='$product_id'";
            $result_products = mysqli_query($con, $select_products);
            
            // Loop through selected product details
            while ($row_product_price = mysqli_fetch_array($result_products)) {
                $product_price = $row_product_price['product_price'];
                $total_price += $product_price;  // Accumulate the total price
            }
        }
        
        echo $total_price;
    }


// get user order details
function get_user_order_details(){
    global $con;
    $username=$_SESSION['username'];
    $get_details="Select * from `user_table` where username='$username'";
    $result_query=mysqli_query($con,$get_details);
    while($row_query=mysqli_fetch_array($result_query)){
        $user_id=$row_query['user_id'];
        if(!isset($_GET['edit_account'])){
            if(!isset($_GET['my_orders'])){
                if(!isset($_GET['delete_account'])){
                    $get_orders="Select * from `user_orders` where user_id=$user_id and order_status='pending'";
                    $result_orders_query=mysqli_query($con,$get_orders);
                    $row_count=mysqli_num_rows($result_orders_query);
                    if($row_count>0){
                        echo "<h3 class='text-center text-success mt-5 mb-2'>You have <span class='text-danger'>$row_count</span> pending orders</h3>
                        <p class='text-center'><a href='profile.php?my_orders' class='text-dark'>Order Details</a></p>";
                    }else{
                        echo "<h3 class='text-center text-success mt-5 mb-2'>You have zero pending orders</h3>
                        <p class='text-center'><a href='../index.php' class='text-dark'>Explore products</a></p>";
                    }
                }
            }

        }
    }
}
?>