<!--This is my php file to make the contact form work--!>

<?php
if (isset($_POST['Email'])) {

    $email_to = "lcookman@highpoint.edu";
    $email_subject = "New form submissions";

    function problem($error)
    {
        echo "We're sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br><br>";
        echo $error . "<br><br>";
        echo "Please go back and fix these errors.<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST['Name']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['Message'])
    ) {
        problem("We're sorry, but there appears to be a problem with the form you submitted.");
    }

    $name = $_POST['Name']; // required
    $email = $_POST['Email']; // required
    $message = $_POST['Message']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'The Email address you entered does not appear to be valid.<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'The Name you entered does not appear to be valid.<br>';
    }

    if (strlen($message) < 2) {
        $error_message .= 'The Message you entered do not appear to be valid.<br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Form details below.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Name: " . clean_string($name) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Message: " . clean_string($message) . "\n";

    // create email headers
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
?>

<?php
}
?>

<!DOCTYPE html>
<html>
     <head>
          <title>Contact</title>

<!--My logo as an icon--!>

          <link rel="icon" href="images/logo.png" type="image/png">

<!--Link to the contact style sheet--!>

          <link rel="stylesheet" type="text/css" href="contact.css">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <style>

/*Navigation css*/

               body {
                    margin: 0;
                    font-family: "Bakersville";
                    }

               .topnav {

                    overflow: hidden;
                    background-color: black;
                    }

               .topnav a {
                    float: left;
                    color: #f2f2f2;
                    text-align: center;
                    padding: 14px 16px;
                    text-decoration: none;
                    font-size: 17px;
                    }

               .topnav a:hover {
                    background-color: #ddd;
                    color: black;
                    }

               .topnav a.active {
                    background-color: grey;
                    color: white;
                    }
          </style>
     </head>

<!--Navigation--!>

     <body>
          <div class="topnav">
               <a href="lcDesign">Home</a>
               <a href="graphics.html">Graphics</a>
               <a href="photo.html">Photography</a>
               <a href="about.html">About</a>
               <a class="active" href="contact.html">Contact</a>
               <img style="float:right; padding-right: 10px;" src="images/name.png" height=48>
          </div>
          
          <img src="images/contact2.png" alt="contact">

<!--Making a spot for the user to see what they entered--!>

          <main>
               <?php if ($error): ?>
                    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
               <?php else: ?>
	            <strong>Thanks for getting in touch. We'll get back to you soon!</strong><br><br>
                    <label>Name entered:</label>
                         <span><?php echo $name ?? ''; ?></span><br>
                    <label>Email entered:</label>
                         <span><?php echo $email ?? ''; ?></span><br>
                    <label>What you want help with:</label>
                         <span><?php echo $message ?? ''; ?></span><br>
               <?php endif; ?>
          </main>

          <img src="images/contactBottom2.png" alt="contact">

     </body>

<!--Footer with special character--!>

     <footer style="list-style-type: none; margin:0; padding: 2% 25% 0.1% 25%; overflow: hidden; background-color: #333333; text-align:center;">
          <a href="lcDesign.html" style="color:white">Home</a>
          <a href="graphics.html" style="color:white">Graphics</a>
          <a href="photo.html" style="color:white">Photography</a>
          <a href="about.html" style="color:white">About</a>
          <a href="contact.html" style="color:white">Contact</a>
     <footer style="color: #A3A3A3"><h6><center>Copyright &copy Lauren Cookman 2024</center></h6>
     </footer>
</html>
