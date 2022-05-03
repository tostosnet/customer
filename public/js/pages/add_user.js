

$(function () {

    // form submit button
    $("[href='#finish']").hide();
    $("[href='#finish']").after(`
        <button type='submit' id='submit-form' class='btn btn-primary'>
            Submit form<i class='icon-paperplane ml-2'></i>
        </button>
        <button type='submit' formaction='?grt=1' formmethod='post' id='getGrtForm' class='btn btn-primary ml-3'>
            Submit & get Guarantor form<i class='icon-paperplane ml-2'></i>
        </button>
    `);


    if ($('form').attr('name') == 'grt_form') {
        $('#getGrtForm').text('Submit & get another Guarantor form')
    }


    // process and preview featured images
    $("input[type=file]").on('change', function (e) {
        const file = e.target.files[0],
            div = $(this).parents('.photo').next().find('.media');
        
        if (file && (accepted_img_types.indexOf(file.type) > -1) && (file.size < 2048000)) {
            setTimeout(() => {
                let url = URL.createObjectURL(file);
                file_size = get_file_byte_unit(file);

                let div1 = $('<div class="card p-0 photo file-preview-frame" id="' + file.name + '" style="opacity:0"><div class="kv-file-content clearfix"></div><div class="file-thumbnail-footer"><div class="file-footer-caption" title="' + file.name + '"><div class="file-caption-info">' + file.name + '</div><div class="file-size-info"> <samp>' + file_size + '' + '</samp></div></div><div class="file-upload-indicator" title="Not uploaded yet"><i class="icon-file-plus text-success"></i></div><div class="file-actions"><div class="file-footer-buttons"><button type="button" class="kv-file-zoom " title="View Details"><i class="icon-zoomin3"></i></button></div></div><div class="clearfix"></div></div></div>');

                var img = $('<img class="photo-upload file-preview-image" src="' + url + '" alt="' + file.name + '" style="width: auto; height: auto; max-width: 100%; max-height: 100%; image-orientation: from-image;" />');

                div.html(div1); div1.children('.kv-file-content').append(img);
                $(this).siblings('span').text(file.name);

                img.onload = function () { URL.revokeObjectURL(img.attr('src')) }

                div1.animate({ opacity: '1' });
            }, 300);
        } else {
            $(this).siblings('span').text('Choose file');
            div.children().animate({ opacity: '0' }, () => { div.html('') });

            setTimeout(() => {
                alert('ERROR!!\nOnly image of type (jpeg, jpg, gif or png) with max file size of 2MB are accepted');
            }, 500);
        }
    });


    // get product details on product select
    $('#product_list').on('change', function(e) {
        let val = $(this).val();
        
        $.get(home_url + '?f=get_product_by_name_color&vals=' + val, (data, status) => {
            
            if (data && data.indexOf('Warning') == -1 && data.indexOf('Fatal error') == -1) {
                $('#product_view').html(data);
                light_box('#product_view');
            } else {
                console.log('Error: '+ status + '; ' + data);
            }
        });
    });

    

});
