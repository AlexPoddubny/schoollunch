import route from "./route";
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
        url: route('getclasses'),
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
            url: '/home/search',
            data: {
                query: query,
                schoolClass: $('#classes').val()
            },
            type: 'POST',
            success: function (res) {
                console.log(res);
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

//****************************
//   Add products to course
//****************************

$(document).on('click', '#add-product', function (e) {
    e.preventDefault();
    // var id = $(this).data('id');
    // console.log(id);
    $.ajax({
        url: route('addproduct'),
        data: {
            id: $('#product_id').val(),
            name: $('#product_id option:selected').text(),
            brutto: $('#brutto').val(),
            netto: $('#netto').val(),
        },
        type: 'POST',
        success: function (res) {
            console.log(res);
            $('#products').html(res);
        },
        error: function (res) {
            console.log(res);
        }
    });
});

//****************************
// Delete products from course
//****************************

$(document).on('click', '.del-product', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: route('delproduct'),//'delproduct',
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

$(document).on('keyup change blur', '#size', function () {
    $('#factor').val(parseInt($(this).val()) / 1000);
});

$(document).on('change', '#type', function () {
    var type = $(this).val();
    // console.log(type);
    $.ajax({
        url: 'getcourses',
        data: {
            type: type
        },
        type: 'POST',
        success: function (res) {
            $('#courses_list').html(res);
            // console.log(res);
        },
        error: function (res) {
            console.log(res);
        }
    })
});

$(document).on('click', '#addcourse', function (e) {
    e.preventDefault();
    $.ajax({
        url: route('addcourse'),
        data: {
            id: $('#courses_list').val(),
            name: $('#courses_list option:selected').text(),
            size_id: $('#size').val(),
            type_id: $('#type').val(),
            type: $('#type option:selected').text(),
            size: $('#size option:selected').text(),
        },
        type: 'POST',
        success: function (res) {
            // console.log(res);
            $('#courses').html(res);
        },
        error: function (res) {
            console.log(res);
        }
    });
});

$(document).on('click', '.del-course', function (e) {
    e.preventDefault();
    $.ajax({
        url: route('delcourse'),
        data: {
            id: $(this).data('id')
        },
        type: 'POST',
        success: function (res) {
            $('#courses').html(res);
        },
        error: function (res) {
            console.log(res);
        }
    })
})

$(document).on('change', '.menu-select', function (e) {
    $.ajax({
        url: '/getlunches',
        data: {
            category: $('#category_id').val(),
            privileged: $('#privileged').is(":checked")
        },
        type: 'POST',
        success: function (res) {
            // console.log(res);
            $('#lunch_select').html(res);
        },
        error: function (res) {
            console.log(res);
        }
    })
});

$(document).on('click', '.edit-product', function () {
    var id = $(this).data('id');
    // console.log(id);
    $.ajax({
        url: 'products/' + id + '/edit',
        type: 'GET',
        success: function (res) {
            console.log(res);
        },
        error: function (res) {
            console.log(res);
        }
    })
});
/*
$(document).on('change', '.class-select', function (e) {
    $.ajax({
        url: '/loadclasses',
        data: {
            break_id: $('#break_id').val(),
            category: $('#category_id').val()
        },
        type: 'POST',
        success: function (res) {
            console.log(res);
            $('#classes_list').html(res);
        },
        error: function (res) {
            console.log(res);
        }
    })
});
*/
