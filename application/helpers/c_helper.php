<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require APPPATH . '/libraries/phpmailer/phpmailer/src/PHPMailer.php';
require APPPATH . 'libraries/phpmailer/phpmailer/src/Exception.php';
require APPPATH . 'libraries/phpmailer/phpmailer/src/SMTP.php';

function viewUser($c_name, $content, $data)
{
    $c_name->load->view('user/templates/header', $data);
    $c_name->load->view('user/templates/navbar', $data);
    $c_name->load->view($content, $data);
    $c_name->load->view('user/templates/footer', $data);
}

function viewAdmin($c_name, $content, $data)
{
    $c_name->load->view('admin/templates/sidebar', $data);
    $c_name->load->view('admin/templates/navbar', $data);
    $c_name->load->view($content, $data);
    $c_name->load->view('admin/templates/footer', $data);
}

function sendEmail($emailto, $message, $subject, $smpt_user, $smpt_pass)
{

    // Recipient Email Address
    $to = $emailto;
    // Email Subject
    $subject = $subject;

    // Gmail SMTP Server Details
    $smtpHost = "smtp.gmail.com";
    $smtpPort = 587;
    $smtpUsername = $smpt_user;
    $smtpPassword = $smpt_pass;

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Set SMTP options
        $mail->isSMTP();
        $mail->Host = $smtpHost;
        $mail->Port = $smtpPort;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = $smtpUsername;
        $mail->Password = $smtpPassword;

        // Set email content
        $mail->setFrom($smtpUsername);
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AltBody = 'This is the plain text version of the email';
        $mail->isHTML(true);

        // Send email
        $mail->send();
        $result = [
            'success' => true,
            'message' => 'Berhasil mengirimkan email'
        ];
    } catch (Exception $e) {
        $result = [
            'success' => false,
            'message' => "Mailer Error: " . $mail->ErrorInfo
        ];
    }
    return $result;

    // //set up email
    // $config = array(
    //     'protocol' => 'smtp',
    //     'smtp_host' => 'smtp.gmail.com',
    //     'smtp_port' => 487,
    //     'smtp_user' => $smpt_user,
    //     'smtp_pass' => $smpt_pass,
    //     'mailtype'  => 'html',
    //     'charset'   => 'iso-8859-1'
    // );

    // $c_name->load->library('email', $config);

    // // $c_name->email->initialize($config);
    // $c_name->email->set_newline("\r\n");
    // $c_name->email->from($config['smtp_user']);
    // $c_name->email->to($emailto);
    // $c_name->email->subject($subject);
    // $c_name->email->message($message);

    // $send = $c_name->email->send();

    // //sending email
    // if ($send) {
    //     $result = [
    //         'success' => true,
    //         'message' => 'Berhasil mengirimkan email'
    //     ];
    // } else {
    //     $result = [
    //         'success' => false,
    //         'message' => $c_name->email->print_debugger()
    //     ];
    // }
    // return $result;
}
// function sendEmailChangePass($c_name, $email, $password, $uuid, $code, $smpt_user, $smpt_pass)
// {

//     //set up email
//     $config = array(
//         'protocol' => 'smtp',
//         'smtp_host' => 'smtp.gmail.com',
//         'smtp_port' => 487,
//         'smtp_user' => $smpt_user,
//         'smtp_pass' => $smpt_pass,
//         'mailtype'  => 'html',
//         'charset'   => 'iso-8859-1'
//     );

//     $message =     "
// 						<html>
// 						<head>
// 							<title>Verification Code</title>
// 						</head>
// 						<body>
// 							<h2>Thank you for Registering.</h2>
// 							<p>Your Account:</p>
// 							<p>Email: " . $email . "</p>
// 							<p>Password: " . $password . "</p>
// 							<p>Please click the link below to activate your account.</p>
// 							<h4><a href='" . base_url() . "auth/activate/" . $uuid . "/" . $code . "'>Activate My Account</a></h4>
// 						</body>
// 						</html>
// 						";

//     $c_name->load->library('email', $config);
//     $c_name->email->set_newline("\r\n");
//     $c_name->email->from($config['smtp_user']);
//     $c_name->email->to($email);
//     $c_name->email->subject('Signup Verification Email');
//     $c_name->email->message($message);

//     //sending email
//     if ($c_name->email->send()) {
//         $result = [
//             'success' => true,
//             'message' => 'Berhasil mengirimkan email'
//         ];
//     } else {
//         $result = [
//             'success' => false,
//             'message' => $c_name->email->print_debugger()
//         ];
//     }
//     return $result;
// }


function multi_unique_array($arr, $key)
{
    $Myarray = array();
    $i = 0;
    $array_of_keys = array();
    foreach ($arr as $val) {
        if (!in_array($val[$key], $array_of_keys)) {
            $array_of_keys[$i] = $val[$key];
            $Myarray[$i] = $val;
        }
        $i++;
    }
    return $Myarray;
}

function unlinkFile($filename)
{
    // try to use real path
    if (realpath($filename) && realpath($filename) !== $filename) {
        return is_writable($filename) && @unlink(realpath($filename));
    } else {
        return false;
    }
}

function valid_url($url)
{
    $regex = "((https?|ftp)\:\/\/)?";
    $regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?";
    $regex .= "([a-z0-9-.]*)\.([a-z]{2,3})";
    $regex .= "(\:[0-9]{2,5})?";
    $regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?";
    $regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?";
    $regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?";

    if (preg_match("/^$regex$/i", $url)) {
        return true;
    }

    return false;
}

function callAPI($method, $url, $data, $headers = false)
{
    $curl = curl_init();
    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    if (!$headers) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        ));
    } else {
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            $headers
        ));
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // EXECUTE:
    $result = curl_exec($curl);
    //Get status code
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if (!$result) {
        $result = "Connection Failure";
        $status = 502;
    }
    curl_close($curl);
    return [
        'result' => $result,
        'status' => $status
    ];
}

function inisial($kalimat)
{
    $words = explode(" ", $kalimat);
    $acronym = "";

    foreach ($words as $w) {
        $acronym .= mb_substr($w, 0, 1);
    }
    return $acronym;
}

function kodeMember($urutan)
{
    $tahun = date('y');
    $bulan = date('m');
    $no_urut = sprintf('%04s', $urutan);
    return 'AMD' . $tahun . $bulan . '-' . $no_urut;
}
