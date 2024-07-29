<?php
$conn=mysqli_connect('localhost','root','','phptestdb');
if(isset($_POST['submit'])){
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
    $fileimage=$_FILES['image']['name'];
    $tmpfile=$_FILES['image']['tmp_name'];
    $uploc="image/".$fileimage;
$sql="INSERT INTO students_info(firstname,lastname,email,image) VALUES('$firstname','$lastname','$email','$fileimage')";
if(mysqli_query($conn,$sql)){
    move_uploaded_file($tmpfile,$uploc);
    echo "data inserted";
    header('location:data_image.php');
}else{
    echo "not inserted ?";
}

}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <title>Data & image insert and display show</title>
    <style>
        .img{
            height: 50px;
            width: 50px;
            border-radius: 20px;
            border-color: red;
        }
    </style>
  </head>
  <body>
   <div class="container">
    <div class="row">
        <div class="col-lg-7 m-auto">
            <div class="card">
                <div class="card-header">
                    <h2 class="bg-success text-white text-center">Student information and image Insert</h2>
                </div>
                <div class="card-body">
                    <form action="<?= $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label calss="form-label">Enter Your firstname :</label>
                        <input class="form-control" type="text" name="firstname" value="">
                    </div>
                    <div class="mb-3">
                        <label calss="form-label">Enter Your lastname</label>
                        <input class="form-control" type="text" name="lastname" value="">
                    </div>
                    <div class="mb-3">
                        <label calss="form-label">Email</label>
                        <input class="form-control" type="email" name="email" value="">
                    </div>
                    <div class="mb-3">
                        <label calss="form-label">Image</label>
                        <input class="form-control" type="file" name="image" value="">
                    </div>
                    <div class="mb-3">
                        <input class=" btn-success btn text-white " type="submit" name="submit" value="submit">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   </div>
  </body>
</html>
<?php
$sql2="SELECT * FROM students_info";
$query=mysqli_query($conn,$sql2);
echo "<table class='table table-border'><tr class='bg-light'>
<th>ID</th>
<th>FIRSTNAME</th>
<th>LASTNAME</th>
<th>EMAIL</th>
<th>IMAGE</th>
<tr> ";
while($data=mysqli_fetch_assoc($query)){
$id=$data['id'];
$firstname=$data['firstname'];
$lastname=$data['lastname'];
$email=$data['email'];
$fileimage=$data['image'];
echo"
<tr>
    <td>$id</td>
    <td>$firstname</td>
    <td>$lastname</td>
    <td>$email</td>";
  echo" <td><img src='image/$fileimage' class='img'></td></tr>";
};
