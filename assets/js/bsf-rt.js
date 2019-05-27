var idleTime = 0;

var timeoutID;

function setup() {

  this.addEventListener("keypress", resetTimer, false);

  this.addEventListener("DOMMouseScroll", resetTimer, false);

  this.addEventListener("mousewheel", resetTimer, false);
  startTimer();

}

setup();

function startTimer() {
  // wait 2 seconds before calling goInactive
  timeoutID = window.setTimeout(goInactive, 1000);
}

function resetTimer(e) {

  window.clearTimeout(timeoutID);
  goActive();
}

function goInactive() {
  if(document.getElementById("bsf_rt_progress_bar") !== null && document.getElementById("bsf_rt_progress_bar_container") !== null ) {
  
    if (typeof document.getElementById("bsf_rt_progress_bar") !== 'undefined' && typeof document.getElementById("bsf_rt_progress_bar_container") !== 'undefined' ) {
  
       document.getElementById("bsf_rt_progress_bar_container").setAttribute('style', 'opacity : 0.5; transition: opacity linear 200ms;');
    }
  }
}

function goActive() {
    if(document.getElementById("bsf_rt_progress_bar") !== null && document.getElementById("bsf_rt_progress_bar_container") !== null ) {
      
      if (typeof document.getElementById("bsf_rt_progress_bar") !== 'undefined' && typeof document.getElementById("bsf_rt_progress_bar_container") !== 'undefined' ) {
       
        document.getElementById("bsf_rt_progress_bar_container").setAttribute('style', 'opacity : 1; transition: opacity linear 200ms;');
      }
    }     
    startTimer();
}


// Progress Bar JS
window.onscroll = function () {

 bsfrtProgressBarScroll()
};

function bsfrtProgressBarScroll() {

    var content = document.getElementById("main");

    var winScroll = document.body.scrollTop || document.documentElement.scrollTop;

    var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;

    var scrolled = (winScroll / height) * 100;

    if(document.getElementById("bsf_rt_progress_bar") !== null && document.getElementById("bsf_rt_progress_bar_container") !== null ) {
      
      if (typeof document.getElementById("bsf_rt_progress_bar") !== 'undefined' && typeof document.getElementById("bsf_rt_progress_bar_container") !== 'undefined' ) {
        
        document.getElementById("bsf_rt_progress_bar").style.width = scrolled + "%";
      }
    }
}

// Progress Bar color selection JS
window.addEventListener('load', function() {

  bsf_rt_ColorSelectCheck();
});

function bsf_rt_ColorSelectCheck() { 

    if (document.getElementById("bsf_rt_progress_bar_styles") !== null) {

      nameSelect=document.getElementById("bsf_rt_progress_bar_styles").value;

      if (nameSelect === 'Gradient') {

        document.getElementById("gradiant-wrap2").style.display = "table-row";
      } else{

        document.getElementById("gradiant-wrap2").style.display = "none";
      }
    }
    if (document.getElementById("bsf_rt_position_of_progress_bar")) {
        progressOptionValue = document.getElementById("bsf_rt_position_of_progress_bar").value;
        
        if(progressOptionValue !== 'none') {

          document.getElementById("bsf-rt-progress-bar-options").style.display = "block";

        }
        else{

          document.getElementById("bsf-rt-progress-bar-options").style.display = "none";

        }
    } 
    if (document.getElementById("bsf_rt_read_time_bg_option")) {

        rtOptionValue = document.getElementById("bsf_rt_read_time_bg_option").value;

        if('None' == rtOptionValue) {

          document.getElementById("bsf_rt_bg").style.display = "none";
        }
        else{

          document.getElementById("bsf_rt_bg").style.display = "block";
        }
    } 
}

function bsf_rt_ColorSelectCheck_two(nameSelect) {

    if(nameSelect) {

      if('Gradient' == nameSelect.value) {

        document.getElementById("gradiant-wrap2").style.display = "table-row";
      }
      else{

        document.getElementById("gradiant-wrap2").style.display = "none";
      }
    }
}

function bsf_rt_Progressbarpositioncheck(positionSelect) {

    if(positionSelect) {

      if(positionSelect.value !== 'none') {

        document.getElementById("bsf-rt-progress-bar-options").style.display = "block";

      }
      else{

        document.getElementById("bsf-rt-progress-bar-options").style.display = "none";

      }
    }
}
function bsf_rt_readtimebgoption(bgoption) {

    if(bgoption) {

      if('None' == bgoption.value) {

        document.getElementById("bsf_rt_bg").style.display = "none";
      }
      else{

        document.getElementById("bsf_rt_bg").style.display = "block";
      }
    }
}
