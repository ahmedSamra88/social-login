<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Document</title>
</head>
<body class="p-5 d-flex justify-content-center align-items-center">
    <?php 
    if(!isset($_GET['code'])){ ?>
    <!-- <form action="" method="post">   -->
        <a class="btn btn-danger m-2" href="<?php echo $google_client->createAuthUrl(); ?>">login with Google</a>
        <a class="btn btn-primary m-2" href="<?php echo $fb_login_url;  ?>">login with Facebook</a>
    <!-- </form> -->
    <?php } else{ ?>
        <div class="card m-auto shadow" style="width: 18rem;">
            <img class="card-img-top" src="<?php echo $profile_pic; ?>" alt="Card image cap">
            <div class="card-body">
                <p class="card-text">Email : <?php echo  $user_name; ?></p>
                <p class="card-text p-2 text-muted">Login At : <?php echo $user->lastlogin($user_name)['logintime']; ?></p>
                <a href="logout.php" class="btn btn-link btn-block">Log out</a>
            </div>
        </div>
    <?php } ?>
</body>
</html>