<html>
<head>
	<title>
	<?php
   		echo basename($_SERVER['PHP_SELF'],'.php');
	?></title>
	<meta charset="utf-8">

<style>
table{
  width:100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #fdfdfd;
}
</style>


	<!-- Bootstrap core CSS -->
<link href="view/css/bootstrap.min.css" rel="stylesheet">

<!-- Documentation extras -->
<link href="view/css/docs.min.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>


</head>
<body>
	<nav class="navbar navbar-dark bg-primary navbar-fixed-top" style="margin-bottom:20px;">
		<h1 class="navbar-brand mb-0">
			BOOKS
		</h1>
    <ul class="nav navbar-nav">
			<li class="nav-item active">
				<a class="nav-link" href="?op=sair">
					Inicio <span class="sr-only">(current)</span>
				</a>
      </li>
			<li class="nav-item">
				<a class="nav-link" href="?op=pageListBooks">Meus livros</a>
      </li>
      <li class="nav-item">
				<a class="nav-link" href="?op=pageNewBook">Registrar livro</a>
      </li>
      <li class="nav-item">
				<a class="nav-link" href="?op=pageNewReminder">Registrar lembrete</a>
      </li>
    </ul>
  </nav>


  <div class="container-fluid" style="margin-top:80px;">
