<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search Results</title>
</head>
<body>
    <h1>Search Results</h1>

<?php
require_once("require_once/settings.php");

try {
    $dbconn = mysqli_connect($host, $user, $pwd, $sql_db);
} catch (mysqli_sql_exception $error) {
    $dbconn = false;
    echo "<p>Connection error: " . $error->getMessage() . "</p>";
}

if ($dbconn) {
    if (isset($_GET['model'])) {
        $model = mysqli_real_escape_string($dbconn, $_GET['model']);
        $sql = "SELECT car_id, make, model, price, yom FROM cars WHERE model LIKE '%$model%'";
        $result = mysqli_query($dbconn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table border='1' cellpadding='5'>";
            echo "<tr><th>ID</th><th>Make</th><th>Model</th><th>Price</th><th>Year</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['car_id'] . "</td>";
                echo "<td>" . $row['make'] . "</td>";
                echo "<td>" . $row['model'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['yom'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Car ain't here</p>";
        }
    } else {
        echo "<p>Look for something else bro</p>";
    }

    mysqli_close($dbconn);
}
?>

    <p><a href="search_form.php">Search again</a></p>
</body>
</html>