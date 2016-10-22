<?php

/***
PHP email sender for static website
***/

// email configuration
$email_to = "website.owner@websitedomain.com"; // recipient
$from = "Contact from <owner@php.mailserver.com>";

// response URL and anchors
$path_to = "/form.html";
$invalid_email_anchor = "#invalid-email";
$email_success_anchor = "#success";
$email_failure_anchor = "#failure";


function clean_POST() {
/* remove malicious character from $_POST values */
    $form = array();
    foreach ($_POST as $key => $value) {
        $form[$key] = trim($value);
        $form[$key] = stripslashes($form[$key]);
        $form[$key] = htmlspecialchars($form[$key]);
        if ($form[$key] == '') {$form[$key] = '- - -';}
    }
    return $form;
} 


if ($_SERVER["REQUEST_METHOD"] == "POST") { // HTML-form has been submitted

    $FORM = clean_POST();

    $FORM['email'] = filter_var($FORM['email'], FILTER_SANITIZE_EMAIL); // remove forbidden characters

    if (filter_var($FORM['email'], FILTER_VALIDATE_EMAIL)) { // valid email address

        $email_subject = $FORM['email'];

        $headers =  "From: {$from}". "\r\n".
                    "Reply-To: {$FORM['email']}". "\r\n".
                    "X-Mailer: PHP/". phpversion();

        $body = "";
        foreach ($FORM as $key => $value) { // build email body 
            $body .= sprintf('%s: %s', $key, $value)."\r\n";
        }

        // In case any lines are larger than 70 characters, we should use wordwrap()
        $body = wordwrap($body, 70, "\r\n");

        $email_sending_result = mail($email_to, $email_subject, $body, $headers);

        if ($email_sending_result) { // email success
            header("Location: ".$path_to.$email_success_anchor);
            exit;
        } else { // email failure
            header("Location: ".$path_to.$email_failure_anchor);
            exit;            
        }
    } else { // invalid email address
        header("Location: ".$path_to.$invalid_email_anchor);
        exit;
    }

} else { // direct access to this php file
    header("Location: ".$path_to);
    exit;
}   
?>