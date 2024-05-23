document.addEventListener('DOMContentLoaded', function() {
  // Your code here



// For profile description

function updateWordCount(textareaId, counterId, limit) {
  const textarea = document.getElementById(textareaId);
  const counter = document.getElementById(counterId);
  
  if (!textarea || !counter) {
    console.error("Textarea or counter element not found.");
    return;
  }

  const words = textarea.value.trim().split(/\s+/).length;
  
  if (words > limit) {
    textarea.value = textarea.value.split(/\s+/).slice(0, limit).join(" ");
  }

  counter.textContent = words + "/" + limit;

  // Prevent further input if limit is reached
  textarea.addEventListener('keydown', function(event) {
    if (words >= limit && event.key.length === 1) {
      event.preventDefault();
    }
  });

}

document.querySelectorAll("textarea").forEach(textarea => {
  const limit = 100;
  const counterId = textarea.id + "-counter";
  console.log(counterId);
  textarea.addEventListener("input", () => {
    updateWordCount(textarea.id, counterId, limit);
  });

  // Initialize word count
  // updateWordCount(textarea.id, counterId, limit);
});



// For image preview

function handleFileSelect(event) {
  const file = event.target.files[0];
  if (!file) return;

  const reader = new FileReader();
  reader.onload = function(e) {
    const img = document.createElement('img');
    img.src = e.target.result;
    img.classList.add('img-thumbnail');
    document.getElementById('image-preview').innerHTML = '';
    document.getElementById('image-preview').appendChild(img);
  };
  reader.readAsDataURL(file);
}

// For video preview

function previewVideo() {
  const input = document.getElementById('video-link');
  const url = input.value;
  let videoId;

  // Check if the URL is in the format: https://www.youtube.com/watch?v=gjVQl_gkCbc
  if (url.includes('youtube.com/watch?v=')) {
    videoId = url.split('v=')[1];
    if(videoId.includes('&')){
      videoId = videoId.split('&')[0];
    }
  }
  // Share URL:  Check if the URL is in the format: https://youtu.be/gjVQl_gkCbc?si=YpBqx_iVXRJZlK0E
  else if (url.includes('youtu.be/')) {
    videoId = url.split('youtu.be/')[1];
  }

  // console.log(videoId);

  if (videoId) {
    const newUrl = `https://www.youtube-nocookie.com/embed/${videoId}`;
    const iframe = document.querySelector('iframe');
    iframe.setAttribute('src', newUrl);
    iframe.classList.remove('visually-hidden');
  } else {
    alert('Invalid YouTube video link');
  }
}





// For languages

let languageCount = 1; // Start with one language already added

document.getElementById('add-language').addEventListener('click', function() {
    if (languageCount < 2) { // Allow adding only two languages
        var container = document.getElementById('language-container');
        var newLanguage = container.children[0].cloneNode(true);
        container.insertBefore(newLanguage, document.getElementById('add-language'));
        languageCount++;
    } else {
        alert('You can only add two languages.');
    }
});

// For certificates

function toggleInputs() {
    var inputs = document.querySelectorAll('#certificate-container input, #certificate-container select');
    var addCertificate = document.getElementById('add-certificate');

    inputs.forEach(function(input) {
      input.disabled = !input.disabled;
      input.style.opacity = input.disabled ? 0.5 : 1;
    });

    addCertificate.style.pointerEvents = addCertificate.style.pointerEvents === 'none' ? 'auto' : 'none';
    addCertificate.style.opacity = addCertificate.style.opacity === '0.5' ? '1' : '0.5';
}

document.getElementById('add-certificate').addEventListener('click', function () {
  var certificateContainer = document.getElementById('certificate-container');
  for(var i = 0; i<=4; i++){
    var newCertificateContainer = certificateContainer.children[i].cloneNode(true);
    newCertificateContainer.querySelector('input, select').value = '';
    certificateContainer.insertBefore(newCertificateContainer, document.getElementById('add-certificate'));
  }
});





// For Education

function toggleEducationInputs() {
    var inputs = document.querySelectorAll('#education-container input, #education-container select');
    var addEducation = document.getElementById('add-education');

    inputs.forEach(function(input) {
      input.disabled = !input.disabled;
      input.style.opacity = input.disabled ? 0.5 : 1;
    });

    addEducation.style.pointerEvents = addEducation.style.pointerEvents === 'none' ? 'auto' : 'none';
    addEducation.style.opacity = addEducation.style.opacity === '0.5' ? '1' : '0.5';
  }

  document.getElementById('add-education').addEventListener('click', function () {
    var educationContainer = document.getElementById('education-container');
    for(var i = 0; i<=4; i++){
      var newEducationContainer = educationContainer.children[i].cloneNode(true);
      newEducationContainer.querySelector('input, select').value = '';
      educationContainer.insertBefore(newEducationContainer, document.getElementById('add-education'));
    }
  });



// For timeslot


document.querySelectorAll('.form-check-input').forEach(function(checkbox) {
  checkbox.addEventListener('change', function() {
    var dayContainer = this.closest('.my-3');
    var timeslotContainer = dayContainer.querySelector('.timeslot-template');
    var startTimeSelect = timeslotContainer.querySelector('.start-time');
    var endTimeSelect = timeslotContainer.querySelector('.end-time');
    var addTimeslot = dayContainer.querySelector('.add-timeslot');

    if (this.checked) {
      startTimeSelect.removeAttribute('disabled');
      endTimeSelect.removeAttribute('disabled');
      addTimeslot.style.opacity = '1';
      addTimeslot.style.pointerEvents = 'auto';
    } else {
      startTimeSelect.setAttribute('disabled', 'disabled');
      endTimeSelect.setAttribute('disabled', 'disabled');
      addTimeslot.style.opacity = '0.5';
      addTimeslot.style.pointerEvents = 'none';
    }
  });
});

// For availability

document.querySelectorAll('.add-timeslot').forEach(function(button) {
  button.addEventListener('click', function() {
    var newTimeslot = document.querySelector('.timeslot-template').cloneNode(true);
    inputs = newTimeslot.querySelectorAll('.timeslot-template select');
    inputs.forEach(function(input){
   if(input.hasAttribute('disabled')){
    input.removeAttribute('disabled');
  }
});
    newTimeslot.classList.remove('timeslot-template');
    var parentDiv = this.parentElement;
    parentDiv.insertBefore(newTimeslot, this);
  });
});


  // Function to serialize the schedule data into JSON format
  function serializeSchedule() {
    const days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    const schedule = [];
  
    days.forEach(day => {
      const dayElement = document.getElementById(day);
      if (dayElement) {
        const isChecked = dayElement.querySelector('input[type="checkbox"]').checked;
        if (isChecked) {
          const timeSlots = [];
          dayElement.querySelectorAll('.toggle-day').forEach(timeslot => {
            const startTime = timeslot.querySelector('.start-time').value;
            const endTime = timeslot.querySelector('.end-time').value;
            if(startTime != '' && endTime != ''){
              if (startTime && endTime && startTime < endTime) {
                timeSlots.push({ start: startTime, end: endTime });
              } else {
                alert('Invalid time slot: "From" time should be less than "To" time');
              }
            }
          });
          if (timeSlots.length > 0) {
            schedule.push({ day: day, slots: timeSlots });
          }
        }
      }
    });
    console.log(schedule);
    document.getElementById('schedule-data').value = JSON.stringify(schedule);
  }
  

// Add an event listener to the form to serialize the schedule data before submission
document.querySelector('form').addEventListener('submit', function(event) {
  serializeSchedule()
  
  // Uncomment the following line if you want to prevent the form from actually submitting
  // event.preventDefault();
});


});