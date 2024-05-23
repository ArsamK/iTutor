<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
$page = 'Home';
include("layout/header.php");

?>

        <main>
            <!-- Start landing page -->
            <section id="landing-page">
                <div class="container-fluid bg-green it-85vh">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="text-button">
        
                                    <div class="it-front-text"><span style="font-size: 3.3rem;">Unlock</span> your Potential with the best tutors in Pakistan and Worldwide.</div>
                                    <div>
                                        <a href="login.php">
                                            <button class="btn btn-dark btn-lg it-get-started">Get Started <i class="fa-solid fa-arrow-right ps-4"></i></button>
                                        </a>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col">
                                <div class="images position-relative">
                                    <img src="images/landing-picture.png" class="it-landing-image1 position-absolute" alt="landing-picture1">
                                    <img src="images/landing-picture.png" class="it-landing-image2 position-absolute"alt="landing-picture2">
                                    <img src="images/landing-picture.png" class="it-landing-image3 position-absolute"alt="landing-picture3">
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
            </section>
                
            <!-- End landing page -->

            <!-- Subject section start -->
                <section id="subject-section">

                    <div class="container my-4">
                        <div class="row">
                            <!-- first row started -->
                            <div class="row mb-4">
                                <div class="col">
                                    <a href="find-tutor.php?subject=OOPs" style="text-decoration: none;">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="position-relative my-3 subject-text">
                                                    <span class="mx-3"><img src="images/svg/oops.svg" alt="OOPs"></span> OOPs tutors <span class="position-absolute subject-arrow"><img src="images/svg/arrow.svg" alt=""></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="find-tutor.php?subject=Javascript" style="text-decoration: none;">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="position-relative my-3 subject-text">
                                                    <span class="mx-3"><img src="images/svg/javascript.svg" alt="javascript"></span>Javascript tutors <span class="position-absolute subject-arrow"><img src="images/svg/arrow.svg" alt=""></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="find-tutor.php?subject=Python" style="text-decoration: none;">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="position-relative my-3 subject-text">
                                                    <span class="mx-3"><img src="images/svg/python.svg" alt="python"></span> Python tutors <span class="position-absolute subject-arrow"><img src="images/svg/arrow.svg" alt=""></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!-- first row end -->
                            <!-- second row start -->
                            <div class="row mb-4">
                                <div class="col">
                                    <a href="find-tutor.php?subject=<?php echo urlencode('C++'); ?>" style="text-decoration: none;">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="position-relative my-3 subject-text">
                                                    <span class="mx-3"><img src="images/svg/c++.svg" alt="c++"></span> C++ tutors <span class="position-absolute subject-arrow"><img src="images/svg/arrow.svg" alt=""></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="find-tutor.php?subject=MYSQL" style="text-decoration: none;">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="position-relative my-3 subject-text">
                                                    <span class="mx-3"><img src="images/svg/database.svg" alt="database"></span> Database tutors <span class="position-absolute subject-arrow"><img src="images/svg/arrow.svg" alt=""></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="find-tutor.php?subject=Web Development" style="text-decoration: none;">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="position-relative my-3 subject-text">
                                                    <span class="mx-3"><img src="images/svg/webicon.svg" alt="web"></span> Web Dev tutors <span class="position-absolute subject-arrow"><img src="images/svg/arrow.svg" alt=""></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!-- second row end -->
                            <!-- third row start -->
                            <div class="row mb-4">
                                <div class="col">
                                    <a href="find-tutor.php?subject=Automata" style="text-decoration: none;">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="position-relative my-3 subject-text">
                                                    <span class="mx-3"><img src="images/svg/automata.svg" alt="automata"></span> Automata tutors <span class="position-absolute subject-arrow"><img src="images/svg/arrow.svg" alt=""></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="find-tutor.php?subject=PHP" style="text-decoration: none;">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="position-relative my-3 subject-text">
                                                    <span class="mx-3"><img src="images/svg/php.svg" alt="php"></span> PHP tutors <span class="position-absolute subject-arrow"><img src="images/svg/arrow.svg" alt=""></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="find-tutor.php?subject=Kotlin" style="text-decoration: none;">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="position-relative my-3 subject-text">
                                                    <span class="mx-3"><img src="images/svg/kotlin.svg" alt="kotlin"></span> Kotlin tutors <span class="position-absolute subject-arrow"><img src="images/svg/arrow.svg" alt=""></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!-- third row end -->
                        </div>
                    </div>
                </section>
            <!-- Subject section end -->

            <!-- Carousal section start -->
                <section id="carousel-section">
                    <div class="container ">

                        <h1 class="text-center it-carousel-heading">Find the right tutor for you.</h1>
                        <p class="text-center py-4 it-carousel-para">Through our dedication and hardwork, we know tutoring tactics.</p>
        
                        <div id="carouselExampleFade" class="carousel slide" data-bs-ride="true">
                            <div class="carousel-inner">
                                <!-- first carousel start -->
                              <div class="carousel-item active" data-bs-interval="5000">
                                <div class="container">
                                    <div class="row it-85vh">
                                        <div class="col">
                                            <div class="position-relative">
                                                <img src="images/firsttutorcarousel.png" class="it-pic1 position-absolute" alt="ismael">
                                                <img src="images/firsttutorcarousel.png" class="it-pic2 position-absolute" alt="ismael">
                                                <img src="images/firsttutorcarousel.png" class="it-pic3 position-absolute" alt="ismael">
                                                    
                                                    <div class="tutor-button position-absolute">
                                                        <span class="tutor-name">Ayesha</span>
                                                        <span class="tutor-subject">Python tutor</span>
                                                    </div>
                                                
                                                
                                            </div>
                                            
                                        </div>
                                        <div class="col position-relative">
                                            <div class="tutor-text position-absolute">
                                                <h3>"The energy she brings to each lesson is amazing."</h3>
                                                <p class="it-bold pt-4">Ismael</p>
                                                <p class="it-italic">Python learner on iTutor</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>

                              <!-- second carousel start -->
                              <div class="carousel-item" data-bs-interval="5000">
                                <div class="container it-100vh">
                                    <div class="row">
                                        <div class="col">
                                            <div class="position-relative">
                                                <img src="images/secondtutorcarousel.png" class="it-pic1 position-absolute" alt="ismael">
                                                <img src="images/secondtutorcarousel.png" class="it-pic2 position-absolute" alt="ismael">
                                                <img src="images/secondtutorcarousel.png" class="it-pic3 position-absolute" alt="ismael">
                                                    
                                                    <div class="tutor-button position-absolute">
                                                        <span class="tutor-name">Mustafa</span>
                                                        <span class="tutor-subject">PHP tutor</span>
                                                    </div>
                                                
                                                
                                            </div>
                                            
                                        </div>
                                        <div class="col position-relative">
                                            <div class="tutor-text position-absolute">
                                                <h3>"With just a few lessons, you can already see the difference."</h3>
                                                <p class="it-bold">Mehmet</p>
                                                <p class="it-italic">PHP learner on iTutor</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                              </div>

                              <!-- third carousel start -->
                              <div class="carousel-item" data-bs-interval="5000">
                                <div class="container it-100vh">
                                    <div class="row">
                                        <div class="col">
                                            <div class="position-relative">
                                                <img src="images/thirdtutorcarousel.png" class="it-pic1 position-absolute" alt="ismael">
                                                <img src="images/thirdtutorcarousel.png" class="it-pic2 position-absolute" alt="ismael">
                                                <img src="images/thirdtutorcarousel.png" class="it-pic3 position-absolute" alt="ismael">
                                                    
                                                    <div class="tutor-button position-absolute">
                                                        <span class="tutor-name">Arsam</span>
                                                        <span class="tutor-subject">Automata tutor</span>
                                                    </div>
                                                
                                                
                                            </div>
                                            
                                        </div>
                                        <div class="col position-relative">
                                            <div class="tutor-text position-absolute">
                                                <h3>"The best choice I made for the self-development in the long run"</h3>
                                                <p class="it-bold">John</p>
                                                <p class="it-italic">Automata learner on iTutor</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                              </div>
                              <!-- third carousel end -->
                            </div>
                            <button class="carousel-control-prev dark" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                            </button>
                          </div>
                    </div>
                </section>
            <!-- Carousal section end -->

            


            
            <!-- how itutor works section start -->
                <section id="itutor-work-section">

                    <div class="container">

                        <h2>How iTutor works:</h2>
                        
                        <div class="row">
                                <!-- first card start -->
                            <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="card it-border3 h-auto" style="width: 26rem;transform: scale(.9);">
                            <div class="card-body card-setting">
                              <h2 class="card-num">1</h2>
                              <h2 class="card-title card-h2">Find your tutor.</h2>
                              <p class="card-text card-para">We'll connect you with the tutor who will motivate, challenge and inspire you.</p>
                              
                              <!-- first inner card -->
                              <div class="card first-inner-card" style="max-width: 28rem;height: auto; border: 3px solid black;z-index: 5;">
                                <div class="row g-0">
                                  <div class="col-sm-4 col-md-4 col-lg-4 ">
                                    <div>
                                    <img src="images/siera.png" class="img-fluid rounded mx-2 my-2" alt="siera-tutor">
                                    </div>
                                </div>
                                  <div class="col-sm-8 col-md-8 col-lg-8">
                                    <div class="card-body">
                                      <h5 class="card-title">Siera <span class="align-middle" style="float: right;"><img class="align-top" src="images/svg/star.svg" alt="">4.9</span></h5>
                                      <p class="card-text"><img src="images/svg/gradcap.svg" alt=""> Python tutor</p>
                                      <p class="card-text"><img src="images/svg/checkpad.svg" alt=""> Ex Microsoft Employee <br><span  style="padding-left:20px ;">English (Advanced) +2</span></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- first inner card end -->
                            
                              <!-- second inner card start -->
                              <div class="card position-relative scnd-inner-card" style="max-width: 28rem;height: auto; border: 3px solid black;z-index: 4;">
                                <div class="row g-0">
                                  <div class="col-sm-4 col-md-4 col-lg-4 ">
                                    <div>
                                    <img src="images/Bassel.png" class="img-fluid rounded mx-2 my-2" alt="siera-tutor">
                                    </div>
                                </div>
                                  <div class="col-sm-8 col-md-8 col-lg-8">
                                    <div class="card-body">
                                      <h5 class="card-title">Bassel <span class="align-middle" style="float: right;"><img class="align-top" src="images/svg/star.svg" alt="">4.9</span></h5>
                                      <p class="card-text"><img src="images/svg/gradcap.svg" alt=""> Web Dev tutor</p>
                                      <p class="card-text"><img src="images/svg/checkpad.svg" alt=""> Googler <br><span  style="padding-left:20px ;">English (Advanced) +2</span></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- second inner card end -->

                              <!-- third inner card start -->
                              <div class="card position-relative third-inner-card" style="max-width: 28rem;height: auto; border: 3px solid black;z-index: 3;">
                                <div class="row g-0">
                                  <div class="col-sm-4 col-md-4 col-lg-4 ">
                                    <div>
                                    <img src="images/milena.png" class="img-fluid rounded mx-2 my-2" alt="siera-tutor">
                                    </div>
                                </div>
                                  <div class="col-sm-8 col-md-8 col-lg-8">
                                    <div class="card-body">
                                      <h5 class="card-title">Milena <span class="align-middle" style="float: right;"><img class="align-top" src="images/svg/star.svg" alt="">4.9</span></h5>
                                      <p class="card-text"><img src="images/svg/gradcap.svg" alt=""> Automata tutor</p>
                                      <p class="card-text"><img src="images/svg/checkpad.svg" alt=""> Senior Lecturer at MIT <br><span  style="padding-left:20px ;">English (Advanced) +2</span></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- third inner card end -->
                              
                            </div>
                          </div>
                        </div>
                        <!-- first card end -->
                        
                        <!-- second card start -->
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="card it-border3 h-auto" style="width: 26rem;transform: scale(.9);">
                            <div class="card-body card-setting ">
                              <h2 class="card-num" style="background-color: #FFE03D;">2</h2>
                              <h2 class="card-title card-h2">Start Learning.</h2>
                              <p class="card-text card-para">Your tutor will guide the way through your first lesson and help you plan your next steps.</p>
                              <img src="images/card-2.png" class="img-fluid rounded position-relative" style="bottom: -55px; transform: scale(1,1.4);" alt="card-2">
                             
                              
                            </div>
                          </div>
                        </div>
                        <!-- second card end -->

                        <!-- third card start -->
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="card it-border3 h-auto" style="width: 26rem;transform: scale(.9);">
                            <div class="card-body card-setting">
                              <h2 class="card-num" style="background-color: #2885FD;">3</h2>
                              <h2 class="card-title card-h2">Speak. Read. Write Repeat.</h2>
                              <p class="card-text card-para">Choose how many lessons you want to take each week and get ready to reach your goals.</p>
                              <div class="position-relative" style="transform: scale(0.9);">
                                <img src="images/card-3.png" class="img-fluid position-absolute z-0" style="width: 87%; right: 0; top: 40px;transform: scale(1.2,1.4);" alt="card-3">
                                <img src="images/card-3.png" class="img-fluid position-absolute" style="width: 87%; right: 20px; top: 40px;transform: scale(1.2,1.4);" alt="card-3">
                                <img src="images/card-3.png" class="img-fluid position-absolute" style="width: 87%; right: 40px; top: 40px;transform: scale(1.2,1.4);" alt="card-3">
                                
                              </div>
                              
                              
                            </div>
                          </div>
                        </div>
                        <!-- third card end -->

                        
                        </div>
                          
                    </div>

                </section>
            <!-- how itutor works section end -->

            <!-- Title section start -->
            <section id="title-section" class="d-flex mx-auto  bg-green">
                <div class="container text-center">
                    <h1 class="pt-5 pb-3">Lesson you will love. Guaranteed.</h1>
                    <p>Try another tutor for free if you're not satisfied.</p>
                </div>
            </section>
        <!-- Title section end -->

            <!-- Become tutor section start -->
                <section id="become-tutor" class="my-5 mx-auto">
                    <div class="container border border-dark border-2 rounded-4" style="overflow: hidden; width: 75%; ">
                        <div class="row" >
                            <div class="col p-0 ">
                                <img src="images/become-tutor.png"   alt="become-tutor" style="background-size: cover; width: 100%;">
                            </div>
                            <div class="col bg-peach ">
                                <div class="py-5 px-4 position-relative" style="width: 100%; top: 10%; left: 3%;">

                                    <h3>Become a tutor</h3>
                                    <p>Earn money sharing your valuable knowledge with students. Sign up to start tutoring online with iTutor.</p>
                                    <ul style="padding-left: 5%;">
                                        <li>Find new students</li>
                                        <li>Grow your business</li>
                                        <li>Get paid securely</li>
                                    </ul>
                                    <div class="text-center">
                                            <a href="become-tutor.php">
                                                <button class="btn btn-dark w-100 btn-lg it-get-started">Become a tutor <i class="fa-solid fa-arrow-right ps-4"></i></button>
                                            </a>
                                            <p class="fw-bolder">How our platform works</p>
                                    </div>

                                </div>
                                
                            </div>
                        </div>
                    </div>
                </section>
            <!-- Become tutor section end -->

            <!-- Changing the game through education start -->
            
            <section id="game-education">

            <div class="container">
                <h2>Changing the game through Education:</h2>
                <div class="row my-5">
                    <div class="col">
                        <div class="card">
                            <div class="card-header bg-peach d-flex justify-content-center align-items-center">
                                <div class="num-circle">1</div>
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p>iTutor transforms education globally by connecting learners with expert tutors
                                        for a personalized and boundary-breaking learning experience.</p>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header bg-peach d-flex justify-content-center align-items-center">
                                <div class="num-circle">2</div>
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p>Changing the game through education, iTutor dismantles geographical barriers,
                                        providing an inclusive space for quality learning accessible to everyone.</p>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header bg-peach d-flex justify-content-center align-items-center">
                                <div class="num-circle">3</div>
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p>A transformative movement, reshapes education by embracing personalized online
                                        learning, propelling individuals towards success in our dynamic world.</p>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
                

            <!-- Changing the game through education end -->

            
                <section id="future-education" class="bg-green mx-auto my-5">
                    <div class="container text-center">
                        <h1 class="py-5" style="font-size: 4rem; font-weight: bold;">We are the future of education. Join Us!</h1>
                    </div>

                </section>

        </main>

 <?php include('layout/footer.php'); ?>