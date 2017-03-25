function show(e) {
     var arr = document.querySelectorAll('.survey_card');
     for (var i = 0; i < arr.length; i++) {
         var attribute = arr[i].getAttribute("data-survey-title");
         if (attribute.search(e.value) !== -1) {
            arr[i].style.display = 'block';
         } else {
             arr[i].style.display = 'none';
         }
     }
 }