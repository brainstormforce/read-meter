
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
               if(document.getElementById("myBar") !== null && document.getElementById("myWrap") !== null ) {
                if (typeof document.getElementById("myBar") !== 'undefined' && typeof document.getElementById("myWrap") !== 'undefined' ) {
                    document.getElementById("myBar").style.opacity=0.5;
                    document.getElementById("myWrap").style.opacity=0.5;
                }
              }
            }

            function goActive()
            {
              if(document.getElementById("myBar") !== null && document.getElementById("myWrap") !== null ) {
                if (typeof document.getElementById("myBar") !== 'undefined' && typeof document.getElementById("myWrap") !== 'undefined' ) {
                    document.getElementById("myBar").style.opacity=1;
                    document.getElementById("myWrap").style.opacity=1;
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
           
          if(document.getElementById("myBar") !== null && document.getElementById("myWrap") !== null ) {
                if (typeof document.getElementById("myBar") !== 'undefined' && typeof document.getElementById("myWrap") !== 'undefined' ) {
          document.getElementById("myBar").style.width = scrolled + "%";
        }
      }
  }


  

  // Progress Bar color selection JS
  window.onload = function() {
  bsd_rt_ColorSelectCheck();
};
  function bsd_rt_ColorSelectCheck()
  { 
    nameSelect=document.getElementById("getFname").value;
    
      console.log(nameSelect);
      if(nameSelect === 'Gradient') {
         
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

      function bsd_rt_ColorSelectCheck_two(nameSelect)
  {
      console.log(nameSelect);
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

  
