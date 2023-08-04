<?php 
include "./databaseInit.php";

// session_start(); //for later once login is added
// if($_SESSION['loggedIn']!=true){ //do not allow a user to upload a listing if they are logged in, redirects to login page
//     header('Location: ./login.php');

// }


if($_POST["submit"]==true){         //when submit button is pressed
    //submits listing info to database

    // echo $_POST["camp_visible"];
    // echo "<br>";
    // echo $_POST["camp_start_date"];
    // echo "<br>";
    // echo $_POST["camp_end_date"];
    // echo "<br>";
    // echo $_POST["camp_fill_date"];
    // echo "<br>";

    // echo $_POST["sunday"];
    // echo $_POST["monday"];
    // echo $_POST["tuesday"];
    // echo $_POST["wednesday"];
    // echo $_POST["thursday"];
    // echo $_POST["friday"];
    // echo $_POST["saturday"];



    // //
        // $daySearch = FALSE;
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
        


        // if($daySearch){

        //   foreach($camp_days_of_week as $day){
        //     $sql[] = " camp_days_of_week LIKE ?";

        //     $parameters[] = "%".$day."%";
            
        //   }
        // }




    //




    
    //                                     int(!!)     text   text         text text  text    text     0.0   text          time        time    bool        time                0.0                 bool        bool                bool            text         date                date    date                str             bool      text
    $insertQuery = "INSERT INTO camp_info (account_id,name, street_address,city,state,zipcode,activity,price,ages_served, start_time,end_time,after_care,after_care_time_end,price_after_care,food_provided,special_needs_accom,scholarship_opps,description,camp_start_date,camp_end_date,camp_fill_date,camp_days_of_week,camp_visible,website_link) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";//may have to work with current_timestamp
    $stmd = $mysqli->prepare($insertQuery);
    $stmd->bind_param("issssssdsssisdiiisssssis",$_POST["account_id"],$_POST["name"],$_POST['street_address'],$_POST['city'],$_POST['state'],$_POST['zipcode'],$_POST['activity'], $_POST['price'], $_POST['ages_served'], $_POST['start_time'], $_POST['end_time'], $_POST['after_care'], $_POST['after_care_end_time'], $_POST['price_after_care'], $_POST['food_provided'], $_POST['special_needs_accom'], $_POST['scholarship_opps'], $_POST['description'],$_POST['camp_start_date'],$_POST['camp_end_date'],$_POST['camp_fill_date'],$camp_days_of_week,$_POST['camp_visible'],$_POST['website_link']);
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