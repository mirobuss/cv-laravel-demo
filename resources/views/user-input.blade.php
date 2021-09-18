<x-layout>

USER INPUT

<form class="" action="/user-input" method="post">

  {{ csrf_field() }}

  <input class="form-input" type="text" name="name" placeholder="Име . . ." value="">
  <input class="form-input" type="text" name="surname" placeholder="Презиме . . ." value="">
  <input class="form-input" type="text" name="family" placeholder="Фамилия . . ." value="">
  <input id="datepicker" class="form-input" type="text" name="birthdate" placeholder="Дата на раждане . . ." value="">

  <select class="form-input" name="university">
    <option value="1">Universitet 1</option>
    <option value="2">Universitet 2</option>
  </select>

  <select class="form-input" name="skills[]" multiple>
      <option value="1">Laravel</option>
      <option value="2">CakePHP</option>
      <option value="3">PHP</option>
      <option value="4">JavaScript</option>
  </select>

  <button type="submit" name="button">Запис на CV</button>

</form>

</x-layout>
