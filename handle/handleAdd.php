<?php 
  require_once '../connection.php';

  if(!isset($_SESSION['user_id'])){
  header("location:Login.php");}else{


  $id=$_SESSION['user_id'];

  if(isset($_POST['submit'])){

    $title=trim(htmlspecialchars($_POST['title']));
    $body=trim(htmlspecialchars($_POST['body']));

$error=[];
if(empty($title)){
    $error[]= "Title Is Required";
}elseif(is_numeric($title)){
    $error[]="The Title must be Text";
}

if(empty($body)){
    $error[]= "Body Is Required";
}elseif(is_numeric($body)){
    $error[]="The Body must be Text";
}

if(isset($_FILES['image'])&&$_FILES['image']['name']){
    $image=$_FILES['image'];
    $image_name=$image['name'];
    $tmp_name=$image['tmp_name'];
    $image_error=$image['error'];
    $size=$image['size']/(1024*1024);
    $extension=strtolower(pathinfo($image_name,PATHINFO_EXTENSION));

if($image_error!=0){
    $error[]=" Image Is Required";
}elseif($size>1){
    $error[]="The Image Has Big Size";
}elseif(!in_array($extension,["jpg","png","jpeg"])){
    $error[]="The Extension Of The Image Must Be Jpg Or Png Or Jpeg";
}

    $new_name=uniqid().".".$extension;

}else{
    $new_name=null;
}

if(empty($error)){
$query="insert into posts(`title` ,`body` ,`image` ,`user_id`) values('$title','$body','$new_name','$id')";

$res=mysqli_query($conn,$query);
if($res){

    if(isset($_FILES['image'])&&$_FILES['image']['name']){
        move_uploaded_file($tmp_name,"../assets/images/postImage/$new_name");
    }

  $_SESSION['success']="Your Post Created Successfully";
  header("location:../index.php");
}else{
    $_SESSION['error']=["Error happened During Insert"];
}



}else{
    $_SESSION['error']=$error;
    header("location:../addPost.php");

}
  }else{
    header("location:../addPost.php");
  }

  }

?>