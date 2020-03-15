$(document).on('click','.add-user', function(e){
    e.preventDefault();
    $('#adminname').attr('value', $(this).data('name'));
    $('#admin-id').attr('value', $(this).data('id'));
    $('ul').html('');
});
