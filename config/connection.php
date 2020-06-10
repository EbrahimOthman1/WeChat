<?php 
		ob_start(); //Turns on output buffering 
		session_start();

		$timezone = date_default_timezone_set("Africa/Cairo");

		$conn = mysqli_connect('localhost' , 'ebrahimotman' , '123' , 'social'); // connect to database (server , username , password , database)

			if (!$conn) {
			    die("Connection failed: " . mysqli_connect_error());

			    }

 ?>