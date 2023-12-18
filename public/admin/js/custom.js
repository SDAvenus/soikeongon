$(document).ready(function () {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
});


$(document).on('click', '.ajax-login', function (e) {
    e.preventDefault();
    let form = $(this).closest('form');
    let url = form.attr('action');
    let data = form.serialize();
    $.ajax({
        url: url,
        data: data,
        type: 'POST',
        dataType: 'json',
        success: function (res) {
            if (res.status === 'success'){
                window.location.href = '/admin/home';
            } else {
                alert('Tài khoản hoặc mật khẩu không đúng!');
                form[0].reset();
                return false;
            }
        }
    })
});

$(document).on('keypress', 'input[name="password"]',function(e) {
    if(e.which === 13) {
        $('.ajax-login').trigger('click');
    }
});

$(document).on('keypress', '.customValidity', function (e) {
    $(this).get(0).setCustomValidity("");
});

function checkEmptyCustomValidity() {
    $('.customValidity').each(function () {
        if (!$(this).val()) {
            $(this).get(0).setCustomValidity("Không được để trống!");
            $(this).get(0).reportValidity();
            return false;
        }
    });
    return true;
}

$(document).on('click', '.btn-change-password', function (e) {
    e.preventDefault();
    if (!checkEmptyCustomValidity()) return;
    let input_old_password = $('#changePassword input[name="old_password"]');
    let input_new_password = $('#changePassword input[name="new_password"]');
    let input_re_password = $('#changePassword input[name="re_password"]');
    let old_password = input_old_password.val();
    let new_password = input_new_password.val();
    let re_password = input_re_password.val();
    if (re_password !== new_password) {
        input_re_password.get(0).setCustomValidity("Mật khẩu nhập lại chưa đúng!");
        input_re_password.get(0).reportValidity();
        return false;
    }
    $.ajax({
        url: '/admin/ajax/changePassword',
        data: {
            old_password: old_password,
            new_password: new_password
        },
        type: 'POST',
        dataType: 'json',
        success: function (res) {
            if (res.status === 'success'){
                $('#changePassword').modal('hide');
                showToastr('success', res.message);
            } else {
                input_old_password.get(0).setCustomValidity("Mật khẩu cũ không đúng!");
                input_old_password.get(0).reportValidity();
            }
        }
    })
});

function upload_file(mode,control){
    let open_url = '/admin/libraries/elfinder/file-elfinder.php?mode='+mode+'&control='+control;
    window.open(open_url,'_blank',"location=0,left=200,width=800,height=500");
    return false;
}

if (document.getElementById('select-multi-category')) {
    let post_id = $('#select-multi-category').data('post-id');
    $.ajax({
        url: '/admin/ajax/loadCategory',
        type: 'POST',
        data: {
            post_id: post_id
        },
        dataType: "json",
        success: function(data) {
            if (data.list_category) {
                let options = data.list_category;
                let select = document.getElementById('select-multi-category');
                new coreui.MultiSelect(select, {
                    multiple: true,
                    selectionType: 'tags',
                    search: true,
                    options: options
                });
            }
            if (data.category_selected) {
                data.category_selected.forEach((item) => {
                    $('#select-multi-category').closest('.form-group').find('.c-multi-select-option[data-value="'+item+'"]').trigger('click');
                });
            }
        }
    });

    $('form').submit(function() {
        $('button[type="submit"]').prop('disabled', true);
        setTimeout($('button[type="submit"]').prop('disabled', false), 5000);

        let container = $('#select-multi-category').parent(),
            categories = [],
            isValid = true,
            formSubmit = $(this);

        $(container).find('.c-multi-select-selection .c-multi-select-tag').each(function () {
            let id = $(this).data('value');
            categories.push(id);
        });

        if($('#post-update').length >= 1)
        {
            isValid = validatorPost(formSubmit, categories);
        }

        if(isValid){
            categories.forEach(function(id, index){
                formSubmit.append('<input type="hidden" name="category[]" value="'+id+'">');
            });

            formSubmit.find('button[type="submit"]').addClass('disabled');
            let containertag = $('#select-multi-tag').parent();
            $(containertag).find('.c-multi-select-selection .c-multi-select-tag').each(function () {
                let id = $(this).data('value');
                $(this).append('<input type="hidden" name="tag[]" value="'+id+'">');
            });
        }
        return isValid;
    });
}

if (document.getElementById('select-multi-tag')) {
    let post_id = $('#select-multi-tag').data('post-id');
    $.ajax({
        url: '/admin/ajax/loadTag',
        type: 'POST',
        data: {
            post_id: post_id
        },
        dataType: "json",
        success: function(data) {
            if (data.list_tag) {
                let options = data.list_tag;
                let select = document.getElementById('select-multi-tag');
                new coreui.MultiSelect(select, {
                    multiple: true,
                    selectionType: 'tags',
                    search: true,
                    options: options
                });
            }
            if (data.tag_selected) {
                data.tag_selected.forEach((item) => {
                    $('#select-multi-tag').closest('.form-group').find('.c-multi-select-option[data-value="'+item+'"]').trigger('click');
                });
            }
        }
    });
}

$(document).ready(function () {
    if (typeof $('#nestable')[0] != 'undefined') {
        var container = $('#nestable');
        container.nestable({
            group: 1,
            maxDepth: 2
        }).change(function () {
            updateOutput(container);
        });
        $('.category_select').click(function(){
            var category = $('select[name=category_id]');
            var option = $('option:selected', category);
            var url = option.data('url');
            var title = option.data('title');
            title = title.replace(/-/g, '');
            appendEditMenuItem(container, title, url);
            updateOutput(container);
            toggleEditMenuItem();
            editMenuItem();
            deleteMenuItem();
        });
        $('.link_select').click(function(){
            var url = $('input[name=custom_link]').val();
            appendEditMenuItem(container, url, '#');
            updateOutput(container);
            toggleEditMenuItem();
            editMenuItem();
            deleteMenuItem();
        });
        var data = $('input[name=data]').val();
        if (data !== ''){
            listify(container, data);
            toggleEditMenuItem();
            editMenuItem();
            deleteMenuItem();
        }
    }
})
function toggleEditMenuItem() {
    $(document).on('click', '.nestleeditd', function () {
        $(this).parent().siblings('div.menublock').toggleClass('d-none');
    });
}
function editMenuItem() {
    $('.apply_item').on('click',function () {
        var container = $(this).closest('li.dd-item');
        var name = container.find('.name_item').first().val();
        var url = container.find('.link_item').first().val();
        container.data('name', name);
        container.data('url', url);
        container.find('.dd-handle').first().text(name);
        updateOutput($('#nestable'));
        container.find('.nestleeditd').first().trigger('click');
    });
}
function deleteMenuItem() {
    $('.nestledeletedd').on('click',function (e) {
        e.preventDefault();
        var item;
        item = $(this).closest('li.dd-item');
        if (confirm('Bạn có chắc chắn xóa?')) {
            item.remove();
        }
        /*$('#smallModal').modal('show');
        $('.confirm_yes').click(function() {
            item.remove();
            $('#smallModal').modal('hide');
        })*/
        updateOutput($('#nestable'));
    });
}
function appendEditMenuItem(container, title, url) {
    var item = "<li class='dd-item' data-name='' data-url=''>\n" +
        "    <div class='dd-handle'></div>\n" +
        "    <div class='action-item'>\n" +
        "        <span class='nestleeditd'>\n" +
        "            <svg class='c-icon'>\n" +
        "                <use xlink:href='/admin/images/icon-svg/free.svg#cil-pencil'></use>\n" +
        "            </svg>\n" +
        "        </span>\n" +
        "        <span class='nestledeletedd'>\n" +
        "            <svg class='c-icon'>\n" +
        "                <use xlink:href='/admin/images/icon-svg/free.svg#cil-trash'></use>\n" +
        "            </svg>\n" +
        "        </span>\n" +
        "    </div>\n" +
        "    <div class='menublock d-none'>\n" +
        "        <input type='text' class='form-control name_item' value='' placeholder='Name'>\n" +
        "        <input type='text' class='form-control link_item' value='' placeholder='Link'>\n" +
        "        <input type='button' class='mt-1 btn btn-theme apply_item border' value='Apply'>\n" +
        "    </div>\n" +
        "</li>";
    item = $.parseHTML(item);
    $(item).data('name', title);
    $(item).data('url', url);
    $(item).find('.dd-handle').text(title);
    $(item).find('.name_item').val(title);
    $(item).find('.link_item').val(url);
    container.find('.dd-list').first().append(item);
    return item;
}
function updateOutput(e) {
    var list   = e.length ? e : $(e.target);
    if (window.JSON) {
        var data = window.JSON.stringify(list.nestable('serialize'));
        $('input[name=data]').val(data);
    }
}
function listify(container, strarr) {
    var obj = JSON.parse(strarr);
    if (!obj.length) obj = [obj];
    $.each(obj, function(i, v) {
        if (typeof v == 'object') {
            var name = v.name;
            var url = v.url;
            var parent = appendEditMenuItem(container,name,url);
            if (!!v.children){
                var div = "<ol class='dd-list'></ol>";
                $(parent).append(div);
                $.each(v.children, function(key, item) {
                    listify($(parent), JSON.stringify(item));
                });
            }
        }
    });
}

function showFeedback(element, feedBack)
{
    element.append(feedBack).css({'display': 'block'});
}

function checkCateIsSoiKeo(categories, listSoiKeo) {
    $result = false;
    if(categories.length < 1)
    {
        return $result;
    }
    categories.forEach(function (param) {
        if(listSoiKeo.includes(param))
        {
            $result = true;
            return true;
        }
    })
    return $result;
}

function validatorPost(formSubmit, categories)
{
    let isValid = true,
        listCateId = [2, 3, 4, 5, 6, 7, 9, 10, 11, 12, 13, 14],
        data = [];

    formSubmit.serializeArray().forEach(function({name, value}, index){
        data[name] = value;
        let input = $(`[name='${name}']`),
            formGroup = input.parent();

        let feedBack = formGroup.find('.invalid-feedback'),
            textArea = formGroup.find('[role=application]'),
            thumbnail = formGroup.find('img');
        //reset invalid
        feedBack.css({'display':'none'});
        feedBack.html('');
        textArea.css({'border': '1px solid #ccc'});
        thumbnail.css({'border':'none'})
        input.removeClass('is-invalid');
    });


    if(data.id_bongdalu == '' && isInArray(categories, listCateId))
    {
        let formGroup = $("input[name='id_bongdalu']").parent(),
        feedBack = formGroup.find('.invalid-feedback');
        $("input[name='id_bongdalu']").addClass('is-invalid')
        showFeedback(feedBack, 'Bài viết là soi kèo, vui lòng thêm thông tin bongdalu!</br>');
        alert('Vui lòng thêm id bongdalu!');
        formGroup.find('img').css({'border': '1px solid #e55353'})
        isValid = false;
    }

    if(data.thumbnail == '')
    {
        let formGroup = $("input[name='thumbnail']").parent(),
            feedBack = formGroup.find('.invalid-feedback');

        showFeedback(feedBack, 'Vui lòng thêm Thumbnail!</br>');
        formGroup.find('img').css({'border': '1px solid #e55353'})
        isValid = false;
    }

    if(tinyMCE.get('tiny-featured').getContent() == '')
    {
        let formGroup = $("[name='description']").parent(),
            feedBack = formGroup.find('.invalid-feedback');

        showFeedback(feedBack, 'Vui lòng thêm Mô tả!</br>');
        formGroup.find('[role=application]').css({'border': '1px solid #e55353'});
        isValid = false;
    }

    $('#select-multi-category').parent().find('.invalid-feedback').css({'display':'none'}).text('');
    $('#select-multi-category').parent().find('.c-multi-select-selection-tags').css({'border': '1px solid #d8dbe0'});
    if(categories.length == 0)
    {
        $('#select-multi-category').parent().find('.invalid-feedback').css({'display':'block'}).text('Vui lòng chọn chuyên mục!');
        $('#select-multi-category').parent().find('.c-multi-select-selection-tags').css({'border': '1px solid #e55353'});
        isValid = false;
    }
    $("input[name='computerPredict[asia_predict]']").closest('.form-group').parent().css({'border': 'none'})
    $("input[name='computerPredict[even_odd_predict]']").closest('.form-group').parent().css({'border': 'none'})

    let isComputerpredict = false;
    if(data.id_bongdalu != '' && typeof (data['computerPredict[asia_predict]']) == 'undefined')
    {
        let formGroup = $("input[name='computerPredict[asia_predict]']").closest('.form-group'),
        feedBack = formGroup.find('.invalid-feedback');
        formGroup.parent().css({'border': '1px solid #e55353'})
        showFeedback(feedBack, 'Vui lòng chọn Kèo châu á!</br>');
        isValid = false;
        isComputerpredict = true;
    }

    if(data.id_bongdalu != '' && typeof(data['computerPredict[even_odd_predict]']) == 'undefined')
    {
        let formGroup = $("input[name='computerPredict[even_odd_predict]']").closest('.form-group'),
        feedBack = formGroup.find('.invalid-feedback');
        formGroup.parent().css({'border': '1px solid #e55353'})
        showFeedback(feedBack, 'Vui lòng chọn Kèo tài xỉu!</br>');
        isComputerpredict = true;
        isValid = false;
    }

    if(isComputerpredict)
    {
        alert('Vui long thêm máy tính dự đoán!');
    }

    return isValid;
}

function isInArray(fisrtArr, secondArr)
{
    let result = false;

    if(fisrtArr.length == 0 || secondArr.length == 0)
    {
        return result;
    }

    fisrtArr.forEach(function(item, index)
    {
        if(secondArr.includes(item))
        {
            result = true;
            return false; //break
        }
    })
    return result;
}

$(document).on('change', '.sl-type-post', function () {
    let url = $(this).val();
    window.location.href = url;
});

if (document.getElementById('select-multi-category-author')) {
    let author_id = $('#select-multi-category-author').data('author-id');
    $.ajax({
        url: '/admin/ajax/loadCategoryAuthor',
        type: 'POST',
        data: {
            author_id: author_id
        },
        dataType: "json",
        success: function(data) {
            if (data.categories) {
                let options = data.categories;
                let select = document.getElementById('select-multi-category-author');
                new coreui.MultiSelect(select, {
                    multiple: true,
                    selectionType: 'tags',
                    search: true,
                    options: options
                });
            }
            if (data.categories_selected) {
                data.categories_selected.forEach((item) => {
                    $('#select-multi-category-author').closest('.form-group').find('.c-multi-select-option[data-value="'+item+'"]').trigger('click');
                });
            }
        }
    });

    $('form').submit(function() {
        let container = $('#select-multi-category-author').parent();
        $(container).find('.c-multi-select-selection .c-multi-select-tag').each(function () {
            let id = $(this).data('value');
            $(this).append('<input type="hidden" name="categories[]" value="'+id+'">');
        });
        return true;
    });
}
