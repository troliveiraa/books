<?php include ('includes/header.php');?>

<style>
  #bookList ul{
    background-color:#eee;
    cursor:pointer;
  }
  #bookList li{
    padding:12px;
  }
</style>
  <div class="col-xs-6 col-sm-4"></div>
  <div class="col-xs-6 col-sm-4">
    <div id="retorno"></div>
    <form action=""  id="form" enctype="multipart/form-data" autocomplete="off"  method="post">
      <legend>Registro de um novo lembrete.</legend>
      <div class="form-group">
      	<label for="name">Nome</label>
      	<input class="form-control" type="text" name="name"  id="name"  placeholder="Digite aqui o nome do livro"><br>
        <div id="bookList"></div>
      </div>
      <div class="form-group">
        <label for="time">Horas</label>
        <div class="col-4">
          <input class="form-control" type="time" name="time" value="00:00" id="time" autocomplete="off"><br>
        </div>
      </div>
      <label>Repetir nos dias</label><br>
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" id="seg" name="day" value="seg"> Seg.
        </label>
      </div>
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" id="ter" name="day" value="ter"> Ter.
        </label>
      </div>
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" id="qua" name="day" value="qua"> Qua.
        </label>
      </div>
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" id="qui" name="day" value="qui"> Qui.
        </label>
      </div>
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" id="sex" name="day" value="sex"> Sex.
        </label>
      </div>
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" id="sab" name="day" value="sab"> Sab.
        </label>
      </div>

      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox"id="dom" name="day" value="dom"> Dom.
        </label>
      </div>

      <div class="form-group" style="margin-top:20px;">
      	<input class="btn btn-success font-weight-bold" type="submit" name="RegistrarLembrete" value="Registrar">
      </div>
  </form>
  </div>

  <div class="col-xs-6 col-sm-4"></div>

  <script type="text/javascript" src="view/js/autocomplete.js"></script>
  <script type="text/javascript" src="view/js/forwardsControlFormReminder.js"></script>

  <script type="text/javascript" src="view/js/jquery.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>


<?php include ('includes/footer.php');?>
