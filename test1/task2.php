<?php 
include "db_conn.php";
 ?>
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
              margin-top:50px;
              font-size: 20px;
              },
        select{
        	background-color: whitesmoke;
        	font-size: 20px;
        	padding: auto;
        	margin: auto;
        }
    </style>
</head>

<body>
   <div class="container-fluid"> 
            <div class="row">
                <div class="col-md-12 mt-1 col-md-offset-1">
                	<h2 class="text-white bg-dark"> place details</h2>
                </div>
    		</div>        
   </div>
 
	<div class="form-group">
		 <label class="col-sm-6 control-label">country</label>
		      <div class="col-sm-6">
		            <select class="form-control " name="country" id="country" onchange="show1()">
		                  <option value=""></option>
		                     <?php
		                        $query="SELECT * FROM country";
		                         $result = mysqli_query($conn,$query);
		                         while($array = mysqli_fetch_array($result))
		                             {
	                         ?>
                                  <option value="<?php echo $array['id']; ?>"><?php echo $array['country']; ?>
		                           </option>
		                      <?php
		                                }
		                       ?>
		             </select>
		         </div>
		      </div>

			<div class="form-group">
		           <label class="col-sm-6 control-label">state</label>
		                <div class="col-sm-6">
		                  <select class="form-control" name="state" id="state" onchange="show2()" >
		                              </select>
		                		</div>
		             		 </div>


		             <div class="form-group">
		                <label class="col-sm-6 control-label">city</label>
		                <div class="col-sm-6">
		                  <select  class="form-control" name="city" id="city" onchange="show3()">
		                  	
		                              </select>
		                		</div>
		             		 </div>

		        
							<p id ="demo1" ></p>
							<p id ="demo2" ></p>
							<p id ="demo3" ></p>

		             		 <script type="text/javascript">
							  $(document).ready(function() {
								$('#country').on('change', function() {
								var country_id = this.value;
								  $.ajax({
								        url: "states-by-country.php",
								        type: "POST",
								        data: {
								        country_id: country_id
									},
									cache: false,
								success: function(result){
								$("#state").html(result);
								$('#city').html('<option value="">Select State First</option>'); 
								}
								});
								});    
								$('#state').on('change', function() {
								var state_id = this.value;
								$.ajax({
								url: "cities-by-state.php",
								type: "POST",
								data: {
								state_id: state_id
								},
								cache: false,
								success: function(result){
								$("#city").html(result);
								}
								});
								});
								});
		             		 </script>


		             		<script type="text/javascript">
							function show1() {
								 var x = document.getElementById("country").selectedIndex;
								var y = document.getElementById("country").options;
							document.getElementById("demo1").innerHTML = y[x].text;
								}
							</script>


		             		<script type="text/javascript">
							function show2() {
								 var x = document.getElementById("state").selectedIndex;
								var y = document.getElementById("state").options;
							document.getElementById("demo2").innerHTML = y[x].text;
								}
							</script>

		             		<script type="text/javascript">
							function show3() {
								 var x = document.getElementById("city").selectedIndex;
								var y = document.getElementById("city").options;
							document.getElementById("demo3").innerHTML = y[x].text;
								}
							</script>

</body>
</html>

				