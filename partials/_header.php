<?php

    session_start();

    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/iDiscuss Forum Project">iDiscuss</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/iDiscuss Forum Project">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Top Categories
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
            $sql2 ="SELECT category_name, category_id FROM `categories`";
            $result = mysqli_query($conn, $sql2);

          while ($row = mysqli_fetch_assoc($result)) {

              $row2 = $row['category_name'];
  
              echo '<li><a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].'">'.$row2.'</a></li>';

          }

          echo '</ul>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="contact.php" >Contact Us</a>
          </li>
        </ul>
        <div class="nav">';


      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
  
        echo '<form class="d-flex" method="GET" action="search.php">
          <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
          <p class="text-light my-2 mx-2"> Welcome&nbsp;<b>'. $_SESSION['username'] .'</b></p>
          <a href = "partials\_logoutModal.php" class="btn btn-outline-success" type="submit">Logout</a>
        </form>';

        }

        else{
          echo '<form class="d-flex">
          <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
          <button class="btn btn-outline-success mx-2 " data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
          <button class="btn btn-outline-success ml-2 " data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</button>';
        }
        
    echo '</div>
    </div>
    </nav>';
  
  
  include 'partials/_loginModal.php';
  include 'partials/_signupModal.php';
  if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true"){
    echo ' <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                <strong>Success! </strong> account has been created successful!!.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            ';
  }
  elseif(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false"){
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
              <strong>Error! </strong> Account has already exists or Password do not matched!!.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          ';
    }

    else{}

?>