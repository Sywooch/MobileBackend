
$('#category-create').on('click', function() {
    $('#category-modal').modal('show')
        .find('#category-modal-content')
        .load($(this).attr('data-target'));
});