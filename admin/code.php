<?php
session_start();
include("../config/dbconnect.php") ;
    if(isset($_POST['add_category_btn']))
    {
        $_SESSION['role_as']=true;
        $category_id=$_POST['category_id'];
        $category_name=$_POST['category_name'];
        $name=$_POST['name'];
        $slug=$_POST['slug'];
        $price=$_POST['price'];
        $description=$_POST['description'];
        $meta_title=$_POST['meta_title'];
        $meta_description=$_POST['meta_description'];
        $meta_keywords=$_POST['meta_keywords'];
        $status=isset($_POST['status'])?'1':'0';
        $popular=isset($_POST['popular'])?'1':'0';
        $image=$_FILES['image']['name'];

        $path="../uploads";
        $image_ext=pathinfo($image,PATHINFO_EXTENSION);
        $file_name=time().'.'.$image_ext;
        $category_query="INSERT INTO categories 
        (category_id,category_name,name,slug,price,description,meta_title,meta_description,meta_keywords,status,popular,image)
        VALUES ('$category_id','$category_name','$name','$slug','$price','$description','$meta_title','$meta_description','$meta_keywords','$status','$popular','$image')";
        $category_query_run=mysqli_query($con,$category_query);
        if($category_query_run){
            move_uploaded_file($_FILES['image']['tmp_name'],$path.'/'.$file_name);
            header("location:add_category.php");
            $_SESSION['message']="Category uploaded successfully";
        }else{
            header("location:add_category.php");
            $_SESSION['message']="something went wrong";
        }

    }
?>