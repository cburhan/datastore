<?php
if (!function_exists('send_notification')) {
    function send_notification($user_id, $data_email, $subject, $email_view, $message)
    {
        $CI = &get_instance();
        $CI->load->model('user/user_model', 'user_model');
        $user_uploader = $CI->user_model->getUserById($user_id)->row_array();
        $recipients = $CI->user_model->getUserNotId($user_id)->result_array();

        foreach ($recipients as $penerima) {
            $data_email['user_uploader'] = $user_uploader['FULLNAME'];
            $data_email['user_penerima'] = $penerima['FULLNAME'];
            $body = $CI->load->view($email_view, $data_email, true);

            insert_notif($user_uploader['FULLNAME'], $penerima['ID'], $penerima['FULLNAME'], $subject, $data_email, $message);
            send_email_notif($penerima['EMAIL'], $penerima['FULLNAME'], $body, $subject);
        }
    }
}

if (!function_exists('insert_notif')) {
    function insert_notif($uploader, $penerima_id, $penerima_fullname, $subject, $data_email, $message)
    {
        $CI = &get_instance();

        $data = array(
            "TO_ID"         => $penerima_id,
            "TO"            => $penerima_fullname,
            "FROM"          => "SYSTEM",
            "SUBJECT"       => strtoupper($subject),
            "MESSAGE"       => $message,
            "ICON"          => "bolt",
            "COLOR"         => $data_email['color'],
            "URL"           => $data_email['url'],
            "MODUL_ID"      => $data_email['modul_id'],
            "STATUS"        => 'UNREAD',
            "CREATED_ON"    => $data_email['time']
        );
        $CI->load->model('notif/notif_model', 'notif_model');
        $CI->notif_model->addNotif($data);
    }
}

if (!function_exists('send_email_notif')) {
    function send_email_notif($email_penerima, $nama_penerima, $body, $subject)
    {
        $CI = &get_instance();
        $CI->load->library('phpmailer_lib');

        $mail = $CI->phpmailer_lib->load();

        //$mail->SMTPDebug  = 2;
        $mail->IsSMTP();
        $mail->SMTPAuth = false;
        //$mail->Host = "mx.plnepi.co.id";
        $mail->Host = "10.60.78.103";
        // $mail->Host = "hub.pln.co.id";
        $mail->Port = 25;
        $mail->Username = "notif@plnepi.co.id";
        $mail->Password = "Plnepi@2024#";
        $mail->SetFrom("notif@plnepi.co.id", "P2EP DATASTORE");
        $mail->AddReplyTo("notif@plnepi.co.id", "P2EP DATASTORE");
        $mail->Body = $body;
        $mail->AltBody = "Plain text message";
        $mail->AddAddress($email_penerima, $nama_penerima);
        $mail->Subject = $subject;
        $mail->IsHTML(true);
        $mail->AddEmbeddedImage('assets/images/logo-p2ep.png', 'p2ep', 'logo-p2ep.png');
        $mail->AddEmbeddedImage('assets/images/plnepi.png', 'plnepi', 'plnepi.png');
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        // Send email
        if (!$mail->send()) {
            //echo 'Message could not be sent.';
            //echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            //echo 'Message has been sent';
        }
    }
}

if (!function_exists('notif')) {
    function notif($to)
    {
        $CI = &get_instance();
        $CI->load->model('notif/notif_model', 'notif_model');
        $notif = $CI->notif_model->getNotifUnread($to)->result_array();
        return $notif;
    }
}
