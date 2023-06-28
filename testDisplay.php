<?php

include "./databaseInit.php";



//database data collection for display

$sql = "SELECT * FROM camp_info";

// Execute the query
$result = $mysqli->query($sql);

?>
<html>
<head>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }
    
    th, td {
      text-align: left;
      padding: 8px;
      border-bottom: 1px solid #ddd;
    }
    
    th {
      background-color: #f2f2f2;
    }
  </style>
</head>
</html>
<?php
if ($result->num_rows > 0) {
    // Loop through each row and display the data
    echo "<table>";
    echo "<tr><th>Unique ID</th>
    <th>Account ID</th>
    <th>Name</th>
    <th>Street Address</th>
    <th>City</th>
    <th>State</th>
    <th>Zipcode</th>
    <th>Activity</th>
    <th>Price</th>
    <th>Ages Served</th>
    <th>Start Time</th>
    <th>End Time</th>
    <th>Hours Duration</th>
    <th>After Care</th>
    <th>After Care Time End</th>
    <th>Price After Care</th>
    <th>Food Provided</th>
    <th>Special Needs Accommodation</th>
    <th>Scholarship Opportunities</th>
    <th>Description</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["camp_id"] . "</td>";
        echo "<td>" . $row["account_id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["street_address"] . "</td>";
        echo "<td>" . $row["city"] . "</td>";
        echo "<td>" . $row["state"] . "</td>";
        echo "<td>" . $row["zipcode"] . "</td>";
        echo "<td>" . $row["activity"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "<td>" . $row["ages_served"] . "</td>";
        echo "<td>" . $row["start_time"] . "</td>";
        echo "<td>" . $row["end_time"] . "</td>";
        echo "<td>" . $row["hours_duration"] . "</td>";
        echo "<td>" . $row["after_care"] . "</td>";
        echo "<td>" . $row["after_care_time_end"] . "</td>";
        echo "<td>" . $row["price_after_care"] . "</td>";
        echo "<td>" . $row["food_provided"] . "</td>";//this should be t/f
        echo "<td>" . $row["special_needs_accom"] . "</td>";
        echo "<td>" . $row["scholarship_opps"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "</tr>";

        // Add more echo statements for other columns as needed
        // echo "</td>";
    }

    echo "</table>";
} else {
    echo "No entries found.";
}

$mysqli->close();

?>
<html>



</html>