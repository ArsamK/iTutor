<?php

error_reporting(E_ERROR | E_PARSE);

include('config.php');
include('functions.php');

$errorMessage = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  // $dob = date('d-m-Y', strtotime($_POST["dob"]));
  $dob = $_POST["dob"];
  $phone = $_POST["phone"];
  $gender = $_POST["gender"];
  $country = $_POST["country"];
  $currentDate = date('Y-m-d');

  // echo $name." ". $email." ".$password." ".$dob." ".$phone." ".$gender." ".$country;
  // exit;

  //checking if the email is valid or not.
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

    // Check if the email is already taken
    $check_email = "SELECT * FROM alluser WHERE email = '$email'";
    $check_email_result = mysqli_query($conn, $check_email);

    //if email already exists.
    if (mysqli_num_rows($check_email_result) > 0) {
      $errorMessage = "User already exists";
    } else { //if email doesn't exist


      //validating name
      if (split_name($name) != false) {

        $name_array = split_name($name);

        $fname = $name_array['first_name'];
        $mname = $name_array['middle_name'];
        $lname = $name_array['last_name'];

        //validating password
        if (validatePassword($password) != false) {
          $hash_password = password_hash($password, PASSWORD_BCRYPT);

          //validating phone number.
          if (validatePhoneNumber($phone)) {

            //validating date of birth.
            if (validateDOB($dob)) {

              //validate and store the profile picture.
              if (isset($_FILES['picture'])) {

                $targetDir = "uploads/images/";
                $file_name = generateUniqueFileName($_FILES["picture"]["name"]);
                $targetFile = $targetDir . $file_name;
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));


                // Check file size
                if ($_FILES["picture"]["size"] > 500000) {
                  $errorMessage = "Sorry, your file is too large.";
                  $uploadOk = 0;
                }

                // Allow certain file formats
                if (
                  $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                  && $imageFileType != "gif"
                ) {
                  $errorMessage = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                  $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                   $errorMessage = $errorMessage . "!";
                  // if everything is ok, try to upload file
                } else {
                  if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFile)) {

                    $sql = "INSERT INTO `student` (`fname`,`mname`,`lname`, `email`, `password`, `DOB`, `phone`, `gender`, `country`, `profilePic`,  `registrationDate`, `timezone`) VALUES ('$fname','$mname','$lname', '$email', '$hash_password', '$dob', '$phone', '$gender', '$country', '$file_name', '$currentDate', 'UTC+05:00')";
                    mysqli_query($conn, $sql);
                    header("location: \iTutor\login.php");

                  } else {
                    $errorMessage = "File could not be uploaded!";
                  }
                }

              } else {
                $errorMessage = "Upload Profile Picture!";
              }

            } else {
              $errorMessage = "Age must at least be 18 years!";
            }

          } else { //if phone number is not valid/.
            $errorMessage = "Invalid Phone Number!";
          }

        } else { // if password is not valid.

          $errorMessage = "Password must contain(Numbers, Lowercase and Uppercase letter, Special symbols(@,#,$,&,?) Length(8-16 characters)!";
        }


      } else { //if name is not valid
        $errorMessage = "Re-enter your name!";
      }


    }

  } else { //if email is not valid.
    $errorMessage = "Invalid Email";
  }

}


$page = 'Signup';
include('layout/header.php');
?>





<main>
  <!-- signup section start -->

  <section id="signup-section" class="mx-auto" style="height: auto; width: 30%;">

    <div class="container ">

          

      <form method="post" action="signup.php" enctype="multipart/form-data">

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

        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="name" class="form-control" id="name" name="name" aria-describedby="emailHelp"
            placeholder="Your Name" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp"
            placeholder="Your Email" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="password"
            placeholder="Your Password" required>
        </div>

        <div class="mb-3">
          <label for="dob" class="form-label">DOB</label>
          <input type="date" class="form-control" id="dob" name="dob" required>
        </div>

        <div class="mb-3">
          <label for="phone" class="form-label">Phone Number</label>
          <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" required>
        </div>

        <div class="mb-3">
          <label for="gender" class="form-label">Gender</label>
          <select class="form-select" name="gender">
            <option selected value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="picture" class="form-label">Profile Picture</label>
          <input type="file" class="form-control" id="picture" name="picture" placeholder="Profile Picture" required>
        </div>

        <div class="mb-3">
          <label for="country" class="form-label">Country</label>
          <select class="form-select" name="country" required>
            <option selected disabled>Select country</option>
            <?php
            $countryList = allCountries();
            foreach ($countryList as $country) {
              ?>
              <option value="<?php echo $country; ?>">
                <?php echo $country; ?>
              </option>

            <?php } ?>
          </select>
        </div>
        
      <p><b>Already have an account? </b><a class="text-dark" href="login.php">Log in</a>.</p>

      
        <button type="submit" class="mb-3 btn w-100 border border-2 border-dark btn-lg bg-green text-bold"
          style="font-weight: bold">
          Sign up
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

<?php include('layout/footer.php');?>