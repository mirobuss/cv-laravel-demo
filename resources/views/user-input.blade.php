<x-layout>

USER INPUT

<form class="" action="/user-input" method="post">

  {{ csrf_field() }}

  <input class="form-input" type="text" name="name" placeholder="Име . . ." value="">
  <input class="form-input" type="text" name="surname" placeholder="Презиме . . ." value="">
  <input class="form-input" type="text" name="family" placeholder="Фамилия . . ." value="">
  <input class="form-input datepicker" type="text" name="birthdate" placeholder="Дата на раждане . . ." value="">

  <select class="form-input" name="university">
    @foreach($universities as $university)
      <option value="{{ $university->id }}">{{ $university->name }}</option>
    @endforeach
  </select>

  <select class="form-input" name="skills[]" multiple>
    @foreach($skills as $skill)
      <option value="{{ $skill->id }}">{{ $skill->skill }}</option>
    @endforeach
  </select>

  <button type="submit" name="button">Запис на CV</button>

</form>

<a href="/cv-list">Show All CVs</a>

</x-layout>
