<?php
$errors = '';
$myemail = 'chinmay3.14@hotmail.com';
if(empty($_POST['name'])   ||
   empty($_POST['email'])  ||
   empty($_POST['message'])||
   empty($_POST['mobile']) ||
   empty($_POST['city']))
{
    $errors .= "\n Error: all fields are required";
}

$name = $_POST['name'];
$email_address = $_POST['email'];
$message = $_POST['message'];
$mobile = $_POST['mobile'];
$city = $_POST['city'];

$email = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
$mob="/^[1-9][0-9]*$/";

if (!preg_match($email, $email_address))
{
    $errors .= "\n Error: Invalid email address";
}
elseif (!preg_match($mob, $mobile)) {
    $errors .= "\n Error: Invalid phone number";
}
elseif ($city== 'select') {
    $errors .= "\n Error: Please select a valid city";
}


if( empty($errors))
{
	$to = $myemail;
	$email_subject = "Enquiry Form: $name";
	$email_body = "You have received a new message. ".
	" Here are the details:\n Name: $name \n Email: $email_address \n Mobile: $mobile \n Message \n $message";

	$headers = "From: $myemail\n";
	$headers .= "Reply-To: $email_address";

	mail($to,$email_subject,$email_body,$headers);
	//redirect to the 'thank you' page
	header('Location: contact-submitted.html');
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Contact form handler</title>
</head>

<body>
<!-- This page is displayed only if there is some error -->
<?php
echo nl2br($errors);
?>


</body>
</html>
