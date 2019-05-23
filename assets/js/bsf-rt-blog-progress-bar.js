function wordCount(str) {
    str.each(function() {
        var str = jQuery(this),
            postheight = str.height(),
            postoffset = str.offset().top,
            postend = postheight + postoffset,
            scroll = jQuery(window).scrollTop();
        if (scroll > postoffset && scroll < postend) {
            var progress = (scroll - postoffset) / postheight,
                words = str.text().split(/\s+/).length,
                wrpm = 220,
                timeleft = Number(words / wrpm).toFixed(2),
                count = Number(timeleft / 100 * (100 - progress * 100)).toFixed(0);
            if (count == 1) minute = " minute left";
            else minute = " minutes left";
            console.log(count);
            if (count > 0) {
                //jQuery(".timeleft").html(count + minute).fadeIn(100);
                jQuery("#bsf_rt_progress_bar").css({
                    "width": Math.round(progress * 100) + "%"
                }).fadeIn(100)
            } else jQuery("#bsf_rt_progress_bar").fadeOut()
        }
    });
    if (scrollTimer !== null) clearTimeout(scrollTimer);
    scrollTimer = setTimeout(function() {
        jQuery("#bsf_rt_progress_bar").fadeOut()
    }, 1E3)
}
var scrollTimer = null;
jQuery(window).scroll(function() {
    str = jQuery('[id^="post-"]');
    wordCount(str)
}).scroll();