<?php

include "./databaseInit.php";

?>

<!DOCTYPE html>
<html>
<head>
    <style>
        /* Style for the form container */
.form-container {
  max-width: 50%;
  /* overflow-x: hidden; */
  margin: 100px auto;
  padding: 20px;
  padding-top:1rem;
  background-color: #f5f5f5;
  border-radius: 5px;
}

/* Style for form labels */
.form-container label {
  display: block;
  margin-bottom: 8px;
  font-weight: bold;
}

/* Style for form input fields */
.form-container input[type="text"],
.form-container textarea {
  width: 100%;
  padding: 8px;
  margin-bottom: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

/* Style for submit button */
.form-container input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

/* Style for submit button on hover */
.form-container input[type="submit"]:hover {
  background-color: #45a049;
}

/* Style for form error messages */
.form-container .error {
  color: red;
  font-size: 14px;
  margin-top: -8px;
  margin-bottom: 16px;
}

/* Style for form success message */
.form-container .success {
  color: green;
  font-size: 14px;
  margin-top: -8px;
  margin-bottom: 16px;
}
        
/* Style for the navigation bar */
.navbar {
  background-color: #4CAF50;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 999;
  
}

/* Style for the navigation links */
.navbar a {
  display: inline-block;
  color: #fff;
  text-decoration: none;
  padding: 15px;
  transition: background-color 0.3s ease;
}

/* Style for the hover effect on navigation links */
.navbar a:hover {
  background-color: #45a049;
}

/* Style for the active navigation link */
.navbar a.active {
  background-color: #45a049;
  transition: transform 0.3s ease;

}
.navbar .active:hover {
  transform: scale(1.1);
}

/* Animation for the navigation links */
@keyframes fadeIn {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

.navbar a {
  animation: fadeIn 0.5s ease forwards;
  opacity: 0;
}

/* Add margin to the page content to prevent it from overlapping with the navigation bar */
.page-content {
  margin-top: 60px;
}

    </style>
  

  <title>My Website</title>

  <!-- <header>
    <nav class = "navbar">
      
        <a href="campUpload.php" class="active">Upload</a>
        <a href="login.html" class="active">Login</a>
        <a href="search.php" class="active" >Search</a>
      
    </nav>
  </header> -->
<?php include "./header.php"; ?>
<?php

$nameErr=$priceErr="";


// post submit db checking and uploading

function test_input($data){ //removes possibility of xss attacks server-side

  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);

  return $data;
}

// echo test_input($_POST['name']);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // echo "page from POST";

  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  }else{
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[A-Za-z0-9\s\-]*$/",$name)) {
      $nameErr = "Only Letters, Numbers, Dashes and white space allowed";
    }
  }

  if(!empty($_POST['street_address'])){
    $_POST['street_address'] = test_input($_POST['street_address']);

  }

  if(!empty($_POST['city'])){
    $_POST['city'] = test_input($_POST['city']);

  }
  if(!empty($_POST['state'])){
    $_POST['state'] = test_input($_POST['state']);

  }

  if(!empty($_POST['zipcode'])){
    $_POST['zipcode'] = test_input($_POST['zipcode']);

  }
  if(!empty($_POST['activity'])){
    $_POST['activity'] = test_input($_POST['activity']);

  }



  if (!empty($_POST['price'])){
    // echo "something";
    $price = test_input($_POST['price']);

  }else{
    $price="";
  }

  if(!empty($_POST['ages_served'])){
    $_POST['ages_served']=test_input($_POST['ages_served']);

  }else{
    $_POST['ages_served'] = "";
  }

  if(!empty($_POST['start_time'])){
    $_POST['start_time'] = test_input($_POST['start_time']);

  }else{
    $_POST['start_time'] = '';
  }

  if(!empty($_POST['end_time'])){
    $_POST['end_time'] = test_input($_POST['end_time']);

  }else{
    $_POST['end_time'] = '';
  }

  if(!empty($_POST['after_care'])){
    $_POST['after_care'] = test_input($_POST['after_care']);
  }

  if(!empty($_POST['after_care_time_end'])){
    $_POST['after_care_time_end'] = test_input($_POST['after_care_time_end']);
  }

  if(!empty($_POST['price_after_care'])){
    $_POST['price_after_care'] = test_input($_POST['price_after_care']);
  }
  if(!empty($_POST['food_provided'])){
    $_POST['food_provided'] = test_input($_POST['food_provided']);
  }

  if(!empty($_POST['special_needs_accom'])){
    $_POST['special_needs_accom'] = test_input($_POST['special_needs_accom']);
  }
  if(!empty($_POST['scholarship_opps'])){
    $_POST['scholarship_opps'] = test_input($_POST['scholarship_opps']);
  }
  if(!empty($_POST['description'])){
    $_POST['description'] = test_input($_POST['description']);
  }

  if(!empty($_POST['camp_start_date'])){
    $_POST['camp_start_date'] = test_input($_POST['camp_start_date']);
  }

  if(!empty($_POST['camp_end_date'])){
    $_POST['camp_end_date'] = test_input($_POST['camp_end_date']);
  }

  if(!empty($_POST['camp_fill_date'])){
    $_POST['camp_fill_date'] = test_input($_POST['camp_fill_date']);
  }

  if(!empty($_POST['sunday'])){
    $_POST['sunday'] = test_input($_POST['sunday']);
  }
  if(!empty($_POST['monday'])){
    $_POST['monday'] = test_input($_POST['monday']);
  }
  if(!empty($_POST['tuesday'])){
    $_POST['tuesday'] = test_input($_POST['tuesday']);
  }
  if(!empty($_POST['wednesday'])){
    $_POST['wednesday'] = test_input($_POST['wednesday']);
  }
  if(!empty($_POST['thursday'])){
    $_POST['thursday'] = test_input($_POST['thursday']);
  }
  if(!empty($_POST['friday'])){
    $_POST['friday'] = test_input($_POST['friday']);
  }
  if(!empty($_POST['saturday'])){
    $_POST['saturday'] = test_input($_POST['saturday']);
  }

  if(!empty($_POST['camp_visible'])){
    $_POST['camp_visible'] = test_input($_POST['camp_visible']);
  }

  if(!empty($_POST['website_link'])){
    $_POST['website_link'] = test_input($_POST['website_link']);
  }









  


}






?>
</head>
<body> 






    <div class="form-container">
    <!-- name is for submitting forms, ID is for DOM elements for javascript-->
    <!-- process_camp_upload.php" -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST"> 
      <!-- <div style="display:inline-block; min-width:45%;"> -->
        <!-- <label for="unique_id">Unique ID:</label>
        <input type="text" id="unique_id" name="unique_id" required><br> -->
        <span style="color:red;">* required field</span>
        
        <label for="account_id">*Account ID:</label>
        <input type="text" id="account_id" name="account_id"><br>
        
        <label for="name">*Name:</label>
        <input type="text" id="name" name="name" required>
        <?php echo "<span style='color:red;'>$nameErr</span>" ?>
        <!-- <br> -->
        
        <label for="street_address">*Street Address:</label>
        <input type="text" id="street_address" name="street_address" required><br>
        
        <label for="city">*City:</label>
        <input type="text" id="city" name="city" required><br>
        
        <label for="state">*State:</label>
        <input type="text" id="state" name="state" required><br>
        
        <label for="zipcode">*Zipcode:</label>
        <input type="text" id="zipcode" name="zipcode" required><br>
        
        <label for="activity">*Activity:</label>
        <input type="text" id="activity" name="activity" required><br>
        
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" min="0"><br>
        
        <label for="ages_served">Ages Served:</label>
        <input type="text" id="ages_served" name="ages_served" ><br>
        
        <label for="start_time">Start Time:</label>
        <input type="text" id="start_time" name="start_time" ><br>
        
        <label for="end_time">End Time:</label>
        <input type="text" id="end_time" name="end_time" ><br>
<!-- </div>
        <div style="display:inline-block; min-width:45%; "> -->
        <!-- <label for="hours_duration">Hours Duration:</label>
        <input type="text" id="hours_duration" name="hours_duration" required><br> -->
        
        <label for="after_care">After Care:</label>
        <input type="text" id="after_care" name="after_care" ><br>
        
        <label for="after_care_time_end">After Care Time End:</label>
        <input type="text" id="after_care_time_end" name="after_care_time_end" ><br>
        
        <label for="price_after_care">Price After Care:</label>
        <input type="text" id="price_after_care" name="price_after_care" ><br>
        
        <label for="food_provided">Food Provided:</label>
        <input type="text" id="food_provided" name="food_provided" ><br>
        
        <label for="special_needs_accom">Special Needs Accommodation:</label>
        <input type="text" id="special_needs_accom" name="special_needs_accom" ><br>
        
        <label for="scholarship_opps">Scholarship Opportunities:</label>
        <input type="text" id="scholarship_opps" name="scholarship_opps" ><br>
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="5" ></textarea><br>

        

        <label for="camp_start_date">Start Date:</label>
        <input type="date" id="camp_start_date" name="camp_start_date"><br>
        
        <label for="camp_end_date">End Date:</label>
        <input type="date" id="camp_end_date" name="camp_end_date"><br>

        <div title="The date the camp is likely to fill up, or stop accepting new campers.">
        <label title="The date the camp is likely to fill up, or stop accepting new campers." for="camp_fill_date">Camp Fill Date:</label>
        <input type="date" id="camp_fill_date" name="camp_fill_date"><br>
        </div>

        <label>Days of Week Camp is Open:</label>
        <div style="padding: 2px; border: 1px solid black; display: inline-flex;">
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
        </div><br>

        <label for="camp_visible">If the camp is searchable:</label>
        <select id="camp_visible" name="camp_visible">
            <option value=0>Hidden</option>
            <option value=1>Shown</option>
        </select><br>

        <label for="website_link">Website:</label>
        <input type="text" id="website_link" name="website_link" ><br>




        
        <input type="submit" value="Submit" name="submit">
<!-- </div> -->
    </form>
    </div>
</body>
</html>
<?php
// if(isset($name)){
//   echo $name."<br>";
// }
// if(isset($price)){
// echo $price;
// }

// echo $_POST['ages_served'];

print_r($_POST)

?>