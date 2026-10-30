<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car List</title>
</head>
<body>
    <h1>Car list</h1>

<?php
require_once("require_once/settings.php");

$dbconn = @mysqli_connect($host, $user, $pwd, $sql_db);

if (!$dbconn) {
    echo "<p>Database connection failure.</p>";
} else {
        $query  = "SELECT car_id, make, model, price, yom FROM cars";
    $result = mysqli_query($dbconn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table border=\"1\">";
        echo "<tr>
                <th>Car ID</th>
                <th>Make</th>
                <th>Model</th>
                <th>Price</th>
                <th>Year</th>
              </tr>";

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
        mysqli_free_result($result);
    } else {
        echo "<p>There are no cars to display.</p>";
    }

    mysqli_close($dbconn);
}
?>

</body>
</html>