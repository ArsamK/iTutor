<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

include "config.php";
include "functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  //checking if the email is valid or not.
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

    // Check if the email is already taken
    $check_email = "SELECT * FROM alluser WHERE email = '$email'";
    $check_email_result = mysqli_query($conn, $check_email);

    //if email already exists.
    if (mysqli_num_rows($check_email_result) > 0) {
      $errorMessage = "User already exists!";
    } else {
      if (validatePassword($password)) {
        $hash_password = password_hash($password, PASSWORD_BCRYPT);
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $hash_password;
        header('location: \iTutor\tutor-form.php');
      } else {
        $errorMessage = "Password must contain(Numbers, Lowercase and Uppercase letter, Special symbols(@,#,$,&,?) Length(8-16 characters)!";
      }
    }

  }

}

$page = 'Become tutor';
include ('layout/header.php');
?>

<main>
  <!-- Registration form section start -->
  <section id="registration-form">
    <div class="container">
      <div class="row">
        <div class="col">
          <div style="width: 70%">
            <h1>Teach Online</h1>
            <p>Earn money on your schedule</p>


            <form action="become-tutor.php" method="post">

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
                <label for="email" class="form-label">Email </label>
                <input type="email" class="form-control border-dark border-2" id="email" name="email"
                  placeholder="Your Email" autocomplete="off" required />
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control border-dark border-2" id="password" name="password"
                  placeholder="Password" required />
              </div>

              <p><b>Already have an account? </b><a class="text-dark" href="login.php">Log in</a>.</p>


              <a href="tutor-form.php">
                <button type="submit" class="mb-3 btn border border-2 border-dark btn-lg bg-peach text-bold w-100"
                  style="font-weight: bold">
                  Sign up with Email
                </button>
              </a>
            </form>

          </div>
        </div>
        <!-- //second column start -->
        <div class="col">
          <div class="images position-relative">
            <img src="images/tutor-registration-img.png" class="it-reg-image1 position-absolute"
              alt="reg-tutor-picture1" />
            <img src="images/tutor-registration-img.png" class="it-reg-image2 position-absolute"
              alt="reg-tutor-picture3" />
            <img src="images/tutor-registration-img.png" class="it-reg-image3 position-absolute"
              alt="reg-tutor-picture3" />
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Registration form section end -->

  <!-- Feature section start -->

  <section id="feature-section">
    <div class="container" style="margin: 100px auto">
      <div class="row">
        <div class="col">
          <div class="card" style="border: none">
            <div class="card-body">
              <h5 class="card-title pb-1">Set your own rate</h5>
              <p class="card-text">
                Choose your hourly rate. On average,
                Python tutors charge 1000-2500 PKR per hour.
              </p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card" style="border: none">
            <div class="card-body">
              <h5 class="card-title pb-1">Teach anytime, anywhere</h5>
              <p class="card-text">
                Decide when and how many hours you want to teach. No minimum
                time commitment or fixed schedule. Be your own boss!
              </p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card" style="border: none">
            <div class="card-body">
              <h5 class="card-title pb-1">Grow professionally</h5>
              <p class="card-text">
                You’ll get all the help you need from
                our team to grow.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Feature section end -->

  <!-- More features section start -->
  <section id="more-feature" class="my-3">
    <div class="container">
      <div class="row">
        <div class="col">
          <div>
            <h1 style="width: 70%">Teach students from over the globe</h1>
            <p class="pt-2 pb-4">
              Join us and you'll have everything you need to teach
              successfully.
            </p>

            <ul style="
                    list-style: none;
                    padding-left: 0;
                    margin-bottom: 3rem;
                  ">
              <li class="py-2">
                <img class="pe-2" src="images/svg/check-mark.svg" />Steady
                stream of new students
              </li>
              <li class="py-2">
                <img class="pe-2" src="images/svg/check-mark.svg" />Smart
                Calender
              </li>
              <li class="py-2">
                <img class="pe-2" src="images/svg/check-mark.svg" />Interactive classroom
              </li>
              <li class="py-2">
                <img class="pe-2" src="images/svg/check-mark.svg" />Convenient payment
                methods
              </li>
            </ul>

            <a href="#">
              <button class="btn border border-dark border-2 bg-peach" style="font-weight: bold">
                Sign up to teach
              </button>
            </a>
          </div>
        </div>
        <div class="col">
          <div class="images position-relative">
            <img src="images/more-feature.png" class="more-feature-image1 position-absolute"
              alt="more-feature-picture1">
            <img src="images/more-feature.png" class="more-feature-image2 position-absolute"
              alt="more-feature-picture2">
            <img src="images/more-feature.png" class="more-feature-image3 position-absolute"
              alt="more-feature-picture3">
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- More feature section end -->

  <!-- Teacher remarks section start -->
  <section id="teacher-remarks">

    <div class="container">
      <div class="row">
        <div class="col">
          <div class="position-relative">
            <img src="images/teacher-remarks-img.png" class="teacher-remark-image1 position-absolute">
            <img src="images/teacher-remarks-img.png" class="teacher-remark-image2 position-absolute">
            <img src="images/teacher-remarks-img.png" class="teacher-remark-image3 position-absolute">
          </div>
        </div>
        <div class="col">
          <div class="position-relative" style="width: 65%; top: 60px;">
            <h1 class="py-2">"iTutor allowed me to make a living without leaving home!"</h1>
            <p class="pb-5"><b>Dua A.</b> Python tutor</p>
            <a href="#">
              <button class="btn border border-dark border-2 bg-peach" style="font-weight: bold;">Become a
                tutor</button>
            </a>
          </div>
        </div>
      </div>
    </div>

  </section>
  <!-- Teacher remarks section end -->

  <!-- Frequently asked question section start -->

  <section id="frequently-asked-section">
    <div class="container my-5">
      <h1 class="py-4 text-center" style="font-size: 3rem;">Frequently asked questions</h1>

      <div class="accordion mx-auto" id="accordionExample" style="width: 70%;">
        <?php
        $sql = "SELECT * FROM faq";
        $faq_result = mysqli_query($conn, $sql);
        if (!$faq_result) {
          echo "FAQ's not available";
        } else {

          while ($row = mysqli_fetch_assoc($faq_result)) {
            $id = (int) $row['faq_id'];
            $idInWords = numberToWords($id);
            echo '<div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#' . $idInWords . '"
              aria-expanded="false" aria-controls="' . $idInWords . '">
              ' . $row['question'] . '
            </button>
          </h2>
          <div id="' . $idInWords . '" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
            ' . $row['answer'] . '
            </div>
          </div>
        </div>';
          }
        }
        ?>

        <p class="py-2 ">Have more question? <a href="mailto:info.arsamism@gmail.com" style="color: #121117;"><b>Contact our support team</b></a></p>
      </div>


    </div>
  </section>

  <!-- Frequently asked question section end -->

  <!-- get paid to teach section start -->
  <section id="get-paid">

    <div class="container border border-dark border-2 rounded-2 my-5" style="overflow: hidden; width: 70%;">
      <div class="row">
        <div class="col p-0 ">
          <img src="images/get-paid-image.png" alt="get-paid" style="background-size: cover; width: 100%;">
        </div>
        <div class="col bg-peach">
          <div class="py-3 ps-4 position-relative" style="width: 60%;top: 10%; left: 20%;">

            <h3>Get paid to teach online</h3>
            <p>Connect with thousands of learners around the world and teach from your living room.</p>

            <div class="d-grid">
              <a href="#">
                <button class="btn btn-dark w-100 m-0 mt-2">Get Started <i
                    class="fa-solid fa-arrow-right ps-4"></i></button>
              </a>
              </di v>

            </div>

          </div>
        </div>
      </div>

  </section>
  <!-- get paid to teadch online end -->

</main>

<?php include ('layout/footer.php'); ?>