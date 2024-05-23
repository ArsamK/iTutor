<?php
error_reporting(E_ERROR | E_PARSE);
include 'config.php';
include 'functions.php';
$output = "";
$url = $_POST['url'];


if (isset($_POST['pageNum'])) {
  $pageNum = $_POST['pageNum'];
} else {
  $pageNum = 1;
}

$limit = 5;
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

      // Tutor data part

      $output .= '<div class="row my-3 tutor-card">';
      $output .= '<div class="col-lg-8 border border-2 border-dark rounded-2 " style="min-height:250px;">';
      $output .= '<!-- Tutor profile display start -->
            <div class="row py-3">';
      $output .= '<div class="col-lg-3">
                  <div class="tutor-img position-relative rounded-1 border border-dark"
                    style="height: 150px; width: 150px; overflow: hidden;">
                    <a href="profile-view.php?id=' . $currentTeacherid . '"><img src="uploads\teacher_img\\' . $row['profilePicture'] . '" class="img-fluid"
                      style="width: 100%; height: auto;"></a>
                    <div class="border border-2 border-light rounded-1 bg-success position-absolute"
                      style="height:20px;width:20px; top:80%; left:80%;"></div>
                  </div>
                </div>';

      $output .= '<div class="col-lg-5">
                <!-- tutor name -->
                <h3 class="pb-2">
                  ' . $fname . ' ' . $lname . '.
                  <span><img src="images/svg/black-tick.svg"></span>
                  <span><img src="images/svg/flag-pakistan.svg"></span>
                </h3>
                
                <div>
                  <div>
                    <span><img style="width:15px;" src="images/svg/graduation-cape.svg"></span>
                    <span style="font-size:14px;"><span>' . $row1['subjectName'] . '</span></span>
                  </div>
                  <div>
                    <span><img style="width:15px;" src="images/svg/person.svg"></span>
                    <span style="font-size:14px;">11 active students.57 lessons</span>
                  </div>
                  <div>
                    <span><img style="width:15px;" src="images/svg/location.svg"></span>
                    <span style="font-size:14px;">' . $row['city'] . '</span>
                  </div>
                  <div>
                    <span><img style="width:15px;" src="images/svg/language-sign.svg"></span>
                    <span style="font-size:14px;">' . $languageText . '</span>
                  </div>
                </div>
                
                <div class="profile-description" style="max-height: 250px; overflow: hidden;">
                  <p class="fw-bold my-3">' . $row['headline'] . '</p>
                  <p id="profileDescriptionText" class="hide mt-3 profileDescriptionText">' . $row['teacherintro'] . '<br>' . $row['experience'] . '</p>
                  <a href="#" id="readMore" class="text-dark fw-bold readMore">Read more</a>
                </div>
              </div>';
      $output .= '<div class="col-lg-4">
              <!-- Ratings and price -->
              <div class="row pb-5">
                <div class="col">
                  <div class="fw-bold fs-5"><img src="images/svg/star.svg">5</div>
                  <div style="font-size:12px">4 reviews</div>
                </div>
                <div class="col">
                  <div class="fw-bold fs-5">PKR ' . floor($row['rates']) . '</div>
                  <div style="font-size:12px">55-min lesson</div>
                </div>
              </div>
              
              <!-- Buttons -->
              <div class="row pt-3">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <a href="profile-view.php?id='.$currentTeacherid.'#schedule">
                    <button class="py-2 px-4 my-1 fw-bold bg-green border border-2 rounded-2 border-dark w-100">Book trial lesson</button>
                  </a>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <a href="#">
                    <button class="py-2 px-4 my-1 fw-bold bg-white border border-2 rounded-2 border-dark w-100">Send message</button>
                  </a>
                </div>
              </div>
            </div>';

      $output .= '</div>
            <!-- Tutor profile display end-->
            </div>';

      $output .= '<div class="col-lg-4">
            <!-- Tutor video display start -->
            <div class="video-display position-relative">
              <div class="visually-hidden video-url">' . $row['videoLinks'] . '</div>
              <div class="play-button bg-green" id="playButton"></div>
              <div class="video-container">
                <div id="thumbnail-container" class="thumbnail-container"><img id="thumbnailImg" class="thumbnailImg border border-2 border-dark rounded-2" width="100%"></div>
              </div>
            </div>

            <div id="videoModal" class="modal video-modal">
              <div class="modal-content">
                <span class="close">&times;</span>
                <div class="video-container">
                  <iframe id="videoFrame" class="rounded-2 video-frame" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture;" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
              </div>
            </div>

            <div>
              <a href="profile-view.php?id=' . $currentTeacherid . '">
                <button class="py-2 px-4 my-1 fw-bold bg-green border border-2 rounded-2 border-dark w-100">View full schedule</button>
              </a>
            </div>
          </div>
          <!-- Tutor video display end -->';

      $output .= '</div>';

    }
    
    $query = strpos($sql, "ORDER");
    $firstHalf = substr($sql, 0, $query);
    $sql3 = $firstHalf;
    $result3 = mysqli_query($conn, $sql3) or die("Query failed!");
    if (mysqli_num_rows($result3) > 0) {
      $totalRecords = mysqli_num_rows($result3);

      $totalPages = ceil($totalRecords / $limit);

      $output .= '<ul class="pagination pagination-custom">';
      if ($pageNum > 1) {
        $output .= '<li class="page-item">
          <a class="page-link" id="' . ($pageNum - 1) .'">Prev<span class="visually-hidden">'. $url .'</span></a>
        </li>';
      }
      for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $pageNum) {
          $active = "active";
        } else {
          $active = "";
        }
        $output .= '<li class="page-item ' . $active . '">
        <a class="page-link" id="' . $i . '">' . $i . '<span class="visually-hidden">'. $url .'</span></a>
        </li>';
      }
      if ($totalPages > $pageNum) {
        $output .= '<li class="page-item">
          <a class="page-link" id="' . ($pageNum + 1) . '">Next<span class="visually-hidden">'. $url .'</span></a>
        </li>';
      }
      $output .= '</ul>';

    }

  } else {
    $output = 'No tutor for this subject';
  }

}

echo $output;


?>