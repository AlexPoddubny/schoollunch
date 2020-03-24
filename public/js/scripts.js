$(document).on('click', '.add-user', function (e) {
    e.preventDefault();
    $('#username').attr('value', $(this).data('name'));
    $('#user-id').attr('value', $(this).data('id'));
    $('.search').html('');
});

$('#schools').change(function () {
    var value = $('#schools').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/getclasses',
        data: {
            id: value
        },
        type: 'POST',
        success: function (res) {
            if (res.length > 0) {
                var html = '';
                for (var i = 0; i < res.length; i++) {
                    if (res[i]['student'].length > 0){
                        html += '<option value="' + res[i]['id'] + '">' + res[i]['name'] + '</option>';
                    }
                }
                $('#classes').html(html);
                $('#classes_group').removeAttr('hidden');
            }
        },
        error: function (res) {
            console.log(res);
        }
    })
});
