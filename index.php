<?php
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$gmail = $_POST['gmail'];
$phoneno = $_POST['phoneno'];
$varsity = $_POST['varsity'];
$gender = $_POST['gender'];
$textarea = $_POST['textarea'];


if(!empty(fname) || !empty(lname) || !empty(gmail) || !empty(phoneno) || !empty(varsity) || !empty(gender) || !emtpy(temxtarea))
{
$HOST = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "facebook";

$conn = new mysqli($HOST,$dbUsername,$dbPassword,$dbname);

if(mysqli_connect_error()){
    die('Connect Error ('. mysqli_connect_error().')'.mysqli_connect_error());
}
else{
    $SELECT = "SELECT gmail From register1 Where gmail=? Limit=1"; 
    $INSERT = "INSERT Into register1(fname,lname,gmail,phoneno,varsity,gender,textarea) 
     values(?,?,?,?,?,?,?)";

     //prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $gmail);
     $stmt->execute();
     $stmt->bind_result($gmail);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssisss", $fname, $lname, $gmail, $phoneno, $varsity, $gender,$textarea);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }

}
else
{
    echo "All feild are required" ;
}
die();


?>
