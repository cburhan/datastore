<?php
class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //USER
    var $select_column = array('ID', 'USERNAME', 'FULLNAME', 'EMAIL', 'IMAGE', 'NIP');
    var $order_column = array('ID', 'USERNAME', 'FULLNAME', 'EMAIL');

    public function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from('user');

        if (isset($_POST['search']['value'])) {
            $this->db->group_start();
            $this->db->like('USERNAME', $_POST['search']['value']);
            $this->db->or_like('FULLNAME', $_POST['search']['value']);
            $this->db->or_like('NIP', $_POST['search']['value']);
            $this->db->group_end();
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('NIP', 'ASC');
        }
    }

    public function make_datatables()
    {
        $this->make_query();

        if (isset($_POST['length']) && isset($_POST['start'])) {
            if ($_POST['length'] != -1) {
                $this->db->limit($_POST['length'], $_POST['start']);
            }
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data()
    {
        $this->make_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_all_data()
    {
        $this->db->select('*');
        $this->db->from('user');
        return $this->db->count_all_results();
    }

    public function getUser()
    {
        $this->db->select('ID, FULLNAME, NIP, SHORT_TITLE');
        $this->db->from('user');
        $this->db->order_by('NIP ASC');
        return $this->db->get();
    }

    public function getUserById($user_id)
    {
        $this->db->select('ID, USERNAME, FULLNAME, EMAIL, COMPANY, DEPARTMENT, SHORT_TITLE, LONG_TITLE,
                             NIP, TYPE_USER, IS_ACTIVE, IMAGE, NO_HP, ORG_ID, SHORT_ORG, PASSWORD,
                             LONG_ORG, CREATED_BY, CREATED_ON, CHANGED_BY, CHANGED_ON');
        $this->db->from('user');
        $this->db->where('ID', $user_id);
        return $this->db->get();
    }

    public function getUserByUsername($username)
    {
        $this->db->select('ID, USERNAME, FULLNAME, EMAIL, COMPANY, DEPARTMENT, TITLE, NIP, 
                            EMPLOYEE_NUMBER, TYPE_USER, IS_ACTIVE, IMAGE, DIVISI, BIDANG, SUBBID, NO_HP');
        $this->db->from('user');
        $this->db->where('USERNAME', $username);
        return $this->db->get();
    }

    public function getUserByFullname($name)
    {
        $this->db->select('ID, IS_ACTIVE, FULLNAME');
        $this->db->from('user');
        $this->db->where('IS_ACTIVE', 1);
        $this->db->like('FULLNAME', $name);
        return $this->db->get();
    }

    public function addUser($data)
    {
        $this->db->insert('user', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function editUser($data, $id)
    {
        $update = $this->db->update('user', $data, array('ID' => $id));
        return $update;
    }

    public function deleteUser($id)
    {
        try {
            $this->db->db_debug = FALSE;
            $this->db->delete('user_group_role', array('USER_ID' => $id));
            $delete = $this->db->delete('user', array('ID' => $id));
            return $delete;
        } catch (Exception $e) {
            return false;
        }
    }

    //USER GROUP ROLE
    public function getUserRole($user_id)
    {
        //$this->db->select('b.ID, b.NAMA_ROLE');
        //$this->db->from('user_group_role a');
        //$this->db->join('user_role b', 'a.ROLE_ID = b.ID');
        //$this->db->where('a.USER_ID', $user_id);
        $this->db->select('ROLE_ID');
        $this->db->from('user_group_role');
        $this->db->where('USER_ID', $user_id);
        return $this->db->get();
    }

    public function getUserRoleById($user_id)
    {
        $this->db->select('b.ROLE, b.ID');
        $this->db->from('user_group_role a');
        $this->db->join('user_role b', 'a.ROLE_ID = b.ID');
        $this->db->where('a.USER_ID', $user_id);
        return $this->db->get();
    }

    public function add_user_role($user_id, $role_id)
    {
        $this->db->insert('user_group_role', ['USER_ID' => $user_id, 'ROLE_ID' => $role_id]);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function add_reseller($user_id, $nama, $alamat, $tgl)
    {
        $this->db->insert('user_reseller', ['USER_ID' => $user_id, 'NAMA' => $nama, 'ALAMAT' => $alamat, 'TGL_JOIN' => $tgl]);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function delete_user_role($user_id)
    {
        $delete = $this->db->delete('user_group_role', array('USER_ID' => $user_id));
        return $delete;
    }
}
