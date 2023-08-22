<?php
session_start();
include '../config/clsConnection.php';
include '../objects/clsDetails.php';
include '../objects/clsUser.php';

$database = new clsConnection();
$db = $database->connect();

$details = new ParDetails($db);
$user = new Users($db);
//segregate the id's of depts  
$dept_id = $_SESSION['dept'];
$array_id = explode(',', $dept_id);
foreach($array_id as $value)
{
    $id = $value;
    $details->department = $id;
    $view = $details->view_eval_approved_manager();
    while($row1 = $view->fetch(PDO::FETCH_ASSOC))
    {
        if($row1['par_status'] == 2 || $row1['par_status'] == 3){
            $action = '<center><a href="#" class="eval-par" value="'.$row1['sup_par_id'].'"><i class="fa fa-file-alt"></i> View PAR</a> || <a href="#" class="print-evalPAR" value="'.$row1['par_id'].'"><i class="fa fa-print"></i> Print PAR</a></center>';
        }else{
            $action = '<center><a href="#" class="print-approvedPAR" value="'.$row1['par_id'].'"><i class="fa fa-print"></i> Print PAR</a></center>';
        }
        $date = date('F j, Y', strtotime($row1['date_evaluated']));
        echo '
            <tr>
                <td style="width: 15%">'.$row1['emp_name'].'</td>
                <td style="width: 10%">'.$row1['dept-name'].'</td>
                <td style="width: 10%"><center>'.$date.'</center></td>
                <td style="width: 10%"><center>'.$row1['fullname'].'</center></td>
                <td style="width: 18%">'.$action.'</td>
            </tr>';
    }                                                  
} 
?>
<script>
//APPROVE PAR EVENT HANDLER
//view evaluated employee PAR in new tab
$('.approve-par').on('click', function(e){
  e.preventDefault();
    var id = $(this).attr('value');

    $.ajax({
      type: 'POST',
      url: '../../controls/approved_par.php',
      data: {id: id},

      success: function(response)
      {
        if(response > 0)
        {
          //view the latest list(FOR FINAL APPROVAL))
          $.ajax({
            url: '../../controls/view_for_finalApproval.php',
            success: function(html)
            {
              $('#evaluatedTable-body').fadeOut();
              $('#evaluatedTable-body').fadeIn();
              $('#evaluatedTable-body').html(html);
            }
          })
          //view the latest list(APPROVED)
          $.ajax({
            url: '../../controls/view_approved_par.php',
            success: function(html)
            {
              $('#approvedTable-body').fadeOut();
              $('#approvedTable-body').fadeIn();
              $('#approvedTable-body').html(html);
            }
          })
          toastr.success('Employee PAR successfully Approved & ready for printing.');
        }
        else
        {
          toastr.danger('Approve Failed. Please contact the system administrator at local 124.')
        }
      }
    })
})
</script>