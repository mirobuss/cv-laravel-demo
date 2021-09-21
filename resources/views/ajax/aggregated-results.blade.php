<div class="results-container">

<div class="grid-table">

  <div class="grid-cell">
    <strong>Брой кандидати</strong>
  </div>

  <div class="grid-cell">
    <strong>Възраст</strong>
  </div>

  <div class="grid-cell">
    <strong>Технология</strong>
  </div>

  @foreach($resultset as $result)

  <div class="grid-cell loop">
      {{ $result->candidates }}
  </div>

  <div class="grid-cell">
    {{ $result->age }}
  </div>

  <div class="grid-cell">
    {{ $result->skill }}
  </div>


  @endforeach
</div> <!-- grid-table -->

</div>

<style media="screen">

.results-container {
  background:#dee6f2;
  margin-top: 20px;
}

.grid-table{
  display:grid;
  grid-template-columns: repeat(3, 1fr);
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
