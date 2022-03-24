<!-- this is dashboard page after login -->
<?php
include "include/connect.php";

 checkAuth();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gmail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">


</head>
<body>
    <?php include "include/navbar.php";?>

    <div class="container-fluid mt-4">
        <div class="row ">
           <div class="col-3">
              <div class="text-center">
              <a href="#compose"  class=" btn btn-danger btn-lg mb-3 px-5 py-3 fw-bold rounded-pill" data-bs-toggle="modal">Compose <i class="bi bi-send"></i></a>
              </div>
              <?php include "include/side.php";?>
              
           </div>
           <div class="col-9">
               <h6 class="lead my-3 ms-5">Inbox</h6>
               <table class="table">
                   <?php
                   $loginedUserId = $user['id'];
                   $callingInbox = mysqli_query($connect,"select * from mails JOIN accounts ON mails.Sender_id=accounts.id where reciever_id='$loginedUserId' AND status='1' ORDER BY mail_id DESC");
                   while($row = mysqli_fetch_array($callingInbox)){
                       ?>
                   <tr>
                       <th><?= $row['fname'];?></th>
                       <td>
                       <a href="viewmail.php?id=<?= $row['mail_id'];?>" class="text-decoration-none">
                       <strong><?= $row['subject'];?> -</strong> <span class="text-muted"><?= $row ['content'];?></span></a></td>
                       <td>
                           <?= date("D d-M-Y h:i:s A", strtotime($row['date']));?>
                           <?php
                           if($row['attachement'] != NULL): ?>
                           <i class="bi bi-paperclip"></i>
                           <?php endif; ?>
                   </td>
                   </tr>
                   <?php } ?>
</table>
           </div>
        </div>
    </div>
    <?php include "include/footer.php";?>
    
                     


      <?php
      if(isset($_POST['send']) || isset($_POST['save'])){
        $to = $_POST['to'];

        //retrieving id of reciever user
 
          $toUser = getUser($to);
          $to = $toUser['id'];
        //retrieve from getUser function
        $sender_id = $user['id'];
        $subject = $_POST['subject'];
        $content = $_POST['content'];
        $status = 1; //1 = mail send(inbox) // =0 draft (saved mail) // -1. (trashed)

        if(isset($_POST['save'])){
            $status = 0;
        }

         //attachement

         $attach = $_FILES['attachement']['name'];
         $tmp_attach = $_FILES['attachement']['tmp_name'];
         move_uploaded_file($tmp_attach,"attachement/$attach");
        $query =  mysqli_query($connect,"insert into mails (sender_id, reciever_id, subject, content, status, attachement) value ('$sender_id','$to','$subject','$content','$status' ,'$attach')");
 

         if($query){
             redirect();
         }
         else{
             message("sending fail");
         }
      }
      ?>
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>