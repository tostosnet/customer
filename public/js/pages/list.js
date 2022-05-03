

$(function () {

    // sort table on sort arrow click
    $('th').each(function (col) {
        $(this).click(function () {
            if ($(this).is('.sort')) {
                if ($(this).is('.asc')) {
                    $(this).removeClass('asc');
                    $(this).addClass('desc sorted');
                    $(this).children('.sort-icon').removeClass('icon-arrow-up12').addClass('icon-arrow-down12');
                    sortOrder = -1;
                }
                else {
                    $(this).addClass('asc sorted');
                    $(this).removeClass('desc');
                    $(this).children('.sort-icon').removeClass('icon-arrow-down12').addClass('icon-arrow-up12');
                    sortOrder = 1;
                }
                $(this).siblings().removeClass('asc sorted');
                $(this).siblings().removeClass('desc sorted');
                var arrData = $('table').find('tbody >tr:has(td)').get();

                arrData.sort(function (a, b) {
                    var val1 = $(a).children('td').eq(col).text().toUpperCase();
                    var val2 = $(b).children('td').eq(col).text().toUpperCase();
                    if ($.isNumeric(val1) && $.isNumeric(val2)) {
                        return sortOrder == 1 ? val1 - val2 : val2 - val1;
                    } else {
                        return (val1 < val2) ? -sortOrder : (val1 > val2) ? sortOrder : 0;
                    }
                });
                $.each(arrData, function (index, row) {
                    $('tbody').append(row);
                });
            }
        });

    });


    $("#search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("table tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#table_length").on("change", function () {
        var value = $(this).val(), url;
        if (location.pathname == '/product_list') {
            url = '/product_list tbody>tr';
        } else if (location.pathname == '/client_list') {
            url = '/client_list tbody>tr';
        } else if (location.pathname == '/grt_list') {
            url = '/grt_list tbody>tr';
        }
        if (value) $('table tbody').load(url, { show: value });
    });
})
