<?php
require_once '../connection.php';

if(!isset($_SESSION['user_id'])){
    header("location:Login.php");}

if(isset($_POST['submit']) &&  isset($_GET['id'])){

    $id=$_GET['id'];


        $query="select * from posts where id=$id";
        $res=mysqli_query($conn,$query);
        if(mysqli_num_rows($res)>0){

           $old_image= mysqli_fetch_assoc($res)['image'];
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
    $new_name=$old_image;
}

if(empty($error)){

    $query="update posts set `title`='$title',`body`='$body',`image`='$new_name' where id=$id";
    $res=mysqli_query($conn,$query);
if($res){
    if(isset($_FILES['image'])&&$_FILES['image']['name']){
        move_uploaded_file($tmp_name,"../assets/images/postImage/$new_name");
    }
    $_SESSION['success']="Post Updated Successfully";
    header("location:../viewPost.php?id=$id"); 
}else{
    $_SESSION['error']="Error Happened While Updating";
    header("location:../editPost.php?id=$id");
}
}
else{
    $_SESSION['error']=$error;
            header("location:../editPost.php?id=$id"); 
}

        }else{
            $_SESSION['error']=["There Is No Post"];
            header("location:../index.php");
        }
}else{
    header("location:../index.php");
}
?>