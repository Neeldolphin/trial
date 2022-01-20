
<?php
 include_once 'db_conn.php';
  function fetch_data()  
  {  
       $output = '';  
       $sql = "SELECT * FROM students ORDER BY id ASC";  
       $result = mysqli_query($conn, $sql);  
       while($row = mysqli_fetch_array($result))  
       {       
       $output .= '<tr>  
                     <td>'.$row["id"].'</td>  
                     <td>'.$row["fname"].'</td>
                     <td>'.$row["lname"].'</td>    
                     <td>'.$row["email"].'</td>
                      </tr>  
                           ';  
       }  
       return $output;  
  }  
  if(isset($_POST["create_pdf"]))  
  {  
       require_once('tcpdf/tcpdf.php');  
       $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
       $obj_pdf->SetCreator(PDF_CREATOR);    
       $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
       $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
       $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
       $obj_pdf->SetDefaultMonospacedFont('helvetica');  
       $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
       $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
       $obj_pdf->setPrintHeader(false);  
       $obj_pdf->setPrintFooter(false);  
       $obj_pdf->SetAutoPageBreak(TRUE, 10);  
       $obj_pdf->SetFont('helvetica', '', 12);  
       $obj_pdf->AddPage();  
       $content = '';  
       $content .= '  
       <h3 align="center">Export HTML Table data to PDF using TCPDF in PHP</h3><br /><br />  
       <table border="1" cellspacing="0" cellpadding="5">  
                         <tr>  
                                <th width="5%">ID</th>  
                                <th width="30%">First Name</th>  
                                <th width="10%">Last Name</th>  
                               <th width="45%">Email</th>  
                         </tr>  
      ';  
      $content .= fetch_data();  
      $content .= '</table>';  
      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output('sample.pdf', 'I');  
}  
  ?>  



 <!DOCTYPE html>  
  <html>  
       <head>  
            <title></title>  
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />            
      </head>  
       <body>  
            <br /><br />  
            <div class="container" style="width:700px;">  
                 <br />  
                 <div class="table-responsive">  
                     <table class="table table-bordered">  
                           <tr>  
                                <th width="5%">ID</th>  
                                <th width="30%">First Name</th>  
                                <th width="10%">Last Name</th>  
                               <th width="45%">Email</th>  
                           </tr>  
                      <?php  
                      echo fetch_data();  
                      ?>  
                      </table>  
                      <br />  
                      <form method="post">  
                 <input type="submit" name="create_pdf" class="btn btn-danger" value="Create PDF" />  
                      </form>  
                 </div>  
            </div>  
       </body>  
 </html>  