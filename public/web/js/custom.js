$(document).on('change', '.loadMoreDate', function () {
    let date = $(this).val();
    $.ajax({
        data: {date: date},
        type: 'GET',
        dataType: 'html',
        success: function (res) {
            res = $(res);
            $('.ajax_content').html(res.find('.ajax_content'));
        }
    })
});
$(document).on('change', '.loadMoreRound', function () {
    let round = $(this).val();
    $.ajax({
        data: {round: round},
        type: 'GET',
        dataType: 'html',
        success: function (res) {
            res = $(res);
            $('.ajax_content').html(res.find('.ajax_content'));
        }
    })
});

$(window).scroll(function () {
    if ($(this).scrollTop() > 500) {
        $('#menu').addClass('scroll-active');
    } else {
        $('#menu').removeClass('scroll-active');
    }
});

if($('.summary-title') && $('.list-unstyled')){
    $('.summary-title').on('click', function(){
        $(this).parent().find('.list-unstyled').slideToggle();
    })
}

$('.collapsible').on('click', function (e) {
    e.preventDefault();
    $(this).toggleClass('active');
});

if($('.btn-cat-load-more'))
{
    $('.btn-cat-load-more').on('click', function (e) {
        e.preventDefault();
        var _this = $(this),
            category_id = _this.data('catid'),
            page = _this.data('page'),
            keyWord = _this.data('keyword'),
            tag_id = _this.data('tagid'),
            url = "";
        if(typeof keyWord != 'undefined') {
            console.log(keyWord)
            url = "/search/load-more-posts?keyword=" + keyWord + '&page='+  page;
        }
        if(typeof category_id != 'undefined')
        {
            url = "/load-more-posts/" + category_id + "/" + page;
        }
        if(typeof tag_id != 'undefined')
        {
            url = "/tag/load-more-posts/" + tag_id + "/" + page;
        }
        $.ajax({
            type: "GET",
            url: url,
            success: function (response) {
                if (response.status == 204) {
                    _this.text('Không còn bài viết phù hợp');
                }else if(response.status == 200){
                    $('.list-more-posts').append(response.data);
                    _this.data('page', page+1);
                    _this.text('Tải thêm bài viết');
                }
            },
            beforeSend: function() {
                _this.text('Đang tải thêm tin tức...');
             },

        });
    });
}

document.addEventListener('DOMContentLoaded', function(){
    var url = location.href;
    if(url.indexOf("#") > 0)
    {
        let position = url.substring(url.indexOf("#")+1);
        scrollToPosition(position);
    }

    if($('#lich-su-doi-dau').length > 0){
        scrollToPosition('lich-su-doi-dau');
    }

    function scrollToPosition(id){
            let target = document.getElementById(id);
            let targetRect = target.getBoundingClientRect();
            let bodyRect = document.body.getBoundingClientRect();
            $("html,body").animate({scrollTop: targetRect.top - bodyRect.top - 50}, "slow");
    }
});

$('.toggle-sub-menu').click(function () {
    $(this).parent().find('.sub-menu').toggle('fast');
});

const FUNC = {
    ajax_load_more: function() {
        $(document).on('click', '.load-more', function (e) {
            e.preventDefault();
            let page = $(this).data('page');
            if (!page) page = 2;
            $.ajax({
                type: 'get',
                url: '',
                dataType: 'html',
                data: {
                    page: page,
                },
                success: function (res) {
                    let selector_show_content = '#ajax_content';
                    let resultFind = $(res).find('#ajax_content').html();
                    if (resultFind) {
                        $(selector_show_content).append(resultFind);
                    }
                    $('.load-more').data('page', page + 1);
                }
            })
        })
    },
    init: function () {
        FUNC.ajax_load_more();
    }
};
$(document).ready(function () {
    FUNC.init();
});

if($('.btn-cat-load'))
{
    $('.btn-cat-load').on('click', function () {
        var _this = $(this),
            category_id = _this.data('catid'),
            page = _this.data('page'),
            keyWord = _this.data('keyword'),
            tag_id = _this.data('tagid'),
            url = "";
        if(typeof keyWord != 'undefined') {
            console.log(keyWord)
            url = "/search/load-more-posts?keyword=" + keyWord + '&page='+  page;
        }
        if(typeof category_id != 'undefined')
        {
            url = "/load-more-posts/" + category_id + "/" + page;
        }
        if(typeof tag_id != 'undefined')
        {
            url = "/tag/load-more-posts/" + tag_id + "/" + page;
        }
        $.ajax({
            type: "GET",
            url: url,
            success: function (response) {
                console.log(response);
                if (response.status == 204) {
                    _this.text('Không còn bài viết phù hợp');
                }else if(response.status == 200){
                    $('.list-more-posts').append(response.data);
                    _this.data('page', page+1);
                    _this.text('Tải thêm bài viết');
                }
            },
            beforeSend: function() {
                _this.text('Đang tải thêm tin tức...');
             },

        });
    });
}

$('.btn-show-ltd').click(function (e) {
    e.preventDefault();
    let _this = $(this);
    let date = _this.data('date');
    $('.list-date-ltd li').removeClass('sub-menu-active');
    _this.parent().addClass('sub-menu-active');
    $.ajax({
        url: '/ajax_get_ltd/' + date,
        type: 'GET',
        dataType: 'html',
        success: function (res) {
            if (res) {
                $('.ajax-content-ltd').html(res);
            }
        }
    });
});


$('.btn-show-ty-le-keo').click(function (e) {
    e.preventDefault();
    let _this = $(this);
    let index = _this.data('index');
    $('.table-ngay-ty-le-keo ul li').removeClass('sub-menu-active');
    _this.parent().addClass('sub-menu-active');
    $.ajax({
        url: '/ajax_get_ty_le_keo/' + index,
        type: 'GET',
        dataType: 'html',
        success: function (res) {
            if (res) {
                $('.ajax-content-tlk').html(res);
            }
        }
    });
});

$('.btn-show-keo-truc-tuyen').click(function (e) {
    e.preventDefault();
    let _this = $(this);
    $('.table-ngay-ty-le-keo ul li').removeClass('sub-menu-active');
    _this.parent().addClass('sub-menu-active');
    $.ajax({
        url: '/ajax_get_ty_le_keo',
        type: 'GET',
        dataType: 'html',
        success: function (res) {
            if (res) {
                $('.ajax-content-tlk').html(res);
            }
        }
    });
});

//Search tỷ lệ kèo - kèo macao
var searchBy = $("#searching-by").val();

$("#searching-by").change(function () {
    searchBy = $(this).val();
});
$("#search-soi-keo").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    if (searchBy == '1') {
        $(".list-link-of-league .club-name").filter(function () {
            var check = false;
            $(this).find('span').each(function () {
                if ($(this).text().toLowerCase().indexOf(value) > -1 || $(this).find('strong').text().toLowerCase().indexOf(value) > -1) {
                    return check = true;
                }
            });

            $(this).closest('.club-name').parent().toggle(check);
        });

        $('.content-list-schedule').find('.list-link-of-league').each(function () {
            var allChildrenHidden = $(this).find('.content-odds-item').filter(function () {
                return $(this).css('display') !== 'none';
            }).length === 0;

            if (allChildrenHidden) {
                $(this).prevAll('.title-schedule-league').first().css('display', 'none');
            }
            else {
                $(this).prevAll('.title-schedule-league').first().css('display', 'block');
            }
        });

    } else {
        $(".title-schedule-league h2").filter(function () {
            $(this).closest('.title-schedule-league').toggle($(this).text().toLowerCase().indexOf(value) > -1);
            $('.content-list-schedule').find('.title-schedule-league').each(function () {
                var allChildrenHidden = $(this).filter(function () {
                    return $(this).css('display') !== 'none';
                }).length === 0;
                if (allChildrenHidden) {
                    $(this).nextUntil('.list-link-of-league').last().next().addClass('d-none');
                }
                else {
                    $(this).nextUntil('.list-link-of-league').last().next().removeClass('d-none');
                }
            });

        });
    }
});

$(function () {
    // this will get the full URL at the address bar
    var url = window.location.href;
    // passes on every "a" tag
    $("#navbarSupportedContent a").each(function () {
        // checks if its the same on the address bar
        if (url == (this.href)) {
            $(this).addClass("sub-active");
        }
    });
});
//End Search tỷ lệ kèo - kèo macao

