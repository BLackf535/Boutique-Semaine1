$(document).ready(function() {
    $("#libelle").autocomplete({
      source: function(request, response) {
          $.ajax({
            url: "scriptPHP.php",
            dataType: "json",
            autoFocus: true,
            minLength: 2, // Minimum characters to trigger the search
            data: { term: request.term }, // Send the term as data
            success: function(data) {
              response(data);
             //$("#autocomplete-input").val(data[0]); // Afficher la première suggestion dans le champ de saisie
   
            }
          });
      },
      select: function(event,ui){
        $("#libelle").val(ui.item.label);
        $("#libelle_id").val(ui.item.value);
        return false;
      }
      //appendTo: "#autocomplete-input" // Append suggestions to the list
    });
  });
