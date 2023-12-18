document.addEventListener('DOMContentLoaded', function() {
    let keyPopup = 'checkPopup';
    if (!sessionStorage.getItem(keyPopup) || 1) {
        sessionStorage.setItem(keyPopup, 1);
        setTimeout(function () {
            $('#adsModal').modal('show');
        },1000);

        // setTimeout(function () {
        //     $('#adsModal').modal('hide');
        // },8000);
    }

    // remove banner closed
    /*let key_session = Object.keys(sessionStorage);
    $.each(key_session, function (key, val) {
        $('.ads-container[data-position="'+val+'"]').remove();
    });*/

    // load banner
    setTimeout(function () {
        $('.banners img:not([src])').each(function () {
            $(this).attr('src', $(this).data('src')).parent().attr('data-load', 1);
        });
    }, 3000);
    $('#adsModal img:not([src])').each(function () {
        $(this).attr('src', $(this).data('src')).parent().attr('data-load', 1);
    });

    $('body').on('click','.banner-close .close-icon',function () {
        let key = $(this).parents('.ads-container').attr('data-position');
        if (!sessionStorage.getItem(key)) {
            sessionStorage.setItem(key, 1);
        }  else {
            let current = sessionStorage.getItem(key);
            let new_val = parseInt(current) + 1;
            sessionStorage.setItem(key, new_val);
        }

        if (key.includes("cat-fish")) {
            $(this).parents('.ads-container').parent('.fixed-bottom').remove();
        } else {
            $(this).parents('.ads-container').remove();
        }
    });
});
