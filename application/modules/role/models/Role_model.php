<?php
class Role_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //ROLE
    var $select_column_role = array('ID', 'ROLE');
    var $order_column_role = array('ID', 'ROLE');

    public function make_query_role()
    {
        $this->db->select($this->select_column_role);
        $this->db->from('user_role');

        if (isset($_POST['search']['value'])) {
            $this->db->like('ROLE', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('ID', 'ASC');
        }
    }

    public function make_datatables_role()
    {
        $this->make_query_role();

        if (isset($_POST['length']) && isset($_POST['start'])) {
            if ($_POST['length'] != -1) {
                $this->db->limit($_POST['length'], $_POST['start']);
            }
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data_role()
    {
        $this->make_query_role();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_all_data_role()
    {
        $this->db->select('*');
        $this->db->from('user_role');
        return $this->db->count_all_results();
    }

    public function getRole()
    {
        $this->db->select('ID, ROLE');
        $this->db->from('user_role');
        return $this->db->get();
    }

    public function getRoleById($role_id)
    {
        $this->db->select('ID, ROLE');
        $this->db->from('user_role');
        $this->db->where('ID', $role_id);
        return $this->db->get()->row_array();
    }

    public function getRoleByUser($user_id)
    {
        $this->db->select('b.ROLE');
        $this->db->from('user_group_role a');
        $this->db->join('user_role b', 'a.ROLE_ID = b.ID');
        $this->db->where('a.USER_ID', $user_id);
        return $this->db->get();
    }

    public function addRole($data)
    {
        $this->db->insert('user_role', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function editRole($data, $role_id)
    {
        $update = $this->db->update('user_role', $data, array('ID' => $role_id));
        return $update;
    }

    public function deleteRole($role_id)
    {
        try {
            $this->db->db_debug = FALSE;
            $delete = $this->db->delete('user_role', array('ID' => $role_id));
            return $delete;
        } catch (Exception $e) {
            return false;
        }
    }

    // ACCESS
    var $select_column = array('b.MENU', 'a.TITLE', 'a.ID');
    var $column_search = array('a.TITLE');
    var $order_column = array('b.SEQUENCE', 'a.ID');

    public function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from('user_sub_menu a');
        $this->db->join('user_menu b', 'a.MENU_ID = b.ID');
        if ($this->input->post('menu')) {
            $this->db->where('a.MENU_ID', $this->input->post('menu'));
        }
        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if (isset($_POST['search']['value'])) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('b.SEQUENCE', 'ASC');
            $this->db->order_by('a.ID', 'ASC');
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
        $this->db->from('user_sub_menu');
        return $this->db->count_all_results();
    }
}
