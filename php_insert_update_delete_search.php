<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "parts_store";

$customer_id = "";
$email = "";
$telephone = "";
$full_name = "";
$payment_method = "";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $connect = mysqli_connect($host, $user, $password, $database);
    mysqli_set_charset($connect, "utf8");
} catch (Exception $ex) {
    echo 'Error';
}

function getPosts()
{
    $posts = array();
    $posts[0] = isset($_POST['customer_id']) ? sanitizeInput($_POST['customer_id']) : '';
    $posts[1] = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
    $posts[2] = isset($_POST['telephone']) ? sanitizeInput($_POST['telephone']) : '';
    $posts[3] = isset($_POST['full_name']) ? sanitizeInput($_POST['full_name']) : '';
    $posts[4] = isset($_POST['payment_method']) ? sanitizeInput($_POST['payment_method']) : '';
    return $posts;
}

function sanitizeInput($data)
{
    global $connect;
    return mysqli_real_escape_string($connect, trim($data));
}

// Search 

if (isset($_POST['search'])) {
    $data = getPosts();
    $search_Query = "SELECT * FROM customers WHERE customer_id = $data[0]";

    $search_Result = mysqli_query($connect, $search_Query);

    if ($search_Result) {
        if (mysqli_num_rows($search_Result)) {
            while ($row = mysqli_fetch_array($search_Result)) {
                $customer_id = $row['customer_id'];
                $email = $row['email'];
                $telephone = $row['telephone'];
                $full_name = $row['full_name'];
                $payment_method = $row['payment_method'];
            }
        } else {
            echo 'No Data For This Customer_ID';
        }
    } else {
        echo 'Result Error';
    }
}

if (isset($_POST['insert'])) {
    $data = getPosts();
    $insert_Query = "INSERT INTO `customers`(`email`, `telephone`, `full_name`, `payment_method`) VALUES ('$data[1]','$data[2]','$data[3]',$data[4])";
    try {
        $insert_Result = mysqli_query($connect, $insert_Query);

        if ($insert_Result) {
            if (mysqli_affected_rows($connect) > 0) {
                echo 'Data Inserted';
            } else {
                echo 'Data not Inserted';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Insert ' . $ex->getMessage();
    }
}

if (isset($_POST['delete'])) {
    $data = getPosts();
    $delete_Query = "DELETE FROM `customers` WHERE `customer_id` = $data[0]";
    try {
        $delete_Result = mysqli_query($connect, $delete_Query);

        if ($delete_Result) {
            if (mysqli_affected_rows($connect) > 0) {
                echo 'Data Deleted';
            } else {
                echo 'Data not Deleted';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Delete ' . $ex->getMessage();
    }
}

if (isset($_POST['update'])) {
    $data = getPosts();
    $update_Query = "UPDATE `customers` SET `email`='$data[1]',`telephone`='$data[2]',`full_name`='$data[3]',`payment_method`=$data[4] WHERE `customer_id` = $data[0]";
    try {
        $update_Result = mysqli_query($connect, $update_Query);

        if ($update_Result) {
            if (mysqli_affected_rows($connect) > 0) {
                echo 'Data Updated';
            } else {
                echo 'Data not Updated';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Update ' . $ex->getMessage();
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>PHP INSERT UPDATE DELETE SEARCH</title>
</head>

<body>
    <form action="php_insert_update_delete_search.php" method="post">
        <input type="number" name="customer_id" placeholder="Customer_ID" value="<?php echo $customer_id; ?>"><br><br>
        <input type="text" name="email" placeholder="Customer Email" value="<?php echo $email; ?>"><br><br>
        <input type="number" name="telephone" placeholder="Customer Telephone" value="<?php echo $telephone; ?>"><br><br>
        <input type="text" name="full_name" placeholder="Customer Full Name" value="<?php echo $full_name; ?>"><br><br>
        <input type="number" name="payment_method" placeholder="Customer Pay Method" value="<?php echo $payment_method; ?>"><br><br>
        <div>
            <input type="submit" name="insert" value="Add">
            <input type="submit" name="update" value="Update">
            <input type="submit" name="delete" value="Delete">
            <input type="submit" name="search" value="Find">
        </div>
    </form>
</body>

</html>
