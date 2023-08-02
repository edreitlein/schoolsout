<?php
include "./databaseInit.php";

function yesNoDisplay($rowVar){
    return $rowVar ? 'Yes' : 'No';

}

function displaySearchResult($row){

    
    
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
        echo "<td>" . yesNoDisplay($row["after_care"]) . "</td>";//this should be t/f and display as Yes/No
        echo "<td>" . $row["after_care_time_end"] . "</td>";
        echo "<td>" . $row["price_after_care"] . "</td>";
        echo "<td>" . yesNoDisplay($row["food_provided"]) . "</td>";//this should be t/f and display as Yes/No
        echo "<td>" . yesNoDisplay($row["special_needs_accom"]) . "</td>";//this should be t/f and display as Yes/No
        echo "<td>" . yesNoDisplay($row["scholarship_opps"]) . "</td>";//this should be t/f and display as Yes/No
        echo "<td>" . $row["description"] . "</td>";
        echo "<td>" . $row["camp_start_date"]."</td>";
        echo "<td>" . $row["camp_end_date"]."</td>";
        echo "<td>" . $row["camp_fill_date"]."</td>";
        echo "<td>" . $row["camp_days_of_week"]."</td>";
        echo "</tr>";

        //  <th>Start Date</th>
    // <th>End Date</th>
    // <th>Fill Date</th>
    // <th>Days Of Week</th></tr>

        // Add more echo statements for other columns as needed
        // echo "</td>";
    

    
}

?>

<html>
<head>
  <title>Search</title>
  
  

<style>

  
  .centered-form {
    max-width: 90%; /* Adjust this value to your desired width */
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin:auto;
    margin-top: 4rem;
    
  }
  .centered-table {
  max-width: 90%; /* Adjust this value to your desired width */
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  margin:auto;
  
}

  </style>
  <header><?php include "./header.php"; ?></header>
</head>
<body>
  <div class="centered-form">
    <form action="search.php" method="GET">

        <label for="name">Camp Name:</label>
        <input type="text" id="name" name="name">

        <label for="city">City:</label>
        <input type="text" id="city" name="city">

        <label for="State">State</label>
        <input type="text" id="state" name="state">

        <label for="Zipcode">Zipcode</label>
        <input type="text" id="zipcode" name="zipcode">
            <div style="padding: 2px; border: 1px solid black; display: inline-block;">
                <!-- <label>Price</lable> -->
                <!-- <br> -->
                <label for="minPrice">Minimum Price:</label>
                <input type="number" id="minPrice" name="minPrice" min="0" step="0.01"> to
            
                <label for="maxPrice">Maximum Price:</label>
                <input type="number" id="maxPrice" name="maxPrice" min="0" step="0.01">
            </div>
            <br>
        <label for="Activity">Activity</label>
        <input type="text" id="activity" name="activity">

        <label for="startTime">Start Time</label>
        <input type="time" id="startTime" name="startTime">

        <label for="endTime">End Time</label>
        <input type="time" id="endTime" name="endTime">



        <input type="submit" value="Submit" name="search">
        <input type="submit" value="See All Entries" name="seeAll">
      
    </form>
  </div>
  <br>
  <div class="centered-table">
  <table>
    <tr><th>Unique ID</th>
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
    <th>Description</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Fill Date</th>
    <th>Days Of Week</th></tr>

    <!-- php here for building search result information -->

    <?php //search area

      if(isset($_GET["search"])){


        
        // $sql_query = "SELECT * FROM camp_info WHERE";
        // $params = "";

        $name_to_search = $_GET["name"];//the name to search
        $state_to_search = $_GET["state"];
        $city_to_search = $_GET["city"];
        $zipcode_to_search = $_GET["zipcode"];
        $minPrice = $_GET['minPrice'];
        $maxPrice = $_GET['maxPrice'];
        $activity_to_search = $_GET["activity"];
        $startTime = $_GET["startTime"];
        $endTime = $_GET["endTime"];
        // echo $activity_to_search;

        $sql = [];
        $parameters = [];

        if ($name_to_search) {
          $sql[] = " name LIKE ?";
          $name_to_search = '%'.$name_to_search.'%';
          $parameters[] = $name_to_search;
          // echo print_r($parameters);
        }
        if ($state_to_search) {
          $sql[] = " state LIKE ?";
          $state_to_search = '%'.$state_to_search.'%';
          $parameters[] = $state_to_search;
          // echo print_r($parameters);
        }
        if ($city_to_search) {
          $sql[] = " city LIKE ?";
          $city_to_search = '%'.$city_to_search.'%';
          $parameters[] = $city_to_search;
          // echo print_r($parameters);
        }
        if ($zipcode_to_search) {
          $sql[] = " zipcode LIKE ?";
          // $zipcode_to_search = $zipcode_to_search;//searches exact zipcode only
          $parameters[] = $zipcode_to_search;
          // echo print_r($parameters);
        }
        if (isset($_GET['minPrice']) and $_GET['minPrice']) {
          echo 'min';
          $sql[] = " price >= ?";
          $minPrice = $minPrice;//searches minimim price
          $parameters[] = $minPrice;
          // echo print_r($parameters);
        }
        if (isset($_GET['maxPrice']) and $_GET['maxPrice']) {//could remove isset 
          echo 'max';
          $sql[] = " price <= ?";
          $maxPrice = $maxPrice;//searches minimim price
          $parameters[] = $maxPrice;
          // echo print_r($parameters);
        }
        if ($activity_to_search) {
          // echo "act";
          $sql[] = " activity LIKE ?";
          $activity_to_search = '%'.$activity_to_search.'%';
          $parameters[] = $activity_to_search;
          // echo print_r($parameters);
        }
        if ($startTime){
          // echo $startTime;
          $sql[] = " start_time = ?";
          // $activit = $activity_to_search;
          $parameters[] = $startTime;
        }
        if ($endTime){
          // echo $endTime;
          $sql[] = " end_time = ?";
          // $activit = $activity_to_search;
          $parameters[] = $endTime;
        }
        

//  WHERE camp_visible = 1
        $query = "SELECT * FROM camp_info WHERE camp_visible = 1";
        if ($sql) {
          $query .= ' AND ' . implode(' AND ', $sql);
          // $query .= implode(' AND ', $sql);
        }

        $stmt = $mysqli->prepare($query);

        if ($parameters) {
          
          $stmt->bind_param((str_repeat('s', count($parameters))), ...$parameters);
        }

        // if(isset($_GET["name"])){//i can use this with concatnation to build a better search query
        //   $sql_query .=" name LIKE ?";
        //   $params .="s";
          
        // }
        // echo $sql_query;
        // echo $params;
        
        // $stmt = $mysqli->prepare("SELECT * FROM camp_info WHERE name LIKE ? AND state LIKE ? AND city LIKE ? AND zipcode LIKE ? AND price <= ?");
        // $stmt = $mysqli->prepare($sql_query);
        // $name_to_search = '%'.$name_to_search.'%';
        // $state_to_search = '%'.$state_to_search.'%';
        // $city_to_search = '%'.$city_to_search.'%';
        // $zipcode_to_search = '%'.$zipcode_to_search.'%';
//AND price >= ? 
        // $minPrice = '%'.$minPrice.'%'; $minPrice,
        //  $stmt->bind_param($params,$name_to_search,$state_to_search,$city_to_search,$zipcode_to_search,$maxPrice);
        

        
        // $stmt->bind_param($params,);
        $stmt->execute();
        $result=$stmt->get_result();


        
            while($row=$result->fetch_assoc()){
            displaySearchResult($row);
            }
        
        }else{
          $results=$mysqli->query("SELECT * FROM camp_info");
          if($results->num_rows>0){
            while($row=$results->fetch_assoc()){
              displaySearchResult($row);
            }
        
          }else{
            echo 'no listings found contact administrator';
          }
        }
?>
    
    </table>

</div>
</body>
</html>




