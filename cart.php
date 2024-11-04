<!-- connect file -->
<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= initial-scale=1.0">
    <title>Ecommerce website-Cart details</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <!-- font awesome link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


     <!-- css file -->
      <link rel="stylesheet" href="style.css">
      <style>
        .cart_img {
          width: 80px;
          height: 80px;
          object-fit:contain;
        }
      </style>
</head>
<body>
    <!-- navbar -->
     <div class="container-fluid p-0">

        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">
   <img src="./images/logo.png" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./users_area/user_registration.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Content</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item();?></sup></a>
        </li>
        </ul>
    </div>
  </div>
</nav>

<!-- calling cart function -->
 <?php
cart();
 ?>
<!-- second child -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <ul class="navbar-nav me-auto">
    <?php
     if(!isset($_SESSION['username'])){
      echo "<li class='nav-item'>
      <a class='nav-link' href='#'>Welcome Guest</a>
      </li>";
    }else{
      echo "<li class='nav-item'>
      <a class='nav-link' href='#'>Welcome".$_SESSION['username']."</a>
      </li>";
    }
    if(!isset($_SESSION['username'])){
      echo "<li class='nav-item'>
      <a class='nav-link' href='./users_area/user_login.php'>Login</a>
      </li>";
    }else{
      echo "<li class='nav-item'>
      <a class='nav-link' href='./users_area/logout.php'>Logout</a>
      </li>";
    }
    ?>
  </ul>
 </nav>

 <!-- third child -->
  <div class="bg-light">
    <h3 class="text-center">Hidden Store</h3>
    <p class="text-center">Communication is at the heart of e-commerce and community</p>
  </div>

<!-- fourth child-table -->
 <div class="container">
    <div class="row">
      <form action="" method="post">
        <table class="table table-bordered text-center">
           
              <!-- php code to display dynamic data -->
               <?php
                $get_ip_add = getIPAddress();
                $total_price = 0;
                $cart_query = "Select *from`cart_details` where ip_address='$get_ip_add'";
                $result = mysqli_query($con, $cart_query);
                $result_count=mysqli_num_rows($result);
                if($result_count>0){
                  echo " <thead>
                <tr>
                    <th>Product Title</th>
                    <th>Product Image</th>
                    <th>Quantity</th>
                    <th>Total price</th>
                    <th>Remove</th>
                    <th colspan='2'>Operations</th>
                </tr>
            </thead>
            <tbody>";
                // Loop through cart items
                while ($row = mysqli_fetch_array($result)) {
                    $product_id = $row['product_id'];
                    $select_products = "Select * from `products` where product_id='$product_id'";
                    $result_products = mysqli_query($con, $select_products);
                    // Loop through selected product details
                    while ($row_product_price = mysqli_fetch_array($result_products)) {
                        $product_price =array($row_product_price['product_price']);
                        $price_table=$row_product_price['product_price'];
                        $product_title = $row_product_price['product_title'];
                        $product_image1 = $row_product_price['product_image1'];
                        $product_values=array_sum($product_price);
                        $total_price += $product_values;  // Accumulate the total price

?>
                <tr>
                    <td><?php echo $product_title?></td>
                    <td><img src="./admin_area/product_images/<?php echo $product_image1?>" alt="" class="cart_img"></td>
                    <td><input type="text" name="qty" class="form-input w-50"></td>
                    <?php
                    $get_ip_add = getIPAddress();
                    if(isset($_POST['update_cart'])){
                      $quantities=$_POST['qty'];
                      $update_cart="update `cart_details` set quantity=$quantities where ip_address='$get_ip_add'";
                      $result_products_quantity=mysqli_query($con,$update_cart);
                      $total_price=$total_price*$quantities;
                    }
                    ?>
                    <td><?php echo $price_table?>/-</td>
                    <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                    <td>
                      <!-- <button class="bg-info px-2 py-1 border-0 mx-2">Update</button> -->
                       <input type="submit" value="Update Cart" class="bg-info px-2 py-1 border-0 mx-2" name="update_cart">
                        <!-- <button class="bg-info px-2 py-1 border-0 mx-2">Remove</button> -->
                       <input type="submit" value="Remove Cart" class="bg-info px-2 py-1 border-0 mx-2" name="remove_cart">
                    </td>
                </tr>
                <?php }
                }}


                else{

                echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
                }
                ?>
            </tbody>
        </table>
        <!-- subtotal -->
         <div class="d-flex mb-5">
         <?php
    $get_ip_add = getIPAddress();
    $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
    $result = mysqli_query($con, $cart_query);
    $result_count = mysqli_num_rows($result);
    
    if($result_count > 0){
        echo "
            <h4 class='px-3'>Subtotal: <strong class='text-info'>$$total_price/-</strong></h4>
            <input type='submit' value='Continue Shopping' class='bg-info px-2 py-1 border-0 mx-2' name='continue_shopping'>
            <button class='bg-secondary p-3 py-2 border-0'>
                <a href='./users_area/checkout.php' class='text-light text-decoration-none'>Checkout</a>
            </button>";
    } else {
        echo "
            <input type='submit' value='Continue Shopping' class='bg-info px-2 py-1 border-0 mx-2' name='continue_shopping'>";
    }
    
    if(isset($_POST['continue_shopping'])){
        echo "<script>window.open('index.php', '_self')</script>";
    }
?>

         </div>
    </div>
 </div>
 </form>
<!-- function to remove item -->
 <?php
function remove_cart_item() {
    global $con;

    // Check if the form is submitted and if the 'removeitem' array is set
    if (isset($_POST['remove_cart'])) {
        if (isset($_POST['removeitem']) && is_array($_POST['removeitem'])) {
            // Loop through each selected item and remove it from the cart
            foreach ($_POST['removeitem'] as $remove_id) {
                echo $remove_id;
                
                // Prepare the delete query
                $delete_query = "DELETE FROM `cart_details` WHERE product_id = $remove_id";
                
                // Execute the query
                $run_delete = mysqli_query($con, $delete_query);
                
                // If the item is deleted, redirect to the cart page
                if ($run_delete) {
                    echo "<script>window.open('cart.php', '_self')</script>";
                }
            }
        } else {
            // Handle the case where no items were selected
            echo "<script>alert('No items selected to remove.')</script>";
        }
    }
}

// Call the function
remove_cart_item();
?>

<!-- last child -->
 <!-- include footer -->
  <?php include("./includes/footer.php") ?>
  </div>





<!-- bootstrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>