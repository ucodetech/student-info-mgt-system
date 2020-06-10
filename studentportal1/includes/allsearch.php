
<script>

	//source code search
	$("#searchCodes").on("keyup", function(){
  var value = jQuery(this).val().toLowerCase();
  $('#codes tr').each(function(result){
      if (result !== 0) {
        var id = $(this).find("td:first").text();
        if (id.indexOf(value) !== 0  && id.toLowerCase().indexOf(value.toLowerCase()) < 0)
        {
          $(this).hide();
        }
        else
        {
          $(this).show();
        }
      }
  });
});

	//search subscribers
	$("#searchSub").on("keyup", function(){
  var value = jQuery(this).val().toLowerCase();
  $('#sub tr').each(function(result){
      if (result !== 0) {
        var id = $(this).find("td:first").text();
        if (id.indexOf(value) !== 0  && id.toLowerCase().indexOf(value.toLowerCase()) < 0)
        {
          $(this).hide();
        }
        else
        {
          $(this).show();
        }
      }
  });
});
//search assignment
$("#searchassign").on("keyup", function(){
  var value = jQuery(this).val().toLowerCase();
  $('#assignment tr').each(function(result){
      if (result !== 0) {
        var id = $(this).find("td:first").text();
        if (id.indexOf(value) !== 0  && id.toLowerCase().indexOf(value.toLowerCase()) < 0)
        {
          $(this).hide();
        }
        else
        {
          $(this).show();
        }
      }
  });
});

//search visitors
 $("#searchVisitors").on("keyup", function(){
      var value = jQuery(this).val().toLowerCase();
      $('#visitors tr').each(function(result){
          if (result !== 0) {
            var id = $(this).find("td:first").text();
            if (id.indexOf(value) !== 0  && id.toLowerCase().indexOf(value.toLowerCase()) < 0)
            {
              $(this).hide();
            }
            else
            {
              $(this).show();
            }
          }
      });
   });
//search logo
 $("#searchlogo").on("keyup", function(){
      var value = jQuery(this).val().toLowerCase();
      $('#logos tr').each(function(result){
          if (result !== 0) {
            var id = $(this).find("td:first").text();
            if (id.indexOf(value) !== 0  && id.toLowerCase().indexOf(value.toLowerCase()) < 0)
            {
              $(this).hide();
            }
            else
            {
              $(this).show();
            }
          }
      });
   });
//search sample letter head
 $("#searchletter").on("keyup", function(){
      var value = jQuery(this).val().toLowerCase();
      $('#letterhead tr').each(function(result){
          if (result !== 0) {
            var id = $(this).find("td:first").text();
            if (id.indexOf(value) !== 0  && id.toLowerCase().indexOf(value.toLowerCase()) < 0)
            {
              $(this).hide();
            }
            else
            {
              $(this).show();
            }
          }
      });
   });
 //search payment project
  $("#searchpayment").on("keyup", function(){
      var value = jQuery(this).val().toLowerCase();
      $('#payment tr').each(function(result){
          if (result !== 0) {
            var id = $(this).find("td:first").text();
            if (id.indexOf(value) !== 0  && id.toLowerCase().indexOf(value.toLowerCase()) < 0)
            {
              $(this).hide();
            }
            else
            {
              $(this).show();
            }
          }
      });
   });
  //search quotes
   $("#searchquotes").on("keyup", function(){
      var value = jQuery(this).val().toLowerCase();
      $('#quotes tr').each(function(result){
          if (result !== 0) {
            var id = $(this).find("td:first").text();
            if (id.indexOf(value) !== 0  && id.toLowerCase().indexOf(value.toLowerCase()) < 0)
            {
              $(this).hide();
            }
            else
            {
              $(this).show();
            }
          }
      });
   });
   //search uzb
   $("#searchUzb").on("keyup", function(){
      var value = jQuery(this).val().toLowerCase();
      $('#uzbs tr').each(function(result){
          if (result !== 0) {
            var id = $(this).find("td:first").text();
            if (id.indexOf(value) !== 0  && id.toLowerCase().indexOf(value.toLowerCase()) < 0)
            {
              $(this).hide();
            }
            else
            {
              $(this).show();
            }
          }
      });
   });
      //search nature
   $("#searchnatures").on("keyup", function(){
      var value = jQuery(this).val().toLowerCase();
      $('#natures tr').each(function(result){
          if (result !== 0) {
            var id = $(this).find("td:first").text();
            if (id.indexOf(value) !== 0  && id.toLowerCase().indexOf(value.toLowerCase()) < 0)
            {
              $(this).hide();
            }
            else
            {
              $(this).show();
            }
          }
      });
   });
</script>
