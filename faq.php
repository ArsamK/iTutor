<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

include "config.php";
include "functions.php";
$page = 'FAQs';
include ('layout/header.php');
?>

<main>

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



</main>

<?php include ('layout/footer.php'); ?>