<!DOCTYPE html>
<html lang="rus">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <title> Products </title>
</head>

<body>

<div class="content">
<form action="" method="post"

    <p>Name</p>
    <input type="text" name="name" value="<?php
    if(isset($_POST['name'])) {
    if (NameCheck($_POST['name']) !== 1) {
        echo $_POST[""];
    } else {
        echo $_POST['name'];
    }
    } ?>" placeholder="Enter your name" required>

    <p>Phone</p>
    <input type="number" name="number" placeholder="Enter your number" required>

    <p>Email</p>
    <input type="email" name="email" value="<?php
    if(isset($_POST['email'])) {
        if (MailCheck($_POST['email']) !== 1) {
            echo $_POST[""];
        } else {
            echo $_POST['email'];
        }
    }?>" placeholder="Example:m@gmail.com" required>

    <p>Subject</p>
    <input type="text" name="topic" placeholder="Enter the subject of your message" required>

    <p>Message text</p>
    <input type="text" name="text_message" placeholder="Enter your message" required>

    <p></p>
    <input type="submit" value="Send message" name="button" >


</form>




<?php
if (ClickVerification() !== null) {
    Main();
}


function MailCheck($mail)
{

    return preg_match('/^[\w.]+@(gmail)+\.+(com)$/i', $mail);
}

function NameCheck($name)
{

    return preg_match('/([А-ЯЁ]([а-яё]{1,29}))+(\s)?+|([A-Z]([a-z]{1,29}))/u', $name);
}

function FieldValidation()
{
    if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST['number']) ||
        empty($_POST['topic']) || empty($_POST['text_message'])) {
        echo "<div class='error'> One of the fields is empty <div/>";
        exit(403);
    }
}

function ClickVerification()
{
    if (isset($_POST["button"])) {
        Main();
    } else {
        return null;
    }
}

function Main()
{
    $to = $_POST['email'];
    $name = $_POST['name'];
    $number = $_POST['number'];
    $topic = trim($_POST['topic']);
    $text_message = trim($_POST['text_message']);

    FieldValidation();

    if (MailCheck($to) !== 1) {
        echo "<div class='error'>Invalid email</div>";
        exit(403);
    } else if (NameCheck($name) !== 1) {
        echo "<div class='error'> Invalid name<div/>";
        exit(403);
    }

    $from = 'phpmail.gai@gmail.com';

    $headers = "From: $from" . "\r\n" . "Reply-To: $from" . "\r\n" . "X-Mailer: PHP/" . phpversion();

    if (mail($to, $topic, $text_message, $headers)) {
        echo "Email sent";
    } else {
        echo "Error";
    };

}

?>

</div>
</body>