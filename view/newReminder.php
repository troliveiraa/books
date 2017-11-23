<?php include ('includes/header.php');?>

  <div class="col-xs-4 col-sm-2"></div>

  <div class="col-xs-8 col-sm-6">

    <form action="?op=registerNewReminder" enctype="multipart/form-data"  method="post">
      <legend>Registro de um novo lembrete.</legend>

      <div class="form-group">
      	<label for="name">Nome</label>
      	<input class="form-control" type="text" name="name"  id="name"  placeholder="Digite aqui o nome do livro"><br>
      </div>


      <div class="form-group">
        <label for="time">Horas</label>
        <div class="col-4">
          <input class="form-control" type="time" name="time" value="00:00:00" id="time"><br>
        </div>
      </div>

      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" id="seg" name="seg" value="seg"> Seg.
        </label>
      </div>
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" id="ter" name="ter" value="ter"> Ter.
        </label>
      </div>
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" id="qua" name="qua" value="qua"> Qua.
        </label>
      </div>
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" id="qui" name="qui" value="qui"> Qui.
        </label>
      </div>
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" id="sex" name="sex" value="sex"> Sex.
        </label>
      </div>
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" id="sab" name="sab" value="sab"> Sab.
        </label>
      </div>

      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox"id="dom" name="ddom" value="dom"> Dom.
        </label>
      </div>


      <div class="form-group" style="margin-top:20px;">
      	<!--<label for="qtdPages">Quantidade de páginas</label>
      	<input class="form-control" type="number" name="qtdPages" id="qtdPages"  min="1" placeholder="Digite aqui a quantidade de páginas do livro" ><br><br>-->
      	<input class="btn btn-success font-weight-bold" type="submit" name="RegistrarLembrete" value="Registrar">
      </div>

  </form>
  </div>

  <div class="col-xs-4 col-sm-2"></div>

<?php include ('includes/footer.php');?>
