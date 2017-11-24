<?php include 'includes/header.php';?>
<style>
.card-columns {
  @include media-breakpoint-only(lg) {
    column-count: 4;
  }
  @include media-breakpoint-only(xl) {
    column-count: 5;
  }
}
</style>

<div class="card-deck">


<?php

  if($result == NULL){
	   echo'
  	  <div class="alert alert-warning" role="alert">
  	    <strong>Nenhum</strong> contato cadastrado!
  	  </div>
    ';
  }
  else{
    $i = 0;
    foreach($result as $listBooksInBD){
      if($i == 0){
        echo '
      <div class="col text-center">
        ';

      }
      if(($i % 3) == 0 && $i != 0){
        echo '
      </div>
    <div class="col text-center">
        ';
      }

      if($listBooksInBD->getImage() == ''){
        echo '
        <div class="card col-lg-3 p-3 text-center">
          <blockquote class="card-blockquote">
            <p>'.$listBooksInBD->getName().'</p>
            <footer>
              <small>
                '.$listBooksInBD->getQtdPages().' páginas.
              </small>
            </footer>
          </blockquote>
        </div>
        <div class="col-lg-1"></div>
        ';

      }
      else{
        if(($i % 3) != 2)
          $div = '<div class="col-lg-1"></div>';
        else
          $div = '';
        echo '
        <div class="card col-lg-3" style="margin-top:15px;">
          <img class="card-img-top  img-fluid" src="view/img/'.$listBooksInBD->getImage().'" alt="Card image cap">
          <div class="card-block">
            <h4 class="card-title">'.$listBooksInBD->getName().'</h4>
            <p class="card-text">'.$listBooksInBD->getQtdPages().' páginas.</p>
          </div>
        </div>
        '.$div.'
        ';

      }

      $i++;
    }
    echo '</div>';
  }
?>

</div>




<?php include 'includes/footer.php';?>
