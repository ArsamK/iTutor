       
            <!-- place footer here -->
            <div  class="position-relative" style=" background-color: #000; color: #fff;">

                <div class="container" style="color: #fff;">
                    <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5  border-top">
                      <div class="col mb-3">
                        <h5>CONTACTS</h5>
                        <p class="text-light"><img src="images/svg/flag-pakistan.svg" alt="Pakistan-flag"> Pakistan</p>
                        <p class="text-secondary">New Hala - Mirpur Khas Rd Link, Hyderabad - Sindh, 71000</p>
    
                      </div>
                  
                      <div class="col mb-3">
                        <h5>Support</h5>
                        <p class="text-secondary"><a href="mailto:info.arsamism@gmail.com" class="text-secondary" href="mailto:info.arsamism@gmail.com">Need any help</a></p>
                      </div>
                  
                      <div class="col mb-3">
                        <h5>ABOUT US</h5>
                        <ul class="nav flex-column">
                          <li class="nav-item mb-2"><a href="\iTutor\become-tutor.php?#frequently-asked-section" class="nav-link p-0 text-secondary">Who we are</a></li>
                          <li class="nav-item mb-2"><a href="\iTutor\become-tutor.php?#frequently-asked-section" class="nav-link p-0 text-secondary">How it works</a></li>
                          <li class="nav-item mb-2"><a href="\iTutor\become-tutor.php?#frequently-asked-section" class="nav-link p-0 text-secondary">Question and Answers</a></li>
                        </ul>
                      </div>
                  
                  
                      <div class="col mb-3">
                        <h5>TUTORS NEAR YOU</h5>
                        <ul class="nav flex-column">
                          <li class="nav-item mb-2"><a href="find-tutor.php?city=Karachi" class="nav-link p-0 text-secondary">Tutors in Karachi</a></li>
                          <li class="nav-item mb-2"><a href="find-tutor.php?city=Hyderabad" class="nav-link p-0 text-secondary">Tutors in Hyderabad</a></li>
                          <li class="nav-item mb-2"><a href="find-tutor.php?city=Lahore" class="nav-link p-0 text-secondary">Tutors in Lahore</a></li>
                          <li class="nav-item mb-2"><a href="find-tutor.php?city=Islamabad" class="nav-link p-0 text-secondary">Tutors in Islamabad</a></li>
                          <li class="nav-item mb-2"><a href="find-tutor.php" class="nav-link p-0 text-secondary">Tutors by city</a></li>
                        </ul>
                      </div>
                    </footer>
                    <div class="container py-3 d-inline-block justify-content-left align-items-end" style="width: 60%;">
                        <div class="row">
                        <div class="col">© 2023 iTutor Inc.</div>
                        </div>
                    </div>
                    <div class="position-absolute" style=" top: 0; right: 2rem;">
                        <a href="#" class="py-3 px-3 border border-3 border-dark rounded-3 <?php echo ($page == 'Become tutor')? 'bg-peach' : 'bg-green'; ?>"><img  src="images/svg/footer-arrow.svg"></a>
                      </div>
                  </div>
            </div>
        
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>

        <!-- JQUERY CDN -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


        <?php if($page =='Tutor Form'){?>
          <script src="\iTutor\js\tutor-form.js"></script>
        <?php }?>

        <?php if($page =='Find tutor'){?>
          <script async src="\iTutor\js\find-tutor.js"></script>
        <?php }?>

        <?php if($page =='Profile view'){?>
          <script src="\iTutor\js\profile-view.js"></script>
        <?php }?>

        <?php if($page =='Material'){?>
          <script src="\iTutor\js\material.js"></script>
        <?php }?>

    </body>
</html>