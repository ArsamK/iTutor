<?php
session_start();
error_reporting(E_ERROR | E_PARSE);

include 'config.php';
$page = 'Material';
include ('layout/header.php');

$user_id = $_SESSION['userId'];
$user_type = $_SESSION['userType'];
$user_img = $_SESSION['userImg'];
$user_name = $_SESSION['userName'];
?>

<main>
  <div class="container-fluid" style="height: 100vh; margin:0; display:flex; flex-direction: column;">
    <div class="row">
      <!-- User list start -->
      <div class="col-sm-12 col-md-3 p-0" id="userListContainer">
        <div class="list-group" id="userList">
          <?php

          $userList_sql = $user_type == 'Teacher' ? "SELECT DISTINCT studentid FROM lessons WHERE teacherid = '$user_id'" : "SELECT DISTINCT teacherid FROM lessons WHERE studentid = '$user_id'";

          $userList_sql_result = mysqli_query($conn, $userList_sql);
          while ($users = mysqli_fetch_assoc($userList_sql_result)) {
            //This userList_id is not same as user_id above because its otherwise of the user_id
            $userList_id = $user_type == 'Teacher' ? $users['studentid'] : $users['teacherid'];
            
            //if user is a student than he will be shown the image and name of the teacher
            if ($user_type == 'Teacher') {
              $studentData_sql = "SELECT * FROM student WHERE studentid = '$userList_id'";
              $studentData_result = mysqli_query($conn, $studentData_sql);
              if ($studentData_result) {
                $studentData_row = mysqli_fetch_assoc($studentData_result);
                $name = $studentData_row['fname'] . ' ' . $studentData_row['lname'];
                $img_url = 'uploads/images/' . $studentData_row['profilePic'];
              }
            } else {  //if user is a teacher than he will be shown the image and name of the student.
              $teacherData_sql = "SELECT * FROM teacher WHERE teacherid = '$userList_id'";
              $teacherData_result = mysqli_query($conn, $teacherData_sql);
              if ($teacherData_result) {
                $teacherData_row = mysqli_fetch_assoc($teacherData_result);
                $name = $teacherData_row['fname'] . ' ' . $teacherData_row['lname'];
                $img_url = 'uploads/teacher_img/' . $teacherData_row['profilePicture'];
              }
            }

            echo '<a href="#" class="list-group-item list-group-item-action" data-user="'.$userList_id.'">
            <div class="d-flex">
              <img class="img-fluid border border-dark border-1 rounded-2" style="width: 15%; padding:0;"
                src="'.$img_url.'">
              <div class="ps-2 fs-5">'.$name.'</div>
            </div>
          </a>';




          }
          ?>

          <a href="#" class="list-group-item list-group-item-action" data-user="user2">
            <div class="d-flex">
              <img class="img-fluid border border-dark border-1 rounded-2" style="width: 15%; padding:0;"
                src="\iTutor\uploads\images\1710862998_777fc188788bbdf5.png">
              <div class="ps-2 fs-5">Arsam khan</div>
            </div>
          </a>
          <a href="#" class="list-group-item list-group-item-action" data-user="user3">
            <div class="d-flex">
              <img class="img-fluid border border-dark border-1 rounded-2" style="width: 15%; padding:0;"
                src="\iTutor\uploads\images\1710862998_777fc188788bbdf5.png">
              <div class="ps-2 fs-5">Arsam khan</div>
            </div>
          </a>
        </div>
      </div>
      <!-- User list end -->

      <!-- User messages start -->
      <div class="col-sm-12 col-md-9 p-0 d-flex flex-column" id="chatBoxContainer">
        <div id="chatBox" class="border flex-grow-1 p-3">
          <div id="user1" class="chat d-none">
            <button class="btn btn-secondary mb-2 back-to-list-btn" data-user="user1">&lt; Back to User List</button>
            <div class="chat-header bg-primary text-white p-2">User 1</div>
            <div class="chat-messages">
              <div class="message received">Hello from User 1</div>
              <div class="message received">How are you?</div>
            </div>
            <label for="fileInput1" class="btn btn-primary mt-2 w-100">
              <input type="file" class="form-control" id="fileInput1" style="display:none;">
              Select File
            </label>
            <button class="btn btn-primary mt-2 w-100 send-file-btn" id="sendFileBtn1">Send File</button>
          </div>
          <div id="user2" class="chat d-none">
            <button class="btn btn-secondary mb-2 back-to-list-btn" data-user="user2">&lt; Back to User List</button>
            <div class="chat-header bg-primary text-white p-2">User 2</div>
            <div class="chat-messages">
              <div class="message received">Hello from User 2</div>
              <div class="message received">Good morning!</div>
            </div>
            <label for="fileInput2" class="btn btn-primary mt-2 w-100">
              <input type="file" class="form-control" id="fileInput2" style="display:none;">
              Select File
            </label>
            <button class="btn btn-primary mt-2 w-100 send-file-btn" id="sendFileBtn2">Send File</button>
          </div>
          <div id="user3" class="chat d-none">
            <button class="btn btn-secondary mb-2 back-to-list-btn" data-user="user3">&lt; Back to User List</button>
            <div class="chat-header bg-primary text-white p-2">User 3</div>
            <div class="chat-messages">
              <div class="message received">Hello from User 3</div>
              <div class="message received">What's up?</div>
            </div>
            <label for="fileInput3" class="btn btn-primary mt-2 w-100">
              <input type="file" class="form-control" id="fileInput3" style="display:none;">
              Select File
            </label>
            <button class="btn btn-primary mt-2 w-100 send-file-btn" id="sendFileBtn3">Send File</button>
          </div>
        </div>
      </div>

      <!-- User messages end -->
    </div>
  </div>
</main>

<?php
include ('layout/footer.php');
?>