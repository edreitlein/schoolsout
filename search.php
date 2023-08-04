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
        echo "<td>" . $row["website_link"]."</td>";
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

        <div style="padding: 2px; border: 1px solid black; display: inline-block;">
        <label for="Aftercare">Aftercare:</label>
        <input type="checkbox" id="aftercare" name="aftercare" value="aftercare">
        <!-- The 'id' and 'for' attributes associate the label with the checkbox -->
</div>
        <div style="padding: 2px; border: 1px solid black; display: inline-block;">
        <label for="food_provided">Food Provided:</label>
        <input type="checkbox" id="food_provided" name="food_provided" value="food_provided">
        </div>

        <div style="padding: 2px; border: 1px solid black; display: inline-block;">
        <label for="special_needs_accom">Special Needs Accomidations:</label>
        <input type="checkbox" id="special_needs_accom" name="special_needs_accom" value="special_needs_accom">
        </div>

        <div style="padding: 2px; border: 1px solid black; display: inline-block;">
        <label for="scholarship_opps">Scholarship Opportunities:</label>
        <input type="checkbox" id="scholarship_opps" name="scholarship_opps" value="scholarship_opps">
        </div>

        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="camp_start_date">

        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="camp_end_date">

        <br>
        <div style="padding: 2px; border: 1px solid black; display: inline-block;">
        <label for="sunday">Sunday</label>
        <input type="checkbox" id="sunday" name="sunday" value="Sunday">
        
        <label for="monday">Monday</label>
        <input type="checkbox" id="monday" name="monday" value="Monday">
        
        <label for="tuesday">Tuesday</label>
        <input type="checkbox" id="tuesday" name="tuesday" value="Tuesday">
        
        <label for="wednesday">Wednesday</label>
        <input type="checkbox" id="wednesday" name="wednesday" value="Wednesday">
        
        <label for="thursday">Thursday</label>
        <input type="checkbox" id="thursday" name="thursday" value="Thursday">
        
        <label for="friday">Friday</label>
        <input type="checkbox" id="friday" name="friday" value="Friday">
        
        <label for="saturday">Saturday</label>
        <input type="checkbox" id="saturday" name="saturday" value="Saturday">
        </div>


        <br><input type="submit" value="Submit" name="search">
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
    <th>Days Of Week</th>
    <th>Website</th></tr>

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
        $camp_start_date = $_GET["camp_start_date"];
        $camp_end_date = $_GET["camp_end_date"];
        // $aftercare = $_GET["aftercare"];
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

        if(isset($_GET["aftercare"])){
          $sql[] = " after_care = 1";
        }

        if(isset($_GET["food_provided"])){
          $sql[] = " food_provided = 1";
        }

        if(isset($_GET["special_needs_accom"])){
          $sql[] = " special_needs_accom = 1";
        }

        if(isset($_GET["scholarship_opps"])){
          $sql[] = " scholarship_opps = 1";
        }

        if($camp_start_date){
          $sql[] = " camp_start_date = ?";

          $parameters[] = $camp_start_date;
        }

        if($camp_end_date){
          $sql[] = " camp_end_date = ?";

          $parameters[] = $camp_end_date;
        }

        $daySearch = FALSE;
        $daySearchParam=[];
        if(isset($_GET["sunday"])){
          $daySearch=TRUE;
          $daySearchParam[]= "S";

          // echo "sunday checked";
        }
        if(isset($_GET["monday"])){
          $daySearch=TRUE;
          $daySearchParam[]= "M";
        }
        if(isset($_GET["tuesday"])){
          $daySearch=TRUE;
          $daySearchParam[]= "T";

        }
        if(isset($_GET["wednesday"])){
          $daySearch=TRUE;
          $daySearchParam[]= "W";
        }
        if(isset($_GET["thursday"])){
          $daySearch=TRUE;
          $daySearchParam[] ="R";
        }
        if(isset($_GET["friday"])){
          $daySearch=TRUE;
          $daySearchParam[] ="F";
        }
        if(isset($_GET["saturday"])){
          $daySearch=TRUE;
          $daySearchParam[] ="U";
        }
        


        if($daySearch){

          foreach($daySearchParam as $day){
            $sql[] = " camp_days_of_week LIKE ?";

            $parameters[] = "%".$day."%";
            
          }

          // echo print_r($daySearchParam);
          // $sql[] = " camp_days_of_week LIKE ?";

          // $parameters[] = "%".$daySearchParam."%";


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




