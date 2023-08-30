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

$nameErr=$priceErr=$streetErr=$cityErr=$stateErr=$zipcodeErr=$webErr=$descripErr="";

$nameVal=$streetVal=$cityVal=$stateVal=$zipcodeVal=$actVal=$priceVal=$ageVal=$stimeVal=$etimeVal=$afterCareVal=$priceAfterVal=$descVal=$startDateVal=$endDateVal=$campFillVal=$campDaysWeekVal="";


// post submit db checking and uploading

function test_input($data){ //removes possibility of xss attacks server-side

  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);

  return $data;
}

// echo test_input($_POST['name']);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $hasError = 0;

  // echo "page from POST";

  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  }else{
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[A-Za-z0-9\s\-]*$/",$name)) {
      $hasError = 1;
      $nameErr = "Only Letters, Numbers, Dashes and white space allowed";
      
    }
  }

  if(!empty($_POST['street_address'])){
    $_POST['street_address'] = test_input($_POST['street_address']);
    if (!preg_match("/^[A-Za-z0-9\s]*$/",$_POST['street_address'])) {
      $hasError = 1;
      $streetErr = "Only Letters, Numbers, and white space allowed";
    }


  }else{
    $hasError = 1;
    $streetErr="Street Address is required";
  }

  if(!empty($_POST['city'])){
    $_POST['city'] = test_input($_POST['city']);
    if (!preg_match("/^[A-Za-z0-9\s]*$/",$_POST['city'])) {
      $hasError = 1;
      $cityErr = "Only Letters, Numbers, and white space allowed";
    }

  }else{
    $hasError=1;
    $cityErr ="City is required";
  }

  if(!empty($_POST['state'])){
    $_POST['state'] = test_input($_POST['state']);
    if (!preg_match("/^[A-Z]{2}$/",$_POST['state'])) {
      $hasError = 1;
      $stateErr = "Only 2 Letter State Abbreviations allowed";
    }

  }else{
    $hasError=1;
    $stateErr="State is required";
  }

  if(!empty($_POST['zipcode'])){
    $_POST['zipcode'] = test_input($_POST['zipcode']);
    if (!preg_match("/^[0-9]{5}$/",$_POST['zipcode'])) {
      $hasError = 1;
      $zipcodeErr = "Only exactly 5 numbers allowed";
    }

  }else{
    $hasError=1;
    $zipcodeErr="Zipcode is required";
  }
  if(!empty($_POST['activity'])){
    $_POST['activity'] = test_input($_POST['activity']);

  }



  if (!empty($_POST['price'])){
    // echo "something";
    $price = test_input($_POST['price']);
    if (!preg_match('/^[0-9.]+$/',$price)) {
      $hasError = 1;
      echo "an issue with price upload has occured!";
      $priceErr = "";//there should not be a way, using the current UI, that a person can upload anything but numbers and . so no err message needed
    }

  }else{
    $price=null; #unwritten price is blank in db instead of showing 0.00
  }

  if(!empty($_POST['ages_served'])){
    $_POST['ages_served']=test_input($_POST['ages_served']);

  }else{
    $_POST['ages_served'] = "";
  }

// there should be no way for a user to upload a time incorrectly while using the UI, if an upload issue occured it was likely caused by an attack/bad actor
// 
//   
  if(!empty($_POST['start_time'])){
    $_POST['start_time'] = test_input($_POST['start_time']);
    $_POST['start_time'].=":00";//adds digits for correct regex and upload
    if (!preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d:[0-5]\d$/',$_POST['start_time'])) {
      $hasError = 1;
      // echo($_POST['start_time']);
      // echo "\n";
      echo "An issue with start time upload has occured!";
      // $priceErr = "";//there should not be a way, using the current UI, that a person can upload anything but numbers and . so no err message needed
    }

  }else{
    $_POST['start_time'] = '';
  }

  if(!empty($_POST['end_time'])){
    $_POST['end_time'] = test_input($_POST['end_time']);
    $_POST['end_time'].=":00";//adds digits for correct regex and upload
    if (!preg_match('/^\d{2}:\d{2}:\d{2}$/',$_POST['end_time'])) {
      $hasError = 1;
      echo "An issue with end time upload has occured!";
      // $priceErr = "";//there should not be a way, using the current UI, that a person can upload anything but numbers and . so no err message needed
    }

  }else{
    $_POST['end_time'] = '';
  }

  if(!empty($_POST['after_care'])){
    $_POST['after_care'] = test_input($_POST['after_care']);
    if($_POST['after_care']!='1' && $_POST['after_care']!='0'){//this is confusing to read
      $hasError = 1;
      echo "after_care was not 1 or 0!";
    }
  }

  if(!empty($_POST['after_care_time_end'])){
    $_POST['after_care_time_end'] = test_input($_POST['after_care_time_end']);
    $_POST['after_care_time_end'].=":00";//adds digits for correct regex and upload
    if (!preg_match('/^\d{2}:\d{2}:\d{2}$/',$_POST['after_care_time_end'])) {
      $hasError = 1;
      echo "An issue with after care time upload has occured!";
      // $priceErr = "";//there should not be a way, using the current UI, that a person can upload anything but numbers and . so no err message needed
    }
  }

  if(!empty($_POST['price_after_care'])){
    $_POST['price_after_care'] = test_input($_POST['price_after_care']);
    if (!preg_match('/^[0-9.]+$/',$_POST['price_after_care'])) {
      $hasError = 1;
      echo "an issue with after care price upload has occured!";
      // $priceErr = "";//there should not be a way, using the current UI, that a person can upload anything but numbers and . so no err message needed
    }
  }else{
    $_POST['price_after_care']=null;
  }
  if(!empty($_POST['food_provided'])){
    $_POST['food_provided'] = test_input($_POST['food_provided']);
    if($_POST['food_provided']!='1' && $_POST['food_provided']!='0'){
      $hasError = 1;
      echo "food_provided was not 1 or 0!";
    }
  }

  if(!empty($_POST['special_needs_accom'])){
    $_POST['special_needs_accom'] = test_input($_POST['special_needs_accom']);
    if($_POST['special_needs_accom']!='1' && $_POST['special_needs_accom']!='0'){
      $hasError = 1;
      echo "special_needs_accom was not 1 or 0!";
    }

  }
  if(!empty($_POST['scholarship_opps'])){
    $_POST['scholarship_opps'] = test_input($_POST['scholarship_opps']);
    if($_POST['scholarship_opps']!=1 && $_POST['scholarship_opps']!=0){
    
      $hasError = 1;
      echo "scholarship_opps was not 1 or 0!";
    }
  }
  if(!empty($_POST['description'])){
    $_POST['description'] = test_input($_POST['description']);
    if (!preg_match('/^[A-Za-z0-9.,\-\s\n{}()#@\$?]+$/', $_POST['description'])) {
      $hasError = 1;
      $descripErr = "Description may only contain Letters, Numbers, Spaces, New Lines, .-{}()@?#";
    }
      
  }

  if(!empty($_POST['camp_start_date'])){
    $_POST['camp_start_date'] = test_input($_POST['camp_start_date']);
    // echo($_POST['camp_start_date']);
    if (!preg_match('/^(?:(?:19|20)\d\d)-(?:0[1-9]|1[0-2])-(?:0[1-9]|[12]\d|3[01])$/',$_POST['camp_start_date'])) {
      $hasError = 1;
      echo "an issue with camp_start_date upload has occured!";
    }
    
  }

  if(!empty($_POST['camp_end_date'])){
    $_POST['camp_end_date'] = test_input($_POST['camp_end_date']);
    if (!preg_match('/^(?:(?:19|20)\d\d)-(?:0[1-9]|1[0-2])-(?:0[1-9]|[12]\d|3[01])$/',$_POST['camp_end_date'])) {
      $hasError = 1;
      echo "an issue with camp_end_date upload has occured!";
    }
  }

  if(!empty($_POST['camp_fill_date'])){
    $_POST['camp_fill_date'] = test_input($_POST['camp_fill_date']);
    if (!preg_match('/^(?:(?:19|20)\d\d)-(?:0[1-9]|1[0-2])-(?:0[1-9]|[12]\d|3[01])$/',$_POST['camp_fill_date'])) {
      $hasError = 1;
      echo "an issue with camp_fill_date upload has occured!";
    }
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
    if($_POST['camp_visible']!="1" && $_POST['camp_visible']!="0"){
      $hasError = 1;
      echo "camp_visible was not 1 or 0!";
      echo $_POST['camp_visible'];
      echo gettype($_POST['camp_visible']);
    }
  }

  if(!empty($_POST['website_link'])){
    $_POST['website_link'] = test_input($_POST['website_link']);
    // echo $_POST['website_link'];
    // website link validation
    if (!(filter_var($_POST['website_link'], FILTER_VALIDATE_URL))) {
      $hasError = 1;
      $webErr = "Website link was detected as invalid!";
      // echo "Website link invalid";
  } 
  }


  if(!empty($_POST['overnight'])){
    $_POST['overnight'] = test_input($_POST['overnight']);
    if($_POST['overnight']!="1" && $_POST['overnight']!="0"){
      $hasError = 1;
      echo "overnight option was not 1 or 0!";
      echo $_POST['overnight'];
      echo gettype($_POST['overnight']);
    }
  }

  if(!empty($_POST['parent_list'])){
    $_POST['parent_list'] = test_input($_POST['parent_list']);
    if($_POST['parent_list']!="1" && $_POST['parent_list']!="0"){
      $hasError = 1;
      echo "parent_list option was not 1 or 0!";
      echo $_POST['parent_list'];
      echo gettype($_POST['parent_list']);
    }
  }



// post data-validation to prevent xss and sql injection, now sending to db

        $camp_days_of_week='';
        if(isset($_POST["sunday"])){
        //   $daySearch=TRUE;
          $camp_days_of_week.= "S";

          // echo "sunday checked";
        }
        if(isset($_POST["monday"])){
        //   $daySearch=TRUE;
          $camp_days_of_week.= "M";
        }
        if(isset($_POST["tuesday"])){
        //   $daySearch=TRUE;
          $camp_days_of_week.= "T";

        }
        if(isset($_POST["wednesday"])){
        //   $daySearch=TRUE;
          $camp_days_of_week.= "W";
        }
        if(isset($_POST["thursday"])){
        //   $daySearch=TRUE;
          $camp_days_of_week.="R";
        }
        if(isset($_POST["friday"])){
        //   $daySearch=TRUE;
          $camp_days_of_week.="F";
        }
        if(isset($_POST["saturday"])){
        //   $daySearch=TRUE;
          $camp_days_of_week.="U";
        }


        if($hasError == 0){//change to $hasError == 0  for prod.
        $insertQuery = "INSERT INTO camp_info (account_id,name, street_address,city,state,zipcode,activity,price,ages_served, start_time,end_time,after_care,after_care_time_end,price_after_care,food_provided,special_needs_accom,scholarship_opps,description,camp_start_date,camp_end_date,camp_fill_date,camp_days_of_week,camp_visible,website_link,overnight,parent_list) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";//may have to work with current_timestamp
        $stmd = $mysqli->prepare($insertQuery);
        $stmd->bind_param("issssssdsssisdiiisssssisii",$_POST["account_id"],$name,$_POST['street_address'],$_POST['city'],$_POST['state'],$_POST['zipcode'],$_POST['activity'], $price, $_POST['ages_served'], $_POST['start_time'], $_POST['end_time'], $_POST['after_care'], $_POST['after_care_end_time'], $_POST['price_after_care'], $_POST['food_provided'], $_POST['special_needs_accom'], $_POST['scholarship_opps'], $_POST['description'],$_POST['camp_start_date'],$_POST['camp_end_date'],$_POST['camp_fill_date'],$camp_days_of_week,$_POST['camp_visible'],$_POST['website_link'],$_POST['overnight'],$_POST['parent_list']);
        if($stmd->execute()){ 
            echo '<script>alert("listing uploaded!")
            const waitFunction = async () => {
                await delay(3000);
                console.log("Waited 3s");
              
                
              };
            window.location.replace("./campUpload.php");
            </script>';

        }else{
            echo "<br>Failed<br>Contact local admin<br>";
            echo($stmd->error);
        }
      }else{
        echo '<script>alert("Please comply with upload standards!")
            const waitFunction = async () => {
                await delay(3000);
                
              
                
              };
            
            </script>';
            #sets values for all previously entered info

            $nameVal = $name;
            $streetVal = $_POST['street_address'];
            $cityVal = $_POST['city'];
            $stateVal = $_POST['state'];
            $zipcodeVal = $_POST['zipcode'];
            $actVal=$_POST['activity'];
            $priceVal=$_POST['price'];
            $ageVal = $_POST['ages_served'];
            $stimeVal = $_POST['start_time'];
            $etimeVal=$_POST['end_time'];
            $afterCareVal=$_POST['after_care_time_end'];
            $priceAfterVal=$_POST['price_after_care'];
            $descVal=$_POST['description'];
            $startDateVal = $_POST['camp_start_date'];
            $endDateVal = $_POST['camp_end_date'];
            $campFillVal = $_POST['camp_fill_date'];
            $campDaysWeekVal=$camp_days_of_week;






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
        <?php echo "<span style='color:red;'>$nameErr</span>" ?>
        <input type="text" id="name" name="name" value="<?php echo $nameVal;?>" required>
        
        <!-- <br> -->
        
        <label for="street_address">*Street Address:</label>
        <?php echo "<span style='color:red;'>$streetErr</span>" ?>
        <input type="text" id="street_address" name="street_address" value="<?php echo $streetVal;?>"required><br>
        
        <label for="city">*City:</label>
        <?php echo "<span style='color:red;'>$cityErr</span>" ?>
        <input type="text" id="city" name="city" value="<?php echo $cityVal;?>"required><br>
        
        <?php
function stateSelect(string $stateName){#sets state to previously selected after upload err
  if( !empty($_POST['state']) and $stateName == $_POST['state']){
    echo " selected ";
    return;
  }
  return;

}
        ?>


        <label for="state">*State:</label>
        <?php echo "<span style='color:red;'>$stateErr</span>" ?>
        <select id="state" name="state">
          <option value="AL" <?php stateSelect("AL");?>>Alabama</option>
          <option value="AK" <?php stateSelect("AK");?>>Alaska</option>
          <option value="AZ" <?php stateSelect("AZ");?>>Arizona</option>
          <option value="AR" <?php stateSelect("AR");?>>Arkansas</option>
          <option value="CA" <?php stateSelect("CA");?>>California</option>
          <option value="CO" <?php stateSelect("CO");?>>Colorado</option>
          <option value="CT" <?php stateSelect("CT");?>>Connecticut</option>
          <option value="DE" <?php stateSelect("DE");?>>Delaware</option>
          <option value="DC" <?php stateSelect("DC");?>>District Of Columbia</option>
          <option value="FL" <?php stateSelect("FL");?>>Florida</option>
          <option value="GA" <?php stateSelect("GA");?>>Georgia</option>
          <option value="HI" <?php stateSelect("HI");?>>Hawaii</option>
          <option value="ID" <?php stateSelect("ID");?>>Idaho</option>
          <option value="IL" <?php stateSelect("IL");?>>Illinois</option>
          <option value="IN" <?php stateSelect("IN");?>>Indiana</option>
          <option value="IA" <?php stateSelect("IA");?>>Iowa</option>
          <option value="KS" <?php stateSelect("KS");?>>Kansas</option>
          <option value="KY" <?php stateSelect("KY");?>>Kentucky</option>
          <option value="LA" <?php stateSelect("LA");?>>Louisiana</option>
          <option value="ME" <?php stateSelect("ME");?>>Maine</option>
          <option value="MD" <?php stateSelect("MD");?>>Maryland</option>
          <option value="MA" <?php stateSelect("MA");?>>Massachusetts</option>
          <option value="MI" <?php stateSelect("MI");?>>Michigan</option>
          <option value="MN" <?php stateSelect("MN");?>>Minnesota</option>
          <option value="MS" <?php stateSelect("MS");?>>Mississippi</option>
          <option value="MO" <?php stateSelect("MO");?>>Missouri</option>
          <option value="MT" <?php stateSelect("MT");?>>Montana</option>
          <option value="NE" <?php stateSelect("NE");?>>Nebraska</option>
          <option value="NV" <?php stateSelect("NV");?>>Nevada</option>
          <option value="NH" <?php stateSelect("NH");?>>New Hampshire</option>
          <option value="NJ" <?php stateSelect("NJ");?>>New Jersey</option>
          <option value="NM" <?php stateSelect("NM");?>>New Mexico</option>
          <option value="NY" <?php stateSelect("NY");?>>New York</option>
          <option value="NC" <?php stateSelect("NC");?>>North Carolina</option>
          <option value="ND" <?php stateSelect("ND");?>>North Dakota</option>
          <option value="OH" <?php stateSelect("OH");?>>Ohio</option>
          <option value="OK" <?php stateSelect("OK");?>>Oklahoma</option>
          <option value="OR" <?php stateSelect("OR");?>>Oregon</option>
          <option value="PA" <?php stateSelect("PA");?>>Pennsylvania</option>
          <option value="RI" <?php stateSelect("RI");?>>Rhode Island</option>
          <option value="SC" <?php stateSelect("SC");?>>South Carolina</option>
          <option value="SD" <?php stateSelect("SD");?>>South Dakota</option>
          <option value="TN" <?php stateSelect("TN");?>>Tennessee</option>
          <option value="TX" <?php stateSelect("TX");?>>Texas</option>
          <option value="UT" <?php stateSelect("UT");?>>Utah</option>
          <option value="VT" <?php stateSelect("VT");?>>Vermont</option>
          <option value="VA" <?php stateSelect("VA");?>>Virginia</option>
          <option value="WA" <?php stateSelect("WA");?>>Washington</option>
          <option value="WV" <?php stateSelect("WV");?>>West Virginia</option>
          <option value="WI" <?php stateSelect("WI");?>>Wisconsin</option>
          <option value="WY" <?php stateSelect("WY");?>>Wyoming</option>
        </select>
        
        <label for="zipcode">*Zipcode:</label>
        <?php echo "<span style='color:red;'>$zipcodeErr</span>" ?>
        <input type="text" id="zipcode" name="zipcode" value="<?php echo $zipcodeVal;?>"required><br>
        
        <label for="activity">*Activity:</label>
        <input type="text" id="activity" name="activity" value="<?php echo $actVal;?>" required><br>
        
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" min="0" value="<?php echo $priceVal;?>"><br>
        
        <label for="ages_served">Ages Served:</label>
        <input type="text" id="ages_served" name="ages_served" value="<?php echo $ageVal;?>"><br>
        
        <label for="start_time">Start Time:</label>
        <input type="time" id="start_time" name="start_time" value="<?php echo substr($stimeVal,0,-3);?>" ><br>
        
        <label for="end_time">End Time:</label>
        <input type="time" id="end_time" name="end_time" value="<?php echo substr($etimeVal,0,-3);?>"><br>
<!-- </div>
        <div style="display:inline-block; min-width:45%; "> -->
        <!-- <label for="hours_duration">Hours Duration:</label>
        <input type="text" id="hours_duration" name="hours_duration" required><br> -->
        
        <label for="after_care">After Care:</label>
        <select id="after_care" name="after_care">
          
          <option value="0" selected >No</option>
          <option value="1" <?php if (isset($_POST['after_care']) and $_POST['after_care'] == '1') echo 'selected'; ?>>Yes</option>
        </select>
        <!-- <input type="text" id="after_care" name="after_care" ><br> -->
        
        <label for="after_care_time_end">After Care Time End:</label>
        <input type="time" id="after_care_time_end" name="after_care_time_end" value="<?php echo $afterCareVal;?>"><br>
        
        <label for="price_after_care">Price After Care:</label>
        <input type="number" id="price_after_care" name="price_after_care" step="0.01" min="0" value="<?php echo $priceAfterVal;?>"><br>
        
        <label for="food_provided">Food Provided:</label>
        <select id="food_provided" name="food_provided">
          
          <option value="0"selected >No</option>
          <option value="1" <?php if (isset($_POST['food_provided']) and $_POST['food_provided'] == '1') echo 'selected'; ?>>Yes</option>
        </select>
        <!-- <input type="text" id="food_provided" name="food_provided" ><br> -->
        
        <label for="special_needs_accom">Special Needs Accommodation:</label>
        <select id="special_needs_accom" name="special_needs_accom">
          <option value="0" selected >No</option>
          <option value="1" <?php if (isset($_POST['special_needs_accom']) and $_POST['special_needs_accom'] == '1') echo 'selected'; ?>>Yes</option>

        </select>
        <!-- <input type="text" id="special_needs_accom" name="special_needs_accom" ><br> -->
        
        <label for="scholarship_opps">Scholarship Opportunities:</label>
        <select id="scholarship_opps" name="scholarship_opps">
          <option value="0" selected >No</option>
          <option value="1" <?php if (isset($_POST['scholarship_opps']) and $_POST['scholarship_opps'] == '1') echo 'selected'; ?>>Yes</option>
        </select>
        <!-- <input type="text" id="scholarship_opps" name="scholarship_opps" ><br> -->
        
        <label for="parent_list"title="If the listing is for several camps on
        a different website">Parent Listing:</label>
        <select id="parent_list" name="parent_list">
          <option value="0" selected >No</option>
          <option value="1" <?php if (isset($_POST['parent_list']) and $_POST['parent_list'] == '1') echo 'selected'; ?>>Yes</option>

        </select>


        <label for="description">Description:</label>
        <?php if($descripErr != '') echo "<span style='color:red;'>$descripErr</span>" ?>
        <textarea id="description" name="description" rows="5" ><?php echo $descVal;?></textarea><br>

        

        <label for="camp_start_date">Start Date:</label>
        <input type="date" id="camp_start_date" name="camp_start_date" value="<?php echo $startDateVal;?>"><br>
        
        <label for="camp_end_date">End Date:</label>
        <input type="date" id="camp_end_date" name="camp_end_date" value="<?php echo $endDateVal;?>"><br>

        <div title="The date the camp is likely to fill up, or stop accepting new campers.">
        <label title="The date the camp is likely to fill up, or stop accepting new campers." for="camp_fill_date">Camp Fill Date:</label>
        <input type="date" id="camp_fill_date" name="camp_fill_date" value="<?php echo $campFillVal;?>"><br>
        </div>
        <?php
        function setDaysChecked(string $campDays, $letter){
          if(str_contains($campDays,$letter)){
            echo " checked ";
            return;
          }
          return;
        }


?>

        <label>Days of Week Camp is Open:</label>
        <div style="padding: 2px; border: 1px solid black; display: inline-flex;">
        <label for="sunday">Sunday</label>
        <input <?php setDaysChecked($campDaysWeekVal,"S");?> type="checkbox" id="sunday" name="sunday" value="Sunday">
        
        <label for="monday">Monday</label>
        <input <?php setDaysChecked($campDaysWeekVal,"M");?> type="checkbox" id="monday" name="monday" value="Monday">
        
        <label for="tuesday">Tuesday</label>
        <input <?php setDaysChecked($campDaysWeekVal,"T");?> type="checkbox" id="tuesday" name="tuesday" value="Tuesday">
        
        <label for="wednesday">Wednesday</label>
        <input <?php setDaysChecked($campDaysWeekVal,"W");?> type="checkbox" id="wednesday" name="wednesday" value="Wednesday">
        
        <label for="thursday">Thursday</label>
        <input <?php setDaysChecked($campDaysWeekVal,"R");?> type="checkbox" id="thursday" name="thursday" value="Thursday">
        
        <label for="friday">Friday</label>
        <input <?php setDaysChecked($campDaysWeekVal,"F");?> type="checkbox" id="friday" name="friday" value="Friday">
        
        <label for="saturday">Saturday</label>
        <input <?php setDaysChecked($campDaysWeekVal,"U");?> type="checkbox" id="saturday" name="saturday" value="Saturday">
        </div><br>

        <label for="camp_visible">If the camp is searchable:</label>
        <select id="camp_visible" name="camp_visible">
            <option value="1" selected>Shown</option>
            <option <?php if(isset($_POST['camp_visible']) and $_POST['camp_visible'] == 0) echo " selected ";  ?> value="0">Hidden</option>
        </select><br>

        <label for="website_link">Website:</label>
        <?php if($webErr != '') echo "<span style='color:red;'>$webErr</span><br>" ?>
        <input <?php if (!empty($_POST['website_link'])) echo " value = ".$_POST['website_link']." "; ?>type="website" id="website_link" name="website_link" ><br>


        <label for="overnight">Camp has Overnight options:</label>
        <select id="overnight" name="overnight">
            <option value="0" selected>No Overnight</option>
            <option value="1" <?php if(isset($_POST['overnight']) and $_POST['overnight']=="1") echo " selected "; ?>>Yes Overnight</option>
        </select><br>




        
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

// print_r($_POST)

?>