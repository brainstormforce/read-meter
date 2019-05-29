
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