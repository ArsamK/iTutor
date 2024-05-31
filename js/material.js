    $(document).ready(function () {
      $('.list-group-item').on('click', function () {
        let userId = $(this).data('user');

        // Hide all chat boxes
        $('.chat').addClass('d-none');

        // Show selected chat box
        $('#' + userId).removeClass('d-none');
      });
    });

    document.addEventListener('DOMContentLoaded', function () {
      const userLinks = document.querySelectorAll('.list-group-item-action');
      const chats = document.querySelectorAll('.chat');
      const fileInput = document.getElementById('fileInput');
      const sendFileBtn = document.getElementById('sendFileBtn');
    
      userLinks.forEach(link => {
        link.addEventListener('click', function (e) {
          e.preventDefault();
          const user = this.getAttribute('data-user');
    
          chats.forEach(chat => chat.classList.add('d-none'));
          document.getElementById(user).classList.remove('d-none');
        });
      });
    
      sendFileBtn.addEventListener('click', function () {
        const file = fileInput.files[0];
        if (file) {
          const activeChat = document.querySelector('.chat:not(.d-none) .chat-messages');
          const newMessage = document.createElement('div');
          newMessage.classList.add('message', 'sent');
          newMessage.innerHTML = `<a href="#" download="${file.name}">${file.name}</a>`;
          activeChat.appendChild(newMessage);
          fileInput.value = '';
        }
      });
    });

     // JavaScript to toggle user list and chat box on mobile devices
  const userListContainer = document.getElementById('userListContainer');
  const chatBoxContainer = document.getElementById('chatBoxContainer');

  document.querySelectorAll('#userList a').forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      const user = this.getAttribute('data-user');
      document.querySelectorAll('#chatBox .chat').forEach(chat => {
        chat.classList.add('d-none');
      });
      document.getElementById(user).classList.remove('d-none');
      if (window.innerWidth < 768) {
        userListContainer.classList.add('d-none');
        chatBoxContainer.classList.remove('d-none');
      }
    });
  });

  // JavaScript to toggle user list and chat box on mobile devices
const backToListBtn = document.getElementById('backToListBtn');

document.querySelectorAll('#userList a').forEach(link => {
  link.addEventListener('click', function(e) {
    e.preventDefault();
    const user = this.getAttribute('data-user');
    document.querySelectorAll('#chatBox .chat').forEach(chat => {
      chat.classList.add('d-none');
    });
    document.getElementById(user).classList.remove('d-none');
    if (window.innerWidth < 768) {
      userListContainer.classList.add('d-none');
      chatBoxContainer.classList.remove('d-none');
    }
  });
});

backToListBtn.addEventListener('click', function(e) {
  e.preventDefault();
  chatBoxContainer.classList.add('d-none');
  userListContainer.classList.remove('d-none');
});

    