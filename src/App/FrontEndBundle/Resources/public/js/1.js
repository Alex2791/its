
$( document ).ready(function()
{
  $('#lang').change(function()
  {
		var select = $(this).val();
          $.ajax({
              type: "GET",
              url: pathajax,
              data: {lang : select},
              // url: "{{ path('my_app_greeting') }}",

              success: function(data)
              {
                  //   $('span#send_mess').html(data.message);
                  //alert(date.message);
               //   location.reload();

              }
          });

  });


});