<!doctype html>
<html lang="en">
<style>
.container {
    min-height: 85vh;
}
</style>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

    <title>Contact Us</title>
</head>

<body>


    <?php include 'partials/_db.php'; ?>

    <?php include 'partials/_header.php'; ?>


    <?php
    
    $method  = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){

        $username = $_POST['username'];
        $number = $_POST['usernumber'];
        $email = $_POST['email'];
        $comments = $_POST['comments'];

    
        if(empty($username) || empty($number) || empty($email) || empty($comments)) {
    
            echo '<div class="alert alert-danger"><strong><em> All Fields are Manadatory.! </em></strong></div>';

        } 
    
        else{

            
            $conSubmit = true;

            $sql = "INSERT INTO `contacts` (`user_name`, `phone_number`, `user_email`, `comments`, `date`) VALUES('$username', '$number', '$email', '$comments', current_timestamp())";
            $result = mysqli_query($conn, $sql);

            $conSubmit = true;

            if($conSubmit){
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success! </strong><em>“Thank you for contacting us. We’ll respond within 24 hours.”</em>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
                
            ';

            }
        }
    }
    

    ?>

    <div class="container">
        <h1 class="text-center my-3">Contact us</h1>
        <div class="bg-light p-5 rounded-lg m-3 my-3 ">
            <h3>Send us a message</h3>
            <p class="small"><em>Send us a message and we'll respond within 24 hours.</em></p>
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
                <div class="mb-3">
                    <label for="form-control" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="username" name="username"
                        placeholder="Type full name here">
                </div>
                <div class="mb-3">
                    <label for="usernumber" class="form-label">Phone Number</label>
                    <input type="number" class="form-control" id="usernumber" name="usernumber"
                        placeholder="Phone number">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Type email here"
                        aria-describedby="emailHelp">
                </div>
                <div class="mb-4 ">
                    <label for="floatingTextarea2" class="form-label">Comments</label>
                    <textarea class="form-control" id="comments" name="comments" placeholder="Type your message here"
                        style="height: 100px"></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" id="submit" name="submit"
                        class="btn btn-success btn-lg col-3 mx-auto">Submit</button>
                </div>
            </form>
        </div>
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