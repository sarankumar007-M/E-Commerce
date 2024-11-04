<?php
include('../includes/connect.php'); // Include database connection
if(isset($_POST['insert_brand'])){
    $brand_title = mysqli_real_escape_string($con, $_POST['brand_title']); // Capture brand title from form input

    // Check if the brand already exists in the database
    $select_query = "SELECT * FROM `brands` WHERE brand_title='$brand_title'";
    $result_select = mysqli_query($con, $select_query);

    if(!$result_select) {
        die("Query failed: " . mysqli_error($con));
    }

    $number = mysqli_num_rows($result_select); // Count the number of rows matching the brand title
    if($number > 0){
        echo "<script>alert('This brand is already inserted in the database')</script>"; // Alert if brand exists
    } else {
        // Insert the new brand into the `brands` table
        $insert_query = "INSERT INTO `brands` (brand_title) VALUES ('$brand_title')";
        $result = mysqli_query($con, $insert_query);

        if(!$result) {
            die("Insertion failed: " . mysqli_error($con)); 
        } else {
            echo "<script>alert('Brand has been inserted successfully')</script>";
        }
    }
}
?>

<!-- Form to insert a new brand -->
 <h2 class="text-center">Insert Brands</h2>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-tag"></i></span>
        <input type="text" class="form-control" name="brand_title" placeholder="Insert brand" aria-label="Brand" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="bg-info border-0 p-2 my-3" name="insert_brand" value="Insert Brand">
        <button class="bg-info p-2 my-3 border-0"></button>
    </div>
</form>
