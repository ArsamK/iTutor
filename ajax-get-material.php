<?php
session_start();

include 'config.php';
if (isset($_POST['uploaded_for_id'])) {
  $uploaded_by = $_SESSION['userId'];
  $uploaded_for = $_POST['uploaded_for_id'];
  $uploaded_for_img = $_POST['uploaded_for_img'];
  $uploaded_for_name = $_POST['uploaded_for_name'];


  $output = '<div id="'.$uploaded_for.'">
  <div class="chat-header bg-green border border-2 border-dark rounded-2 p-2 mb-4">
    <button class="btn mb-2 back-to-list-btn"><i class="fa-solid fa-arrow-left"></i></button>'.$uploaded_for_name.'
  </div>
  <div class="chat-messages">';

  $get_material_query = "SELECT * FROM material WHERE (uploaded_by = '$uploaded_by' AND uploaded_for = '$uploaded_for') OR (uploaded_by = '$uploaded_for' AND uploaded_for = '$uploaded_by') ORDER BY id ASC";
  $get_material_query_result = mysqli_query($conn, $get_material_query);
  if($get_material_query_result){
    while($row = mysqli_fetch_assoc($get_material_query_result)){

      $file_path = 'material/' . $row['filename'];
      $output .= '<div class="message ' . ($uploaded_by == $row['uploaded_by'] ? 'sent' : 'received') . '">
                    <a href="' . $file_path . '" download style="color: black;">' . $row['filename'] . ' <i style="padding-left:5px;" class="fa fa-download"></i></a>
                  </div>';


      
    }
    
  } 
}

$output .= '</div>
<form action="#" enctype="multipart/form-data" id="upload-file">
  <input type="hidden" value="'.$uploaded_for.'">
  <label for="fileInput" class="btn bg-green border border-2 border-dark mt-4 w-100" style="width: 80%;">
    <input type="file" class="form-control" id="fileInput" style="display:none;">
    Select File
  </label>
  <button class="btn bg-peach border border-2 border-dark mt-2 w-100 send-file-btn" id="sendFileBtn">Send
    File</button>
</form>

</div>';


echo $output;

?>