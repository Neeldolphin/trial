<?php
 ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once 'db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>View Ajax</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<style>
body {
  background-color: lightgrey;
  margin-top: 100px;
}
input#name {
    width: 60%;
}
.hint{
background-color: lightseagreen;
border: black;
border-color: black;
border-width: 2px solid;
font-size: 20px;
}
</style>
</head>
<body>
   <div class="w3-top">
  <div class="w3-bar w3-black w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="form.php" class="w3-bar-item w3-button w3-padding-large">Students</a>
    <a href="view.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Course</a>
  </div>
</div>
<div>

</div>
<div class="container" >
  <h2>View data</h2>
  <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
  </div>
  <table class="table table-bordered table-sm hint" >
    <thead>
      <tr>
        <th>Name</th>
    <th>Action</th>
      </tr>
    </thead>
    <tbody id="table">
    </tbody>
  </table>
</div>
<div class="container ">
  <div class="col-md-6 ">
<form id="fupForm" name="form1" method="post">
    <div class="form-group">
      <label for="course">course:</label>
      <input type="text" class="form-control" id="name" placeholder="Name" name="name">
    </div>
    <input type="button" name="save" class="btn btn-primary" value="Save" id="butsave">
  </form> 
  </div>
</div>
<!-- Modal Update-->
    <div class="modal fade" id="update_country" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      <div class="modal-header" style="color:#fff;background-color: #e35f14;padding:6px;">
        <h5 class="modal-title"><i class="fa fa-edit"></i> Update</h5>
       
      </div>
      <div class="modal-body">
      
        <!--1-->
        <div class="row">
          <div class="col-md-3">
              <label>Name</label>
          </div>
          <div class="col-md-9">
            <input type="text" name="name_modal" id="name_modal" class="form-control-sm" required>
          </div>  
        </div>
        <input type="hidden" name="id_modal" id="id_modal" class="form-control-sm">
      </div>
      <div class="modal-footer" style="padding-bottom:0px !important;text-align:center !important;">
      <p style="text-align:center;float:center;"><button type="submit" id="update_data" class="btn btn-default btn-sm" style="background-color: #e35f14;color:#fff;">Save</button>
      <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="background-color: #e35f14;color:#fff;">Close</button></p>
      
      </div>
      </div>
    </div>
  </div>
<!-- Modal End-->
<script>
$(document).ready(function() {
  $.ajax({
    url: "View_ajax.php",
    type: "POST",
    cache: false,
    success: function(dataResult){
      $('#table').html(dataResult); 
    }
  });
  $(function () {
    $('#update_country').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); /*Button that triggered the modal*/
      var id = button.data('id');
      var name = button.data('name');
      var modal = $(this);
      modal.find('#name_modal').val(name);
      modal.find('#id_modal').val(id);
    });
    });
$(document).ready(function() {
  $('#butsave').on('click', function() {
    $("#butsave").attr("disabled", "disabled");
    var name = $('#name').val();
    if(name!=""){
      $.ajax({
        url: "save.php",
        type: "POST",
        data: {
          name: name,       
        },
        cache: false,
        success: function(dataResult){
          var dataResult = JSON.parse(dataResult);
          if(dataResult.statusCode==200){
            $("#butsave").removeAttr("disabled");
            window.location.reload(true);
            $('#fupForm').find('input:text').val('');
            $("#success").show();
            $('#success').html('Data added successfully !');    

          }
          else if(dataResult.statusCode==201){
             alert("Error already exist !");
          }
        }
      });
    }
    else{
      alert('Please fill all the field !');
    }
  });
});

$(document).ready(function() {
  $.ajax({
    url: "View_ajax.php",
    type: "POST",
    cache: false,
    success: function(dataResult){
      $('#table').html(dataResult); 
    }
  });
  $(document).on("click", ".delete", function() { 
    var $ele = $(this).parent().parent();
    $.ajax({
      url: "delete_ajax.php",
      type: "POST",
      cache: false,
      data:{
        id: $(this).attr("data-id")
      },
      success: function(dataResult){
        var dataResult = JSON.parse(dataResult);
        if(dataResult.statusCode==200){
          $ele.fadeOut().remove();
        }
      }
    });
  });
});

  $(document).on("click", "#update_data", function() { 
    $.ajax({
      url: "update_ajax.php",
      type: "POST",
      cache: false,
      data:{
        id: $('#id_modal').val(),
        name: $('#name_modal').val(),
      },
      success: function(dataResult){
        var dataResult = JSON.parse(dataResult);
        if(dataResult.statusCode==200){
          $('#update_country').modal().hide();
          alert('Data updated successfully !');
          window.location.reload();          
        }
        else
          { 
            alert('Data already exist !');
             }
      } 
    });
  }); 
});
</script>
</body>
</html>

  