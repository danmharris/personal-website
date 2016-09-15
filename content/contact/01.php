<br>
<style>

    form{
       width:60%;
       margin-left:auto;
       margin-right:auto;
    }
    label {
        display:block;
        text-align:center;
    }


    input,textarea{
        width:100%;
        margin-bottom:15px;
        font-size:13pt;
    }

    textarea{
        height:20%;
    }

</style>
<div class="content-title">Contact</div>
<div class="content-body">
    <form method="POST" id="contact">
    <label for="name">Name</label>
    <input type="name" name="name">
    <br>
    <label for="email">E-Mail</label>
    <input type="email" name="email">
    <br>
    <label for="subject">Subject</label>
    <input type="text" name="subject">
    <br>
    <label for="message">Message</label>
    <textarea name="message"></textarea>
    <br>
    <input name="submit" type="submit" value="Submit">
    </form>
    <?php
    if ($_POST['submit']){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $from = "Website Contact Form";
        $to = "contact@danmharris.com";
        $body = "From: $name\n E-Mail: $email\n Message:\n $message";
        if ($name =="" || $email == "" || $subject=="" || $message==""){
            echo "Please fill in all fields";
        } elseif (mail($to,$subject,$body,$from)){
            echo "Message sent successfully!";
        } else {
            echo "Error sending message";
        }

    }
?>
</div>