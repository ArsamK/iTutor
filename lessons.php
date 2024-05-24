<?php
session_start();
// error_reporting(E_ERROR | E_PARSE);



include 'config.php';
include 'functions.php';
$page = 'Profile view';
include ('layout/header.php');

?>

<main>

  <div class="container" style="min-height: 100vh;">

    <!-- UPCOMING -->
    <div class="upcoming mb-5">
      <h3 class="mb-4">Upcoming</h3>

      <?php
      $user_id = $_SESSION['userId'];
      $user_type = $_SESSION['userType'];
      $user_img = $_SESSION['userImg'];
      $user_name = $_SESSION['userName'];

      if ($user_type == 'Teacher') {
        $sql = "SELECT * FROM lessons WHERE teacherid = '$user_id' AND lessonStatus = 'Scheduled' ORDER BY lessonDate ASC, lessonTime ASC";


      } else {
        $sql = "SELECT * FROM lessons WHERE studentid = '$user_id' AND lessonStatus = 'Scheduled' ORDER BY lessonDate ASC, lessonTime ASC";
        // $lessons = mysqli_fetch_assoc($lesson_result);
        // $sql1 = "SELECT * FROM teacher WHERE teacherid = '$user_id'";
      }

      $lesson_result = mysqli_query($conn, $sql);
      if ($lesson_result) {
        $count = 1;
        while ($lessons = mysqli_fetch_assoc($lesson_result)) {
          $day = $lessons['lessonDay'];
          $date = $lessons['lessonDate'];
          $month = $lessons['lessonMonth'];
          $time = $lessons['lessonTime'];
          $lesson_time = ucfirst($day) . ', ' . $date . ' ' . date('F', mktime(0, 0, 0, $month, 1)) . ' at ' . $time;
          $lesson_status = $lessons['lessonStatus'];

          $subjectid = $lessons['subjectid'];
          $subject_sql = mysqli_query($conn, "SELECT * FROM subject WHERE subjectid = '$subjectid'");
          $subject_result = mysqli_fetch_assoc($subject_sql);
          $subject_name = $subject_result['subjectName'];

          //if user is a student than he will be shown the image and name of the teacher
          if ($user_type == 'Teacher') {
            $studentid = $lessons['studentid'];
            $sql1 = "SELECT * FROM student WHERE studentid = '$studentid'";
            $result1 = mysqli_query($conn, $sql1);
            if ($result1) {
              $row1 = mysqli_fetch_assoc($result1);
              $name = $row1['fname'] . ' ' . $row1['lname'];
              $img_url = 'uploads/images/' . $row1['profilePic'];
            }
          } else {  //if user is a teacher than he will be shown the image and name of the student.
            $teacherid = $lessons['teacherid'];
            $sql1 = "SELECT * FROM teacher WHERE teacherid = '$teacherid'";
            $result1 = mysqli_query($conn, $sql1);
            if ($result1) {
              $row1 = mysqli_fetch_assoc($result1);
              $name = $row1['fname'] . ' ' . $row1['lname'];
              $img_url = 'uploads/teacher_img/' . $row1['profilePicture'];
            }
          }



          ?>

          <table class="table">

            <tbody>

              <tr>
                <th scope="row"><?php echo $count ?></th>
                <td><img class="rounded-1 border border-1 border-dark" style="width:30px; height: 30px;"
                    src="<?php echo $img_url; ?>">
                </td>
                <td class="table-cell"><?php echo $name ?></td>
                <td class="table-cell"><?php echo $subject_name ?></td>
                <td class="table-cell"><?php echo $lesson_time; ?></td>
                <td class="table-cell"><?php echo $lesson_status; ?></td>
                <td class="table-cell"><a href="#">
                    <button class="btn bg-green border border-1 border-dark py-1">Join Session</button>
                  </a></td>
              </tr>
            </tbody>
          </table>

          <?php
          $count++;
        }
      } 
      
      if($count == 1){
      echo "<div>No upcoming lessons.</div>";
      }
      ?>

    </div>

    <!-- SORT BY TEACHER -->

    <div class="sortBy-teacer mb-5">
      <h3 class="mb-4"><?php echo $user_type == 'Teacher' ? 'Sort by student:' : 'Sort by teacher'; ?></h3>
      <?php
      if ($user_type == 'Teacher') {

        $distinct_ids_sql = "SELECT DISTINCT studentid FROM lessons WHERE teacherid = '$user_id'";
        $distinct_ids_result = mysqli_query($conn, $distinct_ids_sql);
      } else {
        $distinct_ids_sql = "SELECT DISTINCT teacherid FROM lessons WHERE studentid = '$user_id'";
        $distinct_ids_result = mysqli_query($conn, $distinct_ids_sql);
      }

      while ($distinct_ids = mysqli_fetch_assoc($distinct_ids_result)) {
        $distinct_id = $user_type == 'Teacher' ? $distinct_ids['studentid'] : $distinct_ids['teacherid'];
        $distinct_sql1 = $user_type == 'Teacher' ? "SELECT * FROM student WHERE studentid = '$distinct_id'" : "SELECT * FROM teacher WHERE teacherid = '$distinct_id'";
        $distinct_result1 = mysqli_query($conn, $distinct_sql1);
        if ($distinct_result1) {
          $row1 = mysqli_fetch_assoc($distinct_result1);
          $name = $row1['fname'] . ' ' . $row1['lname'];
          $img_url = $user_type == 'Teacher' ? 'uploads/images/' . $row1['profilePic'] : 'uploads/teacher_img/' . $row1['profilePicture'];
        }


        ?>
        <div class="mb-2">
          <div class="d-flex justify-content-start mb-2">
            <img class="rounded-1 border border-1 border-dark me-3" style="width:30px; height: 30px;"
              src="<?php echo $img_url ?>">
            <h4><?php echo $name; ?></h4>
          </div>
          <!-- first lesson -->
          <?php
          $lesson_sql = $user_type == 'Teacher' ? "SELECT * FROM lessons WHERE teacherid = '$user_id' AND studentid = '$distinct_id' ORDER BY lessonMonth DESC, lessonDate DESC, lessonTime DESC, lessonYear DESC" : "SELECT * FROM lessons WHERE studentid = '$user_id' AND teacherid = '$distinct_id' ORDER BY lessonMonth DESC, lessonDate DESC, lessonTime DESC, lessonYear DESC";

          $lesson_result = mysqli_query($conn, $lesson_sql);
          while ($lessons = mysqli_fetch_assoc($lesson_result)) {
            $day = $lessons['lessonDay'];
            $date = $lessons['lessonDate'];
            $month = $lessons['lessonMonth'];
            $time = $lessons['lessonTime'];
            $lesson_time = ucfirst($day) . ', ' . $date . ' ' . date('F', mktime(0, 0, 0, $month, 1)) . ' at ' . $time;
            $lesson_status = $lessons['lessonStatus'];

            $subjectid = $lessons['subjectid'];
            $subject_sql = mysqli_query($conn, "SELECT * FROM subject WHERE subjectid = '$subjectid'");
            $subject_result = mysqli_fetch_assoc($subject_sql);
            $subject_name = $subject_result['subjectName'];

            ?>

            <div class="d-flex justify-content-between mb-2 border-bottom border-2">

              <p><?php echo $lesson_time ?></p>
              <p><?php echo $subject_name ?></p>
              <p><?php echo $lesson_status ?></p>
              <a href="#">
                <button class="btn bg-green border border-1 border-dark py-1">Join Session</button>
              </a>
            </div>

          <?php } ?>

        </div>

      <?php } ?>

    </div>

    <div class="complete-calender container w-50">

      <?php
      // Get the current month and year
      $currentMonth = date('n');
      $currentYear = date('Y');

      // Get the number of days in the current month
      $numDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

      // Get the first day of the current month
      $firstDayOfMonth = new DateTime("$currentYear-$currentMonth-01");
      $firstDayOfWeek = $firstDayOfMonth->format('N'); // 1 (Monday) to 7 (Sunday)
      
      // Get the last day of the current month
      $lastDayOfMonth = new DateTime("$currentYear-$currentMonth-$numDaysInMonth");
      $lastDayOfWeek = $lastDayOfMonth->format('N'); // 1 (Monday) to 7 (Sunday)
      
      // Get the number of days to display from the previous month
      $numDaysPrevMonth = $firstDayOfWeek - 1;

      // Get the number of days to display from the next month
      $numDaysNextMonth = 7 - $lastDayOfWeek;

      // Get the previous month and year
      $prevMonth = $currentMonth - 1;
      $prevYear = $currentYear;
      if ($prevMonth == 0) {
        $prevMonth = 12;
        $prevYear--;
      }

      // Get the next month and year
      $nextMonth = $currentMonth + 1;
      $nextYear = $currentYear;
      if ($nextMonth == 13) {
        $nextMonth = 1;
        $nextYear++;
      }
      ?>

      <div class="mb-2 text-dark fs-5"><?php echo date('F'); ?></div>
      <div class="month-days d-flex justify-content-between mb-1">
        <div class="day-header w-100">Mon</div>
        <div class="day-header w-100 w-100">Tue</div>
        <div class="day-header w-100">Wed</div>
        <div class="day-header w-100">Thu</div>
        <div class="day-header w-100">Fri</div>
        <div class="day-header w-100">Sat</div>
        <div class="day-header w-100">Sun</div>
      </div>
      <div class="calendar mb-3">

        <?php
        // Display the days of the previous month
        for ($i = $numDaysPrevMonth; $i > 0; $i--) {
          $date = new DateTime("$prevYear-$prevMonth-$i");
          echo '<div class="day">' . $date->format('d') . '</div>';
        }

        // Display the days of the current month
        for ($day = 1; $day <= $numDaysInMonth; $day++) {
          $date = new DateTime("$currentYear-$currentMonth-$day");
          $hasClass = isset($classSchedule[$day]) && $classSchedule[$day];
          $class = $hasClass ? 'day highlight' : 'day';
          echo '<div class="' . $class . '">' . $date->format('d') . '</div>';
        }

        // Display the days of the next month
        for ($i = 1; $i <= $numDaysNextMonth; $i++) {
          $date = new DateTime("$nextYear-$nextMonth-$i");
          echo '<div class="day">' . $date->format('d') . '</div>';
        }
        ?>
      </div>


    </div>


  </div>



</main>


<?php
include ('layout/footer.php');
?>