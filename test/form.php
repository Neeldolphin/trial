  <!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
  <style type="text/css">
        body {
              background-color: lightgrey;
              margin-top:70px;
              font-size: 20px;
              }
        .abc{
          float: right;
          padding: 15px 32px;
          display: inline-block;
          font-size: 16px;
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
   <div class="container-fluid"> 
            <div class="row">
                <div class="col-md-12 mt-1 col-md-offset-1"><h2 class="text-white bg-dark"> Student Details</h2></div>
                <div class="col-md-12 "><button type="button" id="create" class="btn btn-success abc">Add</button></div>
        <div class="col-md-12 col-md-offset-1">
<table class="table">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">First Name</th>
                  <th scope="col">Last Name</th>
                  <th scope="col">Birthdate</th>
                  <th scope="col">Mobile Number</th>
                  <th scope="col">Email</th>
                  <th scope="col">Course</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>

              
<?php
include_once 'db_conn.php';
$query="select * from students INNER JOIN course ON students.course=course.id"; // Fetch all the data from the table customers
$result=mysqli_query($conn,$query);

?>
<?php if ($result->num_rows > 0): ?>
<?php while($array=mysqli_fetch_row($result)): ?>

                <tr>
                    <th scope="row"><?php echo $array[0];?></th>
                    <td><?php echo $array[1];?></td>
                    <td><?php echo $array[2];?></td>
                    <td><?php echo $array[3];?></td>
                    <td><?php echo $array[4];?></td>
                    <td><?php echo $array[5];?></td>
                    <td><?php echo $array[10];?></td>
                    <td> 
                    <a href="javascript:void(0)" class="btn btn-primary view"  data-id="<?php echo $array[0];?>">View</a>
                    <a href="javascript:void(0)" class="btn btn-primary edit"  data-id="<?php echo $array[0];?>">Edit</a>
                    <a href="javascript:void(0)" class="btn btn-primary delete" data-id="<?php echo $array[0];?>">Delete</a>
                </tr>

                <?php endwhile; ?>
                <?php else: ?>
                <tr>
                   <td colspan="3" rowspan="1" headers="">No Data Found</td>
                </tr>
                <?php endif; ?>
                <?php mysqli_free_result($result); ?>
              </tbody>
            </table>
        </div>
    </div>        
</div>

<!--MAINFORM--> 
  <div class="modal fade" id="ajax-modal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="custCrudModal"></h4>
          </div>
          <div class="modal-body">
            <form action="javascript:void(0)" id="custForm" name="custForm" class="form-horizontal a" method="POST">
            <input type="hidden" id="id" value="">  
            <div class="form-group">
                <label for="name" class="col-sm-6 control-label">First Name</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter Name" value="" maxlength="50" required="">
                </div>
              </div>  
              <div class="form-group">
                <label for="name" class="col-sm-6 control-label">Last Name</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Name" value="" maxlength="50" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="date" class="col-sm-6 control-label">Birthdate</label>
                <div class="col-sm-12">
                  <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Enter Birthdate" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="mobile_number" class="col-sm-6 control-label">Mobile Number</label>
                <div class="col-sm-12">
                  <input type="number" class="form-control" id="mobile_number" name="mobile_number" placeholder="Enter Mobile Number" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Email</label>
                <div class="col-sm-12">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Course</label>
                <div class="col-sm-12">
                  <select class="form-control" name="course" id="course">
                      <option value=""></option>
                          <?php
                              $query="SELECT * FROM course";
                              $result = mysqli_query($conn,$query);
                                 while($array = mysqli_fetch_array($result))
                                {
                          ?>
                                  <option value="<?php echo $array['id']; ?>"><?php echo $array['name']; ?>
                                    </option>
                          <?php
                                }
                           ?>
                              </select>
                </div>
              </div>
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary save" id="btn-save" value="create">Save changes
                </button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>


<!--EDITFORM--> 
     <div class="modal fade" id="edit-modal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="editModal"></h4>
          </div>
          <div class="modal-body">
            <form action="javascript:void(0)" id="editForm" name="editForm" class="editModal" method="POST">
            <input type="hidden" id="eid" value="">  
            <div class="form-group">
                <label for="name" class="col-sm-6 control-label">First Name</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="efname" name="efname" placeholder="Enter Name" value="" maxlength="50" required="">
                </div>
              </div>  
              <div class="form-group">
                <label for="name" class="col-sm-6 control-label">Last Name</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="elname" name="elname" placeholder="Enter Name" value="" maxlength="50" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="date" class="col-sm-6 control-label">Birthdate</label>
                <div class="col-sm-12">
                  <input type="date" class="form-control" id="ebirthdate" name="ebirthdate" placeholder="Enter Birthdate" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label for="mobile_number" class="col-sm-6 control-label">Mobile Number</label>
                <div class="col-sm-12">
                  <input type="number" class="eform-control" id="emobile_number" name="emobile_number" placeholder="Enter Mobile Number" value="" >
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Email</label>
                <div class="col-sm-12">
                  <input type="email" class="form-control" id="eemail" name="eemail" placeholder="Enter Email" value="" required="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-6 control-label">Course</label>
                <div class="col-sm-12">
                  <select class="form-control" name="ecourse" id="ecourse">
                      <option value=""></option>
                          <?php
                              $query="SELECT * FROM course";
                              $result = mysqli_query($conn,$query);
                                 while($array = mysqli_fetch_array($result))
                                {
                          ?>
                                  <option value="<?php echo $array['id']; ?>"><?php echo $array['name']; ?>
                                    </option>
                          <?php
                                }
                           ?>
                              </select>
                </div>
              </div>
              <div class="col-sm-offset-2 col-sm-10">
                <button type="" class="btn btn-primary edit" id="btn-edit" value="create">Save changes
                </button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>


<!--VIEWFORM--> 
    <div class="modal fade" id="view-modal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="custModal"></h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label for="name" class="col-sm-12 control-label">First Name</label>
                <div class="col-sm-12">
                 <p id="vfname" name="fname" value="" ></p>
                </div>
              </div>  
              <div class="form-group">
                <label for="name" class="col-sm-12 control-label">Last Name</label>
                <div class="col-sm-12">
                <p id="vlname" name="lname" value="" ></p>
                </div>
              </div>
              <div class="form-group">
                <label for="date" class="col-sm-12 control-label">Birthdate</label>
                <div class="col-sm-12">
                  <p id="vbirthdate" name="birthdate" value="" ></p>
                </div>
              </div>
              <div class="form-group">
                <label for="mobile_number" class="col-sm-12 control-label">Mobile Number</label>
                <div class="col-sm-12">
                  <p id="vmobile_number" name="mobile_number" value=""></p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-12 control-label">Email</label>
                <div class="col-sm-12">
                  <p id="vemail" name="email" value="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-12 control-label">Course</label>
                <div class="col-sm-12">
                <p id="vcourse" name="course" value="" ></p>
                </div>
              </div>
            <!-- </form> -->
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>



<!--VIEW & DELETE--> 
<script type="text/javascript">
$(document).ready(function($){
  
    $('body').on('click', '.view', function () {
        var id = $(this).data('id');
        $('#CrudModal').html("Edit Customer");
              $('#view-modal').modal('show');
        // ajax
        $.ajax({
            type:"POST",
            url: "edit.php",
            data: { id:id },
            dataType: 'json', 
            success: function(result){ 
              $('#vid').html(result[0].id);
              $('#vfname').html(result[0].fname);
              $('#vlname').html(result[0].lname);
              $('#vbirthdate').html(result[0].birthdate);
              $('#vmobile_number').html(result[0].mobile_number);
              $('#vemail').html(result[0].email);
              $('#vcourse').html(result[0].course);
           }
        });
    });

 $('body').on('click', '.delete', function () {
       if (confirm("Delete Record?") == true) {
        var id = $(this).data('id');
         
        $.ajax({
            type:"POST",
            url: "delete.php",
            data: { id: id },
            dataType: 'json',
            success: function(result){
            if (result == 1) {
              window.location.reload(true);
            }
           }
        }); 
       }
    });
});
</script>



<!--EDIT & VALIDATE--> 
<script type="text/javascript">
  
$(document).ready(function(){
        
    // Edit
     $('body').on('click', '.edit', function () {
        var id = $(this).data('id');
        console.log(id);
        $('#editModal').html("Edit Customer");
              $('#edit-modal').modal('show');
        // ajax
        $.ajax({
            type:"POST",
            url: "edit.php",
            data: { id:id },
            dataType: 'json', 
            success: function(result){ 
              $('#eid').val(result[0].id);
              $('#efname').val(result[0].fname);
              $('#elname').val(result[0].lname);
              $('#ebirthdate').val(result[0].birthdate);
              $('#emobile_number').val(result[0].mobile_number);
              $('#eemail').val(result[0].email);
              $('#ecourse').val(result[0].course);
           }
        });

    $("#editForm").validate({
        rules: {
            efname: "required",
            elname: "required",
            eemail: {
                required: true,
                email: true
            },
            ecourse: "required",
            emobile_number: {
              required: true,
                digits:true,
                minlength:10,
                maxlength:10
            }
        },
        messages: {
            efname: "Enter your firstname",
            elname: "Enter your lastname",
            eemail: "Please enter valid mail id",
            ecourse: "Please select the valid course",
            emobile_number: "Please enter correct mobile number"
        },
        submitHandler: function(form) { 
        var id = $(this).data('id');
        // if(confirm("Are u sure to want to Update this data?")){
          $.ajax({
            type:"POST",
            url: "update.php",
            data: {  id: $('#eid').val(),
                    fname: $('#efname').val(),
                    lname: $('#elname').val(),
                    birthdate: $('#ebirthdate').val(),
                    mobile_number: $('#emobile_number').val(),
                    email: $('#eemail').val(),
                    course: $('#ecourse').val() },
            dataType: 'json', 
            success: function(result){    
            if (result==1) {
              window.location.reload(true);
            }      
           }
         });
             form.submit();
            }
          });
        });
     });

</script>




<!--ADD & VALIDATE--> 
<script type="text/javascript">
  
$(document).ready(function(){
      $('#create').click(function () {
       $('#custForm').trigger("reset");
       $('#custCrudModal').html("Add New Customer");
       $('#ajax-modal').modal('show');
    });
        
     $('body').on('click', '.save', function () {
    $("#custForm").validate({
        rules: {
            fname: "required",
            lname: "required",
            email: {
                required: true,
                email: true
            },
            course: "required",
            mobile_number: {
              required: true,
                digits:true,
                minlength:10,
                maxlength:10
            }
        },
        messages: {
            fname: "Enter your firstname",
            lname: "Enter your lastname",
            email: "Please enter valid mail id",
            course: "Please select the valid course",
            mobile_number: "Please enter correct mobile number"
        },
        submitHandler: function(form) { 
        $('#custForm').submit(function() { 
        $.ajax({
            type:"POST",
            url: "addupdate.php",
            data: $(this).serialize(), // get all form field value in 
            dataType: 'json',
            success: function(result){
             window.location.reload(true);
           }
        });
        });
             form.submit();
            }
          });
        });
     });

</script>
</body>
</html>