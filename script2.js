$(document).ready(function() {
    $("#select-autocomplete").select2({
      ajax: {
        url: "scriptPHP2.php",
        dataType: "json",
        delay: 250,
        data: function(params) {
          return {
            term: params.term
          };
        },
        processResults: function(data) {
          return {
            results: data
          };
        },
        cache: true
      },
      minimumInputLength: 2
    });
  });