<div class="results-container">

<div class="grid-table">

  <div class="grid-cell">
    <strong>Име</strong>
  </div>

  <div class="grid-cell">
    <strong>Презиме</strong>
  </div>

  <div class="grid-cell">
    <strong>Фамилия</strong>
  </div>

  <div class="grid-cell">
    <strong>Умения</strong>
  </div>

  <div class="grid-cell">
    <strong>Университет</strong>
  </div>

  <div class="grid-cell">
    <strong>Акредитация</strong>
  </div>

  <div class="grid-cell">
    <strong>CV детайли </strong>
  </div>

  @foreach($users as $user)

  <div class="grid-cell loop">
      {{ $user->name }}
  </div>

  <div class="grid-cell">
    {{ $user->surname }}
  </div>

  <div class="grid-cell">
    {{ $user->family }}
  </div>
  <div class="grid-cell">
    @foreach($user->skills as $skill)
        {{ $skill->skill }}{{(!$loop->last) ? ',' : ''}}
    @endforeach
  </div>

  <div class="grid-cell">
    {{ $user->university->name }}
  </div>

  <div class="grid-cell">
    {{ $user->university->accreditation }}
  </div>

  <div class="grid-cell">
    {{ $user->cv->details }}
  </div>
  
  @endforeach
</div> <!-- grid-table -->

</div>

<style media="screen">

.results-container {
  background:#eeefb5;
  min-height:100vh;
}

.grid-table{
  display:grid;
  grid-template-columns: repeat(7, 1fr);
}

.grid-cell {
  padding:15px;
  border-bottom:1px solid black;
}

.loop {
  text-align:center;
}



div {
  box-sizing: border-box;
}
</style>
