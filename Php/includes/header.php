<?php 

	include('includes/conn.php');
	include('includes/functions.php');
	include('includes/sessions.php');
	include('includes/request.php');
	include('includes/user.php');
	include('includes/cart.php');

	$request = new userRequest;
	$session = new session;
	$cart = new cart;

 ?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="../Css/lightbox.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../Css/shop.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Shop</title>
</head>

<body>
	<div id="main">
   		<span id="ham" onclick="openNav()">Menu  &#9776; &nbsp;</span>
    	<div id="logCart"><?php showNavbar(); ?></div>
	</div>
	<div id="mySidenav" class="sidenav">
    	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    	<div id="logCart2"><?php showNavbar(); ?></div>
    	<a><?php showMenu();?></a>
	</div>
