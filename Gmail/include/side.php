<div class="list-group">
                <a href="index.php" class="list-group-item list-group-item-action">Inbox <span class="float-end">(
                    <?php
                    $user_id =$user['id'];
                    $countInbox = mysqli_query($connect,"select * from mails where reciever_id='$user_id' AND status='1'");
                    echo mysqli_num_rows($countInbox);
                    ?>)</span></a>
                <a href="sent_mail.php" class="list-group-item list-group-item-action">Outbox<span class="float-end">(
                    <?php
                    // $user_id =$user['id'];
                    $countInbox = mysqli_query($connect,"select * from mails where sender_id='$user_id' AND status='1'");
                    echo mysqli_num_rows($countInbox);
                    ?>)</span></a>
                <a href="trash.php" class="list-group-item list-group-item-action">Trash <span class="float-end">(<?php
                $countInbox = mysqli_query($connect,"select * from mails where (sender_id='$user_id' OR reciever_id='$user_id') AND status='-1'");
                echo mysqli_num_rows($countInbox);?>);
                </span></a>
                <a href="draft.php" class="list-group-item list-group-item-action">Draft</a>
                <a href="allmails.php" class="list-group-item list-group-item-action">All Mails</a>
                <a href="" class="list-group-item list-group-item-action">Setting</a>
                </div>