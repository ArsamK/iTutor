<?php
session_start();
error_reporting(E_ERROR | E_PARSE);

include 'config.php';
include 'functions.php';
$page = 'Find tutor';
include ('layout/header.php');

?>
<main>
  <!-- Search Bar section start -->
  <section id="search-bar">

    <div class="container">
      <h1>
        Find the best tutors & teachers online - Web classes and lessons.
      </h1>
      <div class="row">

        <!-- ***********************************************first row start****************************** -->
        <div class="row">
          <!-- subject selection start -->
          <div class="col-lg-3 col-md-6">
            <div class="selector">
              <div class="selectField">
                <label style="color: #121117; opacity: 0.7; font-size: 14px">I want to learn</label>

                <div style="
                          display: flex;
                          align-items: center;
                          justify-content: space-between;
                        ">
                  <span id="subject" class="selectText filter-text"  style="display: inline-block; margin-top: 5px"><?php echo isset($_GET['subject'])? $_GET['subject']: 'select subject';?></span>
                  <img class="arrowIcon" src="images/svg/rotate-arrow.svg" />
                </div>
              </div>

              <ul class="subject-list" class="hide" style="height: 250px">
              <li class="options">select subject</li>
                <?php
                $subject_sql = "SELECT * FROM subject";
                $subject_result = mysqli_query($conn, $subject_sql);
                while ($subject_row = mysqli_fetch_array($subject_result)) {

                  echo "<li class='options'>" . $subject_row['subjectName'] . "</li>";
                }
                ?>
                <!-- Add more options here -->
              </ul>
            </div>
          </div>
          <!-- subject selection end -->

          <!-- Price selection start -->
          <div class="col-lg-3 col-md-6">
            <div class="selector">
              <div class="selectField">
                <label style="color: #121117; opacity: 0.7; font-size: 14px">Price per lesson</label>

                <div style="
                          display: flex;
                          align-items: center;
                          justify-content: space-between;
                        ">
                  <span style="display: inline-block; margin-top: 5px">PKR500 - PKR<span id="priceValue" class="filter-text priceValue">5000</span>+</span>
                  <img class="arrowIcon" src="images/svg/rotate-arrow.svg" />
                </div>
              </div>

              <div class="subject-list" class="hide" style="height: 100px">
                <div class="mt-3 mx-3">
                  <label for="priceRange" class="form-label">Price Range:</label>
                  <input type="range" class="form-range" min="0" max="100" id="priceRange" />
                </div>
              </div>
            </div>
          </div>
          <!-- Price selection end -->

          <!-- country selection start -->
          <div class="col-lg-3 col-md-6">
            <div class="selector">
              <div class="selectField">
                <label style="color: #121117; opacity: 0.7; font-size: 14px">Country</label>

                <div style="
                          display: flex;
                          align-items: center;
                          justify-content: space-between;
                        ">
                  <span id="country" class="selectText filter-text" style="display: inline-block; margin-top: 5px">Pakistan</span>
                  <img class="arrowIcon" src="images/svg/rotate-arrow.svg" />
                </div>
              </div>

              <ul class="subject-list" class="hide" style="height: auto">
                
                <li class='options' title="Scope is limited to Pakistan only.">Pakistan</li>
              </ul>
            </div>
          </div>
          <!-- country selection end -->

          <!-- Availablity selection start -->
          <div class="col-lg-3 col-md-6">
            <div class="selector">
              <div class="selectField">
                <label style="color: #121117; opacity: 0.7; font-size: 14px">I'm available</label>

                <div style="
                          display: flex;
                          align-items: center;
                          justify-content: space-between;
                        ">
                  <span id="day" class="selectText filter-text" style="display: inline-block; margin-top: 5px">Any day</span>
                  <img class="arrowIcon" src="images/svg/rotate-arrow.svg" />
                </div>
              </div>

              <ul class="subject-list" class="hide" style="height: 250px">
                <li class="options">Any day</li>
                <li class="options">Monday</li>
                <li class="options">Tuesday</li>
                <li class="options">Wednesday</li>
                <li class="options">Thursday</li>
                <li class="options">Friday</li>
                <li class="options">Saturday</li>
                <li class="options">Sunday</li>
              </ul>
            </div>
          </div>
          <!-- Availablity selection end -->
        </div>
        <!-- ***************************************first row end ******************************* -->


        <!-- ******************************** second row start ********************************* -->
        <div class="row my-4">

          <!-- language selection start -->
          <div class="col-lg-3 col-md-6">
            <div class="selector">
              <div class="selectField py-2" style="
                          display: flex;
                          align-items: center;
                          justify-content: space-between;
                        ">
                <label id="language" class="selectText filter-text" style="color: #121117; opacity: 0.7; font-size: 14px">Also speaks</label>

                <img class="arrowIcon" src="images/svg/rotate-arrow.svg" />
              </div>

              <ul class="subject-list" class="hide" style="height: 250px">
              <li class="options">Also speaks</li>
                <?php
                $language_sql = "SELECT * FROM languages";
                $language_result = mysqli_query($conn, $language_sql);
                while ($language_row = mysqli_fetch_array($language_result)) {
                  echo "<li class='options'>" . $language_row['language'] . "</li>";
                }
                ?>
              </ul>
            </div>
          </div>
          <!-- language selection end -->


          <!-- City selection start -->
          <div class="col-lg-3 col-md-6">
            <div class="selector">
              <div class="selectField py-2" style="
                          display: flex;
                          align-items: center;
                          justify-content: space-between;
                        ">
                <label id="city" class="selectText filter-text" style="color: #121117; opacity: 0.7; font-size: 14px"><?php echo isset($_GET['city']) ? $_GET['city'] : 'City'; ?></label>

                <img class="arrowIcon" src="images/svg/rotate-arrow.svg" />
              </div>

              <ul class="subject-list" class="hide" style="height: 250px">
              <li class="options">City</li>
                <?php
                $cities = citiesPakistan();
                sort($cities);
                foreach ($cities as $city) {
                  echo "<li class='options'>" . $city . "</li>";
                }
                ?>
              </ul>
            </div>
          </div>
          <!-- City selection start -->


          <!-- Sort by selection start -->
          <div class="col-lg-3 col-md-6">
            <div class="selector">
              <div class="selectField py-2" style="
                          display: flex;
                          align-items: center;
                          justify-content: space-between;
                        ">
                <label id="sortBy" class="selectText filter-text" style="color: #121117; opacity: 0.7; font-size: 14px">Sort by:</label>

                <img class="arrowIcon" src="images/svg/rotate-arrow.svg" />
              </div>

              <ul class="subject-list" class="hide" style="height: 250px">
              <li class="options">Sort by:</li>
                <li class="options">high price</li>
                <li class="options">low price</li>
                <li class="options">Best ratings</li>
              </ul>
            </div>
          </div>
          <!-- Sort by selection end -->


          <!-- Search by selection start -->
          <div class="col-lg-3 col-md-6">
            <div class="input-group mb-3 border border-2 border-dark rounded-2 ">
              <span class="input-group-text" id="basic-addon1"><a class="text-decoration-none text-dark"
                  href="#">@</a></span>
              <input type="text" class="form-control" id="searchTerm" placeholder="Search by name">
            </div>

          </div>
          <!-- Search by selection end -->




        </div>
        <!-- ************************************ second row end ******************************* -->

      </div>

    </div>

  </section>
  <!-- Search Bar section End -->

  <section id="tutor-listing">
    <div class="container" id="tutor-data">

    </div>


  </section>


</main>

<?php include ('layout/footer.php'); ?>