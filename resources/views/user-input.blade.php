<x-layout>

USER INPUT

<form class="" action="/user-input" method="post">

  {{ csrf_field() }}

  <input class="form-input" type="text" name="name" placeholder="Име . . ." value="">
  <input class="form-input" type="text" name="surname" placeholder="Презиме . . ." value="">
  <input class="form-input" type="text" name="family" placeholder="Фамилия . . ." value="">
  <input id="datepicker" class="form-input" type="text" name="birthdate" placeholder="Дата на раждане . . ." value="">

  <select class="form-input" name="university">
    <option value="">Universitet 1</option>
    <option value="">Universitet 2</option>
  </select>

  <select class="form-input" name="skills" multiple>
      <option value="">Laravel</option>
      <option value="">CakePHP</option>
      <option value="">PHP</option>
      <option value="">JavaScript</option>
  </select>

  <button type="submit" name="button">Запис на CV</button>

</form>

</x-layout>
