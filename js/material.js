document.addEventListener("DOMContentLoaded", function () {
  const userLinks = document.querySelectorAll(".list-group-item-action");
  const chats = document.querySelectorAll(".chat");
  const backToListBtns = document.querySelectorAll(".back-to-list-btn");
  const userContainerList = document.querySelector("#userListContainer");
  const chatBoxContainer = document.querySelector("#chatBoxContainer");
  let uploaded_for = '';
  let uploaded_forImg = '';
  let uploaded_forName = '';


    // Clicking functinality on the chat list
    document.querySelectorAll('#userList a').forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const uploaded_for_id = this.getAttribute('data-user');
        uploaded_for = uploaded_for_id;
        const uploaded_for_img = this.querySelector('img').src;
        uploaded_forImg = uploaded_for_img;
        const uploaded_for_name = this.querySelector('.uploaded-for-name').innerText;
        uploaded_forName = uploaded_for_name;
        // console.log(uploaded_for_name);
        $.ajax({
          url: "ajax-get-material.php",
          type: "POST",
          data: {uploaded_for_id: uploaded_for_id, uploaded_for_img: uploaded_for_img, uploaded_for_name: uploaded_for_name},
          success: function(response){
            // console.log(response);
            $('#chatBox').html(response);
          }
        });
        if (window.innerWidth < 768) {
          userContainerList.classList.add('d-none');
          chatBoxContainer.classList.remove('d-none');
        }
      });
    });


  // Showing temperory file name to user

    // Event delegation for file input change
    $(document).ready(function() {
      // Event delegation for file input change
      $("#chatBox").on("change", 'input[type="file"]', function(event) {
        const fileInput = $(this);
        // console.log("clicked");
        const file = fileInput[0].files[0];
        if (file) {
          const activeChat = $(".chat-messages");
          let existingFileNameMessage = activeChat.find(".message.file-name");
          if (existingFileNameMessage) {
            existingFileNameMessage.remove();
          }
          const newMessage = $("<div>")
            .addClass("message file-name info")
            .text(`Selected file: ${file.name}`);
          activeChat.append(newMessage);
    
          // Store the selected file in a global variable for later use
          window.selectedFile = file;
        }
      });
    
      // Event listener for the upload button click
      $("#chatBox").on("click", "button#sendFileBtn", function(event) {
        if (window.selectedFile) {
          console.log("Uploading file:", window.selectedFile.name);
          
          // Implement your file upload logic here using jQuery's AJAX
          const formData = new FormData();
          formData.append("file", window.selectedFile);
          formData.append("uploaded_for", uploaded_for);
          // console.log(formData);
          $.ajax({
            url: "ajax-upload-material.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
              console.log("File uploaded successfully:", response);
              $.ajax({
                url: "ajax-get-material.php",
                type: "POST",
                data: {uploaded_for_id: uploaded_for, uploaded_for_img: uploaded_forImg, uploaded_for_name: uploaded_forName},
                success: function(response){
                  // console.log(response);
                  $('#chatBox').html(response);
                }
              });
              const activeChat = document.querySelector(
                ".chat-messages"
              );
              const fileNameMessage = activeChat.querySelector(".message.file-name");
              if (fileNameMessage) {
                fileNameMessage.remove();
              }
            }
          });
        } else {
          console.log("No file selected for upload.");
        }
      });
    });
    
  



  // Back to user list button functionality
  $("#chatBox").on("click", ".back-to-list-btn", function(event){
    
    document.getElementById(uploaded_for).classList.add("d-none");
    if(window.innerWidth < 768){
        document.getElementById("userListContainer").classList.remove("d-none");
    }
});






});

