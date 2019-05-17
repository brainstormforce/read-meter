// Progress Bar JS
window.onscroll = function() {myFunction()};

function myFunction() {
  console.log("inside myfun");
  var content = document.getElementById("main");

  var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
  console.log(winScroll);
  var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  //var height = 1519;
  console.log(document.documentElement.clientHeight);
  var scrolled = (winScroll / height) * 100;
  console.log(scrolled); 
  // console.log(scrolled);
  document.getElementById("myBar").style.width = scrolled + "%";
}

// Select Option of Post Type JS
var expanded = false;
    function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}

// Color Picker JS
jQuery(document).ready(function($){
    $('.my-color-field').wpColorPicker();
});