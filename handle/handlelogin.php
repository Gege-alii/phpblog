<?php 
  require_once '../connection.php';
  
  if(!isset($_SESSION['user_id'])){
    header("location:Login.php");}

  if(isset($_POST['submit'])){

    $email=trim(htmlspecialchars($_POST['email']));
    $password=trim(htmlspecialchars($_POST['password']));

    
    $error=[];

if (empty($email)) {
    $error[]= "Email Is Required";
  } 
   elseif (!filter_var($email , FILTER_VALIDATE_EMAIL)) {
      $error[]= "Invalid Email";
    }

      if (empty($password)) {
        $error[]= "Password Is Required";
      } elseif(!preg_match('/[A-Z]/', $password)){
        $error[]="Password Is Invalid";
      }elseif(!preg_match('/[!@#$%^&*]/', $password))
      {
        $error[]="Password Is Invalid";
      }elseif(strlen($password)<8)
      {
        $error[]="Password must be 8 charachter";
      }
  
$passHased=password_hash($password,PASSWORD_DEFAULT);

$query="select * from users where `email`='$email' ";
$res=mysqli_query($conn,$query);
if(mysqli_num_rows($res)==1){
    
    $user=mysqli_fetch_assoc($res);
    $name=$user['name'];
    $user_id=$user['id'];
    $old_pass=$user['password'];
$verify= password_verify($password,$old_pass);
if($verify){
    $_SESSION['user_id']= $user_id;
    $_SESSION['success']="HI $name Your Login Success";
    header("location:../index.php");
}else{
    $_SESSION['error']=["Error Happened While Login"];
    header("location:../Login.php");
}
}
else{
$_SESSION['error']=["This account not found"];
header("location:../Login.php");
}
  }else{
    header("location:../Login.php");
  }
  ?>