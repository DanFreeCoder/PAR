<?php
include '../config/clsConnection.php';
include '../objects/clsUser.php';

$database = new clsConnection();
$db = $database->connect();

$user = new Users($db);

$get = $user->view_all_approver();
$position = '';
$role = '';
while($row = $get->fetch(PDO::FETCH_ASSOC))
{
    //check if the par is already evaluated
    if($row['access'] == 1){
    $position = 'Administrator';
    $role = 'Admin/HR';
    }elseif($row['access'] == 2){
    $position = 'Supervisor / TeamLead';
    }elseif($row['access'] == 3){
    $position = 'Manager';
    }elseif($row['access'] == 4){
    $position = 'Senior Manager';
    }else{
    $position = 'Employee/Staff';
    }
    //check the user role
    if($row['role'] == 1){
    $role = 'Approver 1';
    }elseif($row['role'] == 2){
    $role = 'Approver 2';
    }elseif($row['role'] == 3){
    $role = 'Final Approver';
    }else{
    $role = 'Admin/HR';
    }
    echo '
        <tr>
            <td>'.$row['fullname'].'</td>
            <td><center>'.$position.'</center></td>
            <td><center>'.$role.'</center></td>
            <td><center>'.$row['username'].'</center></td>
            <td><center><a href="#" class="edit" value="'.$row['id'].'"><i class="fa fa-pen-alt"></i> Edit</a> || <a href="#" class="reset" value="'.$row['id'].'"><i class="fa fa-key"></i> Reset</a> || <a href="#" class="remove" value="'.$row['id'].'"><i class="fa fa-trash"></i> Remove</a></center></td>
            
        </tr>';
}
?>
<script>
//Update user detail
$('.edit').on('click', function(e){
    e.preventDefault();

    var id = $(this).attr('value');

    $.ajax({
        type: 'POST',
        url: '../../controls/view_user_byID.php',
        data: {id: id},
        beforeSend: function()
        {
            showToast();
        },
        success: function(html)
        {
            $('#updUserModal').modal('show');
            $('#user-body-modal').html(html);
        }
    })
})

//Reset account password
$('.reset').on('click', function(e){
    e.preventDefault();

    var id = $(this).attr('value');

    $.ajax({
        type: 'POST',
        url: '../../controls/reset_user.php',
        data: {id: id},
        beforeSend: function()
        {
            showToast();
        },
        success: function(response)
        {
            if(response > 0)
            {
                toastr.success('NOTICE:<br> User account reset successfull.');
                $.ajax({
                    url: '../../controls/view_all_user.php',
                    success: function(html)
                    {
                        $('#listbody').html(html);
                        $('#upd_success').html("<center><i class='fa fa-check menu-icon'></i> User Details successfully updated.</center>");
                        $('#upd_success').show();
                        setTimeout(function(){
                            $('#upd_success').fadeOut();
                        }, 3000)
                    }
                })
            }
            else
            {
                toastr.error('ERROR! Submit Failed. Please contact the system administrator at local 124 for assistance');
            }
        }
    })
})

//remove or deactivate user account
$('.remove').on('click', function(e){
    e.preventDefault();

    var id = $(this).attr('value');

    $.ajax({
        type: 'POST',
        url: '../../controls/remove_user.php',
        data: {id: id},
        beforeSend: function()
        {
            showToast();
        },
        success: function(response)
        {
            if(response > 0)
            {
                toastr.success('NOTICE:<br>User successfully removed.');
                $.ajax({
                    url: '../../controls/view_all_user.php',
                    success: function(html)
                    {
                        $('#listbody').html(html);
                        $('#upd_success').html("<center><i class='fa fa-check menu-icon'></i> User Details successfully updated.</center>");
                        $('#upd_success').show();
                        setTimeout(function(){
                            $('#upd_success').fadeOut();
                        }, 3000)
                    }
                })
            }
            else
            {
                toastr.error('ERROR! Submit Failed. Please contact the system administrator at local 124 for assistance');
            }
        }
    })
})
</script>