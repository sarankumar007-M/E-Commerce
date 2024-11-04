<?php
include('../includes/connect.php'); // Ensure this file connects to your database

if (isset($_POST['insert_product'])) {

    // Getting form data and escaping to avoid SQL injection
    $product_title = mysqli_real_escape_string($con, $_POST['product_title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $product_keywords = mysqli_real_escape_string($con, $_POST['product_keywords']);
    $product_category = mysqli_real_escape_string($con, $_POST['product_category']);
    $product_brands = mysqli_real_escape_string($con, $_POST['product_brands']);
    $product_price = mysqli_real_escape_string($con, $_POST['product_price']);
    $product_status = 'true';  // Setting status as true
    $product_date = date('Y-m-d'); // Setting the current date

    // Accessing images
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    // Accessing image temp names for file upload
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];

    // Check if all fields are filled properly
    if (empty($product_title) || empty($description) || empty($product_keywords) || 
        empty($product_category) || empty($product_brands) || empty($product_price)) {
        echo "<script>alert('Please fill all the available fields');</script>";
    } elseif (!is_uploaded_file($temp_image1) || !is_uploaded_file($temp_image2) || !is_uploaded_file($temp_image3)) {
        // Check if files are uploaded
        echo "<script>alert('Please upload all three product images');</script>";
    } else {
        // Moving uploaded files to the directory
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
        move_uploaded_file($temp_image3, "./product_images/$product_image3");

        // SQL insert query
        $insert_products = "INSERT INTO `products` 
        (product_title, product_description, product_keywords, category_id, brand_id, product_image1, product_image2, product_image3, product_price, date, status) 
        VALUES ('$product_title', '$description', '$product_keywords', '$product_category', '$product_brands', '$product_image1', '$product_image2', '$product_image3', '$product_price', '$product_date', '$product_status')";

        // Execute query and check for errors
        $result_query = mysqli_query($con, $insert_products);

        if ($result_query) {
            echo "<script>alert('Product inserted successfully!');</script>";
        } else {
            // Output detailed error for debugging
            $error_message = mysqli_error($con);
            echo "<script>alert('Failed to insert the product. Error: $error_message');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products - Admin Dashboard</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- CSS file -->
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
        <!-- Form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Title -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" required>
            </div>

            <!-- Description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label">Product Description</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="Enter product description" required>
            </div>

            <!-- Keywords -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keywords" class="form-label">Product Keywords</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter product keywords" required>
            </div>

            <!-- Categories -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_category" class="form-label">Select a Category</label>
                <select name="product_category" id="product_category" class="form-select" required>
                    <option value="1">Fruits</option>
                    <option value="2">Juices</option>
                    <option value="3">Vegetables</option>
                    <option value="4">Milk Products</option>
                    <option value="5">Books</option>
                    <option value="6">Chips</option>
                    <option values="7">Shoes</option>
                </select>
            </div>

            <!-- Brands -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_brands" class="form-label">Select a Brand</label>
                <select name="product_brands" id="product_brands" class="form-select" required>
                    <option value="1">Swiggy</option>
                    <option value="2">Zomato</option>
                    <option value="3">McDonald's</option>
                    <option value="4">Alahabadi</option>
                    <option value="5">Nike</option>
                    <option value="6">Amazon</option>
                    <option value="7">Flipkart</option>
                </select>
            </div>

            <!-- Image 1 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">Product Image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control" required>
            </div>

            <!-- Image 2 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">Product Image 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control" required>
            </div>

            <!-- Image 3 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label">Product Image 3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control" required>
            </div>

            <!-- Price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" required>
            </div>

            <!-- Submit -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert Product">
            </div>
        </form>
    </div>
</body>
</html>
