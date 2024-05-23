<html lang="en">

<head>
  <title><?php echo $page; ?></title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@600&family=Poppins&display=swap"
    rel="stylesheet" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Anton&family=Lato:ital@1&family=Noto+Sans:wght@500;600;700;800;900&family=Poppins&display=swap"
    rel="stylesheet" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@500;600&family=Poppins&display=swap"
    rel="stylesheet" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Lato:ital@1&family=Noto+Sans:wght@500;600&family=Poppins&display=swap"
    rel="stylesheet" />
  <!-- 
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Anton&family=Lato:ital@1&family=Noto+Sans:wght@500;600&family=Poppins&display=swap" rel="stylesheet"> -->

  <!-- Bootstrap CSS v5.3.2 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css" />

  <!-- Font awesome -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
  <script src="https://kit.fontawesome.com/e1ff686f95.js" crossorigin="anonymous"></script>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="images/favicon-32x32.png">

</head>

<body>
  <header>
    <!-- navbar start -->
    <nav class="navbar navbar-expand-lg <?php echo ($page == 'Home') ? 'bg-green' : ''; ?>">
      <div class="container-fluid">
        <a class="navbar-brand" href=<?php isset($_SESSION['userId'])? "find-tutor.php": "index.php"; ?>><img src="images/itutor-logo.png"
            class="img-fluid rounded-top itutor-logo" alt="" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
          aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <a class="navbar-brand" href="#"><img src="images/itutor-logo.png" class="img-fluid rounded-top itutor-logo"
                alt="" />
            </a>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              
              <li class="nav-item mt-1 ms-2">
                <a class="nav-link" aria-current="page" href="find-tutor.php">Find tutors</a>
              </li>

              <?php if (!isset($_SESSION['userId'])): ?>
              <li class="nav-item mt-1 ms-2">
                <a class="nav-link" href="become-tutor.php">Become a tutor</a>
              </li>
              <?php endif; ?>

              <?php if (isset($_SESSION['userId'])): ?>
                <li class="nav-item mt-1 ms-2">
                  <a class="nav-link" href="lessons.php">Lessons</a>
                </li>

                <li class="nav-item mt-1 ms-2">
                  <a class="nav-link" href="messages.php">Messages</a>
                </li>

                <li class="nav-item mt-1 ms-2">
                  <a class="nav-link" href="materials.php">Material</a>
                </li>
              <?php endif; ?>

              <li class="nav-item ms-2 mt-1">
                <a class="nav-link ps-2" href="\iTutor\become-tutor.php?#frequently-asked-section">
                  <span class="position-relative">
                    <span class="it-question">?</span>
                    <i class="circle"></i>
                  </span>
                </a>
              </li>

              <?php if (isset($_SESSION['userId'])): ?>
                <li class="nav-item mt-2 ms-2">
                <div>
                    <img style="width: 40px; height: 40px; cursor: pointer" title="<?php echo $_SESSION['userName'];?>" class="border border-1 border-dark rounded-2" src="<?php echo $_SESSION['userType'] == 'Teacher'?  'uploads/teacher_img/'.$_SESSION['userImg']: 'uploads/images/'. $_SESSION['userImg'] ?>">
                </div>
                </li>
              <?php endif; ?>

              <li class="nav-item ms-2">
                <?php if (isset($_SESSION['userId'])): ?>
                  <a class="nav-link" href="logout.php">
                    <button class="btn btn-outline-dark border-3 mb-1">
                      <i class="fa-solid fa-arrow-right"></i> Log out
                    </button>
                  </a>
                <?php else: ?>
                  <a class="nav-link" href="login.php">
                    <button class="btn btn-outline-dark border-3 mb-1">
                      <i class="fa-solid fa-arrow-right"></i> Log In
                    </button>
                  </a>
                <?php endif; ?>
              </li>
            </ul>
          </div>

        </div>
      </div>
    </nav>
    <!-- navbar end -->
  </header>