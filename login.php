<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
include ('config.php');
$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $email = $_POST['email'];
  $password = $_POST['password'];

  $email = mysqli_real_escape_string($conn, $email);
  $password = mysqli_real_escape_string($conn, $password);

  //checking if the email is valid or not.
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

    // Check if the email is already taken
    $check_email = "SELECT * FROM alluser WHERE email = '$email'";
    $check_email_result = mysqli_query($conn, $check_email);


    //if email exists.
    if (mysqli_num_rows($check_email_result) > 0) {

      $check_user_type = mysqli_fetch_assoc($check_email_result);

      //if user is a teacher
      if ($check_user_type['user_type'] == 'Teacher') {

        $user_type = $check_user_type['user_type'];
        $teacher_query = "SELECT `password` FROM `teacher` WHERE email = '$email'";
        $teacher_query_result = mysqli_query($conn, $teacher_query);
        $row = mysqli_fetch_assoc($teacher_query_result);
        $hash = $row['password'];

        if (password_verify($password, $hash)) {
          $login_sql = mysqli_query($conn, "SELECT * FROM `teacher` WHERE `email` = '$email' and `password` = '$hash'");
          if ($login_sql) {
            $row = mysqli_fetch_assoc($login_sql);
            $_SESSION['userName'] = $row['fname'].' '.$row['lname'];
            $_SESSION['userId'] = $row['teacherid'];
            $_SESSION['userImg'] = $row['profilePicture'];
            $_SESSION['userType'] = $user_type;
            $_SESSION['email'] = $email;
            // echo "<pre>";
            // print_r($row);
            // echo $_SESSION['userId'].'    ';
            // echo $_SESSION['userImg'];
            // exit;
            header('location: \iTutor\lessons.php');
          }

        } else {
          $errorMessage = "Invalid Password";
        }

        //if user is a student
      } else {
        $user_type = $check_user_type['user_type'];
        $student_query = "SELECT `password` FROM `student` WHERE email = '$email'";
        $student_query_result = mysqli_query($conn, $student_query);
        $row = mysqli_fetch_assoc($student_query_result);
        $hash = $row['password'];

        if (password_verify($password, $hash)) {
          $login_sql = mysqli_query($conn, "SELECT * FROM `student` WHERE `email` = '$email' and `password` = '$hash'");
          if ($login_sql) {
            $row = mysqli_fetch_assoc($login_sql);
            $_SESSION['userName'] = $row['fname'].' '.$row['lname'];
            $_SESSION['userId'] = $row['studentid'];
            $_SESSION['userImg'] = $row['profilePic'];
            $_SESSION['userType'] = $user_type;
            $_SESSION['email'] = $email;
            // echo "<pre>";
            // print_r($row);
            // echo $_SESSION['userType'];
            // echo $_SESSION['userId'].'    ';
            // echo $_SESSION['userImg'];
            // echo $_SESSION['userName'];
            // exit;
            header('location: \iTutor\find-tutor.php');
          }

        } else {
          $errorMessage = "Invalid Password";
        }

      }






    } else { // user don't exist.
      $errorMessage = "User do not exist!";
    }

  } else {
    $errorMessage = 'Invalid Email!';
  }

}



$page = 'Login';
include ('layout/header.php');
?>
<main>
  <!-- Login section start -->

  <section id="login-section" class="mx-auto" style="height: 600px; width: 30%;">

    <div class="container ">

      <?php
      if ($errorMessage != "") {
        echo "
				            	<div class='alert alert-danger alert-dismissible fade show' role='alert'>
				            	<strong>$errorMessage</strong>
				            	<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
				            	</div>
				            	";
      }
      ?>

      <div class="pb-4"><img src="images/itutor-logo.png" style="height: 100px; width: 100%;"></div>
      <p><b>Don't have an account? </b></p>
      <p><a class="text-dark" href="signup.php">Sign up as Student</a> or <a class="text-dark"
          href="become-tutor.php">Sign up as tutor</a>.</p>

      <!-- <a href="#">
        <button class="mb-3 btn w-100 border border-2 border-dark btn-lg bg-green" style="font-weight: bold">
          Sign up as tutor
        </button>
      </a>
      <a href="#">
        <button class="mb-3 btn w-100 border border-2 border-dark btn-lg bg-green" style="font-weight: bold">
          Sign up as student
        </button>
      </a> -->


      <form method="post" action="login.php" class="py-4">

        
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" placeholder="Your Email" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Your Password" required>
        </div>


        <button type="submit" class="mb-3 btn w-100 border border-2 border-dark btn-lg bg-green text-bold"
          style="font-weight: bold">
          Log in
        </button>

      </form>

      <p class="text-center">
        By signing up, you agree to iTutor's,
        <b>Terms of Services,</b> and <b>Privacy Policy</b>
      </p>
    </div>


  </section>
  <!-- Login section end -->
</main>

<?php include ('layout/footer.php'); ?>