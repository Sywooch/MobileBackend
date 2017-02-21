$(function(){
   $('#category-create').click(function(){
       $('#category_modal').modal('show')
           .find('#category_model_content')
           .load($(this).attr('value'));
   });
});