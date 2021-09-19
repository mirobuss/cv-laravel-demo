<x-layout>

USER INPUT

<form class="" action="/user-input" method="post">

  {{ csrf_field() }}

  <input class="form-input" type="text" name="name" placeholder="Име . . ." value="">
  <input class="form-input" type="text" name="surname" placeholder="Презиме . . ." value="">
  <input class="form-input" type="text" name="family" placeholder="Фамилия . . ." value="">
  <input class="form-input datepicker" type="text" name="birthdate" placeholder="Дата на раждане . . ." value="">

  <div class="form-input">
    <select class="" name="university">
      @foreach($universities as $university)
      <option value="{{ $university->id }}">{{ $university->name }}</option>
      @endforeach
    </select>
    <i class="fas fa-pencil-alt add-university" data-type="modal-university"></i>
  </div>

  <div class="form-input">
    <select class="" name="skills[]" multiple>
      @foreach($skills as $skill)
      <option value="{{ $skill->id }}">{{ $skill->skill }}</option>
      @endforeach
    </select>
    <i class="fas fa-pencil-alt add-skill" data-type="modal-skill"></i>
  </div>

  <button type="submit" name="button">Запис на CV</button>

</form>

<a href="/cv-list">Show All CVs</a>

<div class="modal-box modal-skill">
  <div class="modal-form" data-container="">

    <span onclick="closeModalBox(this)" style="">&times;</span>
    <div class="errors">
      <ul>

      </ul>

    </div>
    <p>Въведете нова технология</p>
    <input type="text" name="technology" value="" placeholder="Технология . . .">
    <button class="submit-btn submit-skill" type="button" name="button">Запис</button>

  </div>
</div>

<div class="modal-box modal-university">
  <div class="modal-form" data-container="">

    <span onclick="closeModalBox(this)" style="">&times;</span>
    <div class="errors">
      <ul>

      </ul>

    </div>
    <p>Въведете нов университет</p>
    <input type="text" name="" value="" placeholder="Име . . .">
    <input type="text" name="" value="" placeholder="Акредитация . . .">
    <button class="submit-btn submit-university" type="button" name="button">Запис</button>

  </div>
</div>

</x-layout>

<style>

.modal-form{
  margin: auto;
  border:1px solid white;
  background: #6a88a1;
  padding:15px;
  width:50%;
  display:flex;
  flex-direction:column;
  text-align:center;
  position:relative;
}

.modal-form span {
  color:black;
  font-size:28px;
  font-weight:bold;
  position:absolute;
  top:0;
  right:10px;
}

.modal-form span:hover{
  font-size:30;
  color:orange;
  cursor:pointer;
}

.modal-form input {
  height:30px;
  margin-top:20px;
}

.modal-form p {
  margin:2px;
  font-size:18px;
}

.modal-form button {
  display:block;
  height:30px;
  width:50%;
  margin:15px auto;
}

i.fas:hover {
  cursor:pointer;
}

.modal-university, .modal-skill {
  display:none;
}
</style>
