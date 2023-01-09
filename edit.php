<?php
    require 'connect.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $select_qry = "SELECT * FROM tbl_products WHERE product_id = '$id'";
    $qry = mysqli_query($conn, $select_qry);
    if(mysqli_num_rows($qry)){
        while($items = mysqli_fetch_array($qry)){
            $product_name = $items['product_name'];
            $category = $items['category'];
            $price = $items['price'];
            $retail_price = $items['retail_price'];
            $quantity = $items['quantity'];
            $sold_items = $items['sold_items'];
        }
    }
}
    
?>

<html>
    <head>
        <title>Edit Panel</title>
        <link rel="stylesheet" href="edit.css">
    </head>
    <body>
    <div class = "header">
        <a href="ITEC116_Lab1_Marion_Montana_Bustillo.php">Home</a>
    </div>
    <div class = "updateProduct">
                <h2>Update Product</h2>
                <form method="post" autocomplete="off">
                    <label for="">Product Name</label><br>
                    <input type="text" name="product_name" id="" value="<?php echo $product_name ?>" required>
                    <br><br>
                    <label for="">Category</label><br>
                    <input type="text" name="category" id=""  value="<?php echo $category ?>" required>
                    <br><br>
                    <label for="">Price</label><br>
                    <input type="number" name="price" id=""  value="<?php echo $price ?>" required>
                    <br><br>
                    <label for="">Retail price</label><br>
                    <input type="number" name="retail" id=""  value="<?php echo $retail_price ?>" required>
                    <br><br>
                    <label for="">Quantity</label><br>
                    <input type="number" name="quantity" id=""  value="<?php echo $quantity ?>" required>
                    <br><br>
                    <label for="">Sold Items</label><br>
                    <input type="number" name="sold" id=""  value="<?php echo $sold_items ?>" required>
                    <br><br>
                    <button type="submit" name="update_product">Update Product</button>
                </form>
                    <?php
                        if(isset($_POST['update_product'])){
                            $product_name = $_POST['product_name'];
                            $category_name = $_POST['category'];
                            $price = $_POST['price'];
                            $retail_price = $_POST['retail'];
                            $quantity = $_POST['quantity'];
                            $sold_items = $_POST['sold'];
                            $update_query = "UPDATE tbl_products SET product_name='$product_name', category='$category_name', price='$price', retail_price='$retail_price', quantity= '$quantity', sold_items= '$sold_items' WHERE product_id = '$id'";
                            $sql = mysqli_query($conn, $update_query);

                            header('location: ITEC116_Lab1_Marion_Montana_Bustillo.php');
                        }
                    ?>
    </div>

    </body>
</html>