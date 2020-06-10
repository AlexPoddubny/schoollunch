import route from "./route";
let lunchesList = [];
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.add-user', function (e) {
    e.preventDefault();
    $('#user').val($(this).data('name'));
    $('#user_id').attr('value', $(this).data('id'));
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
            html = '<option disabled selected>Оберіть клас навчання вашої дитини</option>' + html;
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
            window.location = route('login');
        }
    })
});

$('#classes').change(function () {
    $('#viewMenu').removeAttr('hidden');
});

//****************************
//   Search student
//****************************
$(document).on('keyup', '#student', function (e) {
    var query = $(this).val();
    if (query.length >= 3){
        $.ajax({
            url: route('home.search'),
            data: {
                query: query,
                schoolClass: $('#classes').val()
            },
            type: 'POST',
            success: function (res) {
                // console.log(res);
                $('#result').html(res);
            },
            error: function (res) {
                console.log(res);
            }
        })
    }
});

//****************************
//   Search user
//****************************
$(document).on('keyup', '#user', function (e) {
    $.ajax({
        url: route('users.search'),
        data: {
            query: $(this).val(),
        },
        type: 'POST',
        success: function (res) {
            // console.log(res);
            $('#result').html(res);
        },
        error: function (res) {
            console.log(res);
        }
    });
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

function printErrorMsg (msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');
    $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
}

//****************************
//   Add product to course
//****************************

$(document).on('click', '#add-product', function (e) {
    e.preventDefault();
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
            // console.log(res);
            if($.isEmptyObject(res.error)){
                $(".print-error-msg").css('display','none');
                $('#products').html(res);
            } else {
                printErrorMsg(res.error);
            }
        },
        error: function (res) {
            console.log(res);
        }
    });
});

//****************************
// Delete product from course
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

//****************************
//      Delete course
//****************************
$(document).on('click', '.course-destroy', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    // console.log(id);
    $.ajax({
        url: route('courses.destroy', [id]),
        type: 'DELETE',
        success: function (res) {
            window.location = route('courses.index');
        },
        error: function (res) {
            console.log(res);
        }
    })
})

//****************************
//      Delete lunch
//****************************
$(document).on('click', '.lunch-destroy', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: route('lunches.destroy', [id]),
        type: 'DELETE',
        success: function (res) {
            window.location = route('lunches.index');
        },
        error: function (res) {
            console.log(res);
        }
    })
})

$(document).on('keyup change blur', '#size', function () {
    $('#factor').val(parseInt($(this).val()) / 1000);
});

$(document).on('change', '#type', function () {
    var type = $(this).val();
    // console.log(type);
    $.ajax({
        url: route('getcourses'),
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

//********************************
//          Course delete
//********************************

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

//********************************
//        Child select
//********************************

$(document).on('click', '.add-child', function (e) {
    e.preventDefault();
    $.ajax({
        url: route('home.store'),
        data: {
            student: $(this).data('id')
        },
        type: 'POST',
        success: function (res) {
            // console.log(res);
            window.location = route('home.index');
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
            $('#lunch_select').html(res.list);
            lunchesList = res.lunches;
            showLunch();
        },
        error: function (res) {
            // console.log(res);
        }
    })
});

function showLunch(){
    $('#lunch').html(lunchesList[$('#lunch_select').val()]);
}

$(document).on('change', '#lunch_select', function () {
    showLunch();
})

/*

$(document).on('click', '.edit-product', function () {
    var id = $(this).data('id');
    // console.log(id);
    $.ajax({
        url: route('products.edit', [id]),//'products/' + id + '/edit',
        type: 'GET',
        success: function (res) {
            console.log(res);
        },
        error: function (res) {
            console.log(res);
        }
    })
});
*/
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
