$(function(){
  $("form").submit(function(event)
  {
    event.preventDefault(); //Cancela o refresh do submit

    var inputNameBook = $("input#name").val(); //Pega o valor da Input
    var inputHour     = $("input#time").val(); //Pega o valor da Input

    var checkboxs = document.getElementsByName('day');
    var days = "";
    for (var i = 0; i < checkboxs.length; i++){
        if (checkboxs[i].checked) {
          checkboxs[i].checked = false;
          if(checkboxs[i].value == "seg"){ days = days + "Seg ";  }
          else if (checkboxs[i].value == "ter"){ days = days + "Ter ";}
          else if (checkboxs[i].value == "qua"){ days = days + "Qua ";}
          else if (checkboxs[i].value == "qui"){ days = days + "Qui ";}
          else if (checkboxs[i].value == "sex"){ days = days + "Sex ";}
          else if (checkboxs[i].value == "sab"){ days = days + "Sab ";}
          else{days = days + "Dom"; checkboxs[i].disabled = true;}
        }
    }

    if(inputNameBook != "" && inputHour != "") //Verifica se o campo foi preenchido
    {
      $("div#Retorno").html("Enviando mensagem, Aguarde...");
      $.ajax({
           url:"?op=registerNewReminder",
           method:"POST",
           data:{
             RegistrarLembrete : "Registrar",
             name: inputNameBook,
             time: inputHour,
             days: days
           },
           success:function(data)
           {
                var ret = data.split("@");

                $("div#Retorno").html(ret[0]);
                $("input#name").val("");
                $("input#time").val("00:00");

                if(ret[1] != "not"){
                  Push.create("Lembrete ativado!",{
              			body: "Lembrar-me "+ days +" para ler "+inputNameBook + " às " + inputHour,
              			icon: "view/img/" + ret[1],
              			timeout: 6000,
              			onClick: function () {
              				window.location="/books";
              				this.close();
              			}
              	});
              }
           }
      });

      return 1;
    }
    else
    {
      if(inputNameBook == ""){
        $("div#Retorno").html("<p style=\"color:red;\">Você não digitou o nome do livro!</p>");
        $("input#name").focus(); //Da focu na input se ela não for digitada
      }
      return 1;
    }
  });
});
