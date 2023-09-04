<?php
class Sub_menu_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //SUB MENU
    var $select_column = array('a.ID', 'a.TITLE', 'a.SUB_MENU', 'a.URL', 'a.IS_ACTIVE', 'b.MENU');
    var $order_column = array('a.ID', 'b.MENU');

    public function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from('user_sub_menu a');
        $this->db->join('user_menu b', 'b.ID = a.MENU_ID');

        if (isset($_POST['search']['value'])) {
            $this->db->like('b.MENU', $_POST['search']['value']);
            $this->db->or_like('a.TITLE', $_POST['search']['value']);
            $this->db->or_like('a.SUB_MENU', $_POST['search']['value']);
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

    public function getSubMenu()
    {
        $this->db->select('a.ID, a.TITLE, a.URL, a.IS_ACTIVE, a.CLASS_METHOD, b.MENU, a.SUB_MENU');
        $this->db->from('user_sub_menu a');
        $this->db->join('user_menu b', 'a.MENU_ID = b.ID');
        $this->db->order_by('b.SEQUENCE', 'ASC');
        $this->db->order_by('a.ID', 'ASC');
        return $this->db->get();
    }

    public function getSubMenuById($sub_menu_id)
    {
        $this->db->select('ID, TITLE, SUB_MENU, URL, CLASS_METHOD, MENU_ID');
        $this->db->from('user_sub_menu');
        $this->db->where('ID', $sub_menu_id);
        return $this->db->get();
    }

    public function addSubMenu($data)
    {
        $this->db->insert('user_sub_menu', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function editSubMenu($data, $submenu_id)
    {
        $update = $this->db->update('user_sub_menu', $data, array('ID' => $submenu_id));
        return $update;
    }

    public function deleteSubMenu($menu_id)
    {
        try {
            $this->db->db_debug = FALSE;
            $delete = $this->db->delete('user_sub_menu', array('ID' => $menu_id));
            return $delete;
        } catch (Exception $e) {
            return false;
        }
    }
}
