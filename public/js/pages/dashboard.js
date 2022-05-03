var current_date = date;

$(function () {

    // start timer for the payment page
    $('#timer').text(date.toLocaleTimeString())
    timer = setInterval(updateTimer, 1000);

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

});


function updateTimer() {
    $('#timer').text(date.toLocaleTimeString())
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

// update table with new record
function updateTable(res, actions = false, tb_ph = '') {
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
