<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Auth extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user/User_model');
        $this->load->model('role/Role_model');
        $this->load->model('user/Log_model');
    }

    public function index()
    {
        if (get_session()) {
            redirect('home');
        }
        $this->form_validation->set_rules('username', 'Username', 'required|trim|username|min_length[3]', [
            'required'      => 'Username tidak boleh kosong!',
            'username'      => 'Hanya boleh mengandung unsur huruf dan angka saja',
            'min_length'    => 'Username minimal 3 karakter',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]', [
            'required'      => 'Password tidak boleh kosong!',
            'min_length'    => 'Password minimal 8 karakter',
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth-view');
        } else {
            cek_csrf();
            $this->_login();
        }
    }

    private function _login()
    {
        $username   = $this->input->post('username');
        $password   = $this->input->post('password');
        //$password2  = password_hash($password, PASSWORD_DEFAULT);

        $userLdap = $this->ldap_auth($username, $password);
        // echo json_encode($userLdap);
        // exit;

        $userTable = $this->db->get_where('user', ['USERNAME' => $username])->row_array();

        if ($userLdap) {
            if ($userTable) {
                if ($userTable['IS_ACTIVE'] == 1) {
                    $this->_update_user($userLdap, $userTable['ID'], $password);
                    $this->_login_success($userTable);
                } else {
                    $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <strong>Gagal!</strong> User tidak aktif.
                                </div>';
                    $this->session->set_flashdata('flash', $flash);
                    redirect('login');
                }
            } else {
                $this->_create_user($userLdap, $username, $password);
            }
        } else if ($userTable) {
            if (password_verify($password, $userTable['PASSWORD'])) {
                if ($userTable['IS_ACTIVE'] == 1) {
                    $this->_login_success($userTable);
                } else {
                    $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <strong>Gagal!</strong> User tidak aktif.
                                </div>';
                    $this->session->set_flashdata('flash', $flash);
                    redirect('login');
                }
            } else {
                $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Gagal!</strong> Password salah.
                            </div>';
                $this->session->set_flashdata('flash', $flash);
                redirect('login');
            }
        } else {
            $flash = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Gagal!</strong> User tidak ditemukan.
                        </div>';
            $this->session->set_flashdata('flash', $flash);
            redirect('login');
        }
    }

    private function _update_user($user, $user_id, $password)
    {
        $data = array(
            'PASSWORD'          => password_hash($password, PASSWORD_DEFAULT),
            'FULLNAME'          => $user['displayName'],
            //'COMPANY'           => $user['company'],
            //'DEPARTMENT'        => $user['department'],
            //'TITLE'             => $user['title'],
            //'EMPLOYEE_NUMBER'   => $user['employeeNumber'],
            //'NIP'               => $user['description'],
            'EMAIL'             => $user['email'],
            'CHANGED_BY'        => $user['displayName']
        );
        $this->User_model->editUser($data, $user_id);
    }

    private function _create_user($user, $username, $password)
    {
        $data = array(
            'USERNAME'          => $username,
            'FULLNAME'          => $user['displayName'],
            'EMAIL'             => $user['email'],
            'PASSWORD'          => password_hash($password, PASSWORD_DEFAULT),
            'IMAGE'             => 'default.png',
            //'COMPANY'           => $user['company'],
            //'DEPARTMENT'        => $user['department'],
            'SHORT_TITLE'       => '-',
            //'EMPLOYEE_NUMBER'   => $user['employeeNumber'],
            //'NIP'               => $user['description'],
            'TYPE_USER'         => 'AD',
            'IS_ACTIVE'         => 1,
            'CREATED_BY'        => 'SYSTEM',
            'CREATED_ON'        => date('Y-m-d H:i:s'),
            'CHANGED_BY'        => 'SYSTEM'
        );
        $add_user = $this->User_model->addUser($data);

        $role = [
            'ROLE_ID'       => 6,
            'USER_ID'       => $add_user
        ];
        $this->db->insert('user_group_role', $role);

        $session = [
            'id'        => $add_user,
            'username'  => $data['USERNAME'],
            'fullname'  => $data['FULLNAME'],
            'title'     => $data['SHORT_TITLE'],
            'image'     => $data['IMAGE'],
            'role_id'   => $this->User_model->getUserRole($add_user)->result_array()
        ];
        $this->session->set_userdata('p2ep', $session);
        $flash = '<div class="alert alert-success text-left mb-0" role="alert">
                    Anda berhasil login.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>';
        $this->session->set_flashdata('flash', $flash);

        $ket = 'User <strong>' . $data['USERNAME'] . '</strong> login pada sistem';
        activity_log(get_session_id(), get_session_name(), 'User', 'LOGIN', 'info', $ket);
        redirect('home');
    }

    private function _login_success($user)
    {
        //$subbidang = $this->Subbid_model->getSubbidById($user['ORG_ID'])->row_array();
        if ($user['SHORT_TITLE'] != NULL) {
            $title = $user['SHORT_TITLE'];
        } else {
            $title = '-';
        }
        $session = [
            'id'        => $user['ID'],
            'username'  => $user['USERNAME'],
            'fullname'  => $user['FULLNAME'],
            'image'     => $user['IMAGE'],
            'title'     => $title,
            'role_id'   => $this->User_model->getUserRole($user['ID'])->result_array(),
            //'org_id'    => $user['ORG_ID'],
            //'bidang_id' => $subbidang['BIDANG_ID']
        ];
        $this->session->set_userdata('p2ep', $session);
        $flash = '<div class="alert alert-success alert-dismissible alert-alt fade show mt-3">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                            <span><i class="fa-solid fa-xmark"></i></span>
                        </button>
                        <strong>Sukses!</strong> Anda berhasil login.
                    </div>';
        $this->session->set_flashdata('flash', $flash);

        $ket = 'User <strong>' . $user['USERNAME'] . '</strong> login pada sistem';
        activity_log(get_session_id(), get_session_name(), 'User', 'LOGIN', 'info', $ket);
        redirect('home');
    }

    public function logout()
    {
        check_session();
        $ket = 'User <strong>' . get_session_username() . '</strong> logout pada sistem';
        activity_log(get_session_id(), get_session_name(), 'User', 'LOGOUT', 'warning', $ket);
        $this->session->unset_userdata('p2ep');
        $flash = '<div class="alert alert-success alert-dismissible alert-alt fade show mt-3">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                            <span><i class="fa-solid fa-xmark"></i></span>
                        </button>
                        <strong>Sukses!</strong> Anda berhasil logout.
                    </div>';
        $this->session->set_flashdata('flash', $flash);
        echo "<script language=\"javascript\">window.localStorage.clear();</script>";
        redirect('login');
    }

    public function ldap_auth($username, $password)
    {
        //$adServer = "adpusat02.pusat.corp.pln.co.id";
        $adServer = "10.60.70.100";

        //$username = 'miftahu.burhan';
        //$password = 'T@rk1man444#';

        $ldap = ldap_connect($adServer);

        //$ldaprdn = 'pusat' . "\\" . $username;
        $ldaprdn = 'plnepi' . "\\" . $username;

        //echo json_encode($ldaprdn);
        //exit;

        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

        $bind = @ldap_bind($ldap, $ldaprdn, $password);

        if ($bind) {
            $filter = "(sAMAccountName=$username)";
            //$result = ldap_search($ldap, "dc=pusat,dc=corp,dc=pln,dc=co,dc=id", $filter);
            $result = ldap_search($ldap, "dc=plnepi,dc=co,dc=id", $filter);
            // ldap_sort($ldap,$result,"sn");
            $info = ldap_get_entries($ldap, $result);


            // print_r($info);
            // exit;
            for ($i = 0; $i < $info["count"]; $i++) {
                if ($info['count'] > 1)
                    break;
                //$userDn[] = $info[$i]["distinguishedname"][0];
                //$userDn[] = $info[$i]["displayname"][0];

                // echo json_encode($info[$i]["company"][0]);
                // exit;

                $dataldap = array(
                    'displayName' => $info[$i]["displayname"][0],
                    'email' => $info[$i]["mail"][0],
                    //'company' => $info[$i]["company"][0],
                    //'department' => $info[$i]["department"][0],
                    //'title' => $info[$i]["title"][0],
                    //'employeeNumber' => $info[$i]["employeenumber"][0],
                    //'description' => $info[$i]["description"][0]
                );
                // print_r($info[$i]["description"][0]);
                // exit;


                return $dataldap;
            }
            @ldap_close($ldap);
        } else {
            return false;
        }
    }
}
