<?php
if (!function_exists('send_notification')) {
    function send_notification($modul, $curr_user_id, $action, $data_email, $email_view, $cc, $id_angsuran = "")
    {
        $CI = &get_instance();
        $CI->load->model('user/User_model', 'User_model');
        $curr_user = $CI->User_model->getUserRoles($curr_user_id)->result();
        //get next role user
        $roles = get_next_user($modul, $curr_user, $action);

        if ($roles != null) {
            //get all recipients
            $recipients = get_recipients($roles, $cc);
            foreach ($recipients as $user) {
                //insert to notification table
                $notification = insert_notification_data($user, $action, $modul, $curr_user, $id_angsuran);
                $data_email['to_name'] = $user->NAMA_USER;
                //send email
                send_notification_email($user, $notification, $data_email, $email_view);
            }
        }
    }
}

if (!function_exists('get_recipients')) {
    function get_recipients($roles, $cc)
    {
        $users = array();
        if ($roles != null) {
            $CI = &get_instance();
            $CI->load->model('user/userModel', 'userModel');

            //get all user by role
            foreach ($roles as $role) {

                if ($cc != '' && $cc != null) {
                    $data = $CI->userModel->getUserByRoleNameAndCompanyCode($role, $cc);
                    foreach ($data as $row) {
                        array_push($users, $row);
                    }
                }

                #get approval pusat | 2 Oktober 2018
                /*if($role == APPROVAL_PUSAT){
                    $data = $CI->userModel->getUserByRoleNameAndCompanyCode($role, $cc);
					foreach ($data as $row) {
						array_push($users, $row);
					}
                }*/
            }
        }
        return $users;
    }
}


//function to identified which role should be received email
if (!function_exists('get_next_user')) {
    function get_next_user($modul, $curr_user, $action)
    {
        foreach ($curr_user as $roles) {
            $role = $roles->NAMA_ROLE;
            $next_role = null;
            switch ($modul) {
                case PESERTA:
                    if ($role == USER_INPUT) {
                        //if user input submit new peserta, send to approval unit
                        $next_role = array(APPROVAL_UNIT);
                    } else if ($role == APPROVAL_UNIT) {
                        //if approved , send to pusat. reject, send to user input
                        $next_role = array(USER_INPUT);
                    }
                    break;
                case COP:
                    if ($role == USER_INPUT) {
                        //if user input submit new cop, send to approval pusat
                        $next_role = array(APPROVAL_PUSAT);
                    } else if ($role == APPROVAL_PUSAT) {
                        //send notif to user input
                        $next_role = array(USER_INPUT);
                    }
                    break;
                case ANGSURAN:
                    if ($role == USER_INPUT) {
                        //send notif to approval unit and pusat
                        $next_role = array(APPROVAL_UNIT, APPROVAL_PUSAT);
                    }
                    break;
                case MUTASI:
                    if ($role == USER_INPUT) {
                        //if user input submit mutasi, send to approval pusat
                        $next_role = array(APPROVAL_PUSAT);
                    } else if ($role == APPROVAL_PUSAT) {
                        //send notif to user input
                        $next_role = array(USER_INPUT);
                    }
                    break;
                case PENUTUPAN:
                    if ($role == USER_INPUT) {
                        //if user input submit pemberhentian, send to approval pusat
                        $next_role = array(APPROVAL_PUSAT);
                    } else if ($role == APPROVAL_PUSAT) {
                        //send notif to user input
                        $next_role = array(USER_INPUT);
                    }
                    break;
            }
        }
        return $next_role;
    }
}
//action adalah action yg dilakukan oleh user (bukan action selanjutnya)
if (!function_exists('insert_notification_data')) {
    function insert_notification_data($user_to, $action, $modul, $curr_user, $id_angsuran = "")
    {
        foreach ($curr_user as $roles) {
            $role = $roles->NAMA_ROLE;
            $CI = &get_instance();
            $CI->load->model('notif/notifModel', 'notifModel');
            $subject = "NO SUBJECT";
            $icon = "";
            $color = "";
            $message = "";
            switch ($action) {
                case SUBMITED:
                    $subject = ($modul == ANGSURAN) ? "LAPORAN ANGSURAN UNIT" : "REQUEST APPROVAL " . $modul;
                    $icon = "icon-checkmark-circle";
                    $color = "primary";
                    $message = ($modul == ANGSURAN) ? "" : "Permintaan Approval " . $modul;
                    break;
                case APPROVED:
                    if ($role == APPROVAL_PUSAT) {
                        $subject = "PERMOHONAN " . $modul . " TELAH DISETUJUI";
                        $icon = "icon-thumbs-up";
                        $color = "success";
                        $message = $modul . " Telah disetujui";
                    } else if ($role == APPROVAL_UNIT) {
                        $subject = "PERMOHONAN " . $modul . " TELAH DISETUJUI";
                        $icon = "icon-thumbs-up";
                        $color = "success";
                        $message = $modul . " Telah disetujui";
                    }
                    break;
                case REJECTED:
                    $subject = "PERMOHONAN " . $modul . " DITOLAK";
                    $icon = "icon-thumbs-down";
                    $color = "danger";
                    $message = $modul . " Tidak  disetujui";
                    break;
            }
            //set url notification on click
            $to_role = $user_to->NAMA_ROLE;
            $url = get_notif_url($to_role, $modul, $id_angsuran, $action);
            $data = array(
                "TO_KEPADA" => $user_to->NAMA_USER,
                "FROM" => "SYSTEM",
                "SUBJECT" => strtoupper($subject),
                "MESSAGE" => $message,
                "ICON" => $icon,
                "COLOR" => $color,
                "URL" => $url,
                "STATUS" => 'UNREAD',
                "CREATED_AT" => date('Y-m-d H:i:s')
            );
            $CI->notifModel->notificationInput($data);
            return $data;
        }
    }
}


if (!function_exists('send_notification_email')) {
    function send_notification_email($to, $notif_data, $data_email, $email_view)
    {
        $CI = &get_instance();
        $CI->load->library('My_PHPMailer');
        $CI->load->helper('send_email_helper');
        $email = $CI->load->view($email_view, $data_email, true);
        send_mail($to->EMAIL, $to->NAMA_USER, strtoupper($notif_data['SUBJECT']), $email, $cc = array());
    }
}

//function to send email confirmation to peserta (sudah siap cop, sudah selesai cop, on mutasi approved)

if (!function_exists('send_peserta_notification')) {
    function send_peserta_notification($peserta, $data_email, $email_view, $subject)
    {
        $data_email['to_name'] = $peserta['NAMA_PEGAWAI'];
        //send email

        $CI = &get_instance();
        $CI->load->library('My_PHPMailer');
        $CI->load->helper('send_email_helper');
        $email = $CI->load->view($email_view, $data_email, true);
        send_mail($peserta['EMAIL'], $peserta['NAMA_PEGAWAI'], strtoupper($subject), $email, $cc = array());
    }
}


if (!function_exists('get_notif_url')) {
    function get_notif_url($to_role, $modul, $parameter = "", $status)
    {
        $url = "";
        switch ($to_role) {
            case APPROVAL_UNIT:
                if ($modul == PESERTA) {
                    $url = "pendaftaran/approval/" . $parameter;
                } else if ($modul == ANGSURAN) {
                    $url = "laporan";
                } else if ($modul == MUTASI) {
                    $url = "mutasi/detail/" . $parameter;
                }
                break;
            case APPROVAL_PUSAT:
                if ($modul == PESERTA) {
                    $url = "pendaftaran/approval/" . $parameter;
                } else if ($modul == ANGSURAN) {
                    $url = "laporan";
                } else if ($modul == COP) {
                    $url = "pengajuan/approval/" . $parameter;
                } else if ($modul == MUTASI) {
                    $url = "mutasi/approval/" . $parameter;
                }
                break;
            case USER_INPUT:
                if ($modul == PESERTA) {
                    $url = ($status == APPROVED) ? "peserta/detail/" . $parameter : "pendaftaran/edit/" . $parameter;
                } else if ($modul == COP) {
                    $url = ($status == APPROVED) ? "peserta/detail/" . $parameter : "pengajuan/edit/" . $parameter;
                } else if ($modul == MUTASI) {
                    $url = "mutasi/detail/" . $parameter;
                }
                break;
        }
        return $url;
    }
}

if (!function_exists('notif')) {
    function notif($to)
    {
        $CI = &get_instance();
        $CI->load->model('notif/notifModel', 'notifModel');
        $notif = $CI->notifModel->showNotifUnread($to)->result_array();
        return $notif;
    }
}
