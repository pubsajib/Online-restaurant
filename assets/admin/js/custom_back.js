


/*product details expand*/
$(document).on("click",".expandBtn",function(){
	$(this).parent(".pDescription-parent").children(".pDescription").toggleClass("P_expand");
});

$('.datepicker').datepicker();

/*For file Input starts*/
$(function() {

  // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {
      $(':file').on('fileselect', function(event, numFiles, label) {

          var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }

      });
  });
  
});
/*For file Input Ends*/

//Opening time dynamic add delete
$(document).on('click','.dynamic_time_add',function(){
    var data_name = $(this).parents('.day_item').attr('data-name');
    $start_name = data_name+'_start_time';
    $end_name = data_name+'_end_time';
    var add_time_section = $('#dynamic_time_section').html();
    var add_time_section = add_time_section.replace('static_start_time', $start_name);
    var add_time_section = add_time_section.replace('static_end_time', $end_name);

    $(this).parents('.day_item').find('.dynamic_time_section_area').append(add_time_section);
});

$(document).on('click','.dynamic_time_delete',function(){
    $(this).parents('.dynamic_multi_section').remove();
});

