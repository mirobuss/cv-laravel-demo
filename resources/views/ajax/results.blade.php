<div class="results-container">

@if(count($users) > 0)
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
@else
  <div class="no-results">
    <p>Няма намерени резултати</p>
  </div>
@endif
</div>

<style media="screen">

.results-container {
  background:#dee6f2;
  margin-top: 20px;
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

.no-results {
  padding: 30px;
  font-size: 25px;
}

div {
  box-sizing: border-box;
}
</style>
