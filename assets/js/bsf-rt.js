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

// Color Picker JS
jQuery(document).ready(function($){
    $('.my-color-field').wpColorPicker();
});

// Progress Bar color selection JS
function bsd_rt_ColorSelectCheck(nameSelect)
{
    console.log(nameSelect);
    if(nameSelect){
       admOptionValue = document.getElementById("gradiantcolor").value;
       if(admOptionValue == nameSelect.value){
            
             document.getElementById("gradiant-wrap2").style.display = "table-row";
             document.getElementById("gradiant-wrap1").style.display = "table-row";
            document.getElementById("normal-color-wrap").style.display = "none";

        }
        else{
            document.getElementById("gradiant-wrap2").style.display = "none";
            document.getElementById("gradiant-wrap1").style.display = "none";            
            document.getElementById("normal-color-wrap").style.display = "table-row";
        }
      }
}
