<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

    <title>Search Content</title>
    <style>
    #maincontainer {
        min-height: 100vh;
    }

    a {
        text-decoration: none;
        color: black;
    }

    a:hover {
        text-decoration: underline;
        color: black;
    }
    </style>
</head>

<body>

    <?php include 'partials/_db.php'; ?>

    <?php include 'partials/_header.php'; ?>


    <!-- Search start here -->
    <div class="container" id="maincontainer">
        <h1 class="my-3 py-3">Search results for <em>"<?php echo $_GET['search']?>"</em></h1>
        <?php

            $searchResult = true;
            $query = $_GET['search'];
            $sql = "SELECT * FROM `threads`WHERE MATCH(thread_title,thread_desc) against('$query')";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)){
                    

                // $searchResult = true;
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                $thread_user = $row['thread_user_id'];
                $url = "threads.php?threadid=" .$thread_user;
                $searchResult = false;
          
                echo '<div class="result my-3">';
                echo '<h3><a href='.$url.'>'.$title.'</a></h3>
                    <p>'.$desc.'</p>';
            echo '</div>';

        }

        if($searchResult){
            echo '<div class="bg-light p-5 rounded-lg m-0">
                    <div class="container">
                        <p class="display-4">No Results Found</p>
                        <p class="lead">Suggestions:
                                            <ul>
                                            <li>Make sure that all words are spelled correctly.</li>
                                            <li>Try different keywords.</li>
                                            <li>Try more general keywords.</li>
                                            <li>Try fewer keywords.</li></ul>
                        
                        </p>
                    </div>
             </div>
            ';
        }


        ?>

    </div>





    <!-- Categories of iDiscuss Forum -->
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