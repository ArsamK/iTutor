


window.onscroll = function () {
  stickyShadow();
};

var buttonContainer = document.getElementById("buttonContainer");

function stickyShadow() {
  if (window.scrollY > 100) {
    // Adjust the scroll position threshold as needed
    buttonContainer.classList.add("box-shadow");
  } else {
    buttonContainer.classList.remove("box-shadow");
  }
}


// AJAX for thumnail
var videoid = document.querySelector(".video-url").textContent.trim();
const apiKey = "AIzaSyBY3alvfttcwtNPoYvXLBziDeVXJDwCrmE"; // Your YouTube Data API key
var apiUrl =
  "https://www.googleapis.com/youtube/v3/videos?id=" +
  videoid +
  "&key=" +
  apiKey +
  "&part=snippet";

$.ajax({
  url: apiUrl,
  method: "GET",
  success: function (response) {
    // console.log(response);
    var thumbnailUrl = response.items[0].snippet.thumbnails.medium.url;
    var thumbnailImg = document.getElementById('thumbnailImg');
    // console.log(thumbnailImg);
    thumbnailImg.src = thumbnailUrl;
  },
  error: function () {
    console.error("Error fetching video details");
  },
});


// Playing video
var iframe = document.querySelector('iframe');
var thumbnailDisplay = document.querySelector('.thumbnail-display');
var playButton = document.querySelector(".play-button");

playButton.addEventListener('click', function(){
  
  if(iframe.classList.contains('frame-hide')){

    iframe.classList.remove('frame-hide');
    thumbnailDisplay.classList.add('frame-hide');
    playButton.classList.add('frame-hide');
    iframe.src = "https://www.youtube-nocookie.com/embed/"+ videoid +"?autoplay=1&rel=0";
  }
});

// Code for Schedule dynamic dates functionality


document.addEventListener('DOMContentLoaded', function() {
  var weekRangeElement = document.getElementById('weekRange');
  var forwardArrow = document.getElementById('forwardArrow');
  var backwardArrow = document.getElementById('backwardArrow');
  var currentWeekOffset = 0;

  function updateWeekRange() {
    var currentDate = new Date();
    var startOfWeek = new Date(currentDate);
    startOfWeek.setDate(currentDate.getDate() - currentDate.getDay() + (currentDate.getDay() === 0 ? -6 : 1) + (currentWeekOffset * 7)); // Start from Monday

    var endOfWeek = new Date(startOfWeek);
    endOfWeek.setDate(endOfWeek.getDate() + 6);

    // Check if the current date is after the end of the week
    if (currentDate > endOfWeek) {
        currentWeekOffset = Math.floor((currentDate - startOfWeek) / (7 * 24 * 60 * 60 * 1000));
        startOfWeek.setDate(startOfWeek.getDate() + (currentWeekOffset * 7));
        endOfWeek.setDate(endOfWeek.getDate() + (currentWeekOffset * 7));
    }

    weekRangeElement.textContent = startOfWeek.toLocaleDateString('en-US', { month: 'short', day: 'numeric' }) +
        ' - ' + endOfWeek.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
}


function updateDates() {
  var dateElements = document.querySelectorAll('.date-column');
  var currentDate = new Date();
  var startOfWeek = new Date(currentDate);
  startOfWeek.setDate(currentDate.getDate() - currentDate.getDay() + (currentDate.getDay() === 0 ? -6 : 1) + (currentWeekOffset * 7)); // Start from Monday

  dateElements.forEach(function(element, index) {
      var date = new Date(startOfWeek);
      date.setDate(date.getDate() + index);
      element.textContent = date.toLocaleDateString('en-US', { day: 'numeric' });

      // Highlight the current date
      if (date.getDate() === currentDate.getDate() && date.getMonth() === currentDate.getMonth()) {
          element.classList.add('current-date');
      } else {
          element.classList.remove('current-date');
      }

      // Update the timeslot URLs
      var dateTimeColumn = element.closest('.col');
      var dateColumn = element.textContent;
      var timeslots = dateTimeColumn.querySelectorAll('.timeslot-url');
      timeslots.forEach(function(timeslot) {
          var transactionUrl = timeslot.getAttribute('href');
          transactionUrl = transactionUrl + '&date=' + dateColumn + '&month=' + (date.getMonth() + 1) + '&year=' + date.getFullYear();
          timeslot.setAttribute('href', transactionUrl);
          transactionUrl = '';

        // Check if the date is less than the current date
          if (date < currentDate) {
            timeslot.classList.add('disabled-link');
            timeslot.addEventListener('click', function(event) {
                event.preventDefault();
            });
        }  else {
          
          timeslot.classList.remove('disabled-link');
          timeslot.removeEventListener('click', function(event) {
              event.preventDefault();
          });
        }

      });
  });
}

function isLogin(){
  var isLoggedIn =  document.querySelector('.islogin').innerText;// Assuming $isLoggedIn is a PHP variable
  
  var disableLinks = document.querySelectorAll('.disable-if-not-logged-in');

  disableLinks.forEach(function(link) {

      if (isLoggedIn == '0') {
          link.addEventListener('click', function(event) {
              event.preventDefault();
              alert('Please Login to book the lesson.');
          });
          link.classList.add('disabled');
      }
  });
}


  forwardArrow.addEventListener('click', function() {
      if (currentWeekOffset < 3) {
          currentWeekOffset++;
          updateWeekRange();
          updateDates();
          isLogin()
      }
  });

  backwardArrow.addEventListener('click', function() {
      if (currentWeekOffset > 0) {
          currentWeekOffset--;
          updateWeekRange();
          updateDates();
          isLogin()
      }
  });

  updateWeekRange();
  updateDates(); // Initial update
  isLogin()
});


