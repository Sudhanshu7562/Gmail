<?php include "include/connect.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php include "include/navbar.php";?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-7">
            </div>
            <div class="col-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="lead">Signup 100% Free</h5>
                        <form action="" method="post">
                            <div class="row">
                                <div class="mb-3 col">
                                    <div class="form-floating">
                                        <input type="text" placeholder="enter fname" name="first_name" class="form-control">
                                        <label for="">First Name</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="mb-3 col">
                                    <div class="form-floating">
                                        <input type="text" placeholder="enter lname" name="last_name" class="form-control">
                                        <label for="">Last Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <div class="form-floating">
                                        <input type="date" placeholder="enter date" name="dob" class="form-control">
                                        <label for="">DOB</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <div class="form-floating">
                                        <input type="email" placeholder="enter email" name="email" class="form-control">
                                        <label for="">Email</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <div class="form-floating">
                                        <input type="password" placeholder="enter password" name="password" class="form-control">
                                        <label for="">Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3 d-flex">
                                    <div class="form-check">
                                        <input type="radio" name="gender" class="form-check-input mx-2">
                                        <label for="" class="form-check-label">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="gender" class="form-check-input mx-2">
                                        <label for="" class="form-check-label">Female</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="gender" class="form-check-input mx-2">
                                        <label for="" class="form-check-label">Other</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                        <input type="submit" name="create" value="submit" class="btn btn-success w-100">
                                    </div>
                                </div>
                            </div>

                        </form>

                        <?php
                        if(isset($_POST['create'])){
                            $first_name = $_POST['first_name'];
                            $last_name = $_POST['last_name'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $gender = $_POST['gender'];
                            $dob = $_POST['dob'];

                            $password = sha1($password);

                            $query = mysqli_query($connect, "insert into accounts (fname,lname,email,password,gender,dob) value('$first_name','$last_name','$email','$password','$gender','$dob')");

                            if($query){
                                redirect("login");
                            }
                            else{
                                message("try again");
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
