<?php
    // =========================================================
    // TODO 1: SECURE DATABASE CONNECTION (XAMPP / MySQL)
    // =========================================================
    // 1. Read your credentials from the 'database.ini' file using parse_ini_file()
    // 2. Connect to MySQL using mysqli_connect($host, $user, $password, $dbname)
    $host = 'localhost'; 
    $username = 'locloc';
    $password = 'ikaw';
    $dbname = 'pizzastoredb';
    
    $conn = mysqli_connect($host, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // =========================================================
    // TODO 2: HANDLE POST REQUESTS (ALL CRUD OPERATIONS)
    // =========================================================


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // --- 🍕 PIZZA ADMIN ---
        if (isset($_POST['add_pizza'])) {
            $name = $_POST['name'];
            $price = $_POST['price'];

            $query = "INSERT INTO pizzas (name, price) VALUES ('$name', $price)";
            mysqli_query($conn, $query);
            // TODO: Write INSERT query for Pizzas 
            // Security Tip: Use Prepared Statements (mysqli_prepare) to prevent SQL Injection!
        }
        if (isset($_POST['update_pizza'])) {
            $id = $_POST['id'];
            $price = $_POST['price'];

            $query = "UPDATE pizzas SET price = $price WHERE id = $id";
            mysqli_query($conn, $query);

            // TODO: Write UPDATE query to change pizza price
        }
        if (isset($_POST['delete_pizza'])) {
            $id = $_POST['id'];

            $query = "DELETE FROM pizzas WHERE id = $id";
            mysqli_query($conn, $query);

            // TODO: Write DELETE query to remove a pizza
        }

        // --- ✨ TOPPINGS ADMIN ---
        if (isset($_POST['add_topping'])) {
                $name = $_POST['name'];
                $price = $_POST['price'];
    
                $query = "INSERT INTO toppings (name, price) VALUES ('$name', $price)";
                mysqli_query($conn, $query);
            // TODO: Write INSERT query for Toppings
        }
        if (isset($_POST['update_topping'])) {
                $id = $_POST['id'];
                $price = $_POST['price'];
    
                $query = "UPDATE toppings SET price = $price WHERE id = $id";
                mysqli_query($conn, $query);
            // TODO: Write UPDATE query to change topping price
        }
        if (isset($_POST['delete_topping'])) {
            $id = $_POST['id'];

            $query = "DELETE FROM toppings WHERE id = $id";
            mysqli_query($conn, $query);
            // TODO: Write DELETE query to remove a topping
        }

        // --- 🛒 ORDERING SYSTEM ---
        if (isset($_POST['create_order'])) {
            // TODO:     
            // 1. Fetch the selected Pizza's price from the database using mysqli_query
            $pizza_result = mysqli_query($conn, "SELECT price FROM pizzas WHERE id = " . $_POST['pizza']);
            $pizza_price = 0;
            if ($pizza_result && mysqli_num_rows($pizza_result) > 0) {
                $pizza_row = mysqli_fetch_assoc($pizza_result);
                $pizza_price = $pizza_row['price'];
            }

            // 2. Loop through selected Toppings, fetch their prices, and calculate total topping cost
            $toppings_total = 0;
            if (!empty($_POST['toppings']) && is_array($_POST['toppings'])) {
                foreach ($_POST['toppings'] as $topping_id) {
                    $topping_result = mysqli_query($conn, "SELECT price FROM toppings WHERE id = " . $topping_id);
                    if ($topping_result && mysqli_num_rows($topping_result) > 0) {
                        $topping_row = $topping_result->fetch_assoc();
                        $toppings_total += $topping_row['price'];
                    }
                }
            }
            // 3. Calculate Grand Total: (Pizza Price + Toppings Total) * Quantity
            $quantity = $_POST['qty'];
            $grand_total = ($pizza_price + $toppings_total) * $quantity;    

            // 4. INSERT the final order into the 'orders' table
            $sql = "INSERT INTO orders (customer_name, pizza_id, toppings, quantity, total_price, status) VALUES ('{$_POST['customer']}', {$_POST['pizza']}, '" . implode(',', $_POST['toppings']) . "', $quantity, $grand_total, 'Pending')";
            mysqli_query($conn, $sql);
        }

        // --- 📋 MANAGE ORDERS ---
        if (isset($_POST['update_status'])) {
            // TODO: Write UPDATE query to change order status to 'Completed'
            $id = $_POST['id'];
            $query = "UPDATE orders SET status = 'Completed' WHERE id = $id";
            mysqli_query($conn, $query);
        }
        if (isset($_POST['delete_order'])) {
            // TODO: Write DELETE query to remove an order
            $id = $_POST['id'];
            $query = "DELETE FROM orders WHERE id = $id";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>🍕 Pizza Master Dashboard</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: linear-gradient(135deg, #FF6B6B 0%, #FFA500 100%); min-height: 100vh; padding: 40px 20px; color: #333;}
        .container { max-width: 1200px; margin: 0 auto; }
        header { text-align: center; color: white; margin-bottom: 40px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3); }
        h1 { font-size: 3em; margin-bottom: 10px; }
        
        .grid-layout { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px;}
        .full-width { grid-column: 1 / -1; }
        @media(max-width: 800px) { .grid-layout { grid-template-columns: 1fr; } }
        
        .card { background: white; border-radius: 15px; padding: 30px; box-shadow: 0 10px 20px rgba(0,0,0,0.2); }
        .card h2 { color: #FF6B6B; border-bottom: 3px solid #FFA500; padding-bottom: 10px; margin-bottom: 20px; }
        
        .form-group { display: flex; gap: 10px; margin-bottom: 20px; align-items: flex-end; }
        .form-stack { display: flex; flex-direction: column; gap: 8px; margin-bottom: 15px; }
        input[type="text"], input[type="number"] { padding: 10px; border: 2px solid #FF6B6B; border-radius: 8px; width: 100%; }
        
        .radio-group, .checkbox-group { display: flex; flex-direction: column; gap: 10px; }
        .selection-item { display: flex; align-items: center; padding: 10px; border-radius: 8px; cursor: pointer; background: #fff5f5;}
        .selection-item:hover { background-color: #ffe8e8; }
        .selection-item input { margin-right: 10px; width: 18px; height: 18px; accent-color: #FF6B6B; }
        .price { color: #FFA500; font-weight: bold; }
        
        button { padding: 10px 15px; background: #FF6B6B; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; }
        button:hover { background: #FFA500; }
        .btn-large { width: 100%; padding: 15px; font-size: 1.1em; }
        .btn-update { background: #4CAF50; padding: 6px 12px; font-size: 0.9em; }
        .btn-delete { background: #f44336; padding: 6px 12px; font-size: 0.9em; }
        
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ecf0f1; }
        th { background-color: #FFF5E6; color: #FF6B6B; }
        .price-input { width: 90px !important; padding: 6px !important; margin-right: 5px; border: 1px solid #ccc !important;}
        
        .badge { padding: 5px 10px; border-radius: 20px; font-size: 0.8em; font-weight: bold; color: white; }
        .bg-pending { background-color: #FFA500; }
        .bg-completed { background-color: #4CAF50; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>🍕 Pizza Master Dashboard</h1>
            <p>Admin Menu Management & Live Ordering System</p>
        </header>

        <div class="grid-layout">
            
            <div class="card">
                <h2>⚙️ Manage Pizzas</h2>
                <form method="post" class="form-group">
                    <div style="flex: 2;"><input type="text" name="name" placeholder="New Pizza Name" required></div>
                    <div style="flex: 1;"><input type="number" name="price" step="0.01" min="0" placeholder="Price" required></div>
                    <button type="submit" name="add_pizza">Add</button>
                </form>
                <table>
                    <tbody>
                        <?php
                            // TODO 3: Read from 'pizzas' table using mysqli_query and mysqli_fetch_assoc
                            // Remember to use htmlspecialchars() for security!
                            echo "<tr><td colspan='3'><em>Code pizza read logic here...</em></td></tr>";
                            $myresult = mysqli_query($conn, "SELECT * FROM pizzas");
                            while($row = mysqli_fetch_assoc($myresult)){
                                echo "<tr>
                                        <td><strong>" . htmlspecialchars($row['name']) . "</strong></td>
                                        <td>
                                            <form method='post' style='display:flex;'>  
                                                <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                <input type='number' name='price' value='" . $row['price'] . "' step='0.01' class='price-input' required>
                                                <button type='submit' name='update_pizza' class='btn-update'>Save</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method='post'>
                                                <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                <button type='submit' name='delete_pizza' class='btn-delete'>✖</button>
                                            </form>
                                        </td>
                                    </tr>";
                            }   
                            
                            /* Example of how the generated HTML should look:
                            <tr>
                                <td><strong>Safe Pizza Name</strong></td>
                                <td>
                                    <form method='post' style='display:flex;'>
                                        <input type='hidden' name='item_id' value='1'>
                                        <input type='number' name='new_price' value='150.00' step='0.01' class='price-input' required>
                                        <button type='submit' name='update_pizza' class='btn-update'>Save</button>
                                    </form>
                                </td>
                                <td>
                                    <form method='post'>
                                        <input type='hidden' name='item_id' value='1'>
                                        <button type='submit' name='delete_pizza' class='btn-delete'>✖</button>
                                    </form>
                                </td>
                            </tr>
                            */
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="card">
                <h2>⚙️ Manage Toppings</h2>
                <form method="post" class="form-group">
                    <div style="flex: 2;"><input type="text" name="name" placeholder="New Topping Name" required></div>
                    <div style="flex: 1;"><input type="number" name="price" step="0.01" min="0" placeholder="Price" required></div>
                    <button type="submit" name="add_topping">Add</button>
                </form>
                <table>
                    <tbody>
                        <?php
                            // TODO 4: Read from 'toppings' table and generate rows dynamically
                            // Remember to use htmlspecialchars() for security!
                            echo "<tr><td colspan='3'><em>Code toppings read logic here...</em></td></tr>";
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card" style="max-width: 800px; margin: 0 auto 30px auto;">
            <h2>🛒 Place New Order</h2>
            <form method="post">
                <div class="form-stack">
                    <label><strong>Customer Name</strong></label>
                    <input type="text" name="customer" required>
                </div>

                <div class="grid-layout" style="gap: 20px; margin-bottom: 0;">
                    
                    <div class="form-stack">
                        <label><strong>Select Pizza</strong></label>
                        <div class="radio-group">
                            <?php 
                                // TODO 5: Fetch Pizzas from DB to generate radio buttons
                                echo "<label class='selection-item'><em>Code pizza radio buttons here...</em></label>";
                            ?>
                        </div>
                    </div>

                    <div class="form-stack">
                        <label><strong>Select Toppings</strong></label>
                        <div class="checkbox-group">
                            <?php 
                                // TODO 6: Fetch Toppings from DB to generate checkboxes
                                echo "<label class='selection-item'><em>Code topping checkboxes here...</em></label>";
                            ?>
                        </div>
                    </div>
                </div>

                <div class="form-stack" style="margin-top: 15px;">
                    <label><strong>Quantity</strong></label>
                    <input type="number" name="qty" min="1" value="1" required>
                </div>

                <button type="submit" name="create_order" class="btn-large">🚀 Submit Order</button>
            </form>
        </div>

        <div class="card full-width">
            <h2>📋 Live Kitchen Orders</h2>
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th><th>Customer</th><th>Order Details</th><th>Total</th><th>Status</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // TODO 7: Read from 'orders' table and display live kitchen orders
                            // If status is Pending, show the Checkmark (✔) button. Otherwise, hide it.
                            echo "<tr><td colspan='6' style='text-align:center;'><em>Code orders read logic here...</em></td></tr>";
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</body>
</html>