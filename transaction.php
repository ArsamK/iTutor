<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
include 'config.php';
$page = 'Payment';
if($_SERVER['REQUEST_METHOD'] == "GET"){
  include("layout/header.php");
}

$teacherId = $_GET['id'];
$date = $_GET['date'];
$month = $_GET['month'];
$year = $_GET['year'];
$time = $_GET['time'];
$day = $_GET['day'];
$studentid = $_SESSION['userId'];
$duration = 55;
$currentTime = time();
$currentDate = date('d');


$sql = "SELECT rates, subjectid FROM teacher WHERE teacherid = '$teacherId'";
$result = mysqli_query($conn, $sql);
if (!$result) {
  die('Error while fetching --> ' . mysqli_error($conn));
} else{
  $row = mysqli_fetch_assoc($result);
  $rates =  $row['rates'];
  
  $currentSubjectid = $row['subjectid'];
  $sql1 = "SELECT subjectName FROM subject WHERE subjectid = '$currentSubjectid'";
  $result1 = mysqli_query($conn, $sql1);
  if ($result1) {
    $row1 = mysqli_fetch_assoc($result1);
    $subjectName = $row1['subjectName'];
  }
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $sql2 = "SELECT * FROM lessons WHERE lessonTime = '$time' AND lessonDate = '$date' AND lessonMonth = '$month' AND lessonYear = '$year' AND lessonDay = '$day' AND teacherid = '$teacherId'";
  $check_time_result = mysqli_query($conn, $sql2);
  // $check_time = mysqli_fetch_assoc($check_time_result);
  if(mysqli_num_rows($check_time_result) > 0){
    echo '<script>alert("Timeslot is already booked"); window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
  
  } else{
    $inputTimeStamp = strtotime($time);

    if(($currentTime > $inputTimeStamp) && ($currentDate == $date)){
          echo '<script>alert("Slot\'s time has passed! Book another"); window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";</script>';

      
    } else{

    $sql3 = "INSERT INTO lessons (lessonDate, lessonTime, lessonMonth, lessonYear, lessonDay, duration, price, lessonStatus, teacherid, studentid, subjectid) VALUES('$date', '$time', '$month', '$year', '$day', $duration, '$rates', 'Scheduled', '$teacherId', '$studentid', '$currentSubjectid' )";
    $result3 = mysqli_query($conn, $sql3);
    if(!$result3){
      echo "Error in submission". mysqli_error($conn);
    } else{
        echo '<script>alert("Successfully booked your slot at '.ucfirst($day).', '. $date .' '. date('F', mktime(0, 0, 0, $month, 1)) .' at ' . $time.'"); window.location.href = "lessons.php";</script>';

    }

    }

  }
  
}
?>

<main>
  <div class="container w-75 " >
    <div class="row">
      <div class="col-lg-5 border border-dark border-2 rounded-2 py-4">

        <div class="row pb-4">
          <div class="col-2">
            <img class="border border-1 border-dark rounded-2" style="width: 50px; height: 50px;" src="uploads\teacher_img\1711681229_2408862b2f1ea2e5.jpeg">
          </div>
          <div class="col-10">
            <div class="pb-1" style="font-size:14px; font-color: #121117; opacity:0.9;"><?php echo $subjectName?> <span><img src="images/svg/flag-pakistan.svg"></span></div>
            <div>PKR <?php echo $rates?></div>
          </div>
        </div>
        
        <div class="py-4" style="border-top:2px solid #121117; border-bottom:2px solid #121117;">
          <div class="fw-bold fs-6"><?php echo ucfirst($day).', '. $date .' '. date('F', mktime(0, 0, 0, $month, 1)) .' at ' . $time?></div>
          <div class="fs-6" style="font-color: #121117; opacity:0.9;">Time based on Asia zone.</div>
        </div>

        <div class="py-4">
          <h4>Your Order</h4>
          <div class="row">
            <div class="col-6" style="font-color: #121117; opacity:0.9;">55-min lesson</div>
            <div class="col-6" style="font-color: #121117; opacity:0.9;">PKR <?php echo $rates?></div>
            <div class="col-6 fw-bold fs-4 pt-2">Total</div>
            <div class="col-6 fw-bold fs-4 pt-2">PKR <?php echo $rates?></div>
          </div>
        </div>

      </div>

      <div class="col-lg-7">
        <h3>Choose how to pay</h3>
        <form action="#" method="post">

          <div class="my-4">
            <label for="accountNum" class="form-label"><img style="width:30px;" src="images/svg/easypaisa.svg">Easypaisa</label>
            <input type="text" class="form-control" id="account-num" name="account-num" placeholder="Your Account Number" required>
          </div>
          <input class="form-control" type="submit" value="Confirm payment">
        </form>
      </div>

    </div>
  </div>
</main>