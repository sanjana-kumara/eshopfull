<?php

require "connection.php";

$fname = $_POST["f"];
$lname = $_POST["l"];
$email = $_POST["e"];
$password = $_POST["p"];
$mobile = $_POST["m"];
$gender = $_POST["g"];

if (empty($fname)) {
    echo ("Please enter your First Name!");
} else if (strlen($fname) > 50) {
    echo ("First Name must have LESS THAN 50 characters!");
}else if (empty($lname)) {
    echo ("Please enter your Last Name!");
} else if (strlen($lname) > 50) {
    echo ("Last Name must have LESS THAN 50 characters!");
}else if(empty($email)){
    echo("Please enter your Email address!");
}else if(strlen($email)>100){
    echo ("Email must have LESS THAN 100 characters!");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo ("Invalid Email address!");
}else if(empty($password)){
    echo ("Please enter your Password!");
}else if(strlen($password)<5 || strlen($password)>20){
    echo ("Password length must be between 5 and 20!");
}else if(empty($mobile)){
    echo ("Please enter your Mobile Number!");
}else if(strlen($mobile) != 10){
    echo ("Mobile Number must contain 10 characters");
}else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mobile)){
    echo ("Invalid Mobile Number!");
}else{

$rs = Database::search("SELECT * FROM `users` WHERE `email`='".$email."' OR 
`mobile`='".$mobile."'");
$n = $rs->num_rows;

if($n > 0){
    echo ("User with the same Email or Mobile already exists.");
}else{

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `users` 
    (`fname`,`lname`,`email`,`password`,`mobile`,`joined_date`,`status`,`gender_id`)
    VALUES ('".$fname."','".$lname."','".$email."','".$password."','".$mobile."',
    '".$date."','1','".$gender."')");

    echo ("success");

}
    
}

?>