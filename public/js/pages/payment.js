var current_date = date;

$(function () {

    // start timer for the payment page
    $('#timer').text(date.toLocaleTimeString())
    timer = setInterval(updateTimer, 1000);

    // set today as default date for the daterangepicker
    $('#daterange-basic').daterangepicker({
        startDate: date,
        endDate: date,
        applyClass: 'bg-slate-600',
        cancelClass: 'btn-default',
        autoUpdateInput: true,
        autoApply: true
    });

    // get payment_list on date selected
    $('#date-filter button').on('click', function () {
        let date_val = $('#daterange-basic').val();
        dates = date_val.split(' - ');
        if (dates[0] == dates[1]) {
            dates = dates[0].split('/');
            current_date = new Date(dates[2], dates[0] - 1, dates[1]);
        }
        get_payments_by_date(date_val);
    });

    // get prev day payments on prev button clicked
    $('#prev').on('click', function () {
        current_date = new Date(current_date.valueOf() - 86400000);
        let d = current_date.getMonth() + 1 + '/' + current_date.getDate() + '/' + current_date.getFullYear();
        get_payments_by_date(d + ' - ' + d);
    });

    // get next day payments on next button clicked
    $('#next').on('click', function () {
        current_date = new Date(current_date.valueOf() + 86400000);
        let d = current_date.getMonth() + 1 + '/' + current_date.getDate() + '/' + current_date.getFullYear();
        get_payments_by_date(d + ' - ' + d);
    });

    // get client payment on search filter
    $('#search-filter').on('input', function () {
        let val = $(this).val();

        $("#search-result").load('/?f=client_list', { data: val }, function () {

            $(this).find("a.list-group-item").on("click", function () {
                var id = $(this).data('id');
                navigateToCurrentDate();
                get_payments_by_cid(id);
                $(this).parent().children().removeClass("bg-light");
                $(this).parent().prepend($(this));
                $(this).addClass("bg-light");

                clearInterval(timer);
                $('#timer').text($(this).find('.name').text().trim());
            });
        });
    });


    // trigger actions event
    trigger_action_events();

    // show payment modal on payment-view click
    // $('.view').on('click', function () {
    //     let id = $(this).parents('tr').children('td:first-child').text().trim();
    //     $("#payment_view .modal-body").load('/?f=get_payment', { id: id }, function () {

    //     });
    // });

});

/**
 * Navigate payment to today
 */
function navigateToCurrentDate() {
    if ($('#timer').text().indexOf(':') == -1) {
        timer = setInterval(updateTimer, 1000);
        current_date = date;
    }
}


// update payment timer
function updateTimer() {
    $('#timer').text(date.toLocaleTimeString())
}


// get payment data by date filter
function get_payments_by_cid(id) {
    if (id) {
        $.post(`/?f=payment_data_by_cid`, { id: id }, function (res) {
            let msg = 'No Payment Made Yet For This Client';
            updateTable(res, true, msg);
        });
    }
}


// get payment data by date filter
function get_payments_by_date(date_val) {
    if (date_val) {
        $.post(`/?f=payment_list_by_date`, { date: date_val }, function (res) {
            updateTable(res, true);
            format_date(date_val, true);
        });
    }
}


function updateTable(res, actions=false, tb_ph='') {
    if (res.trim()) {
        $('#payments table').html(res);
        $('#total_rows').text($('tbody').data('nrows'));
        $('#table-placeholder').hide();
        if (actions) trigger_action_events();
    } else {
        tb_ph = tb_ph ? tb_ph : 'No Payment Made On This Date';
        $('#table-placeholder p').text(tb_ph);
        $('#payments table tbody').html('');
        $('#table-placeholder').fadeIn();
    }
}


function updateItemsOnDeletePaymentData() {
}


function refreshRevenueStats() {

}



// show date picker
function showDatePicker() {
    // Basic initialization
    $('#daterange-basic').daterangepicker({
    });
}


/* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
function openFilter() {
    document.getElementById("main").classList.remove('col-lg-12');
    document.getElementById("main").classList.add('col-lg-9');
    document.getElementById("filter-sidebar").classList.remove('d-none');
    document.getElementById("filter-sidebar").style.marginRight = '0px';
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function closeFilter() {
    document.getElementById("main").classList.remove('col-lg-9');
    document.getElementById("main").classList.add('col-lg-12');
    document.getElementById("filter-sidebar").classList.add('d-none');
} 
