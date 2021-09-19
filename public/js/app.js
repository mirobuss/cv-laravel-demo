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

      $('.alert-danger').show();
      $('.alert-danger').delay(3000).fadeOut(350);
    }
  });
});

//pencil onclick
$('i.fas').on('click', function(){

   //clearErrors();
     let modalBox = '.'+$(this).attr('data-type');
     $(modalBox).css('display','flex');
});

function closeModalBox(x){
  $(x).closest('.modal-box').hide();
}



$('.submit-skill').on('click', function(e) {

  let technology = $('.modal-skill input[name="technology"]').val();
  console.log(technology);
  $.ajax({
    url:'/submit-skill',
    type:'post',
    data:{
      technology: technology,
    },
    success:function(response){

      $('.modal-skill input[name="technology"]').val();
      $('.modal-skill').css('display','none');
      console.log('success');
      // var results = $('#results_found').val();
      // if(results == undefined){ results = 0;}
      //
      // $('#search_results span').html(' ' + results);
      // $('#search_results').fadeIn(350);

    },
    error: function (xhr, ajaxOptions, thrownError) {

      $('.alert-danger').show();
      $('.alert-danger').delay(3000).fadeOut(350);
    }
  });
});
