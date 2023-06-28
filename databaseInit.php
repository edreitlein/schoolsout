<?php
//initializes database, this should be included in all files needing database access
//and this file should be changed when database needs to be updated


//for databases, comment out development or deployment for what youre working on
//it might be worthwhile to untrack this as long as you do not move heroku hosts, and then uncomment development for ease-of-access

//database for development

$db_host = '127.0.0.1';
$db_user= 'root';
$db_password='';
$db_db = 'schools_out';
$db_port = '3306';



//database for deployment
// $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
// $db_host = $cleardb_url["host"];
// $db_user= $cleardb_url["user"];
// $db_password=$cleardb_url["pass"];
// $db_db = substr($cleardb_url["path"],1);


$mysqli = new mysqli( 
    $db_host,
    $db_user,
    $db_password,
    $db_db
);

// echo 'db test successful';


if($mysqli ->connect_error){//access database and load into $mysqli
    echo "errno: ".$mysqli->connect_errno;
    echo '<br>';
    echo 'Error: '.$mysqli->connect_error;
    exit();
}


?>