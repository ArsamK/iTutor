document.addEventListener("DOMContentLoaded", function () {
  const userLinks = document.querySelectorAll(".list-group-item-action");
  const chats = document.querySelectorAll(".chat");
  const fileInputs = document.querySelectorAll("[id^='fileInput']");
  const sendFileBtns = document.querySelectorAll("[id^='sendFileBtn']");
  const backToListBtns = document.querySelectorAll(".back-to-list-btn");
  const userContainerList = document.querySelector("#userListContainer");
  const chatBoxContainer = document.querySelector("#chatBoxContainer");

  document.querySelectorAll('#userList a').forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      const user = this.getAttribute('data-user');
      document.querySelectorAll('#chatBox .chat').forEach(chat => {
        chat.classList.add('d-none');
      });
      document.getElementById(user).classList.remove('d-none');
      if (window.innerWidth < 768) {
        userContainerList.classList.add('d-none');
        chatBoxContainer.classList.remove('d-none');
      }
    });
  });

  fileInputs.forEach((fileInput, index) => {
    fileInput.addEventListener("change", function () {
      const file = fileInput.files[0];
      if (file) {
        const activeChat = document.querySelector(
          ".chat:not(.d-none) .chat-messages"
        );
        let existingFileNameMessage = activeChat.querySelector(".message.file-name");
        if (existingFileNameMessage) {
          existingFileNameMessage.remove();
        }
        const newMessage = document.createElement("div");
        newMessage.classList.add("message", "file-name", "info");
        newMessage.textContent = `Selected file: ${file.name}`;
        activeChat.appendChild(newMessage);
      }
    });
  });

  sendFileBtns.forEach((btn, index) => {
    btn.addEventListener("click", function () {
      const fileInput = fileInputs[index];
      const file = fileInput.files[0];
      if (file) {
        const activeChat = document.querySelector(
          ".chat:not(.d-none) .chat-messages"
        );
        const newMessage = document.createElement("div");
        newMessage.classList.add("message", "sent");
        newMessage.innerHTML = `<a href="#" download="${file.name}">${file.name}</a>`;
        activeChat.appendChild(newMessage);
        fileInput.value = "";
        
        // Remove the file name display message
        const fileNameMessage = activeChat.querySelector(".message.file-name");
        if (fileNameMessage) {
          fileNameMessage.remove();
        }
      }
    });
  });

  backToListBtns.forEach((btn) => {
    btn.addEventListener("click", function () {
      const userId = this.getAttribute("data-user");
      console.log(userId);
      chats.forEach((chat) => chat.classList.add("d-none"));
      document.getElementById(userId).classList.add("d-none");
      document.getElementById("userListContainer").classList.remove("d-none");
    });
  });
});
