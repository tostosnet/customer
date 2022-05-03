// default settings
var accepted_img_types = ['image/jpeg', 'image/png', 'image/gif'];
var home_url = '/', paid_client_ids = [], timer;
let date = new Date();

$(function () {

    // remove grepper links
    // $(".open_grepper_editor").parent().remove();

    // start connection status check
    var onlinestatustimer = setInterval(check_connection_status, 3000);

    $('#payment-table tbody tr>td:first-child').each(function () {
        paid_client_ids.push($(this).text().trim());
    });

    // ticking time
    setInterval(() => {
        date = new Date();
    }, 1000);

    // get todays date
    var today = date.getMonth() + 1 + '-' + date.getDate() + '-' + date.getFullYear();

    // close sidebar for fullscreen display to accomodate data on some page
    var pages = ['/payment_list', '/client_list', '/grt_list', '/product_list'];
    pages.indexOf(location.pathname) > -1 && $('main > .sidebar').addClass('sidebar-main-resized');


    // all anchor link listener
    // $('a').on('click', function (e) {
    //     load_links(e, this);
    // });

    
    // get clients data on search input
    $("#payment_search").on("input", function () {
        let val = $(this).val();
        $("#make_payment #pay_btn").addClass('d-none');

        $(".payment-list>#client_list").load('/?f=client_list', { data: val }, function () {
            $("#client_list a").on("click", function () {
                var id = $(this).data('id');

                $(".payment-list>#client_list").load('/?f=client_details', { id: id }, function (res) {
                    $("#make_payment #pay_btn").removeClass('d-none');
        
                    $("#ndays").on('input', function () { updatePaymentInfo(this) });
                });
            });
        });
    });

    // process payment for submission on pay btn click
    $("#pay_btn").on('click', function () {
        if ($('#ndays').val()) {
            var id = $('#make_payment .card').data('id').toString();
            if (paid_client_ids.indexOf(id) > -1) {

                // confirm repayment action
                bootbox.confirm({ size: 'small',
                    title: '<i class="icon-alert text-info icon-2x mr-2"></i>Note',
                    message: 'This client has already paid for today.',
                    buttons: { confirm: { label: 'Pay Again', className: 'btn-info' } },
                    callback: function (result) {
                        if (result) make_payment(id);
                    }
                });
                $('.bootbox .modal-content').addClass('bg-info-100');
            } else make_payment(id);
        }
    });

    
    // toggle radio checkbox
    $('.radio-check').on('click', function () {
        if ($(this).hasClass('icon-radio-unchecked')) {
            $(this).removeClass('icon-radio-unchecked').addClass('icon-radio-checked');
        } else {
            $(this).removeClass('icon-radio-checked').addClass('icon-radio-unchecked');
        }
    })


});


// username check
function checkItemExist(inp, field='email', role='manager') {
    if (inp.value) {
        formSpinner(inp);
        var func = field + '_exists';
        $.post('/'+func, {field: field, role: role, val: inp.value}, function (res) {
            formSpinner(inp, false);
            if (res == 1) validateInput(inp, 'Already exist, choose another', false);
            else if (res.trim() == '') validateInput(inp, 'Available');
            else validateInput(inp, res, false);
        });
    }
}


// validate input 
function validateInput(inp, text, valid = true) {
    if (valid) {
        $(inp).removeClass('is-invalid').addClass('is-valid');
        $(inp).parent().find('.invalid-feedback, .valid-feedback').remove();
        $(inp).parent().append(`<span class="valid-feedback">${text}</span>`);
        $(inp).parents('form').find('button[type=submit]').attr('disabled', false);
    }
    else {
        $(inp).removeClass('is-valid').addClass('is-invalid');
        $(inp).parent().find('.valid-feedback, .invalid-feedback').remove();
        $(inp).parent().append(`<span class="invalid-feedback">${text}</span>`);
        $(inp).parents('form').find('button[type=submit]').attr('disabled', true);
    }
}


function formSpinner(inp, on = true) {
    if (on) {
        $(inp).after('<div class="form-control-feedback"><i class= "icon-spinner2 spinner"></i></div>');
    } else $(inp).parent().find('.form-control-feedback').remove();
}

/**
 * Make client payment
 * @param {int} id ID of the client to pay for
 */
function make_payment(id) {
    let ndays = $('#ndays')[0].value;

    $.get(`/?f=client_payment&id=${id}&ndays=${ndays}`, function (res) {

        if (res.indexOf('Error') > -1 && res.indexOf('Error') < 6) {
            // Initialize notice
            title = '<i class="icon-alert icon-2x mr-2"></i>Error';
            notice(res, title, 'error');
        }
        else if (res) {
            paid_client_ids.push(id);
            var amount = formatCurrency('', formatCurrency2Num($('#amount_paying').data('value')) * ndays);
            // Initialize notification
            title = '<i class="icon-alert icon-2x mr-2"></i>Success';
            text = `Payment of <span class="font-weight-semibold">₦${amount}</span> completed`;
            notice(text, title, 'success');

            $(".payment-list>#client_list").html(res);
            $('#ndays').on('input', function () { updatePaymentInfo(this) });

            // add the new record to table if on the correct page
            if (location.pathname == '/dashboard' || location.pathname == '/payment_list') {
                if (current_date.toDateString() != date.toDateString()) return;
                $.get('/?f=last_payment_content', function (res) {
                    if (res.trim()) {
                        $('#payments table tbody').prepend(res);
                        $('#table-placeholder').hide();
                        $('#total_rows').text(Number($('#total_rows').text()) + 1);
                        el = $('#payments table tbody tr:first-child .actions .delete');
                        trigger_action_events(el);
                    }
                });
            }
        }
    });
}


/**
 * Used to trigger all the events needed for all table action elements
 * @param {elementObject} el an element object. default to $('table .action .delete') element
 */
function trigger_action_events(el = '') {

    // show payment modal on payment-view click
    $('.view').on('click', function () {
        let id = $(this).parents('tr').children('td:first-child').text().trim();
        // alert(id);
        $("#payment_view .modal-body").load('/?f=get_payment', { id: id }, function () {
            //
        });
    });
    
    el = el ? el : $("table .actions .delete");
    el.on("click", function () {
        var tr = $(this).parents('tr');

        // confirm delete action
        bootbox.confirm({
            size: 'small',
            title: '<i class="icon-alert text-warning icon-2x mr-2"></i>Warning',
            message: 'You are about to delete a payment data',
            buttons: { confirm: { label: 'Delete', className: 'btn-warning' } },
            callback: function (result) {
                if (result) {
                    tr.fadeOut(function () {
                        $(this).remove();
                        if ($('table tbody').text().trim() == '') $('#table-placeholder').fadeIn();
                        $('#total_rows').text(Number($('#total_rows').text()) - 1);
                    });
                }
            }
        });
        $('.bootbox .modal-content').addClass('bg-warning-100');
    });
}


/**
 * display an alert e.g warning, danger, info or success alert notice
 * @param {str} text required: your msg
 * @param {str} title title of the msg
 * @param {str} type type of notice or alert
 * @param {str} styling styling to use, bootstrap3, fontawesome, etc.
 */
function notice(text, title = 'Info', type = 'info', styling='bootstrap3') {
    // Options
    new PNotify({
        title: title,
        text: text,
        type: type,
        opacity: 0.5,
        maxonscreen: 3,
        styling: styling
    });
}

// used for payment
function updatePaymentInfo(el) {
    var amount = $('#amount_paying').data('value').split(',').join('');

    if ($(el).val() > 1) {
        $('#suffix_text').text('days');
        $('#amount_paying').text('₦' + formatCurrency('', amount * $(el).val()) + ' for ' + $(el).val() + ' days');
    } else {
        $('#suffix_text').text('day');
        $('#amount_paying').text('₦' + formatCurrency('', amount) + ' ' + $('#amount_paying').data('period'));
    }
}

/** load all links using this function, although cannot alter refresh
 * */ 
function load_links(e, a) {
    let href = $(a).attr('href');
    if (href && href != '#') {
        if (! check_connection_status_content()) {
            e.preventDefault();
            if (href.indexOf('#') == 0) {
                window.location.assign(href);
            } else {
                // Initialize notification
                title = '<i class="icon-alert icon-2x mr-2"></i> <b>No Internet Connection</b>';
                text = 'Fix your Internet Connection problem and try again.';
                notice(text, title, 'error');
            }
        }
    }
}


// check if online or offline
function check_connection_status_content() {
    let el = $('.online-status');
    return el.text() == 'Online' ? true : false;
}

// display connection Status
function update_connection_status_content(status) {
    let el = $('.online-status');
    if (status) {
        el.text('Online');
        if (el.hasClass('badge-warning')) {
            el.removeClass('badge-warning').addClass('badge-success');
        }
    } else {
        el.text('Offline');
        el.removeClass('badge-success').addClass('badge-warning');
    }
}

// check network connection status
function check_connection_status() {
    var req = $.get("/?p=online_status_test", function (res, status, xhr) {
        update_connection_status_content(status == 'success');
    });
    $(document).ajaxError(function () { update_connection_status_content(false); })
}

// convert number to byte
function get_file_byte_unit(file) {
    var count = 0
    while (true) {
        file_size = file.size / 1024
        if (file_size < 1024) { break }
        count += 1
    }
    if (count == 0) { file_size = file_size.toFixed(2) + 'kb' }
    else if (count == 1) { file_size = file_size.toFixed(2) + 'mg' }
    else if (count == 2) { file_size = file_size.toFixed(2) + 'gb' }
    return file_size;
}


function replace_content(data, idx, val=null) {
    return data.split('').map((item, j) => {
        if (j == idx - 1) {
            if (val) {
                return val;
            } return '';
        } return item
    }).join('');
}


// saved to be used for values with decimals
// val = new Number(val);
// $(this).val(val.toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

/**
 * Format number to currency
 * @param {str} el the element name, class or id
 * @param {int} val number val to format. If val, el will be ignored
 * @returns the formatted value
 */
function formatCurrency(el = '', val = '') {
    if (el) {var val = $(el).val();}
    if (!val) return;
    
    val = val.toString().split('').filter((item) => { return item != ',' }).join('');
    if (val.length > 3) {
        for (let i = val.length - 3; i > 0; i -= 3) {
            newVal = val.charAt(i - 1) + ',';
            val = replace_content(val, i, newVal);
        }
    }
    $(el).val(val);
    return val;
}

/**
 * Format currency to number
 * @param {str} val currency value to format to num
 * @returns number
 */
function formatCurrency2Num(val) {
    return val.split('').filter((item) => { return item != ',' }).join('');
}

/**
 * Format date
 * @param {str} date_val a date string from the daterange-basic input
 * @returns dateStr readable date string from JS date object
 */
function format_date(date_val, update_timer=false) {
    dates = date_val.split(' - ');

    if (dates[0] == dates[1]) {
        dates = dates[0].split('/');
        d = [new Date(dates[2], dates[0]-1, dates[1])];
        dateStr = d[0].toDateString();
    } else {
        dates = [dates[0].split('/'), dates[1].split('/')];
        d = [new Date(dates[0][2], dates[0][0]-1, dates[0][1]), new Date(dates[1][2], dates[1][0]-1, dates[1][1])];
        dateStr = d[0].toDateString() + " - " + d[1].toDateString();
    }
    if (update_timer) {
        if (d.length == 1 && d[0].toLocaleDateString() == date.toLocaleDateString()) {
            if ($('#timer').text().indexOf(':') == -1) {
                $('#timer').text(dateStr);
                timer = setInterval(updateTimer, 1000);
                $('#table-placeholder p').text('No Payment Made Yet For Today');
            }
        } else {
            clearInterval(timer);
            $('#timer').text(dateStr);
        }
    }
    return dateStr;
}


// toggle sidebar
function toggleSidebar(open=true) {

    let page_container = $('main > .content-wrapper');
    let sidebar = $('main > .sidebar.sidebar-main');

    w = sidebar.width();
    page_container.css('margin-left', w + 'px');

    if (sidebar.hasClass('sidebar-main-resized')) {
        page_container.css('margin-left', '56px');
    } else {
        page_container.css('margin-left', w + 'px');
    }
}


/** preview image file
 *  */
function previewImage(e) {
    const id = e.target.name;
    const file = e.target.files[0], div = $('#'+id+' .file-preview-thumbnails');
    if (file) {
        $('#'+id+' .fileinput-remove').fadeIn();
        $('#'+id+' .file-drop-zone-title').fadeOut();

        setTimeout(() => {
            let url = URL.createObjectURL(file);
            file_size = get_file_byte_unit(file);

            let div1 = $(`<div class="card p-0 ${id} file-preview-frame" id="${file.name}" style="opacity:0"><div class="kv-file-content"></div><div class="file-thumbnail-footer"><div class="file-footer-caption" title="${file.name}"><div class="file-caption-info">${file.name}</div><div class="file-size-info"> <samp>${file_size}</samp></div></div><div class="file-upload-indicator" title="Not uploaded yet"><i class="icon-file-plus text-success"></i></div><div class="file-actions"><div class="file-footer-buttons"><button type="button" class="kv-file-zoom " title="View Details"><i class="icon-zoomin3"></i></button></div></div><div class="clearfix"></div></div></div>`);

            var img = $(`<img class="featured file-preview-image kv-preview-data" id="img_preview${id}" src="${url}" alt="${file.name}" style="width: auto; height: auto; max-width: 100%; max-height: 100%; image-orientation: from-image;" />`);

            div.html(div1); div1.children('.kv-file-content').append(img);

            img.onload = function () { URL.revokeObjectURL(img.attr('src')) }

            div1.animate({ opacity: '1' });
            $('#'+id+' .close').fadeIn();
            trigger_img_del_evt(id);
        }, 300);
    }

}


function trigger_img_del_evt(id) {
    id = '#' + id;
    $(id + ' .close').on('click', function () {
        let cont = $(this).parents(id);
        let div = cont.find('.file-preview-frame');

        $(div).fadeOut(function () {
            div.remove();
            $(id + ' .fileinput-remove').fadeOut();
            $(id + ' .file-drop-zone-title').fadeIn();
            $(id + ' .kv-fileinput-error').fadeOut();
            if (cont.parent().has('button[type=submit]')) cont.siblings('button[type=submit]').addClass('d-none');
        });
    });
}


function light_box(el) {

    // Initialize
    const lightbox = GLightbox({
        selector: el + ' .glightbox'
    });
    // const myGallery = GLightbox({
    //     elements: [
    //         {
    //             'href': 'https://picsum.photos/1200/800',
    //             'type': 'image',
    //             'title': 'My Title',
    //             'description': 'Example',
    //         },
    //         {
    //             'href': 'https://picsum.photos/1200/800',
    //             'type': 'image',
    //             'alt': 'image text alternatives'
    //         },
    //         {
    //             'href': 'https://www.youtube.com/watch?v=Ga6RYejo6Hk',
    //             'type': 'video',
    //             'source': 'youtube', //vimeo, youtube or local
    //             'width': 900,
    //         },
    //         {
    //             'content': '<p>This will append some html inside the slide</p>' // read more in the API section
    //         },
    //         {
    //             'content': document.getElementById('inline-example') // this will append a node inside the slide
    //         },
    //     ],
    //     autoplayVideos: true,
    // });
    // myGallery.open();

}


function validateForm() {
    let ps1 = document.getElementById('psw').value;
    let ps2 = document.getElementById('psw_confirm').value;
    let tos = document.getElementById('old_psw');
    if (!tos.value) {
        alert("Input your old Password to continue");
        return false;
    }
    if (ps2 != ps1) {
        alert("You need to confirm your password to continue");
        return false;
    }
    return true;
}


function togglePasswordView(el) {
    if ($(el).hasClass('icon-eye')) {
        $(el).removeClass('icon-eye').addClass('icon-eye-blocked');
        $(el).parents('.form-group').find('input').attr('type', 'text');
    } else {
        $(el).removeClass('icon-eye-blocked').addClass('icon-eye');
        $(el).parents('.form-group').find('input').attr('type', 'password');
    }
}


function confirmAction(text, title='', callback, action=null, el='', type='warning')
{
    bootbox.confirm({
        size: 'small',
        title: '<i class="icon-alert text-'+type+' icon-2x mr-2"></i>'+title,
        message: text,
        buttons: { confirm: { label: action, className: 'btn-'+type } },
        callback: function(result) { callback(result, el) }
    });
    $('.bootbox .modal-content').addClass('bg-'+type+'-100');
}


function delGrt(result, el)
{
    if (result) {
        $(el).parents('form').trigger('submit');
    }
}


// preview single product
function getProduct(el) {
    let val = $(el).val();

    $.get(`/p/preview/${val}`, (data, status) => {
        $('#product_view').html(data);
        light_box('#product_view');
    });

}


/** show or hide a content base on a condition
 * @param opt the condition to compare with
 * @param val the value to compare with the condition
 * @param base the content to hide or show base on the condition
 * @returns void
 *  */
function toggleOnOptionSelect(val, opt, base = '', required_el = []) {
    let cond_base = base ? $(base) : $('#' + opt);
    if (val.indexOf(opt) > -1) {
        cond_base.removeClass('d-none');
        $.each(required_el, (i, el) => {
            $(el).addClass('required');
        });
    } else {
        cond_base.addClass('d-none');
        $.each(required_el, (i, el) => {
            $(el).removeClass('required');
        });
    }
}


function toggleOnInputChange(el) {
    setTimeout(function () {
        ($(el).val() == '' || $(el).val() == '__%') ? $('#' + $(el).attr('name')).fadeOut() : $('#' + $(el).attr('name')).fadeIn();
    }, 100);
}


function toggleOnBeneficialSelect(el) {
    if ($(el).val() == 'n_people') {
        if (!$('#coupon').hasClass('d-none')) $('#coupon').addClass('d-none');
        $('#n_people').removeClass('d-none');
    }
    else if ($(el).val() == 'coupon') {
        if (!$('#n_people').hasClass('d-none')) $('#n_people').addClass('d-none');
        $('#coupon').removeClass('d-none');
    }
    else if ($(el).val() == 'coupon_n_people') {
        $('#coupon').removeClass('d-none');
        $('#n_people').removeClass('d-none');
    }
    else $('#coupon, #n_people').addClass('d-none');
}
