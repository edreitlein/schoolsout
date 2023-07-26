<?php

//use include "./header.php";

?>
<html>
    <header>
        <style>

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


    <nav class = "navbar">
      
        <a href="campUpload.php" class="active">Upload</a>
        <a href="login.html" class="active">Login</a>
        <a href="search.php" class="active" >Search</a>
      
    </nav>



</header>

</html>