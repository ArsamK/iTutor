<?php
session_start();
error_reporting(E_ERROR | E_PARSE);

include 'config.php';
include 'functions.php';
$page = 'Material';
include ('layout/header.php');
?>

<main>
  <div class="container-fluid" style="height: 100vh; margin:0; display:flex; flex-direction: column;">
    <div class="row">
      <!-- User list start -->
      <div class="col-sm-12 col-md-3 p-0" id="userListContainer">
        <div class="list-group" id="userList">
          <a href="#" class="list-group-item list-group-item-action" data-user="user1">
            <div class="d-flex">
              <img class="img-fluid border border-dark border-1 rounded-2" style="width: 15%; padding:0;"
                src="\iTutor\uploads\images\1710862998_777fc188788bbdf5.png">
              <div class="ps-2 fs-5">Arsam khan</div>
            </div>
          </a>
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
          <button class="btn btn-secondary mb-2" id="backToListBtn">&lt; Back to User List</button>
          <div id="user1" class="chat d-none">
            <div class="chat-header bg-primary text-white p-2">User 1</div>
            <div class="chat-messages">
              <div class="message received">Hello from User 1</div>
              <div class="message received">How are you?</div>
              <label for="fileInput1" class="btn btn-primary mt-2">
                <input type="file" class="form-control" id="fileInput1" style="display:none;">
                Select File
              </label>
            </div>
          </div>
          <div id="user2" class="chat d-none">
            <div class="chat-header bg-primary text-white p-2">User 2</div>
            <div class="chat-messages">
              <div class="message received">Hello from User 2</div>
              <div class="message received">Good morning!</div>
              <label for="fileInput2" class="btn btn-primary mt-2">
                <input type="file" class="form-control" id="fileInput2" style="display:none;">
                Select File
              </label>
            </div>
          </div>
          <div id="user3" class="chat d-none">
            <div class="chat-header bg-primary text-white p-2">User 3</div>
            <div class="chat-messages">
              <div class="message received">Hello from User 3</div>
              <div class="message received">What's up?</div>
              <label for="fileInput3" class="btn btn-primary mt-2">
                <input type="file" class="form-control" id="fileInput3" style="display:none;">
                Select File
              </label>
            </div>
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