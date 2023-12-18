document.addEventListener("DOMContentLoaded", function() {
    $('body').delegate('.btn-tatchat', 'click', function () {
        $('.box-chat-mb').removeClass('d-block');
        $('.box-chat-mb').addClass('d-none');
        $('.icon-mess').addClass('d-block');
    });
    $('body').delegate('.icon-mess img', 'click', function () {
        $('.box-chat-mb').addClass('d-block');
        $('.box-chat-mb').removeClass('d-none');
        $('.icon-mess').removeClass('d-block');
    });


    $('#filter_options .filter_item input').each(function(i, v) {
        $(this).on('change', function () {
            $(this).parent()[0].toggleAttribute('selected');
            getValueCheckbox();
        });
    });
    $('#form-search-club').on('keyup', function () {
        var val = $(this).val();
        if (val.length != 0) {
            $('.table-tyleweb tr.keo-dong').addClass('d-none');
            $('.table-tyleweb tr.odd-competition').addClass('d-none');
            $('.table-tyleweb table tr.keo-dong').each(function (key, value) {
                if ($(this).attr('data-home')) {
                    var home = $(this).attr('data-home').toLowerCase();
                    var away = $(this).attr('data-away').toLowerCase();
                    if (home.includes(val.toLowerCase()) || away.includes(val.toLowerCase())) {
                        if ($(this).attr('data-home') == home) {
                            $(this).removeClass('d-none');
                            $(this).parents('tr.odd-competition').removeClass('d-none');
                            $(this).next().removeClass('d-none');
                        }
                    }
                }
            });
        } else {
            if ($('.table-tyleweb tr.odd-competition').hasClass('d-none')) {
                $('.table-tyleweb tr.odd-competition').removeClass('d-none');
            }
            if ($('.table-tyleweb tr.keo-dong').hasClass('d-none')) {
                $('.table-tyleweb tr.keo-dong').removeClass('d-none');
            }
        }
    });
    $('#form-search-club').on('search', function(event) {
        if ($('.table-tyleweb tr.odd-competition').hasClass('d-none')) {
            $('.table-tyleweb tr.odd-competition').removeClass('d-none');
        }
        if ($('.table-tyleweb tr.keo-search').hasClass('d-none')) {
            $('.table-tyleweb tr.keo-search').removeClass('d-none');
        }
    });
    $('#filter-select-all').on('click', function () {
        $('#filter_options .filter_item input').each(function(i, v) {
            $(v).parent()[0].setAttribute('selected', '');
            $(this).prop('checked', true);
        });
        getValueCheckbox();
    });

    $('#filter-clear').on('click', function () {
        $('#filter_options .filter_item input').each(function(i, v) {
            $(v).parent()[0].removeAttribute('selected');
            $(this).prop('checked', false);
        });

        $('.table-tyleweb tr.odd-competition').removeClass('d-none');
    });

    $('.open_filter').on('click', function () {
        $(this).next().toggle();
    });
    $('.list-btn .btn-keo-ngay').each(function(i, v) {
        $(this).on('click', function () {
            $('.btn-keo-ngay').find('span').attr('style', '');
            $(this).find('span').attr('style', 'display: inline-block');
            var date = $(this).attr('date');

            $('.table-tyleweb tr.keo-dong').addClass('d-none');
            $('.table-tyleweb tr.odd-competition').addClass('d-none');
            if ($(this).attr('data-value') === '1') {
                $('.table-tyleweb .bg_h2').each(function (i, v) {
                    if ($(this).text().toLowerCase() === 'kèo nhà cái trực tuyến') {
                        $(this).next().find('>tbody>tr.odd-competition').removeClass('d-none');
                        $(this).next().find('>tbody>tr.odd-competition .keo-dong').removeClass('d-none');
                    }
                });
            }
            $('.table-tyleweb .TYLETT_3a').each(function(i, v) {
                var el = $(this).find('b:first');
                if (el.length != 0 && date === el.text()) {
                    var date_home = $(this).parent('.keo-dong').attr('data-home');

                    $('.table-tyleweb table tr.keo-dong').each(function (key, value) {
                        if ($(this).attr('data-home')) {
                            var home = $(this).attr('data-home').toLowerCase();
                            if (date_home === home) {
                                $(this).removeClass('d-none');
                                $(this).parents('tr.odd-competition').removeClass('d-none');
                                $(this).next().removeClass('d-none');
                            }

                        }
                    });
                }
            });
        });
    });
});

function getValueCheckbox() {
    var arr_value = [];
    $('#filter_options .filter_item input').each(function(i, v) {
        if ($(this).is(':checked') && !arr_value.includes($(this).val())) {
            arr_value.push($(this).val());
        }
    });
    if (arr_value.length != 0) {
        $('.table-tyleweb tr.odd-competition').addClass('d-none');
        $('.table-tyleweb tr.odd-competition').each(function (i, v) {
            if ($(this).find('.odd-competition').length != 0) {
                $(this).removeClass('d-none');
                var name = $(this).attr('data-name');
                if (!arr_value.includes(name)) {
                    $(this).find('table:first').addClass('d-none');
                }
            }
        });
        $('.table-tyleweb tr.odd-competition').each(function (i, v) {
            var name = $(this).attr('data-name');
            if (arr_value.includes(name)) {
                $(this).removeClass('d-none');
            }
        });
    } else {
        $('.table-tyleweb tr.odd-competition').removeClass('d-none');
        $('.table-tyleweb tr.keo-dong').removeClass('d-none');
    }

}