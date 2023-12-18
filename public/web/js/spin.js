let checked = 0;
let radio_number_length = 0, li_number = 0;

const RESULT_FOOT = {
    event_click_radio_digit: function () {
        $(document).on('click', "table > tfoot [type='radio']", function () {
            let table = $(this).closest('table');
            let checked = radio_number_length = $(this).val();
            let numberSel = table.find('tr:not(:first-child) > td > span.text-number');
            numberSel.each(function (i, v) {
                let numberSelector = $(v);
                if (numberSelector.children('.fa-pulse').length == 0) {
                    let number = numberSelector.text();
                    if (checked == 0) {
                        numberSelector.text(number);
                    } else {
                        let numberHead = number.substring(0, number.length - checked);
                        let numberSelected = number.replace(numberHead, '<number style="display: none;">' + numberHead + '</number>');
                        numberSelector.html(numberSelected);
                    }
                }
            })
        });
    },
    event_click_filter_number: function () {
        $(document).on("click", ".check-number ul > li", function () {
            let _this = $(this);
            _this.parent().find('li').removeClass('active');
            let article = _this.closest('article');
            let table = article.find('.result table');
            if (_this.text() === li_number) {
                li_number = 0;
                let numberSel = table.find('tr > td > span');
                numberSel.each(function (i, v) {
                    let numberSelector = $(v);
                    numberSelector.html(numberSelector.text());
                });
            } else {
                _this.addClass('active');
                let numberChecked = li_number = _this.text();
                let numberSel = table.find('tr > td > span');
                numberSel.each(function (i, v) {
                    let numberSelector = $(v);
                    if (numberSelector.children('.fa-pulse').length === 0) {
                        let number = numberSelector.text().trim();
                        let twoNumberTail = number.substr((number.length - 2), 2);
                        let NumberTail = number.slice(0, number.length - 2);
                        numberSelector.find('number').remove();
                        if (checked === 0) {
                            numberSelector.text(number);
                            if (twoNumberTail.indexOf(numberChecked) !== -1) {
                                let numberSelected = NumberTail + '<number class="numberTail">' + twoNumberTail + '</number>';
                                numberSelector.html(numberSelected);
                            }
                        } else {
                            let numberSelected = number;
                            if (twoNumberTail.indexOf(numberChecked) !== -1) {
                                numberSelected = NumberTail + '<number class="numberHead">' + twoNumberTail + '</number>';
                            }
                            let numberLast = number.length - checked;
                            let numberHead = number.substring(0, numberLast);
                            numberSelected = numberSelected.replace(numberHead, '<number style="display: none;">' + numberHead + '</number>');
                            numberSelector.html(numberSelected);
                        }
                    }
                })
            }
        });
    },
    init: function () {
        this.event_click_radio_digit();
        this.event_click_filter_number();
    }
};

const LOAD_NUMBER = {
    random_number: function (length) {
        let list_number = '';
        let cl;
        for (let i = 1; i <= length; i++) {
            let rand = Math.floor(Math.random() * 10);
            list_number += '<strong>' + rand + '</strong>';
        }
        return list_number;
    },
    format_number: function (number) {
        let string = number.replace(/<\/strong>/g, "");
        string = string.replace(/<strong>/g, "");
        return string;
    },
    load_number: function () {
        let intV = setInterval(function () {
            let checkEmpty = $('.table-result  > tbody td > span.text-number > span');
            if (checkEmpty.length > 0) {
                checkEmpty.each(function () {
                    let max = $(this).parent().attr("nc");
                    let num = LOAD_NUMBER.random_number(max);
                    $(this).html(num);
                });
            }
        }, 100);
    },
    check_time: function () {
        let checkLoading = $('.table-result  > tbody td > span.text-number > .fa-pulse');
        let article = checkLoading.closest('article');
        let tableResult = article.find('table.table-result');
        let checkTableMulti = article.find('table.table-result-multi-col');

        /*==>> kiem tra <<==*/
        if (tableResult.length > 0) console.log('co bang dang quay');
        if (checkTableMulti.length > 0) {
            for (td = 2; td <= 5; td++) {
                let checkRandomIsset = tableResult.find('td:nth-child(' + td + ') > span.text-number > span');
                if (checkRandomIsset.length === 0) {
                    $('td:nth-child(' + td + ') > span.text-number').each(function () {
                        checkRandomIsset = tableResult.find('td:nth-child(' + td + ') > span.text-number > span');
                        let checkItemRandomIsset = $(this).find('.fa-pulse');
                        if (checkItemRandomIsset.length === 1 && checkRandomIsset.length === 0) {
                            $(this).html(' <span class="loadNumber"></span>');
                            return false;
                        }
                    });
                }
            }
        } else {
            let checkTableMb = tableResult.data('code');
            if (checkTableMb === 'XSMB') {
                let tdFind = tableResult.find('td:nth-child(2) > span.text-number');
                let tdFindImg = tableResult.find('td:nth-child(2) > span.text-number > .fa-pulse');
                $(tdFind).each(function (idx) {
                    if (tdFindImg.length > 4 && idx > 3) {
                        let checkTdFindImg = $(this).find('.fa-pulse');
                        if (checkTdFindImg.length === 1) {
                            $(this).html(' <span class="loadNumber"></span>');
                            return false;
                        }
                    }
                });
            } else {
                let tdFind = tableResult.find('td:nth-child(2) > span.text-number');
                $(tdFind).each(function () {
                    let letCheckTdFind = $(this).find('.fa-pulse');
                    if (letCheckTdFind.length === 1) {
                        $(this).html('  <span class="loadNumber"></span>');
                        return false;
                    }
                });
            }
        }
    },
    check_load_number: function () {
        console.log('check load number :)) start ...');
        let d = new Date();
        let mi = d.getMinutes();
        if (mi <= 13) {
            let second = 0;
            let SInt_cln = setInterval(function () {
                second = second + 1;
                console.log('loading...(' + second + ')');
                d = new Date();
                mi = d.getMinutes();
                if (mi === 13) {
                    LOAD_NUMBER.check_time();
                    clearInterval(SInt_cln);
                }
            }, 1000);
        } else {
            console.log('F5 loading...');
            LOAD_NUMBER.check_time();
        }
    },
    init: function () {
        this.load_number();
    }
};

let DELAY = (function () {
    var queue = [];

    function processQueue() {
        if (queue.length > 0) {
            setTimeout(function () {
                queue.shift().callBack();
                processQueue();
            }, queue[0].delay);
        }
    }

    return function DELAY(delay, callBack) {
        queue.push({delay: delay, callBack: callBack});

        if (queue.length === 1) {
            processQueue();
        }
    };
}());

const LOAD_SPIN = {
    rewardMB: function (key) {
        let min;
        let length;
        switch (key) {
            case 0:
            case 1:
            case 2:
            case 3:
                min = 10000;
                length = 99999;
                break;
            case 4:
            case 5:
                min = 1000;
                length = 9999;
                break;
            case 6:
                min = 100;
                length = 999;
                break;
            default:
                min = 10;
                length = 99;
        }
        return [min, length];
    },
    rewardMN: function (key) {
        let min;
        let length;
        switch (key) {
            case 0:
                min = 10;
                length = 99;
                break;
            case 1:
                min = 100;
                length = 999;
                break;
            case 2:
            case 3:
                min = 1000;
                length = 9999;
                break;
            case 4:
            case 5:
            case 6:
            case 7:
                min = 10000;
                length = 99999;
                break;
            default:
                min = 100000;
                length = 999999;
        }
        return [min, length];
    },
    random_number: function (min, max, selector, tableLoto, colLoto) {
        let number;
        let flag = 0;
        let run_random_number = setInterval(function () {
            if (flag < 10) {
                flag++;
                let max = $(selector).attr("nc");
                let num = LOAD_NUMBER.random_number(max);
                selector.find('span').html(num);
            } else {
                clearInterval(run_random_number);
                number = selector.find('span').text();
                selector.html(number);
                LOAD_SPIN.show_loto(tableLoto, colLoto, number);
            }
        }, 100);
    },
    show_loto: function (selector, col, number) {
        let twoNumber = number.substr(number.length - 2);
        let head = twoNumber.substr(0, 1);
        let tail = twoNumber.substr(1, 1);

        let nthChildTr = parseInt(head) + 1;
        selector.find('tbody > tr:nth-child(' + nthChildTr + ') > td:nth-child(' + col + ')').append('<span>' + tail + '</span>');
        if (selector.closest('.spin-loto').length > 0) {
            nthChildTr = parseInt(tail) + 1;
            col = 4;
            selector.find('tbody > tr:nth-child(' + nthChildTr + ') > td:nth-child(' + col + ')').append('<span>' + head + '</span>');
        }
        LOAD_SPIN.done();
    },

    show_result_MB: function (selectorKQ, selectorLoto, childTr) {
        if (selectorKQ.find('.text-number i.fa-spinner').length === 0) {
            selectorKQ.find('.text-number').html(' <i class="fas fa-spinner fa-pulse"></i>');
            selectorLoto.find('td span').remove();
        }
        selectorKQ.find('tbody > tr' + childTr).each(function (i, v) {
            if (childTr === ':not(:nth-child(-n+2))') {
                i = i + 1;
            }
            let lenghtObj = LOAD_SPIN.rewardMB(i);
            let trElement = $(this);
            trElement.find('td').each(function (iTd, vTd) {
                $(this).find('span').each(function (iSpan, vSpan) {
                    let spanElement = $(this);
                    DELAY(2000, function (iTd, iSpan) {
                        return function () {
                            let keyTD = iTd + 1;
                            spanElement.html('<span class="loadNumber"></span>');
                            LOAD_SPIN.random_number(lenghtObj[0], lenghtObj[1], spanElement, selectorLoto, keyTD);
                        };
                    }(iTd, iSpan));
                });
            });
            if (childTr === ':not(:first-child)') {
                return false;
            }
        });
    },
    show_result_MN: function (selectorKQ, selectorLoto, childTr) {
        let list_span = $('.random_mt_mn').find('span').length;
        selectorKQ.find('tbody > tr' + childTr).each(function (i, v) {
            if (childTr === ':not(:first-child)' && list_span <= 18) {
                i = i + 1;
            }
            let lenghtObj = LOAD_SPIN.rewardMN(i);
            let trElement = $(this);
            trElement.find('td').each(function (iTd, vTd) {
                $(this).find('span').each(function (iSpan, vSpan) {
                    let spanElement = $(this);
                    DELAY(2000, function (iTd, iSpan) {
                        return function () {
                            let keyTD = iTd + 1;
                            spanElement.html('<span class="loadNumber"></span>');
                            LOAD_SPIN.random_number(lenghtObj[0], lenghtObj[1], spanElement, selectorLoto, keyTD);
                        };
                    }(iTd, iSpan));
                });

            });
        });
    },
    init: function () {
        var code = $('.table-result-spin').attr('data-code');
        if (code == 'xsmb') {
            $('button.btn_spin').click(function (e) {
                e.preventDefault();
                $(this).attr('disabled', true);
                LOAD_SPIN.show_result_MB($('table.table-result-spin'), $('table.spin-loto'), ':not(:nth-child(-n+2))');
                LOAD_SPIN.show_result_MB($('table.table-result-spin'), $('table.spin-loto'), ':not(:first-child)');
            });
        } else if (code == 'xsmn' || code == 'xsmt') {
            let list_span = $('.random_mt_mn').find('span').length;
            $('button.btn_spin').click(function (e) {
                e.preventDefault();
                $(this).attr('disabled', true);
                if (list_span <= 18) {
                    LOAD_SPIN.show_result_MN($('table.table-result-spin'), $('.loto table.spin-loto'), ':first-child');
                }
                LOAD_SPIN.show_result_MN($('table.table-result-spin'), $('.loto table.spin-loto'), ':not(:first-child)');
            });
        }
    },
    done: function () {
        let checkDone = $("table[class*='random'] img");
        if (checkDone.length == 0) {
            $(".btn.btn_spin").prop('disabled', false);
        }
    }
};

const SPIN_MATCH = {
    timeOut: 3000,
    init: function () {
        SPIN_MATCH.loadImage();
    },
    loadImage: function () {
        setTimeout(function(){
            SPIN_MATCH.spinFirst();
        }, SPIN_MATCH.timeOut);

    },
    random: function (table) {
        table = $(table);
        if (Math.random() < 0.5){
            table.parent().find('input:nth(0)').attr('checked','checked');
        } else {
            table.parent().find('input:nth(1)').attr('checked','checked');
        }
    },
    spinFirst: function () {
        $('.table-spin-match tr > td:nth-child(2) img').addClass('d-none');
        let tableEmpty = $('.table-spin-match tr > td:nth-child(2):empty:first');
        tableEmpty.append('<img src="/web/images/icon/spin-match-icon.png" class="spin"/>');
        if (tableEmpty.length > 0){
            setTimeout(function(){
                SPIN_MATCH.random(tableEmpty);
                SPIN_MATCH.spinFirst();
            }, SPIN_MATCH.timeOut);
        }
    }
};

const COMMON = {
    init: function () {
        $('#list-province').change(function () {
            let url = '/quay-thu-xo-so-' + $(this).val();
            window.location.href = url;
        });
        $('button.btn_spin').hide();
        $('button.btn_spin').trigger('click');
    },
}

$(document).ready(function () {
    RESULT_FOOT.init();
    LOAD_SPIN.init();
    LOAD_NUMBER.init();
    COMMON.init();
    // SPIN_MATCH.init();
    $(document).on('click', '.btnLoadMore', function () {
        let btn = $(this);
        let page = btn.data('page');
        let textBtn = btn.html();
        $.ajax({
            data: {page: page},
            type: 'GET',
            dataType: 'html',
            beforeSend: function(){
                btn.html('Đang tải...');
            },
            success: function (res) {
                res = $(res);
                let html = res.find('.ajax_content').html();
                if (html.trim().length > 0 && typeof html != 'undefined'){
                    $('.ajax_content').append(html);
                    btn.html(textBtn);
                    btn.data('page', page + 1);
                } else {
                    btn.html('Đã tải hết dữ liệu');
                    btn.attr('disabled','disabled');
                }
                SPIN_MATCH.loadImage();
            }
        })
    })
    $(document).on('click', '.btnLoadMore2', function () {
        let btn = $(this);
        let page = btn.data('page');
        let textBtn = btn.html();
        $.ajax({
            data: {page2: page},
            type: 'GET',
            dataType: 'html',
            beforeSend: function(){
                btn.html('Đang tải...');
            },
            success: function (res) {
                res = $(res);
                let html = res.find('.ajax_content2').html();
                if (html.trim().length > 0 && typeof html != 'undefined'){
                    $('.ajax_content2').append(html);
                    btn.html(textBtn);
                    btn.data('page', page + 1);
                } else {
                    btn.html('Đã tải hết dữ liệu');
                    btn.attr('disabled','disabled');
                }
                SPIN_MATCH.loadImage();
            }
        })
    })
});
