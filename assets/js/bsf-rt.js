
var idleTime = 0;

            var timeoutID;

            function setup()
            {


                this.addEventListener("keypress", resetTimer, false);
                this.addEventListener("DOMMouseScroll", resetTimer, false);
                this.addEventListener("mousewheel", resetTimer, false);


                startTimer();
            }
                setup();

            function startTimer()
            {
                // wait 2 seconds before calling goInactive
                timeoutID = window.setTimeout(goInactive, 1000);
            }

            function resetTimer(e)
            {
                window.clearTimeout(timeoutID);

                goActive();
            }

            function goInactive()
            {
               if(document.getElementById("bsf_rt_progress_bar") !== null && document.getElementById("bsf_rt_progress_bar_container") !== null ) {
                if (typeof document.getElementById("bsf_rt_progress_bar") !== 'undefined' && typeof document.getElementById("bsf_rt_progress_bar_container") !== 'undefined' ) {
                   document.getElementById("bsf_rt_progress_bar_container").setAttribute('style', 'opacity : 0.5; transition: opacity linear 200ms;');
                   // document.getElementById("bsf_rt_progress_bar_container").style.opacity=0.5;
                }
              }
            }

            function goActive()
            {
              if(document.getElementById("bsf_rt_progress_bar") !== null && document.getElementById("bsf_rt_progress_bar_container") !== null ) {
                if (typeof document.getElementById("bsf_rt_progress_bar") !== 'undefined' && typeof document.getElementById("bsf_rt_progress_bar_container") !== 'undefined' ) {
                   
                    document.getElementById("bsf_rt_progress_bar_container").setAttribute('style', 'opacity : 1; transition: opacity linear 200ms;');
                  // document.getElementById("bsf_rt_progress_bar_container").style.opacity=1;
                }
               }     
               startTimer();
            }


// Progress Bar JS
  window.onscroll = function () {
      myFunction()};

  function myFunction()
  {
      
          var content = document.getElementById("main");

          var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
          //console.log(winScroll);
          var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
          //var height = 1519;
          var scrolled = (winScroll / height) * 100;
        
          if(document.getElementById("bsf_rt_progress_bar") !== null && document.getElementById("bsf_rt_progress_bar_container") !== null ) {
                if (typeof document.getElementById("bsf_rt_progress_bar") !== 'undefined' && typeof document.getElementById("bsf_rt_progress_bar_container") !== 'undefined' ) {
          document.getElementById("bsf_rt_progress_bar").style.width = scrolled + "%";
          console.log(document.getElementById("bsf_rt_progress_bar").style.width);
        }
      }
  }


  

  // Progress Bar color selection JS
  window.onload = function() {
  bsd_rt_ColorSelectCheck();
 
};
  function bsd_rt_ColorSelectCheck() { 
   
   if (document.getElementById("bsf_rt_progress_bar_styles") !== null) {
    nameSelect=document.getElementById("bsf_rt_progress_bar_styles").value;
    
      
          if (nameSelect === 'Gradient') {
         
               document.getElementById("gradiant-wrap2").style.display = "table-row";
              document.getElementById("normal-color-wrap").style.display = "none";

          } else{
              document.getElementById("gradiant-wrap2").style.display = "none";
              document.getElementById("normal-color-wrap").style.display = "table-row";
          }
        }
          if (document.getElementById("bsf_rt_position_of_progress_bar")){
          progressOptionValue = document.getElementById("bsf_rt_position_of_progress_bar").value;
          if(progressOptionValue !== 'none') {
      
               document.getElementById("bsf-rt-progress-bar-options").style.display = "block";
               
          }
          else{
           document.getElementById("bsf-rt-progress-bar-options").style.display = "none";

          }
      }   
        //   if (document.getElementById("bsf_rt_single_page").checked) {
        //     document.getElementById("bsf_rt_single_page_position_of_read_time").style.display = "inline-block"; 
        //   } else {
        //         document.getElementById("bsf_rt_single_page_position_of_read_time").style.display = "none"; 
        // }
        // if (document.getElementById("bsf_rt_home_blog_page").checked) {
        //     document.getElementById("bsf_rt_home_blog_page_position_of_read_time").style.display = "inline-block"; 
        //   } else {
        //         document.getElementById("bsf_rt_home_blog_page_position_of_read_time").style.display = "none"; 
        // }
        // if (document.getElementById("bsf_rt_archive_page").checked) {
        //     document.getElementById("bsf_rt_archive_page_position_of_read_time").style.display = "inline-block"; 
        //   } else {
        //         document.getElementById("bsf_rt_archive_page_position_of_read_time").style.display = "none"; 
        // }


   
 }

      function bsd_rt_ColorSelectCheck_two(nameSelect)
  {
      
      if(nameSelect) {
          admOptionValue = document.getElementById("gradiantcolor").value;
          if(admOptionValue == nameSelect.value) {
      
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


function bsd_rt_Progressbarpositioncheck(positionSelect) {

if(positionSelect) {
  //console.log(positionSelect.value);
          //progressOptionValue = document.getElementById("bsf_rt_position_of_progress_bar").value;
          if(positionSelect.value !== 'none') {
      
               document.getElementById("bsf-rt-progress-bar-options").style.display = "block";
               
          }
          else{
           document.getElementById("bsf-rt-progress-bar-options").style.display = "none";

          }
      }
}

// function singlePage() {

//     // access properties using this keyword
//     if ( document.getElementById('bsf_rt_single_page').checked ) {
//         document.getElementById("bsf_rt_single_page_position_of_read_time").style.display = "inline-block"; 

//     } else {
//        document.getElementById("bsf_rt_single_page_position_of_read_time").style.display = "none"; 
//       }
// }
// function homePage() {

//     // access properties using this keyword
//     if ( document.getElementById('bsf_rt_home_blog_page').checked ) {
//         document.getElementById("bsf_rt_home_blog_page_position_of_read_time").style.display = "inline-block"; 

//     } else {
//        document.getElementById("bsf_rt_home_blog_page_position_of_read_time").style.display = "none"; 
//       }
// }
// function archivePage() {

//     // access properties using this keyword
//     if ( document.getElementById('bsf_rt_archive_page').checked ) {
//         document.getElementById("bsf_rt_archive_page_position_of_read_time").style.display = "inline-block"; 

//     } else {
//        document.getElementById("bsf_rt_archive_page_position_of_read_time").style.display = "none"; 
//       }
// }
  
