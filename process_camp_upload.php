<?php 
include "./databaseInit.php";

// session_start(); //for later once login is added
// if($_SESSION['loggedIn']!=true){ //do not allow a user to upload a listing if they are logged in, redirects to login page
//     header('Location: ./login.php');

// }


if($_POST["submit"]==true){         //when submit button is pressed
    //submits listing info to database
    
    //                                     int(!!)     text   text         text text  text    text     0.0   text          time        time    bool        time                0.0                 bool        bool                bool            text
    $insertQuery = "INSERT INTO camp_info (account_id,name, street_address,city,state,zipcode,activity,price,ages_served, start_time,end_time,after_care,after_care_time_end,price_after_care,food_provided,special_needs_accom,scholarship_opps,description) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";//may have to work with current_timestamp
    $stmd = $mysqli->prepare($insertQuery);
    $stmd->bind_param("issssssdsssisdiiis",$_POST["account_id"],$_POST["name"],$_POST['street_address'],$_POST['city'],$_POST['state'],$_POST['zipcode'],$_POST['activity'], $_POST['price'], $_POST['ages_served'], $_POST['start_time'], $_POST['end_time'], $_POST['after_care'], $_POST['after_care_end_time'], $_POST['price_after_care'], $_POST['food_provided'], $_POST['special_needs_accom'], $_POST['scholarship_opps'], $_POST['description']);
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
    //prepaired query, stores the listing ID in $_SESSION once it is uploaded
    // $getListingID="SELECT * FROM listings WHERE user_id=? AND addressStreet=? AND addressCity=? AND addressState=? AND addressZipcode=? AND saleType=? AND description=? AND nameListing=? AND price=?";
    // $stmd=$mysqli->prepare($getListingID);
    // $stmd->bind_param('isssssssi',$_SESSION['user_id'],$_POST["addressStreet"],$_POST['addressCity'],$_POST['addressState'],$_POST['addressZipcode'],$_POST['saleType'],$_POST['description'], $_POST['nameListing'], $_POST['price']);
    // $stmd->execute();
    // $result=$stmd->get_result();
    
    // while($row = $result->fetch_assoc()) {
    //     echo('ListingID: '.$row["listingID"]);
    //     $listingID=$row["listingID"];
        
        
    // }


    
    
    

}else{
    echo "an error has occured";
}

?>