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
        }
    }
}

function goActive()
{
    if(document.getElementById("bsf_rt_progress_bar") !== null && document.getElementById("bsf_rt_progress_bar_container") !== null ) {
      
        if (typeof document.getElementById("bsf_rt_progress_bar") !== 'undefined' && typeof document.getElementById("bsf_rt_progress_bar_container") !== 'undefined' ) {
       
            document.getElementById("bsf_rt_progress_bar_container").setAttribute('style', 'opacity : 1; transition: opacity linear 200ms;');
        }
    }     
    startTimer();
}


// Progress Bar JS
window.onscroll = function () {
    var content = document.getElementById("bsf_rt_marker");
    bsfrtProgressBarScroll(content)
};
function bsfrtProgressBarScroll(content) {

    var intViewportHeight = window.innerHeight; // window height
        if (content !== null) {
            var height = content.clientHeight;
            var winScroll = document.documentElement.scrollTop - content.offsetTop;

    if (content.clientHeight < intViewportHeight) {
        if(document.getElementById("bsf_rt_progress_bar") !== null && document.getElementById("bsf_rt_progress_bar_container") !== null ) {

            if (typeof document.getElementById("bsf_rt_progress_bar") !== 'undefined' && typeof document.getElementById("bsf_rt_progress_bar_container") !== 'undefined' ) {

                document.getElementById("bsf_rt_progress_bar").style.width = 0 + "%";
                document.getElementById("bsf_rt_progress_bar_container").style.width = 0+ "%";
            }
        }
    } else {
    height -= content.offsetTop;
        if (winScroll <= 0){
            if(document.getElementById("bsf_rt_progress_bar") !== null && document.getElementById("bsf_rt_progress_bar_container") !== null ) {

                if (typeof document.getElementById("bsf_rt_progress_bar") !== 'undefined' && typeof document.getElementById("bsf_rt_progress_bar_container") !== 'undefined' ) {

                    document.getElementById("bsf_rt_progress_bar").style.width = 0 + "%";
                }
            }
        }

        var scrolled = (winScroll / height) * 100;
        if( scrolled ) {
            if(document.getElementById("bsf_rt_progress_bar") !== null && document.getElementById("bsf_rt_progress_bar_container") !== null ) {

                if (typeof document.getElementById("bsf_rt_progress_bar") !== 'undefined' && typeof document.getElementById("bsf_rt_progress_bar_container") !== 'undefined' ) {

                    document.getElementById("bsf_rt_progress_bar").style.width = scrolled + "%";
                }
            }
        }
    }
 } else {
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

}

// Progress Bar color selection JS
window.addEventListener(
    'load', function () {

        bsf_rt_ColorSelectCheck();
    }
);

function bsf_rt_ColorSelectCheck()
{ 

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
    
}

function bsf_rt_ColorSelectCheck_two(nameSelect)
{

    if(nameSelect) {

        if('Gradient' == nameSelect.value) {

            document.getElementById("gradiant-wrap2").style.display = "table-row";
        }
        else{

            document.getElementById("gradiant-wrap2").style.display = "none";
        }
    }
}

function bsf_rt_Progressbarpositioncheck(positionSelect)
{

    if(positionSelect) {

        if(positionSelect.value !== 'none') {

            document.getElementById("bsf-rt-progress-bar-options").style.display = "block";

        }
        else{

            document.getElementById("bsf-rt-progress-bar-options").style.display = "none";

        }
    }
}

    //var content = document.getElementById("comments");
    
    // 1. Short Content
    //  Content height < viewport height = dont show progerssbar.
    // 2. Large Content
    //  
    // 3. Short Content + Comments 
    // 
    // 4. Large Content + Comments 
    // 