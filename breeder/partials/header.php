<?php
require 'config/database.php';

// fetch current user from database

if(isset($_SESSION['user-id'])) {
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $avatar = mysqli_fetch_assoc($result);
    $_SESSION['unique_id'] = $avatar['unique_id'];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rabbit Website</title>
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/rabbit7.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/css3.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style27.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style012.css">
    <!-- CUSTOM STYLESHEET -->
    <!-- ICONSCOUT CDN -->
    <link rel="stylesheet" href="admin/chatapp/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- GOOGLE FONT (MONTSERRAT) -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>


</head>
<body>
    <nav>
        <div class="container nav__container">
            <a href="<?= ROOT_URL ?>breeder/" class="nav__logo"> RABBIT WEBOOK</a>
            <ul class="nav__items">
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <!-- <li><a href="contact.php">Contact Us</a></li> -->
                <li><a href="users.php">Message</a></li>
                
                <?php if(isset($_SESSION['user-id'])): ?>
                    <li class="nav__profile">
                    <div class="avatar">
                        <img src="<?= ROOT_URL . 'images/' . $avatar['avatar'] ?>">
                    </div>
                    <ul>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="<?= ROOT_URL ?>logout.php">Logout</a></li>
                    </ul>
                </li>
                <?php else : ?>
                  <li><a href="<?= ROOT_URL ?>signin.php">Signin</a></li>
                <?php endif ?>
            </ul>

            <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>
    <!--====================== END OF NAV ====================-->
