<?php

include ('config.php');
include ('functions.php');

$currentYear = date("Y");
$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $hash_password = $_POST["password"];
  $dob = $_POST["dob"];
  $phone = $_POST["phone"];
  $gender = $_POST["gender"];
  $country = $_POST["country"];
  $age = $_POST["age"];
  $subjectid = $_POST['subjectid'];
  $languages = $_POST['language'];
  $currentDate = date('Y-m-d');
  $videoUrl = $_POST['video-link'];
  $rates = $_POST['rate'];
  $introduction = $_POST['introduction'];
  $experience = $_POST['experience'];
  $motivate = $_POST['motivate'];
  $headline = $_POST['headline'];

  if (isset($_FILES['picture'])) {

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

        $teacher_sql = "INSERT INTO `teacher` (`fname`,`mname`,`lname`, `email`, `password`, `DOB`, `phone`, `gender`, `country`, `profilePicture`,  `registrationDate`, `timezone`, `age`, `subjectid`, `teacherintro`, `experience`, `description`, `headline`, `videoLinks`, `rates`,) VALUES ('$fname','$mname','$lname', '$email', '$hash_password', '$dob', '$phone', '$gender', '$country', '$file_name', '$currentDate', 'UTC+05:00', '$age', '$subjectid', '$introduction', '$experience', '$motivate', '$headline', '$videoUrl', '$rates')";

        $teacherResult = mysqli_query($conn, $teacher_sql);

        // Grabbing the teacherid of teacher to input the languages 
        $getting_teacherid = mysqli_query($conn, "SELECT * from teacher WHERE email ='$email'");
        $row = mysqli_fetch_assoc($getting_teacherid);
        $teacherid = $row['teacherid'];

        // Inserting the languages into Languages table using teacherid;
        foreach ($languages as $language) {

          $language_sql = "INSERT INTO `teacherlanguage` (`language`, `teacherid`) VALUES ('$language', '$teacherid')";
          $language_result = mysqli_query($conn, $language_sql);
        }
      }

    }
  }
}

$page = "Tutor Form";
include "layout/header.php";
?>




<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body style="width:33%; margin: 0 auto">

  <form action="test.php" method="post">

    <div id="about-section" class="mb-5">

      <h2>About</h2>
      <p>Start creating your public tutor profile. Your progress will be
        automatically saved as you complete each section. You can
        return at any time to finish your registration.</p>




      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="name" class="form-control" id="name" name="name" placeholder="Your Name"
          value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" required>
      </div>

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Your Email" required>
        <input type="password" name="password">
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
        <select class="form-select" name="country"
          value="<?php echo isset($_POST['country']) ? $_POST['country'] : ''; ?>" required>
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


    </div>

    <div id="picture-section" class="mb-5">

      <h2>Profile picture</h2>
      <label class="fw-bold py-3" style="font-size: 18px;">Make a great impression</label>



      <div class="mb-3">
        <input type="file" class="form-control visually-hidden" id="upload-button" name="picture"
          onchange="handleFileSelect(event)" required>
        <button type="button" class="btn btn-md bg-green border border-dark border-2 me-2 mb-2"
          onclick="document.getElementById('upload-button').click();">Upload photo</button>
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
            attention-grabbing, mention your specific teaching language
            and encourage students to read your full description.</p>

          <div class="form-floating">

            <textarea class="form-control" rows="10" cols="30" placeholder="Leave a comment here" id="headline"
              name="headline" style="height: 100px"></textarea>

            <span id="headline-counter">0/100</span>

          </div>

        </div>



      </div>




    </div>

    <div id="video-section" class="mb-5">

      <h2>Video introduction</h2>
      <label class="fw-bold py-3" style="font-size: 18px;">Add a horizontal video upto 2 minutes.</label>


      <div class="mb-3">
        <label for="video-link" class="form-label">Video link</label>
        <input type="text" class="form-control" id="video-link" name="video-link" placeholder="Insert your link here..."
          oninput="previewVideo()">
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


        <div class="mb-3">
          <div class="d-flex align-items-start px-2 py-1" style="background-color:#CCE2FF;">
            <img class="pe-2" src="images/svg/warning-mark.svg">
            <p>Change your base rate in setting after approval.</p>
          </div>
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


  <?php include "layout/footer.php"; ?>
</body>

</html>


<div id="schedule" style="padding-top: 100px;">
  <h2 class="pb-3">Schedule</h2>
  <div style="opacity: 0.8;">

    <?php

    // Query to fetch the tutor's timetable
    $sql3 = "SELECT * FROM teacheravailability WHERE teacherid = $currentTeacherid ORDER BY start_time";
    $result3 = $conn->query($sql3);


    if ($result3->num_rows > 0) {
      $timetable = array();

      // Fetch each row and group by day
      while ($row3 = $result3->fetch_assoc()) {
        $day = $row3['day'];
        $timetable[$day][] = array(
          'start_time' => $row3['start_time'],
          'end_time' => $row3['end_time']
        );
      }

      // echo "<pre>";
      // print_r($timetable);
      // exit;
      // Display the timetable
      echo '<table>';
      echo '<tr><th>Day</th><th>Available Hours</th></tr>';

      foreach ($timetable as $day => $hours) {
        echo '<tr>';
        echo '<td>' . $day . '</td>';
        echo '<td>';

        // Display available hours with one-hour difference
        foreach ($hours as $hour) {
          $startTime = strtotime($hour['start_time']);
          $endTime = strtotime($hour['end_time']);

          // Split the time into one-hour intervals
          while ($startTime <= $endTime) {
            echo date('h:i A', $startTime) . ' - ';
            $startTime += 3600; // Add one hour
          }
        }

        echo '</td>';
        echo '</tr>';
      }

      echo '</table>';
    } else {
      echo "No timetable available.";
    }

    ?>
  </div>
</div>


<script>




  var selectors = document.querySelectorAll(".selector");
  var selectFields = document.querySelectorAll(".selectField");
  var optionsLists = document.querySelectorAll(".subject-list");
  var arrowIcons = document.querySelectorAll(".arrowIcon");
  var priceRange = document.querySelector("#priceRange");
  var priceValue = document.querySelector("#priceValue");

  selectors.forEach(function (selector, index) {
    var selectText = selector.querySelector(".selectText");
    var options = selector.querySelectorAll(".options");
    var subjectList = optionsLists[index];
    var arrowIcon = arrowIcons[index];

    selector.addEventListener("click", function (event) {
      event.stopPropagation();
      subjectList.classList.toggle("show");
      arrowIcon.classList.toggle("rotate");

      // if (subjectList.classList.contains("show")) {
      //   document.body.classList.add("background-fade");
      // } else {
      //   document.body.classList.remove("background-fade");
      // }
    });

    document.body.addEventListener("click", function () {
      subjectList.classList.remove("show");
      arrowIcon.classList.remove("rotate");
      // document.body.classList.remove("background-fade");
    });

    priceRange.addEventListener("input", function () {
      var minPrice = 500;
      var maxPrice = 5000;
      var priceRangeValue = this.value / 100;
      var price = minPrice + (maxPrice - minPrice) * priceRangeValue;
      priceValue.textContent = price.toFixed(0);
    });

    options.forEach(function (option) {
      option.addEventListener("click", function () {
        selectText.innerHTML = this.textContent;
        subjectList.classList.add("hide");
        arrowIcon.classList.remove("rotate");
        // console.log(searchText);
        // document.body.classList.remove("background-fade");
      });
    });
  });



  // Read more functionality

  var tutorCards = document.querySelectorAll('.tutor-card');
  var profileDescriptions = document.querySelectorAll(".profile-description");
  var readMoreLinks = document.querySelectorAll(".readMore");
  var profileDescriptionTexts = document.querySelectorAll(".profileDescriptionText");

  tutorCards.forEach(function (card, index) {
    var profileDescription = profileDescriptions[index];
    var readMoreLink = readMoreLinks[index];
    var profileDescriptionText = profileDescriptionTexts[index];

    readMoreLink.addEventListener("click", function (event) {
      event.preventDefault();

      var maxHeight = window.getComputedStyle(profileDescription).maxHeight;

      if (maxHeight === "250px") {
        profileDescription.style.maxHeight = "none";
        profileDescriptionText.classList.remove("hide");
        readMoreLink.textContent = "Read less";
      } else {
        profileDescription.style.maxHeight = "250px";
        profileDescriptionText.classList.add("hide");
        readMoreLink.textContent = "Read more";
      }
    });

  });



  // Grabbing the videoId and url as key value pair
  function videoPreview() {
    const videoUrls = document.querySelectorAll(".video-url");
    let videoIds = {};

    videoUrls.forEach(function (videoUrl) {
      let url = videoUrl.textContent.trim();
      let videoId;

      // Check if the URL is in the format: https://www.youtube.com/watch?v=gjVQl_gkCbc
      if (url.includes("youtube.com/watch?v=")) {
        videoId = url.split("v=")[1];
        if (videoId.includes("&")) {
          videoId = videoId.split("&")[0];
        }
      }
      // Share URL: Check if the URL is in the format: https://youtu.be/gjVQl_gkCbc?si=YpBqx_iVXRJZlK0E
      else if (url.includes("youtu.be/")) {
        videoId = url.split("youtu.be/")[1];
        if (videoId.includes("?")) {
          videoId = videoId.split("?")[0];
        }
      }

      if (videoId) {
        let url = `https://www.youtube-nocookie.com/embed/${videoId}?autoplay=1&rel=0`;
        videoIds[videoId] = url;
        let playButton = videoUrl.nextElementSibling; // Assuming play button is next to the video URL
        playButton.dataset.videoId = videoId;
      }
    });

    return videoIds;
  }


  // Video modal functionality


  const playButtons = document.querySelectorAll(".play-button");
  const videoModals = document.querySelectorAll(".video-modal");
  const videoFrames = document.querySelectorAll(".video-frame");
  var thumbnailImgs = document.querySelectorAll(".thumbnailImg");
  const VideoidToUrl = videoPreview();

  playButtons.forEach(function (playButton, index) {

    const videoModal = videoModals[index];
    const videoFrame = videoFrames[index];
    const videoid = playButton.dataset.videoId;
    // console.log(videoid);

    playButton.addEventListener("click", function () {
      videoModal.style.display = "block";
      videoFrame.src = VideoidToUrl[videoid];
      // https://youtu.be/Wl7hr5b8db4
    });

    let closeButton = videoModal.querySelector(".close");
    closeButton.addEventListener("click", function () {
      videoModal.style.display = "none";
      videoFrame.src = "";
    });

    window.addEventListener("click", function (event) {
      if (event.target === videoModal) {
        videoModal.style.display = "none";
        videoFrame.src = "";
      }
    });

  });







  // AJAX for thumbnail


  function apiUrls() {
    const videoUrls = document.querySelectorAll(".video-url");
    let apiUrls = {};

    videoUrls.forEach(function (videoUrl) {
      let url = videoUrl.textContent.trim();
      let videoId;

      // Check if the URL is in the format: https://www.youtube.com/watch?v=gjVQl_gkCbc
      if (url.includes("youtube.com/watch?v=")) {
        videoId = url.split("v=")[1];
        if (videoId.includes("&")) {
          videoId = videoId.split("&")[0];
        }
      }
      // Share URL: Check if the URL is in the format: https://youtu.be/gjVQl_gkCbc?si=YpBqx_iVXRJZlK0E
      else if (url.includes("youtu.be/")) {
        videoId = url.split("youtu.be/")[1];
        if (videoId.includes("?")) {
          videoId = videoId.split("?")[0];
        }
      }

      if (videoId) {
        const apiKey = "AIzaSyBY3alvfttcwtNPoYvXLBziDeVXJDwCrmE"; // Your YouTube Data API key
        var apiUrl =
          "https://www.googleapis.com/youtube/v3/videos?id=" +
          videoId +
          "&key=" +
          apiKey +
          "&part=snippet";

        apiUrls[videoId] = apiUrl;
      }
    });

    return apiUrls;
  }


  // var apiValues = Object.values(apis);
  // console.log(apiValues);

  // var videoIds = [];
  // playButtons.forEach(function(playButton){
  //   var videoId = playButton.dataset.videoId;
  //   videoIds.push(videoId);
  // });
  // console.log(videoIds);



  const apis = apiUrls();
  var thumbnailImgs = document.getElementsByClassName('thumbnailImg');
  playButtons.forEach(function (playButton, index) {

    var videoId = playButton.dataset.videoId;
    // console.log(videoId);

    $.ajax({
      url: apis[videoId],
      method: "GET",
      success: function (response) {
        // console.log(response);
        var thumbnailUrl = response.items[0].snippet.thumbnails.medium.url;
        var thumbnailImg = thumbnailImgs[index];
        // console.log(thumbnailImg);
        thumbnailImg.src = thumbnailUrl;
      },
      error: function () {
        console.error("Error fetching video details");
      },
    });

  });



</script>



<!-- important data -->
<?php

$limit = 5;


if (isset($_GET['pageNum'])) {
  $pageNum = $_GET['pageNum'];
} else {
  $pageNum = 1;
}
$offset = ($pageNum - 1) * $limit;


$sql = "SELECT * FROM teacher ORDER BY teacherid ASC LIMIT {$offset}, {$limit}";
// $sql = "SELECT * FROM teacher";

$result = mysqli_query($conn, $sql);
if (!$result) {

  die('Error while fetching --> ' . mysqli_error($conn));

} else { //Grabbing the teacher info:

  if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
      $currentTeacherid = $row['teacherid'];

      // truncating the name
      $fname = $row['fname'];
      $fname = ucfirst($fname);
      $lname = $row['lname'];
      $lname = ucfirst(substr($lname, 0, 1));

      // Grabbing the subject name
      $currentSubjectid = $row['subjectid'];
      $sql1 = "SELECT subjectName FROM subject WHERE subjectid = '$currentSubjectid'";
      $result1 = mysqli_query($conn, $sql1);
      if ($result1) {
        $row1 = mysqli_fetch_assoc($result1);
      }

      // Grabbing the language
      $sql2 = "SELECT language FROM `teacherlanguage` WHERE `teacherid` = '$currentTeacherid'";
      $result2 = mysqli_query($conn, $sql2);

      if ($result2) {
        $count = 0;
        $languages = array();
        while ($row2 = mysqli_fetch_assoc($result2)) {
          $count += 1;
          $languages[] = $row2['language'];
          // echo $row2['language'] . "<br>";
        }

        // setting the language text
        if ($count > 1) {
          $languageText = 'Speaks' . $languages[0] . '(Proficient),' . $languages[1] . '(Native)';
        } else {
          $languageText = 'Speaks' . $languages[0] . '(Proficient)';
        }
      }



      ?>



      <div class="row my-3 tutor-card">

        <!-- profile picture, details and price section -->
        <div class="col-lg-8 border border-2 border-dark rounded-2 " style="min-height:250px;">


          <!-- Tutor profile display start -->
          <div class="row py-3">
            <!-- tutor image and active sign -->
            <div class="col-lg-3">

              <div class="tutor-img position-relative rounded-1 border border-dark"
                style="height: 150px; width: 150px; overflow: hidden;">
                <img src="uploads\teacher_img\<?php echo $row['profilePicture']; ?>" class="img-fluid"
                  style="width: 100%; height: auto;">
                <div class="border border-2 border-light rounded-1 bg-success position-absolute"
                  style="height:20px;width:20px; top:80%; left:80%;"></div>
              </div>

            </div>

            <!-- tutor description -->
            <div class="col-lg-5">
              <!-- tutor name -->
              <h3 class="pb-2">
                <?php echo $fname . ' ' . $lname; ?>.
                <span><img src="images/svg/black-tick.svg"></span>
                <span><img src="images/svg/flag-pakistan.svg"></span>
              </h3>

              <div>
                <div>
                  <span><img style="width:15px;" src="images/svg/graduation-cape.svg"></span>
                  <span style="font-size:14px;"><span>
                      <?php echo $row1['subjectName']; ?>
                    </span>
                </div>
                <div>
                  <span><img style="width:15px;" src="images/svg/person.svg"></span>
                  <span style="font-size:14px;">11 active students.57 lessons</span>
                </div>
                <div>
                  <span><img style="width:15px;" src="images/svg/location.svg"></span>
                  <span style="font-size:14px;">
                    <?php echo $row['city']; ?>
                  </span>
                </div>
                <div>
                  <span><img style="width:15px;" src="images/svg/language-sign.svg"></span>
                  <span style="font-size:14px;">
                    <?php echo $languageText; ?>
                  </span>
                </div>
              </div>

              <div class="profile-description" style="max-height: 250px; overflow: hidden;">
                <p class="fw-bold my-3">
                  <?php echo $row['headline']; ?>
                </p>

                <p id="profileDescriptionText" class="hide mt-3 profileDescriptionText">
                  <?php echo $row['teacherintro'] . '<br>' . $row['experience']; ?>

                </p>
                <a href="#" id="readMore" class="text-dark fw-bold readMore">Read more</a>
              </div>

            </div>

            <!-- tutor's ratings, price and buttons -->
            <div class="col-lg-4">

              <!-- Ratings and price -->
              <div class="row pb-5">
                <div class="col">
                  <div class="fw-bold fs-5"><img src="images/svg/star.svg">5</div>
                  <div style="font-size:12px">4 reviews</div>
                </div>
                <div class="col">
                  <div class="fw-bold fs-5">PKR
                    <?php echo floor($row['rates']); ?>
                  </div>
                  <div style="font-size:12px">55-min lesson</div>
                </div>
              </div>

              <!-- Buttons -->

              <div class="row pt-3">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <a href="#">
                    <button class="py-2 px-4 my-1 fw-bold bg-green border border-2 rounded-2 border-dark w-100">Book
                      trial
                      lesson</button>
                  </a>
                </div>
                <div class="ol-lg-12 col-md-12 col-sm-12">
                  <a href="#">
                    <button class="py-2 px-4 my-1 fw-bold bg-white border border-2 rounded-2 border-dark w-100">Send
                      message</button>
                  </a>
                </div>
              </div>


            </div>

          </div>
          <!-- Tutor profile display end-->
        </div>

        <!-- Tutor video display start -->
        <div class="col-lg-4">

          <div class="video-display position-relative">
            <div class="visually-hidden video-url">
              <?php echo $row['videoLinks']; ?>
            </div>
            <div class="play-button bg-green" id="playButton"></div>
            <div class="video-container">
              <div id="thumbnail-container" class="thumbnail-container"><img id="thumbnailImg"
                  class="thumbnailImg border border-2 border-dark rounded-2" width="100%"></div>
            </div>
          </div>

          <div id="videoModal" class="modal video-modal">
            <div class="modal-content">
              <span class="close">&times;</span>
              <div class="video-container">
                <iframe id="videoFrame" class="rounded-2 video-frame" frameborder="0"
                  allow="accelerometer; encrypted-media; gyroscope; picture-in-picture;"
                  referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
              </div>
            </div>
          </div>

          <div>
            <a href="profile-view.php?id=<?php echo $currentTeacherid;?>">
              <button class="py-2 px-4 my-1 fw-bold bg-green border border-2 rounded-2 border-dark w-100">View full
                schedule</button>
            </a>
          </div>
        </div>
        <!-- Tutor video display end-->



      </div>
    <?php
    }
    $query = strpos($sql, "ORDER");
    $firstHalf = substr($sql, 0, $query);
    $sql3 = $firstHalf;
    $result3 = mysqli_query($conn, $sql3) or die("Query failed!");
    if (mysqli_num_rows($result3) > 0) {
      $totalRecords = mysqli_num_rows($result3);

      $totalPages = ceil($totalRecords / $limit);

      echo '<ul class="pagination pagination-custom">';
      if ($pageNum > 1) {
        echo '<li class="page-item">
              <a class="page-link" href="find-tutor.php?pageNum=' . ($pageNum - 1) . '">Prev</a>
            </li>';
      }
      for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $pageNum) {
          $active = "active";
        } else {
          $active = "";
        }
        echo '<li class="page-item ' . $active . '"><a class="page-link" href="find-tutor.php?pageNum=' . $i . '">' . $i . '</a></li>';
      }
      if ($totalPages > $pageNum) {
        echo '<li class="page-item">
              <a class="page-link" href="find-tutor.php?pageNum=' . ($pageNum + 1) . '">Next</a>
            </li>';
      }
      echo '</ul>';

    }

  } else {
    $error = 'No tutor for this subject';
  }
}
?>
<!-- arsam khan  -->
<!-- important data -->