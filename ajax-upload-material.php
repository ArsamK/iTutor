<?php
session_start();
include "config.php";
$uploaded_by = $_SESSION['userId'];
$uploaded_for = $_POST['uploaded_for'];
$uploader_type = $_SESSION['userType'];

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $uploadDirectory = "material/";

    // Ensure the upload directory exists
    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    // Define the target file path
    $targetFilePath = $uploadDirectory . basename($file['name']);
    $filename = basename($file['name']);

    // Move the uploaded file to the target directory
    if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
      // Sanitize and escape variables before using them in the SQL query
      $targetFilePath = mysqli_real_escape_string($conn, $targetFilePath);
      $uploaded_by = mysqli_real_escape_string($conn, $uploaded_by);
      $uploaded_for = mysqli_real_escape_string($conn, $uploaded_for);
  
      // Correct SQL syntax with single quotes for values
      $material_sql = "INSERT INTO material (filename, uploaded_by, uploaded_for, uploader_type) VALUES ('$filename', '$uploaded_by', '$uploaded_for', '$uploader_type')";
      $material_sql_result = mysqli_query($conn, $material_sql);
      
      if ($material_sql_result) {
          echo "File uploaded successfully: " . $targetFilePath;
      } else {
          echo "Error inserting data: " . mysqli_error($conn);
      }
  } else {
      echo "Error uploading file.";
  }
  
} else {
    echo "No file uploaded.";
}
?>
