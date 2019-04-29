$(document).ready(function(){
    $("button#submit").click(function(){
    $.ajax({
    type: "GET",
    url: "crudoperationsonitems.php",
    data: $('form.user').serialize(),
    success: function(message){
    $("#additemsection").html(message)
    $("#addItemModal").modal('hide');
    },
    error: function(){
    alert("Error");
    }
    });
    });
    });

    $('#editItemModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var modal = $(this);
        var dataString = 'id=' + recipient;

          $.ajax({
              type:"GET",
              url: "newlydelivereditems.php",
              data: dataString,
              cache: false,
              success: function (data) {
                  console.log(data);
                  modal.find('.user').html(data);
              },
              error: function(err) {
                  console.log(err);
              }
          });  
  })