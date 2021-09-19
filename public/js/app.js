console.log('works');
$( function() {
  $( ".datepicker" ).datepicker({
    showOn: "button",
    buttonImage: "images/calendar.png",
    buttonImageOnly: true,
    buttonText: "Select date"
  });
} );

$('#show-results').on('click', function(e) {
  e.preventDefault();
  $('.result-set').html('');
  let date_from = $('.date-from').val();
  let date_to = $('.date-to').val();

  $.ajax({
    url:'/result-set',
    type:'post',
    data:{
      date_from: date_from,
      date_to: date_to
    },
    success:function(response){

      $('.result-set').append(response);
      console.log('success');
      // var results = $('#results_found').val();
      // if(results == undefined){ results = 0;}
      //
      // $('#search_results span').html(' ' + results);
      // $('#search_results').fadeIn(350);

    },
    error: function (xhr, ajaxOptions, thrownError) {
      //these parameters are for later usage, when I decide to make the error reporting more advanced
      // alert(xhr.status);
      // alert(thrownError);
      $('.alert-danger').show();
      $('.alert-danger').delay(3000).fadeOut(350);
    }
  });
});
