<?php 

//test file for git
include "./databaseInit.php";
include "./header.php";


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
        echo "</tr>";

        // Add more echo statements for other columns as needed
        // echo "</td>";
    

    
}

?>
<html>



<div class="page-content">
    <form action="testfile.php" method="GET">

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

        <input type="submit" value="Submit" name="search">
        <input type="submit" value="See All Entries" name="seeAll">
      
    </form>
  </div>

<div>
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
    <th>Description</th></tr>

<?php
if(isset($_GET["search"])){
    $name_to_search = $_GET["name"];//the name to search
    $state_to_search = $_GET["state"];
    $city_to_search = $_GET["city"];
    $zipcode_to_search = $_GET["zipcode"];
    $minPrice = $_GET['minPrice'];
    $maxPrice = $_GET['maxPrice'];
    // AND state LIKE ? AND city LIKE ? AND zipcode LIKE ? AND price <= ?
    $stmt = $mysqli->prepare("SELECT * FROM camp_info WHERE name LIKE ?");
    $name_to_search = '%'.$name_to_search.'%';
    // $state_to_search = '%'.$state_to_search.'%';
    // $city_to_search = '%'.$city_to_search.'%';
    // $zipcode_to_search = '%'.$zipcode_to_search.'%';
//AND price >= ? 
    // $minPrice = '%'.$minPrice.'%'; $minPrice,

    //,$state_to_search,$city_to_search,$zipcode_to_search,$maxPrice
    $stmt->bind_param("s",$name_to_search);
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


</html>