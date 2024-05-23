<?php
session_start();
error_reporting(E_ERROR | E_PARSE);

if (!isset($_GET['id']) || empty($_GET['id'])) {
  header('location: find-tutor.php');
}

include 'config.php';
include 'functions.php';
$page = 'Profile view';
include ('layout/header.php');



$isLoggedIn = isset($_SESSION['userId'])? true: 0;

$id = $_GET['id'];
$sql = "SELECT * FROM teacher WHERE teacherid = $id";

$result = mysqli_query($conn, $sql);
if (!$result) {

  die('Error while fetching --> ' . mysqli_error($conn));

} else { //Grabbing the teacher info:

  if (mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_assoc($result);
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



  }
}

?>
<?php
if (isset($_GET['alert'])) {
  $alertMessage = htmlspecialchars($_GET['alert']);
  echo "<script>alert('$alertMessage');</script>";
}
?>

<main>

  <div class="container">
    <!-- main row -->
    <div class="row">
      <!-- First column start -->
      <div class="col-lg-7 py-2">
        <div class="row">

          <!-- Picture -->
          <div class="col-lg-4">
            <div class="tutor-img position-relative rounded-1 border border-dark"
              style="height: 180px; width: 180px; overflow: hidden;">
              <img src="uploads\teacher_img\<?php echo $row['profilePicture']; ?>" class="img-fluid"
                style="width: 100%; height: auto;">
              <div class="border border-2 border-light rounded-1 bg-success position-absolute"
                style="height:20px;width:20px; top:80%; left:80%;"></div>
            </div>
          </div>


          <!-- Description -->
          <div class="col-lg-8">
            <h2>
              <?php echo $fname . ' ' . $lname; ?>.
              <span><img src="images/svg/flag-pakistan.svg"></span>
              </h3>
              <div class="profile-description" style="max-height: 250px; overflow: hidden;">
                <p class="mb-3">
                  <?php echo $row['headline']; ?>
                </p>

              </div>

              <div>

                <div class="pb-1">
                  <span><img style="width:18px;" src="images/svg/graduation-cape.svg"></span>
                  <span style="font-size:16px; opacity:0.8"><span>
                      <?php echo $row1['subjectName']; ?>
                    </span>
                </div>
                <div class="pb-1">
                  <span><img style="width:18px;" src="images/svg/person.svg"></span>
                  <span style="font-size:16px; opacity:0.8">11 active students.57 lessons</span>
                </div>
                <div class="pb-1">
                  <span><img style="width:18px;" src="images/svg/location.svg"></span>
                  <span style="font-size:16px; opacity:0.8">
                    <?php echo $row['city']; ?>
                  </span>
                </div>

                <div>
                  <span><img style="width:18px;" src="images/svg/language-sign.svg"></span>
                  <span style="font-size:16px; opacity:0.8">
                    <?php echo $languageText; ?>
                  </span>
                </div>

              </div>



          </div>
        </div>



        <div class="button d-flex align-items-center justify-content-between pt-5 pb-3 sticky-top bg-white px-1"
          id="buttonContainer">
          <div><a class="link-item" href="#about">About</a></div>
          <div><a class="link-item" href="#schedule">Schedule</a></div>
          <div><a class="link-item" href="#education">Education</a></div>
          <div><a class="link-item" href="#certification">Certification</a></div>
        </div>


        <div class="d-flex flex-column align-items-stretch">

          <div id="about" style="padding-top: 100px; line-height:1.7;">
            <h2 class="pb-3">About the tutor</h2>
            <div style="opacity:0.8;">
              <p><?php echo $row['teacherintro']; ?> <br></p>
              <p><?php echo $row['experience']; ?> <br></p>
              <p><?php echo $row['description']; ?></p>
            </div>
          </div>

          <div id="schedule" style="padding-top: 100px;">

            <div class="d-flex align-items-center justify-content-between mb-3">
              <div class="visually-hidden islogin"><?php echo $isLoggedIn?></div>
              <h2>Schedule</h2>
              <div>
                <span id="backwardArrow" style="cursor:pointer"><img class="schedule-arrow" style="transform:rotate(180deg); border: 2px solid #121117; border-radius: 0 5px 5px 0; padding: 1px 5px;margin-right:2px;" src="images/svg/schedule-arrow.svg"></span>

                <span id="weekRange">
                <?php
                // Calculate the start and end dates of the current week
                $startOfWeek = date('M d', strtotime('this week'));
                $endOfWeek = date('M d', strtotime('this week +6 days'));
                echo $startOfWeek . ' - ' . $endOfWeek;
                ?>
                </span>

                <span id="forwardArrow" style="cursor:pointer"><img class="schedule-arrow" style="border: 2px solid #121117; border-radius: 0 5px 5px 0; padding: 1px 5px;margin-left:2px;" src="images/svg/schedule-arrow.svg"></span>

                

              </div>
              <div class="timezone border border-2 border-dark rounded-1 p-2">
                Karachi, Asia (GMT+5)
              </div>
            </div>

            <div style="opacity: 0.8;">
              <?php
              // Query to fetch the tutor's timetable
              $sql3 = "SELECT * FROM teacheravailability WHERE teacherid = $currentTeacherid ORDER BY start_time";
              $result3 = mysqli_query($conn, $sql3);

              if ($result3->num_rows > 0) {
                $timetable = array();

                // Fetch each row and group by day
                while ($row3 = mysqli_fetch_assoc($result3)) {
                  $day = $row3['day'];

                  $timetable[$day][] = array(
                    'start_time' => $row3['start_time'],
                    'end_time' => $row3['end_time']
                  );
                }

                echo '<div class="row">';

                // Loop through each day of the week
                foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day) {
                  echo '<div class="col">';
                  echo '<h4 class="text-dark">' . substr(ucfirst($day), 0, 3) . '</h4>';

                  // Calculate the date for the current day in the loop
                  $date = date('d', strtotime("$day this week"));
                  // echo '<div class="pb-3">' . $date . '</div>';
                  echo '<div class="pb-3 fs-5 date-column"></div>';

                  // Check if timetable has entry for the day
                  if (isset($timetable[$day])) {
                    // Display available hours with one-hour difference
                    foreach ($timetable[$day] as $hour) {
                      $startTime = strtotime($hour['start_time']);
                      $endTime = strtotime($hour['end_time']);

                      // Split the time into one-hour intervals
                      while ($startTime <= ($endTime - 3600) ) {
                        echo '<a class="text-decoration-none text-dark timeslot-url disable-if-not-logged-in" href="transaction.php?id='. $currentTeacherid .'&time=' . date('H:i', $startTime) . '&day='.$day.'"><div class="p-0 fs-6">' . date('H:i', $startTime) . '</div></a><br>';
                        $startTime += 3600; // Add one hour
                      }
                    }
                  } 

                  echo '</div>';
                }

                echo '</div>';

              } else {
                echo "No timetable available.";
              }

              ?>
            </div>
          </div>

          <div id="education" style="padding-top: 100px;">
            <h2 class="pb-3">Education</h2>

            <div style="opacity:0.8;">

              <?php
              $sql4 = "SELECT * FROM teachereducation WHERE teacherid = $currentTeacherid";
              $result4 = mysqli_query($conn, $sql4);
              if (mysqli_num_rows($result4) > 0) {

                while ($row4 = mysqli_fetch_assoc($result4)) {

                  echo '<div class="row">';
                  echo '<div class="col-lg-4">' . $row4['startYear'] . ' — ' . $row4['endYear'] . '</div>';
                  echo '<div class="col-lg-8 pb-2">' . $row4['degree'] . '</div>';
                  echo '</div>';
                }

              } else {
                echo "<span>No Education available.</span>";
              } ?>


            </div>
          </div>

          <div id="certification" style="padding-top: 100px;">
            <h2 class="pb-3">Certification</h2>

            <div style="opacity:0.8;">

              <?php
              $sql5 = "SELECT * FROM teachercertification WHERE teacherid = $currentTeacherid";
              $result5 = mysqli_query($conn, $sql5);
              if (mysqli_num_rows($result5) > 0) {

                echo '<div class="row" style="opacity:0.8;">';

                while ($row5 = mysqli_fetch_assoc($result5)) {

                  ?>

                  <div class="col-lg-4"><?php echo $row5['certStartYear']; ?> — <?php echo $row5['certEndYear']; ?></div>
                  <div class="col-lg-8">
                    <p class="m-0"><?php echo $row5['certTitle']; ?></p>
                    <p>By: <?php echo $row5['issued_by']; ?></p>
                  </div>

                <?php }
                echo '</div>';

              } else {
                echo "No certification available";
              } ?>

            </div>

          </div>


        </div>

      </div>

      <!-- Second column start -->
      <div class="col-lg-5">

        <div class="sticky-top py-2">
          <div class="video-card p-2 rounded-2 "
            style="background: #fff; box-shadow: 5px 5px 10px #a8a7ae; width: 80%;">



            <div class="video-container position-relative">

              <div class="visually-hidden video-url">
                <?php echo videoPreview($row['videoLinks']) ?>
              </div>

              <div class="play-button bg-green" id="playButton"></div>

              <div class="thumbnail-display">
                <div id="thumbnail-container" class="thumbnail-container"><img id="thumbnailImg"
                    class="thumbnailImg border border-2 border-dark rounded-2" width="100%"></div>
              </div>

              <iframe class="frame-hide" id="videoFrame" class="rounded-2 video-frame" frameborder="0"
                allow="accelerometer; encrypted-media; gyroscope; picture-in-picture;"
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

            </div>

            <!-- Ratings and price -->
            <div class="row py-3 text-center">
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

    </div>
  </div>


</main>


<?php
include ('layout/footer.php');
?>