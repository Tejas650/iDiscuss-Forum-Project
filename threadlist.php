<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <style>
    .container {
        min-height: 333px;
    }

    .container h1 {
        width: 666px;
    }

    a {
        text-decoration: none;
    }

    a.text-dark:hover {
        text-decoration: underline;
    }
    .container p.para{
        display: flex;
        justify-content: center;
    }
    </style>

    <title>iDiscuss Threads</title>

</head>

<body>

    <?php include 'partials/_db.php'; ?>


    <?php include 'partials/_header.php'; ?>


    <?php

        $id = $_GET['catid'];
        $sql = "SELECT * FROM `categories` WHERE category_id = '$id'";
        $result = mysqli_query($conn, $sql);
    
        while ($row = mysqli_fetch_assoc($result)){
            $catname = $row['category_name'];
            $catdesc = $row['category_description'];
        }

    ?>

    <?php
    $method  = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        $showAlert = false;
        $th_title = $_POST['title'];
        $user_id = $_POST['sno'];
        $th_desc = $_POST['desc'];

        $th_title = str_replace("<", "&lt;", $th_title);
        $th_title = str_replace(">", "&gt;", $th_title);

        $th_desc = str_replace("<", "&lt;", $th_desc);
        $th_desc = str_replace(">", "&gt;", $th_desc);

        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$user_id', current_timestamp())";

        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success! </strong> Threads has been inserted successful! Please wait for community to respond.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            ';
        }
    }
    ?>

    <div class="container my-4">

        <div class="bg-light p-5 rounded-lg m-3">
            <h1 class="display-4">Welcome <?php echo $catname ?> Forum</h1>
            <p class="lead"><?php echo $catdesc ?></p>
            <hr class="my-4">
            <p>No Spam / Advertising / Self-promote in the forums is not allowed. Do not post copyright-infringing
                material. Do not post “offensive” posts, links or images. Do not cross post questions. Do not PM users
                asking for help.Remain respectful of other members at all times....</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Show more </a>
        </div>
    </div>

    <?php

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

        echo '<div class="container">
            <h1 class="py-2">Start a Discussion</h1>
            <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text">Keep your title short and crisp as possible.</small>
            </div>
            <div class="mb-3">
                <label for="floatingTextarea2" class="form-label">Elaborate Your Concern</label>
                <textarea class="form-control" id="desc" name="desc" style="height: 100px"></textarea>
                <input type="hidden" name="sno" value="'.$_SESSION["sno"]. '"  >
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
            </form>
            </div>';
            
    }
    else{
        echo ' 
            <div class="container">
            <p class="para"><b><em>You are not loggedin!!Please login to be able to start a Discussion.</em></b></p>
        </div>
        ';
    }

    ?>

    <div class="container mb-5">
        <h1 class="py-4 "> Browse Questions</h1>
        <hr>

        <?php

        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id = '$id'";
        $result = mysqli_query($conn, $sql);
        $noResult = true;

        while ($row = mysqli_fetch_assoc($result)){
            
            $noResult = false;
            $catid = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $time = date('D, d/m/Y');
            $thread_user = $row['thread_user_id'];
            $sql2 = "SELECT user_email from `users` WHERE sno='$thread_user'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            echo '<div class="d-flex my-4">
                <img src="img/defaultuser.png" class="mr-3" alt="..." height="55px">
                <div>
                    <h6 class="fw-bold my-1">'. $row2['user_email'] . ' at - '. $time .'</h6>
                    <h6 class="fw-bold"> <a class= "text-dark" href ="threads.php?threadid=' . $catid . '" > '.$title.' </a> </h6>
                        '.$desc.'
                </div>
            </div>';

        }
        
        // echo var_dump($noResult);

        if($noResult){
        
            echo '<div class="bg-light p-5 rounded-lg m-0">
                    <div class="container">
                        <p class="display-4">No Results Found</p>
                        <p class="lead">Be the first person to ask the question.</p>
                    </div>
                 </div>';
       
        }

        ?>
    </div>
    <?php include 'partials/_footer.php'; ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>
    -->
</body>

</html>