<?php 
    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "sarreal_db";
    $conn = mysqli_connect($server, $user, $password, $db);

    if(!$conn){
        die("Could not connect to server". mysqli_connect_error());
    }
?>
<html>
    <head>
        <title>Lab1</title>
        <link rel="stylesheet" href="index.css">
        <meta name="author" content="Marion Alolino, Ryam Montana, Kim Justin Bustillo">
    </head>
    <body>
        <div class="expenses">
            <h2>EXPENSES</h2>
                <form action="" method="post">
                    <label for="">Store Rental (/Month): </label><br>
                    <input type="number" name="store_rental"><br><br>

                    <label for="">Electric Bill (/Month): </label><br>
                    <input type="number" name="electric_bill"><br><br>

                    <label for="">Water Bill (/Month): </label><br>
                    <input type="number" name="water_bill"><br><br>

                    <label for="">Transpo (/Month): </label><br>
                    <input type="number" name="transpo"><br><br>

                    <label for="">Sales Staff (/Month): </label><br>
                    <input type="number" name="staff"><br><br>

                    <button type="submit" name="calcu">Calculate</button>
                    <br>
                        <div class = "echo1">
                            <?php
                                if(isset($_POST['calcu'])){
                                    $raw_store_rental = $_POST['store_rental'];
                                    $raw_electric_bill = $_POST['electric_bill'];
                                    $raw_water_bill = $_POST['water_bill'];
                                    $raw_transpo = $_POST['transpo'];
                                    $raw_sales_staff = $_POST['staff'];
                                    $store_rental = $raw_store_rental + ($raw_store_rental * 0.10);
                                    $electric_bill = $raw_electric_bill + ($raw_electric_bill * 0.10);
                                    $water_bill = $raw_water_bill + ($raw_water_bill * 0.10);
                                    $transpo = $raw_transpo + ($raw_transpo * 0.10);
                                    $sales_staff = $raw_sales_staff + ($raw_sales_staff * 0.10);
                                    $expenses_weekly =($store_rental + $electric_bill + $water_bill + $transpo + $sales_staff) / 4;
                                    echo "Expenses: $expenses_weekly";
                                }
                            ?>
                        </div>
                </form>
        </div>
        <div class = "productsdUh">
            <div class = "addProduct">
                <h2>ADD PRODUCT</h2>
                <form method="post" autocomplete="off">
                    <label for="">Product Name</label><br>
                    <input type="text" name="product_name" id="" required>
                    <br><br>
                    <label for="">Category</label><br>
                    <input type="text" name="category" id="" required>
                    <br><br>
                    <label for="">Price</label><br>
                    <input type="number" name="price" id="" required>
                    <br><br>
                    <label for="">Retail price</label><br>
                    <input type="number" name="retail" id="" required>
                    <br><br>
                    <label for="">Quantity</label><br>
                    <input type="number" name="quantity" id="" required>
                    <br><br>
                    <button type="submit" name="add_product">Add Product</button>
                </form>
                <div class = "php1">
                    <?php
                        if(isset($_POST['add_product'])){
                            $product_name = $_POST['product_name'];
                            $category_name = $_POST['category'];
                            $price = $_POST['price'];
                            $retail_price = $_POST['retail'];
                            $quantity = $_POST['quantity'];
                            $insert_query = "INSERT INTO tbl_products(product_name, category, price, retail_price, quantity) VALUES('$product_name', '$category_name', '$price', '$retail_price', '$quantity')";
                            $sql = mysqli_query($conn, $insert_query);
                        }
                    ?>
                </div>
            </div>
            <div class = "listofProducts" style="overflow-y:auto;">          
                <h2>LIST OF PRODUCTS</h2>
                <table border= double>
                    <tr>
                        <th>product_name</th>
                        <th>category</th>
                        <th>price</th>
                        <th>retail_price</th>
                        <th>quantity</th>
                        <th>sold_items</th>
                    </tr>
                    <tr>
                        <div class = "echxo2">
                            <?php
                                $select_sql = "SELECT * FROM tbl_products";
                                $select_qry = mysqli_query($conn, $select_sql);
                                if(mysqli_num_rows($select_qry)){
                                    while($products = mysqli_fetch_array($select_qry)){
                                        ?>
                                            <tr>
                                                <td style='color:white; padding:.5%; text-align:'><?php echo $products['product_name'] ?></td>
                                                <td style='color:white; padding:.5%; text-align:'><?php echo $products['category'] ?></td>
                                                <td style='color:white; padding:.5%; text-align:'><?php echo $products['price'] ?></td>
                                                <td style='color:white; padding:.5%; text-align:'><?php echo $products['retail_price'] ?></td>
                                                <td style='color:white; padding:.5%; text-align:'><?php echo $products['quantity'] ?></td>
                                                <td style='color:white; padding:.5%; '><?php echo $products['sold_items'] ?></td>
                                            </tr>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                    </tr>
                </table>
            </div>             
        </div>
    </body>
</html>