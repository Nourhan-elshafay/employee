<?php 
      $host = "localhost";
      $username = "root";
      $password = '';
      $dbname = "company";
      $connection = mysqli_connect($host,$username,$password,$dbname);

      // create
      if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $department = $_POST['department'];
            $phone = $_POST['phone'];
            $gender = $_POST['gender'];

            $insert = "INSERT INTO employees VALUES (null,'$name','$department','$phone','$gender')";
            $insertquery = mysqli_query($connection,$insert);
      }


      // delete
      if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $delete = "DELETE FROM `employees` WHERE id= $id ";
        $deletequery = mysqli_query($connection,$delete);
        header("location:index.php");
      }


      // update
      $mode="create";
      $name = '';        
      $department = '';
      $phone = '';
      $gender = '';
      $userid='';

      if(isset($_GET['update'])){
        $id = $_GET['update'];
        $getquery = "SELECT * FROM `employees` WHERE id = $id ";
        $getcon = mysqli_query($connection,$getquery);
        $row = mysqli_fetch_assoc($getcon);
        $name = $row['name'];        
        $department = $row['department'];
        $phone = $row['phone'];
        $gender = $row['gender'];
        $userid = $id;
        $mode = "update";
      }

      if(isset($_POST['update'])){
        $name = $_POST['name'];
        $department = $_POST['department'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];

        $update = "UPDATE `employees` SET `name`='$name',`department`='$department',`phone`='$phone',`gender`='$gender' WHERE id=$userid ";
        $updatequery = mysqli_query($connection,$update);
        $mode = "create";
        header("location:index.php");

      }

      // read
      $select = "SELECT * FROM employees";
      $selectquery = mysqli_query($connection,$select);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>employee</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./main.css">
</head>

<body>

  <div class="container py-5">
    <div class="row justify-content-center mt-5">
      <div class="col-7">
        <div class="card">
          <div class="card-body">
            <form action="" method="POST">
              <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" value="<?= $name ?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Department</label>
                <input type="text" name="department" value="<?= $department ?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="">phone</label>
                <input type="text" name="phone" value="<?= $phone ?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="">gender</label>:
                  <?php if(isset($_GET['update'])): ?>
                    <?php if($gender == 'Male'): ?>
                male <input type="radio" checked name="gender" value="Male">
                female <input type="radio" name="gender" value="Female">
                <?php else: ?>
                  male <input type="radio" name="gender" value="Male">
                female <input type="radio" checked name="gender" value="Female">
                <?php endif;?>
                <?php else: ?>
                  male <input type="radio" name="gender" value="Male">
                female <input type="radio" name="gender" value="Female">
                <?php endif; ?>
              </div>
              <div class="form-group text-center">
                <?php if($mode=="create"): ?>
                <button name="submit" class="btn btn-primary"> Add employee</button>
                <?php else: ?>
                <button name="update" class="btn btn-warning"> Update employee</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
                <?php endif; ?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-5">
      <table class="table table-dark">
        <tr>
          <th>id</th>
          <th>name</th>
          <th>Department</th>
          <th>Phone</th>
          <th>Gender</th>
          <th colspan="2">Action</th>
        </tr>
        <?php foreach($selectquery as $employee): ?>
          <tr>
          <th><?= $employee['id'] ?></th>
          <th><?= $employee['name'] ?></th>
          <th><?= $employee['department'] ?></th>
          <th><?= $employee['phone'] ?></th>
          <th><?= $employee['gender'] ?></th>
          <th> <a href="?delete= <?= $employee['id'] ?>" class="btn btn-danger">Delete</a></th>
          <th> <a href="?update= <?= $employee['id'] ?>" class="btn btn-warning">Update</a></th>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>