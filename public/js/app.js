
$( function() {
  $( ".datepicker" ).datepicker({
    showOn: "button",
    buttonImage: "images/calendar.png",
    buttonImageOnly: true,
    buttonText: "Select date"
  });
} );

function success(response){
  $('.modal-overlay').hide();
  $('.flash-message').show();
  $('.success-hidden').css('display', 'block');
  $('.success-hidden strong').html(response.success);
  $('.success-hidden').delay(2000).fadeOut(350);
}

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


    },
    error: function (xhr, ajaxOptions, thrownError) {

      $('.alert-danger').show();
      $('.alert-danger').delay(3000).fadeOut(350);
    }
  });
});

$('#show-aggregated-results').on('click', function(e) {
  e.preventDefault();
  $('.result-set').html('');
  let date_from = $('.date-from').val();
  let date_to = $('.date-to').val();

  $.ajax({
    url:'/cv-list-group',
    type:'post',
    data:{
      date_from: date_from,
      date_to: date_to
    },
    success:function(response){

      $('.result-set').append(response);

    },
    error: function (xhr, ajaxOptions, thrownError) {

      $('.alert-danger').show();
      $('.alert-danger').delay(3000).fadeOut(350);
    }
  });
});

//pencil onclick
$('i.fas').on('click', function(){

     let modalBox = '.'+$(this).attr('data-type');

     $(modalBox).css('display','flex');
     $(modalBox).closest('.modal-overlay').show();
});

function closeModalBox(x){
  $(x).closest('.modal-box').hide();
  $('.modal-overlay').hide();
}

$('.submit-skill').on('click', function(e) {

  let technology = $('.modal-skill input[name="technology"]').val();

  $.ajax({
    url:'/submit-skill',
    type:'post',
    data:{
      technology: technology,
    },
    success:function(response){

      $('.modal-skill input[name="technology"]').val('');
      $('.modal-skill').css('display','none');
      success(response);

      let html = '<option value="' + response.id + '">' + response.name + '</option>';
      $('.skills-select').append(html);

    },
    error: function (xhr, ajaxOptions, thrownError) {

      let errors = $.parseJSON(xhr.responseText).errors;
      $('.modal-skill div.errors').show();
      $('.modal-skill div.errors ul').html('');
      $.each(errors, function(k, v){
         $.each(v, function(kk, error){
           $('.modal-skill div.errors ul').append('<li>' + error + '</li>');
         });
      });

      $('.modal-skill div.errors').delay(2000).fadeOut(350);
    }
  });
});

$('.submit-university').on('click', function(e) {

  let name = $('.modal-university input[name="name"]').val();
  let accreditation = $('.modal-university input[name="accreditation"]').val();

  $.ajax({
    url:'/submit-university',
    type:'post',
    data:{
      name: name,
      accreditation: accreditation
    },
    success:function(response){

      $('.modal-university input[name="name"]').val('');
      $('.modal-university input[name="accreditation"]').val('');
      $('.modal-university').css('display','none');

      success(response);

      let html = '<option value="' + response.id + '">' + response.name + '</option>';
      $('.universities-select').append(html);

    },
    error: function (xhr, ajaxOptions, thrownError) {

      let errors = $.parseJSON(xhr.responseText).errors;
      $('.modal-university div.errors').show();
      $('.modal-university div.errors ul').html('');
      $.each(errors, function(k, v){
         $.each(v, function(kk, error){
           $('.modal-university div.errors ul').append('<li>' + error + '</li>');
         });
      });

      $('.modal-university div.errors').delay(2000).fadeOut(350);
    }
  });
});
