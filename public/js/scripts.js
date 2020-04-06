$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.add-user', function (e) {
    e.preventDefault();
    $('#username').attr('value', $(this).data('name'));
    $('#user-id').attr('value', $(this).data('id'));
    $('.search').html('');
});

function fillSelect(res){
    if (res.length > 0) {
        var html = '';
        for (var i = 0; i < res.length; i++) {
            if (res[i]['student'].length > 0){
                html += '<option value="'
                    + res[i]['id']
                    + '">'
                    + res[i]['name']
                    + '</option>';
            }
        }
        if (html != '') {
            html = '<option disabled selected>Оберіть клас</option>' + html;
            $('#classes').html(html);
            $('#classes_group').removeAttr('hidden');
        }
    }
}

function hideElements(){
    $('#classes').html('');
    $('#classes_group').attr('hidden', true);
    $('#viewMenu').attr('hidden', true);
}

$('#schools').change(function () {
    hideElements();
    var value = $('#schools').val();
    $.ajax({
        url: '/getclasses',
        data: {
            id: value
        },
        type: 'POST',
        success: function (res) {
            fillSelect(res);
        },
        error: function (res) {
            console.log(res);
        }
    })
});

$('#classes').change(function () {
    $('#viewMenu').removeAttr('hidden');
});

// $(document).on('keyup', '#query', function (e) {
$(document).on('click', '#search', function (e) {
    var query = $('#query').val();
    e.preventDefault();
    if (query.length >= 3){
        $.ajax({
            url: '/search',
            data: {
                query: query
            },
            type: 'POST',
            success: function (res) {
                $('#result').html(res);
            },
            error: function (res) {
                console.log(res);
            }
        })
    }
});

/*$(document).on('keyup', '#course_query', function() {
    var query = $('#course_query').val();
    $.ajax({
        url: '/admin/product/search',
        data: {
            query: query
        },
        type: 'POST',
        success: function (res) {
            $('#result').html(res);
        },
        error: function (res) {
            console.log(res);
        }
    })
});*/

/*
$(document).on('click', '.add-product', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var title = $(this).html();
    var html = $('#ingredients').html();
    html += '<tr><td>' + '<input type="hidden" name="product[]" value="' + id + '">' + title + '</td>'
        + '<td style="text-align: center"><input type="number" step="0.5" name="brutto[]" class="form-control"></td>'
        + '<td style="text-align: center"><input type="number" step="0.5" name="netto[]" class="form-control"></td>'
        + '<td></td></tr>';
    $('#ingredients').html(html);
})
*/

$(document).on('click', '.add-product', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    // console.log(id);
    $.ajax({
        url: 'addproduct',
        data: {
            id: id
        },
        type: 'POST',
        success: function (res) {
            // console.log(res);
            $('#products').html(res);
        },
        error: function (res) {
            console.log(res);
        }
    });
});

$(document).on('click', '.del-product', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    // console.log(id);
    $.ajax({
        url: 'delproduct',
        data: {
            id: id
        },
        type: 'POST',
        success: function (res) {
            // console.log(res);
            $('#products').html(res);
        },
        error: function (res) {
            console.log(res);
        }
    });
});
