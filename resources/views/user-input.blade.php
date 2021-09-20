<x-layout>

<h3> Submit your CV here</h3>

<x-flash-messages />


  <form class="" action="/user-input" method="post">

    {{ csrf_field() }}
    <div class="inputs-container">
        <div class="left-container">
            <div class="">
              <input class="form-input" type="text" name="name" placeholder="Име . . ." value="{{old('name')}}">
            </div>
            <div class="">
              <input class="form-input" type="text" name="surname" placeholder="Презиме . . ." value="{{old('surname')}}">
            </div>
            <div class="">
              <input class="form-input" type="text" name="family" placeholder="Фамилия . . ." value="{{old('family')}}">
            </div>
            <div class="">
              <input class="form-input datepicker" type="text" name="birthdate" placeholder="Дата на раждане . . ." value="{{old('birthdate')}}">
            </div>
        </div>

        <div class="right-container">
            <div class="form-input">
              <select class="universities-select" name="university">
                @foreach($universities as $university)
                <option value="{{ $university->id }}">{{ $university->name }}</option>
                @endforeach
              </select>
              <i class="fas fa-pencil-alt add-university" data-type="modal-university"></i>
            </div>
            <div class="form-input">
              <select class="skills-select" name="skills[]" multiple>
                @foreach($skills as $skill)
                <option value="{{ $skill->id }}">{{ $skill->skill }}</option>
                @endforeach
              </select>
              <i class="fas fa-pencil-alt add-skill" data-type="modal-skill"></i>
            </div>
        </div>
    </div>

    <button type="submit" class="submit-cv" name="button">Запис на CV</button>

  </form>

  <span class=""><a class="show-cvs" href="/cv-list">Налични CV-та</a></span>

  <div class="modal-overlay">
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
  </div>

  <div class="modal-overlay">
    <div class="modal-box modal-university">
      <div class="modal-form" data-container="">

        <span onclick="closeModalBox(this)" style="">&times;</span>
        <div class="errors">
          <ul>

          </ul>

        </div>
        <p>Въведете нов университет</p>
        <input type="text" name="name" value="" placeholder="Име . . .">
        <input type="text" name="accreditation" value="" placeholder="Акредитация . . .">
        <button class="submit-btn submit-university" type="button" name="button">Запис</button>

      </div>
    </div>
  </div>

</x-layout>

<style>

.modal-overlay {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

.modal-box {
  margin-top:100px;
}

.modal-form{
  margin: auto;
  border:1px solid white;
  background: #acb4b3;
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

div.errors {
  display:none;
}

.errors ul {
  list-style-type:none;
  color:white;
  background:red;
  padding:5px;
}

i.fas:hover {
  cursor:pointer;
}

.modal-university, .modal-skill {
  display:none;
}
</style>
