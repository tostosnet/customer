
$(function () {
    
    if (location.pathname.indexOf('profile') > -1) trigger_action_events();

    $(".btn-file").on("click", function (e) {
        $(this).siblings('input[type=file]').trigger('click');
    });


    // process and preview other images
    $("input[type=file]:not(input#profile_photo_input)").on('change', function (e) {
        previewImage(e);
        if (location.pathname.indexOf('/profile') > -1) $(this).parent().find('button[type=submit]').removeClass('d-none');
    });
    
    
    // update client photo
    $('input#profile_photo_input').on('change', function (e) {
        const file = e.target.files[0];

        let url = URL.createObjectURL(file);

        let a = $('<a href="' + url +'" class="img-link d-block" target="_blank"></a>');
        let img = $('<img class="shadow" src="' + url + '" alt="' + file.name + '" height="150px" />');

        $(this).parent().children('a.img-link').remove();
        $(this).parent().prepend(a); a.append(img);
        img.onload = function () { URL.revokeObjectURL(img.attr('src')) }
        a.animate({ opacity: '1' });
        $(this).parent().find('button[type=submit]').removeClass('d-none');
    });


    if (location.pathname.indexOf('/c/profile') > -1) {
        
        // delete single grt
        $('.del_grt').on('click', function () {
            let btn = $(this);

            // confirm delete action
            bootbox.confirm({
                size: 'small',
                title: '<i class="icon-alert text-danger icon-2x mr-2"></i>Warning',
                message: 'You are about to Delete A Guarantor for this Client. This Action cannot be Undone',
                buttons: { confirm: { label: 'Delete', className: 'btn-danger' } },
                callback: function (result) {
                    if (result) {
                        btn.parents('tr').fadeOut(function () {
                            let tbody = $(this).parent();
                            let id = btn.data('id');

                            $(this).remove();
                            if (tbody.text().trim() == '') {
                                tbody.parents('#grt').find('#table-placeholder').fadeIn();
                                $('#del_grt_btn').fadeOut();
                            }
                        });
                    }
                }
            });
            $('.bootbox .modal-content').addClass('bg-danger-100');
        });

    } else if (location.pathname.indexOf('/p/profile') > -1) {
        light_box('.product-image');
    }

});


function getProduct(el) {
    let val = $(el).val();

    $.get(`/p/preview/${val}`, (data, status) => {
        $('#product_view').html(data);
        light_box('#product_view');
    });

}
