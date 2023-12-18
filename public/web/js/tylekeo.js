var device = 'desktop';
var date = 1;
$(".btn-keo-ngay span").first().css( "display", "inline-block" );
if ( jQuery("#load_keo_mb").length ) device = "mobile";

get_keo_live(true);
setInterval(get_keo_live, 30031);

setInterval(get_keo_normal, 60000);

function get_keo_live(isFirst) {
    if ( date !== 1 ) { return }
    jQuery.ajax({
        type: 'POST',
        data: { device: device, type: 'live', CsrfToken: csrf_token },
        url: "https://odds.keopro.com/ajax_tyle.php",
        success: function (result) {
            result = JSON.parse(result);
            if (result.token) csrf_token = result.token;
            if ( result.html != "Error: wrong request CsrfToken.") {
                if ( device === 'desktop')
                    jQuery('#load_keo').html(result.html);
                else
                    jQuery('#load_keo_mb').html(result.html);
                if ( !isFirst ) runAfterAjax();
            }

            jQuery.ajax({
                type: 'POST',
                data: { device: device, type: 'live-tivi', CsrfToken: csrf_token },
                url: "https://odds.keopro.com/ajax_tyle.php",
                success: function (result) {
                    result = JSON.parse(result);
                    if (result.token) csrf_token = result.token;
                    if ( result.html != "Error: wrong request CsrfToken.") {
                        jQuery('#live-match-popup').html(result.html);
                        var live_num = jQuery("#live-match-popup>table").length;
                        if ( live_num === 0 ) {
                            jQuery(".live-match").hide();
                        } else {
                            jQuery("#live-num").html(live_num);
                            jQuery(".live-match").show();
                        }
                    }
                    if ( isFirst ) {
                        if ( $('#normal_dt').length ||  $('#normal_mbs').length) {
                            get_keo_normal();
                        }
                    }
                }
            });
        }
    });
}

function get_keo_normal(isSelectDate) {
    if(typeof(isSelectDate) === "undefined") {
        if ( date !== 1 ) { return }
    }
    jQuery.ajax({
        type: 'POST',
        data: { device: device, type: 'normal', date: date, CsrfToken: csrf_token },
        url: "https://odds.keopro.com/ajax_tyle.php",
        success: function (result) {
            result = JSON.parse(result);
            if (result.token) csrf_token = result.token;
            if ( result.html != "Error: wrong request CsrfToken.") {
                if ( device === 'desktop')
                    jQuery('#normal_dt').html(result.html);
                else
                    jQuery('#normal_mbs').html(result.html);
                runAfterAjax();
            }
        }
    });
}

var typingTimer;                //timer identifier
var doneTypingInterval = 500;  //time in ms, 5 second for example
var $input = $('#input-search');
$input.on('keyup', function () {
    query = $(this).val();
    if ( query.length > 0 ) {
        $(".search_tyle span.clear-span").show();
        $(".search_tyle span.search-span").hide();
    } else {
        $(".search_tyle span.clear-span").hide();
        $(".search_tyle span.search-span").show();
    }

    clearTimeout(typingTimer);
    typingTimer = setTimeout(search_keo, doneTypingInterval);
});
$input.on('keydown', function () {
    clearTimeout(typingTimer);
});


function clearSearch(){
    $("#input-search").val('');
    search_keo();
}

$("#filter-select-all").on('click', function(){
    $('#filter_options input:checkbox').prop('checked', true);
    search_keo();
});

$("#filter-clear").on('click', function(){
    $('#filter_options input:checkbox').prop('checked', false);
    search_keo();
});

$('#filter_options input:checkbox').change(function(){
    search_keo();
});

function elementHideShow(elementToHideOrShow) {
    var el = $('#' + elementToHideOrShow);
    el.hide();
}

function elementShow(elementToHideOrShow) {
    var el = $('#' + elementToHideOrShow);
    el.show();
}

function isViewTLH1(isView, id) {
    var elBut = $('#showHiep' + id);
    var hiep1 = localStorage.getItem("keo_hiep_1_open");
    hiep1 = JSON.parse(hiep1);
    var hiep1_final = hiep1;
    if ( Array.isArray(hiep1) ){
        hiep1_final = hiep1_final.filter(function (open_id) {
            return open_id !== id;
        })
    }
    if (isView === 0) {
        elementShow('viewTyLeHiep' + id);
        elBut.css('opacity', '0');
        // open
        if ( Array.isArray(hiep1) ){
            hiep1_final.push(id);
        } else {
            hiep1_final = [id];
        }

    } else {
        elementHideShow('viewTyLeHiep' + id);
        elBut.css('opacity', '1');
    }
    localStorage.setItem("keo_hiep_1_open", JSON.stringify(hiep1_final));
}

function openTySo(id, isAjaxCall) {
    if ( isAjaxCall === "undefined" ) isAjaxCall  = false;
    var thisElement = $("#tiso"+id);
    var tiso = localStorage.getItem("keo_tiso_open");
    tiso = JSON.parse(tiso);
    var tiso_final = tiso;
    if ( Array.isArray(tiso) ){
        tiso_final = tiso_final.filter(function (open_id) {
            return open_id !== id;
        })
    }

    if ( thisElement.hasClass( 'active' ) && !isAjaxCall ) {
        thisElement.removeClass('active');
        thisElement.next().removeClass('open');
    } else {
        thisElement.addClass('active');
        thisElement.next().addClass('open');
        if ( Array.isArray(tiso) ){
            tiso_final.push(id);
        } else {
            tiso_final = [id];
        }
    }

    localStorage.setItem("keo_tiso_open", JSON.stringify(tiso_final));
}

function open_exsit_open_item(){
    var hiep1 = localStorage.getItem("keo_hiep_1_open");
    hiep1 = JSON.parse(hiep1);
    var tiso = localStorage.getItem("keo_tiso_open");
    tiso = JSON.parse(tiso);
    if ( Array.isArray(tiso) ){
        tiso.forEach(function(id) {
            openTySo(id, true);
        });
    }
    if ( Array.isArray(hiep1) ){
        hiep1.forEach(function(id) {
            isViewTLH1(0, id);
        });
    }
}

function add_ads(){
    $(".wordad").remove();
    if (typeof ads_arr !== 'undefined' ) {
        if ( ads_arr.length > 0) {
            var count_ads = 0;
            var insert = false;
            var $this = null;
            var class_arr = ['dong1','dong2','dong3','dong4'];
            $(".keo-dong").each(function() {
                if (! $(this).is(":visible") ) return;
                if ( count_ads < ads_arr.length ) {
                    $this = $(this);
                    insert = false;
                    class_arr.every(function (className) {
                        if ($this.hasClass(className)) {
                            if ( $this.next().hasClass('keo-ti-so') ){
                                $this = $this.next();
                                insert = true;
                                return false;
                            }
                            if ( $this.next().hasClass('hiep_1') ){
                                $this = $this.next();
                                if ( $this.next().hasClass('keo-ti-so') ){
                                    $this = $this.next();
                                    insert = true;
                                    return false;
                                }
                            }
                            if (!$this.next().hasClass(className) ) {
                                insert = true;
                                return false;
                            }
                        }
                        return true;
                    });

                    if ( insert ) {
                        var str_ad = '';
                        if ( ads_arr[count_ads].type === "image" ) {
                            str_ad = '<tr class="wordad"><td colspan="8" align="center"><a target="_blank" rel="nofollow" href="'+ads_arr[count_ads].link+'"><img style="width: 100%;" src="'+ads_arr[count_ads].image+'" alt="'+ads_arr[count_ads].title+'" /></a></td></tr>'
                        } else {
                            str_ad = '<tr class="wordad"><td colspan="8" align="center"><a class="blink_me" target="_blank" style="color:red;line-height:20px;" rel="nofollow" href="'+ads_arr[count_ads].link+'" title="'+ads_arr[count_ads].text+'"><b>'+ads_arr[count_ads].text+'</b></a></td></tr>';
                        }
                        $(str_ad).insertAfter($this);
                        count_ads++;
                    }
                }
            })
        }
    }
}

function openFilter(){
    $('#open_filter').toggleClass('active');
    $('#filter_options').slideToggle();
}

function filter_keo(){
    var array_filters = [];
    $('#filter_options input:checkbox').each(function(){
        if ( $(this).prop('checked') ){
            var filter_value = $(this).val();
            if ( filter_value == 'la liga') {
                array_filters.push('spain segunda division');
                array_filters.push('spain primera division');
            }
            else array_filters.push(filter_value);
        }
    });
    if ( array_filters.length ) {
        $(".odd-competition").each(function() {
            var competition_name = $(this).data("name");
            if ( array_filters.indexOf(competition_name) < 0 ){
                $(this).hide();
            }
            else {
                $(this).show();
            }
        })
    }
}

function search_keo(){
    $(".search_tyle span.search-span").show();
    $(".search_tyle span.clear-span").hide();

    $(".search_tyle span.search-span").css('background-image', 'url(/loading_icon.gif)');
    $(".search_tyle span.search-span").css('width', '25px');

    $(".odd-competition").show();
    filter_keo();

    $(".keo-search").show();
    $(".keo-ti-so").show();

    var query = $("#input-search").val();
    query = query.toLowerCase();

    if ( query.length > 0 ) {
        $(".keo-search").each(function () {
            var home = $(this).data('home');
            var away = $(this).data('away');
            var str_search = home + " " + away;
            if (str_search.search(query) === -1){
                $(this).hide();
                if ( $(this).next().hasClass("hiep_1") ){
                    $(this).next().hide();
                    if ( $(this).next().next().hasClass("keo-ti-so") ) $(this).next().next().hide();
                }else if( $(this).next().hasClass("keo-ti-so") ){
                    $(this).next().hide();
                }
            }
        });
    }

    $(".wordad").remove();
    hideCompetitionEmpty();
    open_exsit_open_item();
    add_ads();
    setTimeout(function(){
        var query = $input.val();
        if ( query.length > 0 ) {
            $(".search_tyle span.clear-span").show();
            $(".search_tyle span.search-span").hide();
        } else {
            $(".search_tyle span.clear-span").hide();
            $(".search_tyle span.search-span").css('background-image', 'url(/search-icon-1.png)');
            $(".search_tyle span.search-span").css('width', '25px');
            $(".search_tyle span.search-span").show();
        }
    }, 500);
}

function hideCompetitionEmpty() {
    var show = false;
    $(".odd-competition").each(function() {
        show = false;
        $(this).find(".keo-search").each(function () {
            if ( $(this).is(":visible") ) {
                show = true;
            }
        });
        if ( show ) $(this).show(); else $(this).hide();
    });
    checkEmptyAllValue();
}

function checkEmptyAllValue(){
    var show = false;
    $(".message-live").hide();
    $(".message-normal").hide();
    if ( 'desktop' === device ) {
        if  (! $("#load_keo p.no-odds").length ) {
            show = false;
            $("#load_keo").find(".odd-competition").each(function () {
                if ( $(this).is(":visible") ) {
                    show = true;
                }
            });
            if ( !show ) $(".message-live").show();
        }

        if  (! $("#normal_dt p.no-odds").length ) {
            show = false;
            $("#normal_dt").find(".odd-competition").each(function () {
                if ( $(this).is(":visible") ) {
                    show = true;
                }
            });
            if ( !show ) $(".message-normal").show();
        }
    } else {
        if  (! $("#load_keo_mb p.no-odds").length ) {
            show = false;
            $("#load_keo_mb").find(".odd-competition").each(function () {
                if ( $(this).is(":visible") ) {
                    show = true;
                }
            });
            if ( !show ) $(".message-live").show();
        }

        if  (! $("#normal_mbs p.no-odds").length ) {
            show = false;
            $("#normal_mbs").find(".odd-competition").each(function () {
                if ( $(this).is(":visible") ) {
                    show = true;
                }
            });
            if ( !show ) $(".message-normal").show();
        }
    }
}

function runAfterAjax(){
    search_keo();
}

function PopUpLive(id, time) {
    var url = "https://keopro.com/live.php?id="+id+"&time="+time;
    window.open(url, "live-"+id, "height=800,width=860");
}


$(".btn-keo-ngay").click(function(){
    var thisValue = parseInt($(this).attr("value"));
    if ( thisValue === 1 ) {
        get_keo_live();
        $("#keolive").show();
    } else {
        $("#keolive").hide();
    }

    $(".btn-keo-ngay span").css( "display", "none" );
    $(this).find("span").css( "display", "inline-block" );
    if ( thisValue !== date) {
        date = thisValue;
        $("#header-odds").html($(this).attr("date"));
        get_keo_normal("isSelectDate");
    } else if (thisValue === 1){
        if ( "mobile" === device ) {
            $('html, body').animate({
                scrollTop: $("#header-odds").offset().top
            }, 1000);

        } else {
            $('html, body').animate({
                scrollTop: $("#header-odds").offset().top-170
            }, 1000);
        }
    }
});

function toTopFunction() {
    $('html, body').animate({
        scrollTop: 0
    }, 1000);
}
var lastScrollTop = 0;
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
    var st = $(this).scrollTop();
    if ( (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) && st < lastScrollTop) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
    lastScrollTop = st;
}

$(".live-match").on('click', function () {
    $("#live-match-popup").toggle();
})