<div class="flash-message">

  @if (Session::get('code') == 'success')
  <div class="success">
      <strong>{{ Session::get('message') }}</strong>
  </div>
  @endif

  @if (Session::get('code') == 'error')
  <div class="error">
      <strong>{{ Session::get('message') }}</strong>
  </div>
  @endif


  @if($errors->any)
    @foreach ($errors->all() as $error)
    <div class="error">
        <strong> {{ $error }} </strong>
    </div>
    @endforeach
  @endif
</div>

<style media="screen">


.flash-message strong {
  padding:15px;
  display:block;
  font-size:18px;
}

.success {
  background:#368e30;
  color:white;
}

.error {
  background:#ff5656;
}
</style>

<script type="text/javascript">
$(document).ready(function(){
  $(".flash-message").delay(3000).slideUp(300);
});
</script>
