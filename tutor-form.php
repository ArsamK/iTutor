<?php

error_reporting(E_ERROR | E_PARSE);
session_start();

if(!isset($_SESSION['email'])){
  header("location: \iTutor\become-tutor.php");
}


include ('config.php');
include ('functions.php');

$currentYear = date("Y");
$errorMessage = '';

// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//   $email = 'daniyakhan@gmail.com';
//   $videoUrl = $_POST['video-link'];
//   $rates = $_POST['rate'];
//   $introduction = $_POST['introduction'];
//   $experience = $_POST['experience'];
//   $motivate = $_POST['motivate'];
//   $headline = $_POST['headline'];

//   $introduction = mysqli_real_escape_string($conn, $introduction);
//   $experience = mysqli_real_escape_string($conn, $experience);
//   $motivate = mysqli_real_escape_string($conn, $motivate);
//   $headline = mysqli_real_escape_string($conn, $headline);
//   $videoUrl = mysqli_real_escape_string($conn, $videoUrl);
//   $rates = mysqli_real_escape_string($conn, $rates);

//   if (!empty($headline) && !empty($introduction) && !empty($experience) && !empty($motivate) && !empty($videoUrl) && !empty($rates)) {

//     // Grabbing the teacherid of teacher to input the languages 
//     $getting_teacherid = mysqli_query($conn, "SELECT * from teacher WHERE email ='$email'");
//     $row = mysqli_fetch_assoc($getting_teacherid);
//     $teacherid = $row['teacherid'];
//     // echo $teacherid;

//     $teacher_sql = "UPDATE `teacher` SET `teacherintro` = '$introduction', `experience` = '$experience', `description` = '$motivate', `headline` = '$headline', `videoLinks` = '$videoUrl', `rates` = '$rates' WHERE teacherid = '$teacherid'";

//     $teacherResult = mysqli_query($conn, $teacher_sql);
//     if ($teacherResult) {
//       echo "inserted success!";
//     } else {
//       echo "Error occurred" . mysqli_error($conn);
//     }


//     exit;

//   }

// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = $_POST["name"];
  $email = $_POST["email"];
  $hash_password = $_POST["password"];
  $dob = $_POST["dob"];
  $phone = $_POST["phone"];
  $gender = $_POST["gender"];
  $country = $_POST["country"];
  $city = $_POST["city"];
  $age = $_POST["age"];
  $subjectid = $_POST['subjectid'];
  $languages = $_POST['language'];
  $currentDate = date('Y-m-d');
  // Decode the JSON schedule data
  $availability = json_decode($_POST['schedule-data'], true);

  $videoUrl = $_POST['video-link'];
  $rates = $_POST['rate'];
  $introduction = $_POST['introduction'];
  $experience = $_POST['experience'];
  $motivate = $_POST['motivate'];
  $headline = $_POST['headline'];

  $introduction = mysqli_real_escape_string($conn, $introduction);
  $experience = mysqli_real_escape_string($conn, $experience);
  $motivate = mysqli_real_escape_string($conn, $motivate);
  $headline = mysqli_real_escape_string($conn, $headline);
  $videoUrl = mysqli_real_escape_string($conn, $videoUrl);
  $rates = mysqli_real_escape_string($conn, $rates);

  $part_one = false;
  $part_two = false;
  $part_three = false;
  $part_four = false;

  $edu_check = true;
  $cert_check = true;


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

        //validating age
        if ($age >= 18) {

          // validating subject entry
          if (!empty($subjectid)) {

            //validating phone number.
            if (validatePhoneNumber($phone)) {

              //validating date of birth.
              if (validateDOB($dob)) {

                // validating the country
                if (!empty($country)) {

                  // validating the profile, video and rates section
                  if (!empty($headline) && !empty($introduction) && !empty($experience) && !empty($motivate) && !empty($videoUrl) && !empty($rates)) {

                    // validating the languages
                    if (!empty($languages)) {

                      // validating the picture input
                      if (isset($_FILES['picture'])) {

                        if(!empty($city)){

                          $part_one = true;

                        } else{
                          $errorMessage = "Select city!";
                        }

                      } else {
                        $errorMessage = "Upload image!";
                      }

                    } else {
                      $errorMessage = "Select your Language!";
                    }

                  } else {
                    $errorMessage = "Insert all the fields!";
                  }

                } else {
                  $errorMessage = "Select country!";
                }

              } else {
                $errorMessage = "Age must at least be 18 years!";
              }

            } else { //if phone number is not valid/.
              $errorMessage = "Invalid Phone Number!";
            }
          } else {
            $errorMessage = "Select subject you teach!";
          }

        } else { // if age is not valid.
          $errorMessage = "Your must be more than 18 years!";
        }


      } else { //if name is not valid
        $errorMessage = "Re-enter your name!";
      }


    }

  } else { //if email is not valid.
    $errorMessage = "Invalid Email";
  }




  // echo $fname . " " . $mname . " " . $lname . " " . $email . " " . $hash_password . " " . $dob . " " . $phone . " " . $gender . " " . $country . " " . $file_name . " " . $currentDate . " " . $age . " " . $subjectid . " " . $introduction . " " . $experience . " " . $motivate . " " . $headline . " " . $videoUrl . " " . $rates . " ";
  // echo "<pre>";
  // print_r($languages);
  // exit;




  // For Education
  if ($part_one) {

    if (!isset($_POST['has_education'])) {
      $university = $_POST['university'];
      $degree = $_POST['degree'];
      $degree_type = $_POST['degree_type'];
      $specialization = $_POST['specialization'];
      $startEduYear = $_POST['startEduYear'];
      $endEduYear = $_POST['endEduYear'];

      if (!empty($university) && !empty($degree) && !empty($degree_type) && !empty($specialization) && !empty($startEduYear) && !empty($endEduYear)) {

        $part_two = true;

      } else {

        $errorMessage = "Fill all required details in Education!";

      }

    } else{
      $edu_check = false;
      $part_two = true;
    }

  }

  // For Certificates
  if ($part_one && $part_two) {

    if (!isset($_POST['has_certificate'])) {
      $subject = $_POST['subject'];
      $cert_title = $_POST['cert_title'];
      $cert_link = $_POST['cert_link'];
      $issued_by = $_POST['issued_by'];
      $startYear = $_POST['startYear'];
      $endYear = $_POST['endYear'];

      if (!empty($subject) && !empty($cert_title) && !empty($cert_link) && !empty($issued_by) && !empty($startYear) && !empty($endYear)) {

        $part_three = true;

      } else {
        $errorMessage = "Fill all required details in Certification!";
      }

    } else{
      $cert_check = false;
      $part_three = true;
    }

  }

  // For Availability
  if ($part_one && $part_two && $part_three) {

    if (!empty($availability)) {
      $part_four = true;
    } else{
      $errorMessage = "You need to be available for at least one day!";
    }

  }

  // Inserting all the queries when every input is validated
  if ($part_one && $part_two && $part_three && $part_four) {

    $targetDir = "uploads/teacher_img/";
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

        $teacher_sql = "INSERT INTO `teacher` (`fname`,`mname`,`lname`, `email`, `password`, `DOB`, `phone`, `gender`, `country`, `profilePicture`,  `registrationDate`, `timezone`, `age`, `subjectid`, `city`) VALUES ('$fname','$mname','$lname', '$email', '$hash_password', '$dob', '$phone', '$gender', '$country', '$file_name', '$currentDate', 'UTC+05:00', '$age', '$subjectid', '$city')";

        $teacherResult = mysqli_query($conn, $teacher_sql);


        // Grabbing the teacherid of teacher to insert data in certification, education, languages and availability.
        $getting_teacherid = mysqli_query($conn, "SELECT * from teacher WHERE email ='$email'");
        $row = mysqli_fetch_assoc($getting_teacherid);
        $teacherid = $row['teacherid'];
        // echo $teacherid;

        $teacher_sql = "UPDATE `teacher` SET `teacherintro` = '$introduction', `experience` = '$experience', `description` = '$motivate', `headline` = '$headline', `videoLinks` = '$videoUrl', `rates` = '$rates' WHERE teacherid = '$teacherid'";

        $teacherResult = mysqli_query($conn, $teacher_sql);
        if (!$teacherResult) {
          echo "Error occurred" . mysqli_error($conn);
        }


        // Inserting the languages into Languages table using teacherid;
        foreach ($languages as $language) {

          $language_sql = "INSERT INTO `teacherlanguage` (`language`, `teacherid`) VALUES ('$language', '$teacherid')";
          $language_result = mysqli_query($conn, $language_sql);
        }

        // Inserting the education into teachereducation table using teacherid;
        if($edu_check){//checking if education is set or not

          for ($j = 0; $j < count($university); $j++) {
  
            $edu_sql = "INSERT INTO `teachereducation` (`institute`,`degree`, `degreeType`, `specialization`, `startYear`, `endYear`, `teacherid`) VALUES ('$university[$j]','$degree[$j]','$degree_type[$j]','$specialization[$j]','$startEduYear[$j]','$endEduYear[$j]', '$teacherid')";
            $edu_result = mysqli_query($conn, $edu_sql);
          }

        }

        //   Inserting into teachercertification
        if($cert_check){

          for ($i = 0; $i < count($subject); $i++) {
  
            $certificate_sql = "INSERT INTO `teachercertification` (`subjectid`,`certTitle`, `certLink`, `issued_by`, `certStartYear`, `certEndYear`, `teacherid`) VALUES ('$subject[$i]','$cert_title[$i]','$cert_link[$i]','$issued_by[$i]','$startYear[$i]','$endYear[$i]', '$teacherid')";
            $certificate_result = mysqli_query($conn, $certificate_sql);
  
          }

        }

        // Inserting teacher availability
        foreach ($availability as $dayAvailability) {
          $day = $dayAvailability['day'];
          $slots = $dayAvailability['slots'];

          foreach ($slots as $slot) {
            $start_time = $slot['start'];
            $end_time = $slot['end'];

            $availability_sql = "INSERT INTO teacheravailability (teacherid, day, start_time, end_time) 
                    VALUES ('$teacherid', '$day', '$start_time', '$end_time')";
            $availability_result = mysqli_query($conn, $availability_sql);

            if ($availability_result && $language_result && $teacherResult) {

              session_destroy();
              header("location: \iTutor\login.php");

            } else {

              echo "Error inserting record: " . $conn->error;

            }
          }
        }

      }


    }

  }

}


$page = "Tutor Form";
include "layout/header.php";
?>

<main>
  <!-- signup section start -->

  <section id="tutor-signup" class="container mx-auto" style="height: auto; width: 30%;">

    <form id="tutor-form" method="post" action="tutor-form.php" enctype="multipart/form-data">


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

      <div id="about-section" class="mb-5">

        <h2>About</h2>
        <p>Start creating your public tutor profile.</p>




        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="name" class="form-control" id="name" name="name" placeholder="Your Name"
            value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="email"
            value="<?php echo $_SESSION['email'] ?>" placeholder="Your Email" required readonly>
          <input type="password" class="visually-hidden" name="password" value="<?php echo $_SESSION['password'] ?>"
            readonly>
        </div>

        <div class="mb-3">
          <label for="subject" class="form-label">Subject you teach</label>
          <select class="form-select" name="subjectid"
            value="<?php echo isset($_POST['subjectid']) ? $_POST['subjectid'] : ''; ?>" required>
            <?php
            $subject_sql = "SELECT * FROM subject";
            $subject_result = mysqli_query($conn, $subject_sql);
            while ($subject_row = mysqli_fetch_array($subject_result)) {
              if ($subject_row['subjectid'] == 1) {
                echo "<option selected disabled>select subject</option>";
              }
              echo "<option value='" . $subject_row['subjectid'] . "'>" . $subject_row['subjectName'] . "</option>";
            }
            ?>
          </select>
        </div>

        <div id="language-container">
          <div class="mb-3">
            <label for="gender" class="form-label">Language</label>
            <select class="form-select" name="language[]">
              <?php
              $language_sql = "SELECT * FROM languages";
              $language_result = mysqli_query($conn, $language_sql);
              while ($language_row = mysqli_fetch_array($language_result)) {
                echo "<option value='" . $language_row['language'] . "'>" . $language_row['language'] . "</option>";
              }
              ?>
            </select>
          </div>
          <p id="add-language" style="cursor: pointer; color: #121113; text-decoration:underline;">Add another language
          </p>
        </div>


        <div class="mb-3">
          <label for="dob" class="form-label">DOB</label>
          <input type="date" class="form-control" id="dob" name="dob"
            value="<?php echo isset($_POST['dob']) ? $_POST['dob'] : ''; ?>" required>
        </div>

        <div class="mb-3">
          <label for="age" class="form-label">Age</label>
          <input type="number" class="form-control" id="age" name="age" min="18" max="120"
            value="<?php echo isset($_POST['age']) ? $_POST['age'] : ''; ?>" placeholder="Your age" required>
        </div>


        <div class="mb-3">
          <label for="phone" class="form-label">Phone Number</label>
          <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number"
            value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>" required>
        </div>

        <div class="mb-3">
          <label for="gender" class="form-label">Gender</label>
          <select class="form-select" name="gender"
            value="<?php echo isset($_POST['gender']) ? $_POST['gender'] : ''; ?>">
            <option selected value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="country" class="form-label">Country</label>
          <select class="form-select" name="country" required>
            <option selected disabled>Select country</option>
              <option value="pakistan">
                Pakistan
              </option>

          </select>
        </div>

        <div class="mb-3">
          <label for="city" class="form-label">City</label>
          <select class="form-select" name="city" required>
            <option selected disabled>Select city</option>
            <?php
            $cityList = citiesPakistan();
            foreach ($cityList as $city) {
              ?>
              <option value="<?php echo $city; ?>">
                <?php echo $city; ?>
              </option>

            <?php } ?>
          </select>
        </div>

      </div>

      <!-- Profile Picture -->
      <div id="picture-section" class="mb-5">

        <h2>Profile picture</h2>
        <label class="fw-bold py-3" style="font-size: 18px;">Make a great impression</label>

        <div class="mb-3">
          <input type="file" class="form-control visually-hidden" id="upload-button" name="picture"
            required>
          <button type="button" id="upload-button-alt" class="btn btn-md bg-green border border-dark border-2 me-2 mb-2"
            >Upload photo</button>
          <small style="color:#666;">JPG, JPEG or PNG format, maximum size 5MB.</small>
          <div id="image-preview" class="mt-2"></div>
        </div>

        <div class="mb-3">
          <label class="fw-bold py-3" style="font-size: 18px;">Tips for an amazing photo</label>
          <ul style="
            list-style: none;
            padding-left: 0;
            margin-bottom: 3rem;
          ">
            <li class="py-2">
              <img class="pe-2" src="images/tutor-form-demo-pic.png" style="background-size: cover; width: 100%;">
            </li>
            <li class="py-2 row">
              <div class="col-1"><img class="pe-2" src="images/svg/check-mark.svg"></div>
              <div class="col-11">Smile and look at the camera</div>
            </li>
            <li class="py-2 row">
              <div class="col-1"><img class="pe-2" src="images/svg/check-mark.svg"></div>
              <div class="col-11">Frame your head and shoulders</div>
            </li>
            <li class="py-2 row">
              <div class="col-1"><img class="pe-2" src="images/svg/check-mark.svg"></div>
              <div class="col-11">Your photo is centered and upright</div>
            </li>
            <li class="py-2 row">
              <div class="col-1"><img class="pe-2" src="images/svg/check-mark.svg"></div>
              <div class="col-11">Use neutral lighting and background</div>
            </li>
            <li class="py-2 row">
              <div class="col-1"><img class="pe-2" src="images/svg/check-mark.svg"></div>
              <div class="col-11">Your face and eyes are fully visible (except for religious reasons)</div>
            </li>
            <li class="py-2 row">
              <div class="col-1"><img class="pe-2" src="images/svg/check-mark.svg"></div>
              <div class="col-11">Avoid logos or contact information</div>
            </li>
            <li class="py-2 row">
              <div class="col-1"><img class="pe-2" src="images/svg/check-mark.svg"></div>
              <div class="col-11">You are the only person in the photo</div>
            </li>
          </ul>
        </div>



      </div>

      <div id="education-section" class="mb-5">

        <h2>Education</h2>
        <p>Tell students more about the higher education that you've
          completed or are working on</p>


        <div class="mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="has_education" id="has_education">
            <label class="form-check-label" for="flexCheckDefault">
              I don't have a higher education degree yet!
            </label>
          </div>
        </div>

        <div id="education-container">

          <div class="mb-3">
            <label for="university" class="form-label">College / University</label>
            <input type="text" class="form-control" id="university" name="university[]" required>
          </div>


          <div class="mb-3">
            <label for="degree-type" class="form-label">Degree type</label>
            <select id="startYear" class="form-select" name="degree_type[]" required>
              <option selected disabled value="">Select degree</option>
              <option value="">O'levels/Matric</option>
              <option value="">A'levels/Intermediate</option>
              <option value="">Associate Degree</option>
              <option value="">Bachelors</option>
              <option value="">Masters</option>
              <option value="">PHD</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="degree" class="form-label">Degree</label>
            <input type="text" class="form-control" id="degree" name="degree[]" required>
          </div>

          <div class="mb-3">
            <label for="specialization" class="form-label">Specialization</label>
            <input type="text" class="form-control" id="specialization" name="specialization[]" required>
          </div>

          <div class="mb-3 row">
            <label class="form-label">Years of study</label>

            <div class="col">
              <select id="startYear" class="form-select" name="startEduYear[]" required>
                <option selected disabled value=""></option>
                <?php
                $currentYear = date("Y");
                for ($year = 1950; $year <= $currentYear; $year++) {
                  echo "<option value='$year'>$year</option>";
                }
                ?>
              </select>
            </div>

            <div class="col">
              <select id="finalYear" class="form-select" name="endEduYear[]" required>
                <option selected disabled value=""></option>
                <?php
                for ($year = 1950; $year <= $currentYear; $year++) {
                  echo "<option value='$year'>$year</option>";
                }
                ?>
              </select>
            </div>
          </div>

          <p id="add-education" style="cursor: pointer; color: #121113; text-decoration:underline;">Add another
            education</p>

        </div>




      </div>

      <div id="certificate-section" class="mb-5">

        <h2>Certification</h2>
        <p>Do you have teaching certificates? If so, describe them to
          enhance your profile credibility and get more students.</p>


        <div class="mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="has_certificate" id="has_certificate">
            <label class="form-check-label" for="flexCheckDefault">
              I don't have any certifications yet!
            </label>
          </div>
        </div>

        <div id="certificate-container">


          <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <select class="form-select" name="subject[]">
              <?php
              $subject_sql = "SELECT * FROM subject";
              $subject_result = mysqli_query($conn, $subject_sql);
              while ($subject_row = mysqli_fetch_array($subject_result)) {
                if ($subject_row['subjectid'] == 1) {
                  echo "<option selected disabled>select subject</option>";
                }
                echo "<option value='" . $subject_row['subjectid'] . "'>" . $subject_row['subjectName'] . "</option>";
              }
              ?>
            </select>
          </div>


          <div class="mb-3">
            <label for="certificate" class="form-label">Certificate title</label>
            <input type="text" class="form-control" id="cert_title" name="cert_title[]" required>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Certificate link</label>
            <input type="text" class="form-control" id="cert_link" name="cert_link[]" required>
          </div>

          <div class="mb-3">
            <label for="issued-by" class="form-label">Issued by</label>
            <input type="text" class="form-control" id="issued-by" name="issued_by[]" required>
          </div>

          <div class="mb-3 row">
            <label class="form-label">Years of study</label>

            <div class="col">
              <select id="startYear" class="form-select" name="startYear[]">
                <option value="" selected disabled></option>
                <?php
                $currentYear = date("Y");
                for ($year = 1900; $year <= $currentYear; $year++) {
                  echo "<option value='$year'>$year</option>";
                }
                ?>
              </select>
            </div>

            <div class="col">
              <select id="endYear" class="form-select" name="endYear[]">
                <option value="" selected disabled></option>
                <?php
                for ($year = 1900; $year <= $currentYear; $year++) {
                  echo "<option value='$year'>$year</option>";
                }
                ?>
              </select>
            </div>
          </div>

          <p id="add-certificate" style="cursor: pointer; color: #121113; text-decoration:underline;">Add another
            certificate</p>

        </div>



      </div>

      <div id="profile-section" class="mb-5">

        <h2>Profile Description</h2>
        <p>This info will go on your public profile. Write it in the language
          you’ll be teaching. </p>


        <div id="profile-container">

          <div class="my-5">

            <label for="introduction" class="form-label" style="font-weight: bold;">1. Introduce yourself</label>

            <p class="py-3">Show potential students who you are! Share your teaching
              experience and passion for education and briefly mention your
              interests and hobbies.</p>

            <div class="form-floating">

              <textarea class="form-control" rows="10" cols="30" placeholder="Leave a comment here" id="introduction"
                name="introduction" style="height: 100px"></textarea>

              <span id="introduction-counter">0/100</span>

            </div>

          </div>

          <!-- Instruction text -->
          <div class="mb-3">
            <div class="d-flex align-items-start px-2 py-1" style="background-color:#CCE2FF;">
              <img class="pe-2" src="images/svg/warning-mark.svg">
              <p>Don't include your last name or present your information in a CV format.</p>
            </div>
          </div>

          <hr style="color: #999">

          <div class="mb-3 my-5">

            <label for="experience" class="form-label" style="font-weight: bold;">2. Teaching experience</label>

            <p class="py-3">Provide a detailed description of your relevant teaching
              experience. Include certifications, teaching methodology,
              education, and subject expertise.</p>

            <div class="form-floating">

              <textarea class="form-control" rows="10" cols="30" placeholder="Leave a comment here" id="experience"
                name="experience" style="height: 100px"></textarea>

              <span id="experience-counter">0/100</span>

            </div>

          </div>

          <hr style="color: #999">

          <div class="mb-3 my-5">

            <label for="motivate" class="form-label" style="font-weight: bold;">3. Motivate potential
              student</label>

            <p class="py-3">Encourage students to book their first lesson. Highlight the
              benefits of learning with you!</p>

            <div class="form-floating">

              <textarea class="form-control" rows="10" cols="30" placeholder="Leave a comment here" id="motivate"
                name="motivate" style="height: 100px"></textarea>

              <span id="motivate-counter">0/100</span>

            </div>

          </div>

          <!-- Instruction text -->
          <div class="mb-3">
            <div class="d-flex align-items-start px-1 py-1" style="background-color:#CCE2FF;">
              <img class="pe-2" src="images/svg/warning-mark.svg">
              <p>Do not include any information regarding free trial
                lessons or discounts, or any of your personal contact
                details</p>
            </div>
          </div>

          <hr style="color: #999">

          <div class="mb-3 my-5">

            <label for="headline" class="form-label" style="font-weight: bold;">4. Write a catchy headline</label>
            <p class="py-3">Your headline is the first thing students see about you. Make it
              attention-grabbing, write 15 - 10 words headline
              and encourage students to read your full description.</p>

            <div class="form-floating">

              <textarea class="form-control" rows="10" cols="30" placeholder="Leave a comment here" id="headline"
                name="headline" style="height: 100px"></textarea>

              <span id="headline-counter">0/100</span>

            </div>

          </div>



        </div>




      </div>

      <div id="availability-section" class="mb-5">

        <h2>Availability</h2>
        <p>GMT+5 Asia, karachi timezone will be followed.</p>
        <h5 for="availibility" class="form-label" style="font-weight: bold;">Set your availability</h5>
        <p class="py-3">Availability shows your potential working hours. Students can book lessons at this time.</p>


        <div id="monday" class="my-3">

          <div class="mb-3 form-check">
            <input class="form-check-input" type="checkbox" value="" name="day" id="day">
            <label class="form-check-label" id="dayName">Monday</label>
          </div>



          <div class="row timeslot-template toggle-day">
            <div class="col">
              <label for="start-time" class="form-label">From</label>
              <select class="form-select start-time" disabled>
                <option selected disabled></option>
                <?php
                $startTime = strtotime('00:00');
                $endTime = strtotime('23:00');
                $interval = 60 * 60; // 1 hour interval
                
                for ($time = $startTime; $time <= $endTime; $time += $interval) {
                  echo '<option value="' . date('H:i', $time) . '">' . date('H:i', $time) . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="col">
              <label for="end-time" class="form-label">To</label>
              <select class="form-select end-time" disabled>
                <option selected disabled></option>
                <?php
                for ($time = $startTime + $interval; $time <= $endTime + $interval; $time += $interval) {
                  echo '<option value="' . date('H:i', $time) . '">' . date('H:i', $time) . '</option>';
                }
                ?>
              </select>
            </div>
          </div>

          <p class="add-timeslot py-2"
            style="cursor: pointer; color: #121113; text-decoration:underline; opacity:.5; pointer-events:none;">Add
            another timeslot</p>




        </div>

        <div id="tuesday" class="my-3">

          <div class="mb-3 form-check">
            <input class="form-check-input" type="checkbox" value="" name="day" id="day">
            <label class="form-check-label" id="dayName">Tuesday</label>
          </div>



          <div class="row timeslot-template toggle-day">
            <div class="col">
              <label for="start-time" class="form-label">From</label>
              <select class="form-select start-time" disabled>
                <option selected disabled></option>
                <?php
                $startTime = strtotime('00:00');
                $endTime = strtotime('23:00');
                $interval = 60 * 60; // 1 hour interval
                
                for ($time = $startTime; $time <= $endTime; $time += $interval) {
                  echo '<option value="' . date('H:i', $time) . '">' . date('H:i', $time) . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="col">
              <label for="end-time" class="form-label">To</label>
              <select class="form-select end-time" disabled>
                <option selected disabled></option>
                <?php
                for ($time = $startTime + $interval; $time <= $endTime + $interval; $time += $interval) {
                  echo '<option value="' . date('H:i', $time) . '">' . date('H:i', $time) . '</option>';
                }
                ?>
              </select>
            </div>
          </div>

          <p class="add-timeslot py-2"
            style="cursor: pointer; color: #121113; text-decoration:underline; opacity:.5; pointer-events:none;">Add
            another timeslot</p>




        </div>

        <div id="wednesday" class="my-3">

          <div class="mb-3 form-check">
            <input class="form-check-input" type="checkbox" value="" name="day" id="day">
            <label class="form-check-label" id="dayName">Wednesday</label>
          </div>



          <div class="row timeslot-template toggle-day">
            <div class="col">
              <label for="start-time" class="form-label">From</label>
              <select class="form-select start-time" disabled>
                <option selected disabled></option>
                <?php
                $startTime = strtotime('00:00');
                $endTime = strtotime('23:00');
                $interval = 60 * 60; // 1 hour interval
                
                for ($time = $startTime; $time <= $endTime; $time += $interval) {
                  echo '<option value="' . date('H:i', $time) . '">' . date('H:i', $time) . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="col">
              <label for="end-time" class="form-label">To</label>
              <select class="form-select end-time" disabled>
                <option selected disabled></option>
                <?php
                for ($time = $startTime + $interval; $time <= $endTime + $interval; $time += $interval) {
                  echo '<option value="' . date('H:i', $time) . '">' . date('H:i', $time) . '</option>';
                }
                ?>
              </select>
            </div>
          </div>

          <p class="add-timeslot py-2"
            style="cursor: pointer; color: #121113; text-decoration:underline; opacity:.5; pointer-events:none;">Add
            another timeslot</p>




        </div>

        <div id="thurday" class="my-3">

          <div class="mb-3 form-check">
            <input class="form-check-input" type="checkbox" value="" name="day" id="day">
            <label class="form-check-label" id="dayName">Thursday</label>
          </div>



          <div class="row timeslot-template toggle-day">
            <div class="col">
              <label for="start-time" class="form-label">From</label>
              <select class="form-select start-time" disabled>
                <option selected disabled></option>
                <?php
                $startTime = strtotime('00:00');
                $endTime = strtotime('23:00');
                $interval = 60 * 60; // 1 hour interval
                
                for ($time = $startTime; $time <= $endTime; $time += $interval) {
                  echo '<option value="' . date('H:i', $time) . '">' . date('H:i', $time) . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="col">
              <label for="end-time" class="form-label">To</label>
              <select class="form-select end-time" disabled>
                <option selected disabled></option>
                <?php
                for ($time = $startTime + $interval; $time <= $endTime + $interval; $time += $interval) {
                  echo '<option value="' . date('H:i', $time) . '">' . date('H:i', $time) . '</option>';
                }
                ?>
              </select>
            </div>
          </div>

          <p class="add-timeslot py-2"
            style="cursor: pointer; color: #121113; text-decoration:underline; opacity:.5; pointer-events:none;">Add
            another timeslot</p>




        </div>

        <div id="friday" class="my-3">

          <div class="mb-3 form-check">
            <input class="form-check-input" type="checkbox" value="" name="day" id="day">
            <label class="form-check-label" id="dayName">Friday</label>
          </div>



          <div class="row timeslot-template toggle-day">
            <div class="col">
              <label for="start-time" class="form-label">From</label>
              <select class="form-select start-time" disabled>
                <option selected disabled></option>
                <?php
                $startTime = strtotime('00:00');
                $endTime = strtotime('23:00');
                $interval = 60 * 60; // 1 hour interval
                
                for ($time = $startTime; $time <= $endTime; $time += $interval) {
                  echo '<option value="' . date('H:i', $time) . '">' . date('H:i', $time) . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="col">
              <label for="end-time" class="form-label">To</label>
              <select class="form-select end-time" disabled>
                <option selected disabled></option>
                <?php
                for ($time = $startTime + $interval; $time <= $endTime + $interval; $time += $interval) {
                  echo '<option value="' . date('H:i', $time) . '">' . date('H:i', $time) . '</option>';
                }
                ?>
              </select>
            </div>
          </div>

          <p class="add-timeslot py-2"
            style="cursor: pointer; color: #121113; text-decoration:underline; opacity:.5; pointer-events:none;">Add
            another timeslot</p>




        </div>

        <div id="saturday" class="my-3">

          <div class="mb-3 form-check">
            <input class="form-check-input" type="checkbox" value="" name="day" id="day">
            <label class="form-check-label" id="dayName">Saturday</label>
          </div>



          <div class="row timeslot-template toggle-day">
            <div class="col">
              <label for="start-time" class="form-label">From</label>
              <select class="form-select start-time" disabled>
                <option selected disabled></option>
                <?php
                $startTime = strtotime('00:00');
                $endTime = strtotime('23:00');
                $interval = 60 * 60; // 1 hour interval
                
                for ($time = $startTime; $time <= $endTime; $time += $interval) {
                  echo '<option value="' . date('H:i', $time) . '">' . date('H:i', $time) . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="col">
              <label for="end-time" class="form-label">To</label>
              <select class="form-select end-time" disabled>
                <option selected disabled></option>
                <?php
                for ($time = $startTime + $interval; $time <= $endTime + $interval; $time += $interval) {
                  echo '<option value="' . date('H:i', $time) . '">' . date('H:i', $time) . '</option>';
                }
                ?>
              </select>
            </div>
          </div>

          <p class="add-timeslot py-2"
            style="cursor: pointer; color: #121113; text-decoration:underline; opacity:.5; pointer-events:none;">Add
            another timeslot</p>




        </div>

        <div id="sunday" class="my-3">

          <div class="mb-3 form-check">
            <input class="form-check-input" type="checkbox" value="" name="day" id="day">
            <label class="form-check-label" id="dayName">Sunday</label>
          </div>



          <div class="row timeslot-template toggle-day">
            <div class="col">
              <label for="start-time" class="form-label">From</label>
              <select class="form-select start-time" disabled>
                <option selected disabled></option>
                <?php
                $startTime = strtotime('00:00');
                $endTime = strtotime('23:00');
                $interval = 60 * 60; // 1 hour interval
                
                for ($time = $startTime; $time <= $endTime; $time += $interval) {
                  echo '<option value="' . date('H:i', $time) . '">' . date('H:i', $time) . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="col">
              <label for="end-time" class="form-label">To</label>
              <select class="form-select end-time" disabled>
                <option selected disabled></option>
                <?php
                for ($time = $startTime + $interval; $time <= $endTime + $interval; $time += $interval) {
                  echo '<option value="' . date('H:i', $time) . '">' . date('H:i', $time) . '</option>';
                }
                ?>
              </select>
            </div>
          </div>

          <p class="add-timeslot py-2"
            style="cursor: pointer; color: #121113; text-decoration:underline; opacity:.5; pointer-events:none;">Add
            another timeslot</p>

          <input type="hidden" id="schedule-data" name="schedule-data" />


        </div>

      </div>

      <div id="video-section" class="mb-5">

        <h2>Video introduction</h2>
        <label class="fw-bold py-3" style="font-size: 18px;">Add a horizontal video upto 2 minutes.</label>


        <div class="mb-3">
          <label for="video-link" class="form-label">Video link</label>
          <input type="text" class="form-control" id="video-link" name="video-link"
            placeholder="Insert your link here..." >
        </div>
        <div id="video-preview" class="mb-3"></div>
        <iframe width="100%" class="visually-hidden" src="" title="YouTube video player" frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
          referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>


        <label class="fw-bold py-3" style="font-size: 18px;">Video requirements</label>

        <div class="mb-3">
          <label class="fw-bold py-3" style="font-size: 18px;"><img class="pe-2"
              src="images/svg/green-tick.svg">Do</label>
          <ul style="
            list-style: none;
            padding-left: 0;
            margin-bottom: 3rem;
          ">
            <li class="py-2 row">
              <div class="col-1"><img src="images/svg/green-dot.svg"></div>
              <div class="col-11">Your video should be between 30
                seconds and 2 minutes long</div>
            </li>

            <li class="py-2 row">
              <div class="col-1"><img src="images/svg/green-dot.svg"></div>
              <div class="col-11">Record in horizontal mode and at eye
                level</div>
            </li>

            <li class="py-2 row">
              <div class="col-1"><img class="pe-2" src="images/svg/green-dot.svg"></div>
              <div class="col-11">
                Use good lighting and a neutral
                background
              </div>
            </li>

            <li class="py-2 row">
              <div class="col-1"><img class="pe-2" src="images/svg/green-dot.svg"></div>
              <div class="col-11">
                Use a stable surface so that your
                video does not appear shaky
              </div>
            </li>

            <li class="py-2 row">
              <div class="col-1"><img class="pe-2" src="images/svg/green-dot.svg"></div>
              <div class="col-11">
                Make sure your face and eyes are fully
                visible (except for religious reasons)
              </div>
            </li>

            <li class="py-2 row">
              <div class="col-1"><img class="pe-2" src="images/svg/green-dot.svg"></div>
              <div class="col-11">
                Highlight your teaching experience
                and any relevant teaching
                certification(s)
              </div>
            </li>

            <li class="py-2 row">
              <div class="col-1"><img class="pe-2" src="images/svg/green-dot.svg"></div>
              <div class="col-11">
                Greet your students warmly and
                invite them to book a lesson
              </div>
            </li>

          </ul>
        </div>

        <div class="mb-3">
          <label class="fw-bold py-3" style="font-size: 18px;"><img class="pe-2"
              src="images/svg/red-tick.svg">Don't</label>
          <ul style="
            list-style: none;
            padding-left: 0;
            margin-bottom: 3rem;
          ">

            <li class="py-2 row">
              <div class="col-1"><img src="images/svg/red-dot.svg"></div>
              <div class="col-11">Include your surname or any contact
                details</div>
            </li>

            <li class="py-2 row">
              <div class="col-1"><img src="images/svg/red-dot.svg"></div>
              <div class="col-11">Include logos or links</div>
            </li>

            <li class="py-2 row">
              <div class="col-1"><img src="images/svg/red-dot.svg"></div>
              <div class="col-11">se slideshows or presentations</div>
            </li>

            <li class="py-2 row">
              <div class="col-1"><img src="images/svg/red-dot.svg"></div>
              <div class="col-11">Have any other people visible in your
                video</div>
            </li>

          </ul>
        </div>



      </div>

      <div id="rate-section" class="mb-5">

        <h2>Set your base rate.</h2>
        <p>GMT+5 Asia, karachi timezone will be followed.</p>


        <div id="rate-container">

          <div class="mb-3">
            <input type="text" name="rate" class="form-control" id="rate">
            <div id="rate" class="form-text">Price in PKR</div>
          </div>


        </div>

      </div>


      <div id="submit-btn" class="mb-4">

        <button class="my-3 w-100 border border-2 border-dark btn btn-lg bg-green text-bold"
          style="font-weight: bold; font-size: 18px;">
          Complete Registration
        </button>

      </div>

    </form>



  </section>
  <!-- Login section end -->
</main>


<?php include ('layout/footer.php'); ?>