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
              <a href="#compose"  class=" btn btn-danger btn-lg mb-3 px-5 py-3 fw-bold rounded-pill" data-bs-toggle="modal">Compose</a>
              </div>
              <?php include "include/side.php";?>
              
           </div>
           <div class="col-9">
               <h6 class="lead my-3 ms-5">Inbox</h6>
               <div class="container">

                   <?php
                   $mail_id = $_GET['id'];
                   $loginedUserId = $user['id'];
                   $callingInbox = mysqli_query($connect,"select * from mails JOIN accounts ON mails.Sender_id=accounts.id where mail_id='$mail_id' ORDER BY mail_id DESC");
                   $row = mysqli_fetch_array($callingInbox);
                       ?>
                   <div class="col-12">

                   <div class="row">
                       <div class="offset-8 col-4">
                          
                       <?php if($row['status'] != -1): ?>
                            <a href="viewmail.php?del=<?= $row['mail_id'];?>&id=<?= $_GET['id'];?>" class="btn btn-danger"><i class="bi bi-trash"></i> Delete</a>
                        <?php endif; ?>
                    
                    
                   <?php if($row['status'] == 0):?>
                           <a href="viewmail.php?resend=<?= $row['mail_id'];?>&id=<?= $_GET['id'];?>" class="btn btn-success"><i class="bi bi-send"></i> Send</a>
                     <?php endif; ?>

                   <?php if($row['status'] == -1):?>
                           <a href="viewmail.php?undo=<?= $row['mail_id'];?>&id=<?= $_GET['id'];?>" class="btn btn-warning"><i class="bi bi-arrow-counterclockwise"></i> Undo</a>

                    <?php endif; ?>
            
                   <?php if($row['status'] == -1):?>
                           <a href="viewmail.php?remove=<?= $row['mail_id'];?>&id=<?= $_GET['id'];?>" class="btn btn-danger"><i class="bi bi-trash"></i> Permanent Delete</a>

                    <?php endif; ?>
            
                     

                        </div>
                   </div>
                       <h6><?= $row['fname'];?></h6>
                       <p><strong><?= $row['subject'];?> -</strong> <span class="text-muted"><?= $row ['content'];?></span></p>
                       <p> <?= date("D d-M-Y h:i:s A", strtotime($row['date']));?> </p>

                       <?php
                       if($row['attachement'] != null): ?>

                         <img src="attachments/<?= $row['attachement'];?>" class="w-25" alt="">
                         <a href="attachments/<?= $row['attachement'];?>" class="me-2">View</a>
                         <a href="attachments/<?= $row['attachement'];?>" download>Download</a>

                       <?php endif; ?>
</div>
                   </div>
           </div>
        </div>
    </div>
    <?php include "include/footer.php";?>


      
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>

<?php

if(isset($_GET['del'])){
    $id = $_GET['del'];
    $query = mysqli_query($connect, "update mails SET status='-1' where  mail_id='$id'");

    redirect("index");
}
if(isset($_GET['remove'])){
    $id = $_GET['remove'];
    $query = mysqli_query($connect, "delete from mails where  mail_id='$id'");

    redirect("index");
}

if(isset($_GET['resend']) || isset($_GET['undo'])){
    $id = $_GET['resend'];

    if(isset($_GET['undo'])){
        $id = $_GET['undo'];
    }

    $query = mysqli_query($connect, "update mails SET status='1' where  mail_id='$id'");
    redirect("index");
}

?>