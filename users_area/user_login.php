<?php include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User -Login</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        body{
            overflow-x:hidden;
        }
    </style>
    <body>
        <div class="container-fluid my-3">
            <h2 class="text-center">User Login</h2>
            <div class="row d-flex align-items-center justify-content-center mt-5">
                <div class="col-lg-12 col-xl-6">
                    <form action="" method="post">
                            <!-- username field -->
                            <div class="form-outline mb-4">
                            <label for="user_username" class="form-label">Username</label>
                            <input type="text" id="user_name" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username"/>
                        </div>
                    
                        <!-- password field -->
                        <div class="form-outline mb-4">
                            <label for="user_password" class="form-label">Password</label>
                            <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password"/>
                        </div>

                          
                        <div class="mt-4 pt-2">
                            <input type="submit" value="Login" class="bg-info py-2 px-3 border-0" name="user_login">
                            <p class="small fw-bold mt-2 pt-1 mb-0">Dont't have an account? <a href="user_registration.php" class="text-danger"> Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>
</html>

<?php
if(isset($_POST['user_login'])){
    $user_username=$_POST['user_username'];
    $user_password=$_POST['user_password'];
    
    $select_query="Select * from `user_table` where username='$user_username'";
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);
    $user_ip=getIPAddress();





    // cart item
    $select_query_cart="Select * from `cart_details` where ip_address='$user_ip'";
    $select_cart=mysqli_query($con,$select_query_cart);
    $row_count_cart=mysqli_num_rows($select_cart);
    if($row_count>0){
        $_SESSION['username']=$user_username;
        if(password_verify($user_password,$row_data['user_password'])){
           // echo "<script>alert('Login successful')</script>";
           if($row_count==1 and $row_count_cart==0){
            $_SESSION['username']=$user_username;
            echo "<script>alert('Login successful')</script>";
            echo "<script>window.open('profile.php','_self')</script>";
           }else{
            $_SESSION['username']=$user_username;
            echo "<script>alert('Login successful')</script>";
            echo "<script>window.open('payment.php','_self')</script>";
           }
        }else{
            echo "<script>alert('Invalid Credentials')</script>";
        }

    }else{
        echo "<script>alert('Invalid Credentials')</script>";
    }
}

?>