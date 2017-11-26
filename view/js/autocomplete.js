$(document).ready(function(){
     $('#name').keyup(function(){
          var query = $(this).val();
          if(query.length < 2){
            $('#bookList').slideUp();
          }
          if(query != '' && query.length >= 2)
          {
               $.ajax({
                    url:"?op=getBooksInBDForAutoComplete",
                    method:"POST",
                    data:{query:query},
                    success:function(data)
                    {
                         $('#bookList').slideDown();
                         $('#bookList').html(data);
                    }
               });
          }
     });
     $(document).on('click', 'li', function(){
          $('#name').val($(this).text());
          $('#bookList').fadeOut();
     });
});
