<?php 

//Decleration Variable
$first_name = '';
$last_name = '';
$email = '';
$check_email = '';
$password = '';
$re_password = '';
$date = ''; //signup_date
$error_array= array(); //Holds error messages

if (isset($_POST['register'])) {
	$first_name = strip_tags($_POST['first_name']); //Remove Html Tages
	$first_name = str_replace(' ', '', $first_name); //Remove Spaces
	$_SESSION['first_name'] = $first_name; //Store firstName into session variabel 

	$last_name = strip_tags($_POST['last_name']); 
	$last_name = str_replace(' ', '', $last_name);
	$_SESSION['last_name'] = $last_name;

	$email = strip_tags($_POST['email']); 
	$email = str_replace(' ', '', $email);
	$_SESSION['email'] = $email;

	$check_email = strip_tags($_POST['check_email']); 
	$check_email = str_replace(' ', '', $check_email);
	$_SESSION['check_email'] = $check_email;

	$password = strip_tags($_POST['password']); 
    $re_password = strip_tags($_POST['re_password']); 

    $date = date("Y-m-d"); //current date

    if($email == $check_email){
    	//check if email is in valid format 
    	if (filter_var($email, FILTER_VALIDATE_EMAIL)){
    		$email = filter_var($email, FILTER_VALIDATE_EMAIL);

    		// check if email is already exist
    		$e_check = mysqli_query($conn, "SELECT email From users WHERE email ='$email'");
    		
    		//Count the number of rows return 
    		$num_rows = mysqli_num_rows($e_check);
    		if($num_rows > 0){
    			array_push($error_array,"Email is already in use<br>") ;
    		}
    	}
    	else{
    		array_push($error_array,"Invalid format<br>") ;
    	}	
    }
    else{
    	array_push($error_array,"Emails don't match<br>") ;
    }
    if(strlen($first_name) > 25 || strlen($first_name) < 2){
    	array_push($error_array,"Your FirstName must be between 2 & 25 characters<br>") ;

    }

    if(strlen($last_name) > 25 || strlen($last_name) < 2){
    	array_push($error_array,"Your LastName must be between 2 & 25 characters<br>") ;

    }
    if($password != $re_password){
        array_push($error_array,"Your Password don't Match<br>") ;

    }
    else{
    	if(preg_match('/[^A-Za-z0-9]/', $password)){
    	    array_push($error_array,"Your password Can only contain English characters or Numbers<br>") ;

    	}
    }
    if(strlen($password) > 30 || strlen($password) <5){
	    array_push($error_array,"Your Password Must be between 5 & 30 characters<br>") ;
    }
    if(empty($error_array)){
    	$password = md5($password); //Encript password before sending to database

    	//Generate username by concatinate firstname & lastname
    	$username = strtolower($first_name . "_" . $last_name);
    	$check_username_query = mysqli_query($conn, "SELECT username From users WHERE username ='$username'");
    	$i = 0 ;
    	//if username exist add number to username
    	while (mysqli_num_rows($check_username_query) != 0){
    		$i++;
    		$username = $username . "_" . $i;
    		$check_username_query = mysqli_query($conn, "SELECT username From users WHERE username ='$username'");
    	}
    	//profile picture
    	$rand = rand(1 , 2);

    	if($rand == 1)
    	$profile_pic = "assets/images/profile_pics/default/head_deep_blue.png";
    	 else if ($rand == 2)
    	$profile_pic = "assets/images/profile_pics/default/head_emerald.png";
         $query = mysqli_query($conn ,"INSERT INTO users VALUES ('','$first_name','$last_name','$username','$email','$password',
         	'$date','$profile_pic','0','0','no',',')");
         array_push($error_array, "<span style='color: #14c800;'>You 're all set! Goahed &login!</span><br>");
         //clear session variable
         $_SESSION['first_name']='';
         $_SESSION['last_name']='';
         $_SESSION['email']='';
         $_SESSION['check_email']='';

    }

}
?>