$(document).ready(function () {

  var selectors = document.querySelectorAll(".selector");
  var selectFields = document.querySelectorAll(".selectField");
  var optionsLists = document.querySelectorAll(".subject-list");
  var arrowIcons = document.querySelectorAll(".arrowIcon");
  var priceRange = document.querySelector("#priceRange");
  var priceValue = document.querySelector(".priceValue");

  selectors.forEach(function (selector, index) {
    var selectText = selector.querySelector(".selectText");
    var options = selector.querySelectorAll(".options");
    var subjectList = optionsLists[index];
    var arrowIcon = arrowIcons[index];

    selector.addEventListener("click", function (event) {
      event.stopPropagation();
      subjectList.classList.toggle("show");
      arrowIcon.classList.toggle("rotate");
    });

    document.body.addEventListener("click", function () {
      subjectList.classList.remove("show");
      arrowIcon.classList.remove("rotate");
    });

    priceRange.addEventListener("input", function () {
      var minPrice = 500;
      var maxPrice = 5000;
      var priceRangeValue = this.value / 100;
      var price = minPrice + (maxPrice - minPrice) * priceRangeValue;
      priceValue.textContent = price.toFixed(0);
    });

    options.forEach(function (option) {
      option.addEventListener("click", function () {
        var searchText;
        selectText.innerHTML = this.textContent;
        searchText = this.textContent;
        subjectList.classList.add("hide");
        arrowIcon.classList.remove("rotate");
      });
    });
  });

  // ***************************AJAX for pagination, live search and filter search. ***********************

  var globalSearchTerm;
  // Store the initial values of the filter texts
  var initialValues = {};

  // load page function
  function loadPage(page) {
    var url = "ajax-pagination";
    $.ajax({
      url: "ajax-pagination.php",
      type: "POST",
      data: { pageNum: page, url: url },
      success: function (res) {
        $("#tutor-data").html(res);
        // console.log(res);
      },
    });
  }
  loadPage();

  function liveSearchPage(searchTerm, page) {
    var url = "ajax-live-search";
    $.ajax({
      url: "ajax-live-search.php",
      type: "POST",
      data: { searchTerm: searchTerm, pageNum: page, url: url },
      success: function (res) {
        $("#tutor-data").html(res);
        // console.log(res);
      },
    });
  }

  function filterSearch(filterSet, page) {
    var url = "ajax-filter";
    $.ajax({
      url: "ajax-filter.php",
      type: "POST",
      data: { data: filterSet, pageNum: page, url: url },
      success: function (response) {
        $("#tutor-data").html(response);
      },
    });
  }

  //pagination code
  $(document).on("click", ".pagination li a", function (e) {
    e.preventDefault();
    var page_id = $(this).attr("id");
    var pageName = $(this).find("span");
    var pageValue = Object.values(pageName);
    // console.log(pageValue);
    // console.log(pageValue[0].innerText);

    if (pageValue[0].innerText == "ajax-live-search") {
      liveSearchPage(globalSearchTerm, page_id);
      ReadVideoModal();
      // console.log(pageValue[0].innerText);
    } else if (pageValue[0].innerText == "ajax-filter") {
      filterSearch(initialValues, page_id);
      ReadVideoModal();
      // console.log(pageValue[0].innerText);
      // console.log(initialValues);
    } else {
      loadPage(page_id);
      ReadVideoModal();
      // console.log(pageValue[0].innerText);
    }
  });

  // AJAX for live search
  $("#searchTerm").on("keyup", function () {
    globalSearchTerm = $(this).val();
    var url = "ajax-live-search";
    $.ajax({
      url: "ajax-live-search.php",
      type: "POST",
      data: { searchTerm: globalSearchTerm, url: url },
      success: function (res) {
        $("#tutor-data").html(res);
        // console.log(res);
      },
    });
    ReadVideoModal();
  });

  var filterTexts = document.querySelectorAll(".filter-text");

  filterTexts.forEach(function (filterText) {
    initialValues[filterText.id] = filterText.innerText;
  });
  console.log(initialValues);

  filterTexts.forEach(function (filterText) {
    var observer = new MutationObserver(function (data) {
      var currentValue = filterText.innerText;
      var url = "ajax-filter";
      if (currentValue !== initialValues[filterText.id]) {
        // console.log("Value changed:", currentValue);

        // Update the initial value to the current value
        initialValues[filterText.id] = currentValue;
        // console.log(initialValues);

        // Perform AJAX request here
        $.ajax({
          url: "ajax-filter.php",
          type: "POST",
          data: { data: initialValues, url: url },
          success: function (response) {
            $("#tutor-data").html(response);
          },
        });
        ReadVideoModal();
      }
      // console.log(data);
    });

    observer.observe(filterText, {
      childList: true,
      characterData: true,
      subtree: true,
    });

    sendAjaxRequest(initialValues, "ajax-filter.php");
  });

  function sendAjaxRequest(data, url) {
    $.ajax({
        url: url,
        type: "POST",
        data: { data: data, url: url },
        success: function (response) {
            $("#tutor-data").html(response);
        },
    });
}

// ******************************AJAX for Read more and video thumnail and modal funcitonality*******************
  function ReadVideoModal() {
    setTimeout(function () {
      // Your code here

      

      // Read more functionality

      var tutorCards = document.querySelectorAll(".tutor-card");
      console.log(tutorCards);
      tutorCards.forEach(function (tutorCard) {
        var profileDescription = tutorCard.querySelector(
          ".profile-description"
        );
        var readMoreLink = tutorCard.querySelector(".readMore");
        var profileDescriptionText = tutorCard.querySelector(
          ".profileDescriptionText"
        );

        readMoreLink.addEventListener("click", function (event) {
          event.preventDefault();
          console.log('Read more clicked');
          var maxHeight = window.getComputedStyle(profileDescription).maxHeight;

          if (maxHeight === "250px") {
            profileDescription.style.maxHeight = "none";
            profileDescriptionText.classList.remove("hide");
            readMoreLink.textContent = "Read less";
          } else {
            profileDescription.style.maxHeight = "250px";
            profileDescriptionText.classList.add("hide");
            readMoreLink.textContent = "Read more";
          }
        });
      });

      // Grabbing the videoId and url as key value pair
      function videoPreview() {
        const videoUrls = document.querySelectorAll(".video-url");
        let videoIds = {};

        videoUrls.forEach(function (videoUrl) {
          let url = videoUrl.textContent.trim();
          let videoId;

          // Check if the URL is in the format: https://www.youtube.com/watch?v=gjVQl_gkCbc
          if (url.includes("youtube.com/watch?v=")) {
            videoId = url.split("v=")[1];
            if (videoId.includes("&")) {
              videoId = videoId.split("&")[0];
            }
          }
          // Share URL: Check if the URL is in the format: https://youtu.be/gjVQl_gkCbc?si=YpBqx_iVXRJZlK0E
          else if (url.includes("youtu.be/")) {
            videoId = url.split("youtu.be/")[1];
            if (videoId.includes("?")) {
              videoId = videoId.split("?")[0];
            }
          }

          if (videoId) {
            let url = `https://www.youtube-nocookie.com/embed/${videoId}?autoplay=1&rel=0`;
            videoIds[videoId] = url;
            let playButton = videoUrl.nextElementSibling; // Assuming play button is next to the video URL
            playButton.dataset.videoId = videoId;
          }
        });

        return videoIds;
      }

      // Video modal functionality

      const playButtons = document.querySelectorAll(".play-button");
      const videoModals = document.querySelectorAll(".video-modal");
      const videoFrames = document.querySelectorAll(".video-frame");
      var thumbnailImgs = document.querySelectorAll(".thumbnailImg");
      const VideoidToUrl = videoPreview();

      playButtons.forEach(function (playButton, index) {
        const videoModal = videoModals[index];
        const videoFrame = videoFrames[index];
        const videoid = playButton.dataset.videoId;
        // console.log(videoid);

        playButton.addEventListener("click", function () {
          videoModal.style.display = "block";
          videoFrame.src = VideoidToUrl[videoid];
          // https://youtu.be/Wl7hr5b8db4
        });

        let closeButton = videoModal.querySelector(".close");
        closeButton.addEventListener("click", function () {
          videoModal.style.display = "none";
          videoFrame.src = "";
        });

        window.addEventListener("click", function (event) {
          if (event.target === videoModal) {
            videoModal.style.display = "none";
            videoFrame.src = "";
          }
        });
      });

      // AJAX for thumbnail

      function apiUrls() {
        const videoUrls = document.querySelectorAll(".video-url");
        let apiUrls = {};

        videoUrls.forEach(function (videoUrl) {
          let url = videoUrl.textContent.trim();
          let videoId;

          // Check if the URL is in the format: https://www.youtube.com/watch?v=gjVQl_gkCbc
          if (url.includes("youtube.com/watch?v=")) {
            videoId = url.split("v=")[1];
            if (videoId.includes("&")) {
              videoId = videoId.split("&")[0];
            }
          }
          // Share URL: Check if the URL is in the format: https://youtu.be/gjVQl_gkCbc?si=YpBqx_iVXRJZlK0E
          else if (url.includes("youtu.be/")) {
            videoId = url.split("youtu.be/")[1];
            if (videoId.includes("?")) {
              videoId = videoId.split("?")[0];
            }
          }

          if (videoId) {
            const apiKey = "AIzaSyBY3alvfttcwtNPoYvXLBziDeVXJDwCrmE"; // Your YouTube Data API key
            var apiUrl =
              "https://www.googleapis.com/youtube/v3/videos?id=" +
              videoId +
              "&key=" +
              apiKey +
              "&part=snippet";

            apiUrls[videoId] = apiUrl;
          }
        });

        return apiUrls;
      }

      // var apiValues = Object.values(apis);
      // console.log(apiValues);

      // var videoIds = [];
      // playButtons.forEach(function(playButton){
      //   var videoId = playButton.dataset.videoId;
      //   videoIds.push(videoId);
      // });
      // console.log(videoIds);

      const apis = apiUrls();
      var thumbnailImgs = document.getElementsByClassName("thumbnailImg");
      playButtons.forEach(function (playButton, index) {
        var videoId = playButton.dataset.videoId;
        // console.log(videoId);

        $.ajax({
          url: apis[videoId],
          method: "GET",
          success: function (response) {
            // console.log(response);
            var thumbnailUrl = response.items[0].snippet.thumbnails.medium.url;
            console.log(thumbnailUrl);
            var thumbnailImg = thumbnailImgs[index];
            // console.log(thumbnailImg);
            thumbnailImg.src = thumbnailUrl;
          },
          error: function () {
            console.error("Error fetching video details");
          },
        });
      });
    }, 2000);
  }
  ReadVideoModal();

});
