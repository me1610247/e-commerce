<?php
session_start();
if(!isset($_SESSION['auth'])){
  header("location:../login.php");
}
include ("includes/header.php");
include("../config/dbconnect.php");
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Category</h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" placeholder="Enter Category Name" class="form-control border rounded ms-auto p-2 font-weight-bold">

                        <div class="row">
                    <div class="col-md-6">
                            <label class="font-weight-bold" for="">Category Name</label>
                            <select name="category_name" id="">
                                <option value="" seleceted>Select Category</option>
                                <option value="mobiles" >Mobiles</option>
                                <option value="technology" >Technology</option>
                                <option value="Fashion" >Fashion</option>
                                <option value="shoes" >Shoes</option>
                                <option value="TV" >TV</option>
                                <option value="bodylotion" >Body Lotion</option>
                            </select>
                            </div>
                    <div class="col-md-6">
                            <label class="font-weight-bold" for="">Name</label>
                        <input type="text" name="name" placeholder="Enter Category Name" class="form-control border rounded ms-auto p-2 font-weight-bold">
                            </div>
                            <div class="col-md-6">
                            <label class="font-weight-bold" for="">Slug</label>
                        <input type="text" name="slug" placeholder="Slug" class="form-control border rounded ms-auto p-2 font-weight-bold">
                            </div>
                            <div class="col-md-6">
                            <label class="font-weight-bold" for="">Price</label>
                        <input type="text" name="price" placeholder="Price" class="form-control border rounded ms-auto p-2 font-weight-bold">
                            </div>
                            <div class="col-md-12">
                            <label class="font-weight-bold" for="">Description</label>
                        <textarea rows="3" type="text" name="description" placeholder="Enter Category Description" class="form-control border rounded ms-auto p-2 font-weight-bold"></textarea>
                            </div>
                            <div class="col-md-12">
                            <label class="font-weight-bold" for="">Upload Image</label>
                        <input type="file" name="image" placeholder="Category Image" class="form-control border rounded ms-auto  font-weight-bold">
                            </div>
                            <div class="col-md-12">
                            <label class="font-weight-bold" for="">Meta title</label>
                        <input type="text" name="meta_title" placeholder="Meta Title" class="form-control p-2 border rounded ms-auto  font-weight-bold">
                            </div>
                            <div class="col-md-12">
                            <label class="font-weight-bold" for="">Meta Description</label>
                        <input type="text" name="meta_description" placeholder="Meta Description" class="form-control p-2 border rounded ms-auto  font-weight-bold">
                            </div>
                            <div class="col-md-12">
                            <label class="font-weight-bold" for="">Meta Keywords</label>
                        <textarea rows="3" type="text" name="meta_keywords" placeholder="Enter Meta Keywords" class="form-control p-2 border rounded ms-auto p-2 font-weight-bold"></textarea>
                            </div>
                            <div class="col-md-6">
                            <label for="">Status</label>
                        <input type="checkbox" name="status" >
                            </div>
                            <div class="col-md-6">
                            <label for="">Popular</label>
                        <input type="checkbox" name="popular" >
                            </div>
                            <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" name="add_category_btn">Save</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("includes/footer.php") ?>