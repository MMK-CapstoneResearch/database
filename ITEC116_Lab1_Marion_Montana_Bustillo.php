<?php 
    require "connect.php";
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lab1</title>
        <link rel="stylesheet" href="index.css">
        <script defer src="index.js"></script>
        <!-- CSS only -->
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
        <meta name="author" content="Marion Alolino, Ryam Montana, Kim Justin Bustillo">
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>
    </head>
    <body>

        <section class = "hidden">
        <div class = "expenses">
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
        </section>
        <section class = "hidden">
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
        </section>

            <div class = "productsdUh">
            <section class = "hidden">
            <div class = "textExpenses" >
                <h2>LIST OF PRODUCTS</h2>
            </div>
            <div class = "listofProducts" style="overflow-y:auto;"> 
                <table border = double>
                    <tr>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Retail Price</th>
                        <th>Quantity</th>
                        <th>Sold Items</th>
                        <th>Actions</th>
                    </tr>
                    <tr>
                        <div class = "echo2">
                            <?php
                                $select_sql = "SELECT * FROM tbl_products";
                                $select_qry = mysqli_query($conn, $select_sql);
                                if(mysqli_num_rows($select_qry)){
                                    while($products = mysqli_fetch_array($select_qry)){
                                        ?>
                                            <tr>
                                                <td style='color:white; padding: 1%; text-align:center;'><?php echo $products['product_name'] ?></td>
                                                <td style='color:white; padding: 1%; text-align:center;'><?php echo $products['category'] ?></td>
                                                <td style='color:white; padding: 1%; text-align:center;'><?php echo $products['price'] ?></td>
                                                <td style='color:white; padding: 1%; text-align:center;'><?php echo $products['retail_price'] ?></td>
                                                <td style='color:white; padding: 1%; text-align:center;'><?php echo $products['quantity'] ?></td>
                                                <td style='color:white; padding: 1%; text-align:center;'><?php echo $products['sold_items'] ?></td>
                                                <td style='color:white; padding: 1%; text-align:center;'>
                                                    <a style = 'color:cyan; text-decoration:none' href="edit.php?id=<?php echo $products['product_id'] ?>">Edit </a> or
                                                    <a style = 'color:cyan; text-decoration:none' href="delete.php?id=<?php echo $products['product_id'] ?>">Delete</a>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                    </tr>
                </table>
            </div>      
            </section>       
        </div>
        

        <div class = "sProducts">
            <div class = "products1">
                <h2>SOLD PRODUCT</h2>
                <form method="post" autocomplete="off">
                    <label for="">Product Name</label><br>
                    <input type="text" name="product_name" id="" required>
                    <br><br>
                    <label for="">Category</label><br>
                    <input type="text" name="category" id="" required>
                    <br><br>
                    <label for="">Price per unit</label><br>
                    <input type="number" name="price" id="" required>
                    <br><br>
                    <label for="">Quantity</label><br>
                    <input type="number" name="quantity" id="" required>
                    <br><br>
                    <button type="submit" name="sold_product">Add Product</button>
                </form>
                <div class = "php1">
                    <?php
                         
                        if(isset($_POST['sold_product'])){
                            $product_name = $_POST['product_name'];
                            $category_name = $_POST['category'];
                            $price = $_POST['price'];
                            $quantity = $_POST['quantity'];
                            // fetch product table
                            $fetch_qry = "SELECT sold_items FROM tbl_products WHERE product_name = '$product_name';";
                            $items= mysqli_query($conn, $fetch_qry);
                            $tempvar = mysqli_fetch_array($items);
                            $updatedCount = (int)$tempvar['sold_items'] + (int)$quantity;
                            $update_qry = "UPDATE tbl_products set sold_items= '$updatedCount' WHERE product_name='$product_name'";
                            $insert_query = "INSERT INTO tbl_sold(product_name, category, price_per_unit, quantity) VALUES('$product_name', '$category_name', '$price', '$quantity')";
                            $sql1 = mysqli_query($conn, $update_qry);
                            $sql = mysqli_query($conn, $insert_query);
                        }
                    ?>
                </div>
            </div>
            <br>
            <!-- ------------------------------------------------Most and Least Sold Products------------------------------------- -->
        
            <div class ="moale">
                <div class ="mostSold">
                    <!-- most sold -->
                    <h2>Most Sold Product</h2>
                    <?php
                        $select_sql = "SELECT product_name, category, retail_price, MAX(total) AS total FROM (
                            SELECT product_name, category, retail_price, SUM(sold_items) AS total FROM tbl_products GROUP BY product_name ORDER BY total DESC) as most;";
                        $select_qry = mysqli_query($conn, $select_sql);
                        $sold_item = mysqli_fetch_array($select_qry);
                    ?>
                    <table class ="center" border = "single">
                    <tr>
                        <td>Product Name</td>
                        <td>Category</td>
                        <td>Price per Unit</td>
                        <td>Quantity</td>
                    </tr>
                        <tr>
                            <td style='color:white; padding:.5%;'><?php echo $sold_item['product_name'] ?></td>
                            <td style='color:white; padding:.5%;'><?php echo $sold_item['category'] ?></td>
                            <td style='color:white; padding:.5%;'><?php echo $sold_item['retail_price'] ?></td>
                            <td style='color:white; padding:.5%;'><?php echo $sold_item['total'] ?></td>
                        </tr>
                    </table> 
                </div>        
                <div class = "leastSold">
                    <!-- least sold -->
                    <h2>Least Sold Product</h2>
                    <?php
                        $select_sql = "SELECT product_name, category, retail_price, MIN(total) AS total FROM (
                            SELECT product_name, category, retail_price, SUM(sold_items) AS total FROM tbl_products GROUP BY product_name ORDER BY total ASC) as least;";
                        $select_qry = mysqli_query($conn, $select_sql);
                        $sold_item = mysqli_fetch_array($select_qry);
                    ?>
                    <table class = "center2" border= double>
                    <tr>
                        <td>Product Name</td>
                        <td>Category</td>
                        <td>Price Per Unit</td>
                        <td>Quantity</td>
                    </tr>
                        <tr>
                            <td style='color:white; padding:.5%;' ><?php echo $sold_item['product_name'] ?></td>
                            <td style='color:white; padding:.5%;'><?php echo $sold_item['category'] ?></td>
                            <td style='color:white; padding:.5%;'><?php echo $sold_item['retail_price'] ?></td>
                            <td style='color:white; padding:.5%;'><?php echo $sold_item['total'] ?></td>
                        </tr>
                    </table> 
                </div>
            </div>
            <!-- ------------------------------------------------Most and Least Sold Products------------------------------------- -->
            <!-- ------------------------------------------------Gross and Net Income------------------------------------- -->
            <div class ="income">
                <div class = "grossIncome">
                <h2>Gross Income</h2>
                <?php
                    $select_sql = "SELECT retail_price, quantity FROM `tbl_products`;";
                    $select_qry = mysqli_query($conn, $select_sql);
                    $gross_amount =0;
                    if(mysqli_num_rows($select_qry)){
                        while($sold_item = mysqli_fetch_array($select_qry)){
                            $gross_amount = $gross_amount + ($sold_item['retail_price'] * $sold_item['quantity']);
                        }
                    }
                ?>
           
                <table border = double class = "grossI">
                    <tr>
                        <th >Total Amount</th>
                    </tr>
                    <tr>
                    <td style='color:white; text-align:center;'><?php echo $gross_amount ?></td>
                    </tr>
                </table>
                </div>
                <div class = "netIncome">
                    <h2>Net Income</h2>
                    <?php
                        // $select_sql = "SELECT price_per_unit, tbl_sold.quantity as sold_price, tbl_products.price AS org_price FROM tbl_sold INNER JOIN tbl_products ON tbl_sold.product_name = tbl_products.product_name;";
                        $select_sql = "SELECT retail_price as sold_price, price AS org_price FROM tbl_products;";
                        $select_qry = mysqli_query($conn, $select_sql);
                        $net_amount =0;
                        if(mysqli_num_rows($select_qry)){
                            while($sold_item = mysqli_fetch_array($select_qry)){
                                $net_amount = $net_amount + ($sold_item['sold_price'] * $sold_item['org_price']);
                            }
                        }
                        $net_amount =($net_amount - $gross_amount)/4;
                    ?>
                    <table border = double class ="netI">
                        <tr>
                            <th>Total Amount</th>
                        </tr>
                        <tr>
                        <td style='color:white; text-align:center;'><?php echo $net_amount ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
            <!-- ------------------------------------------------Gross and Net Income------------------------------------- -->
    </body>
</html>