<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <style>
        .container {
            min-height: 333px;
        }

        .container p.para {
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


    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id = '$id'";
    $result = mysqli_query($conn, $sql);
    $noResult = true;

    while ($row = mysqli_fetch_assoc($result)) {
        $noResult = false;
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $commentby = $row['thread_user_id'];

        $sql2 = "Select user_email from `users` WHERE sno='$commentby'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $postedby = $row2['user_email'];
    }



    ?>

    <?php
    $method  = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $showAlert = false;
        $th_comment = $_POST['content'];
        $th_comment = str_replace("<", "&lt;", $th_comment);
        $th_comment = str_replace(">", "&gt;", $th_comment);
        $user_id = $_POST['sno'];
        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$th_comment ', '$id', '$user_id', current_timestamp())";

        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success! </strong> comment has been added! Please wait for response to others.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            ';
        }
    }
    ?>


    <div class="container my-4">
        <div class="bg-light p-5 rounded-lg m-3">
            <h1 class="display-4"><?php echo $title ?></h1>
            <p class="lead my-0"><?php echo $desc ?></p>
            <hr class="my-4">
            <p>No Spam / Advertising / Self-promote in the forums is not allowed. Do not post copyright-infringing
                material. Do not post “offensive” posts, links or images. Do not cross post questions. Do not PM users
                asking for help.Remain respectful of other members at all times....</p>
            <p>Posted by: <b><?php echo $postedby ?></b></p>
        </div>
    </div>

    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '
    <div class="container mb-5">
        <h1 class="py-2">Post a Comment</h1>
        <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
            <div class="mb-3">
                <label for="floatingTextarea2" class="form-label">Type your Comment</label>
                <textarea class="form-control" id="content" name="content" style="height: 100px"></textarea>
                <input type="hidden" name="sno" value="' . $_SESSION["sno"] . '">
            </div>
            <button type="submit" class="btn btn-success">Post Comment</button>
        </form>
    </div>';
    } else {
        echo '
            <div class="container">
                <p class="para"><b><em>You are not loggedin!!Please login to be able to Post a Comment.</em></b></p>
            </div>
        ';
    }
    ?>

    <div class="container mb-5">
        <h1 class="py-2">Discussion</h1>
        <hr>

        <?php

        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id = '$id'";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {

            $noResult = true;
            $id = $row['thread_id'];
            $comment = $row['comment_content'];
            // $comment_time = $row['comment_time'];
            $time = date('D, d/m/Y');
            $comment_user_id = $row['comment_by'];
            $sql2 = "Select user_email from `users` WHERE sno='$comment_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $rows2 = mysqli_fetch_assoc($result2);

            echo '<div class="d-flex my-4">
            <img src="img/defaultuser.png" class="mr-3" alt="..." height="55px">
            <div>
            <p class="fw-bold my-0">' . $rows2['user_email'] . ' at - ' . $time . '</p>
                ' . $comment . '
            </div>
            </div>';
        }

        if(!$noResult){
        echo '<div class="bg-light p-5 rounded-lg m-0">
            <div class="container">
                <p class="display-4">No Comments Found</p>
                <p class="lead">Be the first person to responce the question.</p>
            </div>
        </div>';
        }
        ?>



    </div>

    <?php include 'partials/_footer.php'; ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>
    -->
</body>

</html>