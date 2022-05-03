
var file_counter = 0, max_file_upload = 0, xhr_handle, res_data;
    
$(function () {

    max_file_upload = $('#gallery_field').attr('data-max-file-upload');

    // form submit button
    $("[href='#finish']").hide();
    $("[href='#finish']").after("<button type='submit' id='submit-form' class='btn btn-primary' role='menuitem'>Submit form <i class='icon-paperplane ml-2'></i></button>");

    
    // open file browser
    $(".btn-file").on('click', function () {
        $(this).siblings('input').trigger('click');
    });

    // process and preview featured image
    $("#fimage_input").on('change', function (e) {
        previewImage(e);
    });

    
    // process and preview gallery images
    $("#gallery").on('change', function (event) {
        let files = event.target.files, div = $('#gallery_preview');

        if (files) {
            let file_list = remove_file_duplicates(files);
            copies = file_list.pop()
            files = file_list;
            
            $('#gallery_field .fileinput-remove').trigger('click');
            $('#gallery_field .file-drop-zone-title').fadeOut();

            file_counter = files.length;
            file_counter = file_counter > max_file_upload ? max_file_upload : file_counter;

            setTimeout(() => {
                $.each(files, (i, file) => {

                    if (i > max_file_upload-1 && files.length > max_file_upload) {
                        $('#gallery_field .kv-fileinput-error').text('You cannot upload more than ' + max_file_upload + ' files');
                        $('#gallery_field .kv-fileinput-error').css('display', 'block');
                        return;
                    }
                    
                    let url = URL.createObjectURL(file);
                    file_size = get_file_byte_unit(file);

                    let div1 = $(`<div class="card col-lg-4 p-0 file-preview-frame" id="` + file.name + `" style="opacity:0;max-width:32%"><div class="kv-file-content"></div><div class="file-thumbnail-footer"><div class="file-footer-caption" title="${file.name}"><div class="file-caption-info">${file.name}</div><div class="file-size-info"> <samp>${file_size}</samp></div></div><div class="file-upload-indicator" title="Not uploaded yet"><i class="icon-file-plus text-success"></i></div><div class="file-actions"><div class="file-footer-buttons"><button type="button" class="kv-file-upload " title="Upload file"><i class="icon-upload"></i></button> <button type="button" class="kv-file-remove " title="Remove file"><i class="icon-bin"></i></button><button type="button" class="kv-file-zoom " title="View Details"><i class="icon-zoomin3"></i></button></div></div><div class="clearfix"></div></div></div>`);
                    
                    var img = $('<img class="file-preview-image kv-preview-data" id="img_preview' + i + '" src="' + url + '" alt="' + file.name + '" style="width: auto; height: auto; max-width: 100%; max-height: 100%; image-orientation: from-image;" />');

                    div.append(div1); div1.children('.kv-file-content').append(img);

                    img.onload = function () { URL.revokeObjectURL(img.attr('src')) }

                    div1.animate({ opacity: '1' });
                    $('#gallery_field .fileinput-remove').fadeIn();
                    update_caption();
                    trigger_del_evt();
                });
            }, 300)
            
        }
    });


    /**
     * fileinput-remove: remove all unprocessed files; 
     *  */ 
    $('#gallery_field .fileinput-remove').on('click', function () {
        file_counter = 0;
        $('#gallery_field .fileinput-remove').fadeOut();
        $('#gallery_field .kv-fileinput-error').fadeOut();
        $('#gallery_field .file-drop-zone-title').fadeIn();

        $('#gallery_field .file-preview-thumbnails').children().each((i, f) => {
            $(f).fadeOut(function () {
                $(f).remove();
            });
            $('#gallery_field .file-caption-name').val('');
        });
    });


    $(".cat-option .dropdown-item").on('click', function () {
        const input = $(this).parents('.cat-option').find('input:first');
        input.val(($(this).children('a').text()));
        input.attr('id', $(this).children('a').attr('id'));
        input.next().val(($(this).children('a').attr('id')));
    })


    // Category: ajax get brands on category select 
    $("#product_cat input").on("blur", function (e) {
        setTimeout(function () {
            id = $("#product_cat input").attr('id');
            if (!id) return;

            $("#product_brand").html('<option value="">Select Product Brand</option>');
            $("#product_model").html('<option value="">Select Product Model</option>');

            $.get(`/cat/${id}/brands`, function (data) {
                $.each(data, function (i, brand) {
                    var opt = `<option value="${brand.id}">${brand.name}</option>`;
                    $("#product_brand").append(opt);
                });
            });
        }, 300);
    });

    // Brand: get model data on brand select
    $("#product_brand").on("change", function () {
        $("#product_model").html('<option value="">Select Product Model</option>');

        $.get(`/brand/${$(this).val()}/models`, function (data) {
            $.each(data, function (i, model) {
                let opt = `<option value="${model.id}">${model.name}</option>`;
                $("#product_model").append(opt);
            });
        });
    });

    // Model: update product name on model select
    $("#product_model").on("change", function () {
        let cat = $("#product_cat>option:selected");
        let brand = $("#product_brand>option:selected");
        let model = $("#product_model>option:selected");
        let pname = $("#product_name");

        if (model.val()) {
            pname.val(brand.text() + ' ' + model.text());
        }
    });


    // format currency input field as user types 
    $('.currency_format').on('input', function () {
        let val = $(this).val();
        val = val.split('').filter((item) => { return item != ',' }).join('');
        if (val > 0) {
            if (val.length > 3) {
                for (let i = val.length - 3; i > 0; i -= 3) {
                    newVal = val.charAt(i - 1) + ',';
                    val = replace_content(val, i, newVal);
                }
            }
            $(this).val(val);
        } else {
            $(this).val('');
        }
    });


    // free_days: update selected on check change 
    $('#free_days input[type=checkbox]').on('change', (event) => {
        var el = $('#free_days select[name=free_days]>option').filter(`[value=${event.target.value}]`);
        if (el.attr('selected') == 'selected') {
            el.attr('selected', false);
        } else {
            el.attr('selected', 'selected');
        }
    });
    


});


function upload_ajax(url, files, responseType = '') {

    const xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    // xhr.setRequestHeader('Content-Type', 'multipart/form-data');
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4) {
            console.log(xhr.response);
        }
        console.log(xhr.readyState);
    }
    xhr.send(files);
}


function remove_file_duplicates(files) {
    let file_list = [], sizes = [], copies = [];

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        if (sizes.indexOf(file.size) == -1) {
            file_list.push(file)
            sizes.push(file.size);
            continue
        }
        copies.push(file);
    }
    file_list[file_list.length] = copies
    return file_list;
}


function trigger_del_evt() {

    $('#gallery_field .kv-file-remove').on('click', function () {
        let div = $(this).parents('#gallery_field .file-preview-frame');
        
        $(div).fadeOut(function () {
            file_counter -= 1;
            div.remove();
            update_caption();
            if (file_counter == 0) {
                $('#gallery_field .fileinput-remove').fadeOut();
                // $('#gallery_field .fileinput-upload').fadeOut();
                $('#gallery_field .file-drop-zone-title').fadeIn();
                $('#gallery_field .kv-fileinput-error').fadeOut();
            }
        });
    });
}


function update_caption() {
    let caption = $('.file-caption-name'); caption.val('');
    if (file_counter > 2) {
        caption.val(file_counter + ' files selected');
    } else {
        $('#gallery_field .file-preview-frame').each(function (i, f) {
            if (i == 0) { caption.val(f.id) }
            else { caption.val(caption.val() + ', ' + f.id) }
        });
    }
}


function toggleOnDiscount(el) {
    if ($(el).val() == 'discount') {
        if (!$('#coupon').hasClass('d-none')) $('#coupon').addClass('d-none');
        $('#discount').removeClass('d-none');
    }
    else if ($(el).val() == 'coupon') {
        if (!$('#discount').hasClass('d-none')) $('#discount').addClass('d-none');
        $('#coupon').removeClass('d-none');
    }
    else $('#coupon, #discount').addClass('d-none');
}
