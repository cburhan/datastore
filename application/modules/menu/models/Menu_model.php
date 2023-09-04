<?php
class Menu_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //MENU
    var $select_column = array('ID', 'MENU', 'ICON', 'SEQUENCE');
    var $order_column = array('ID', 'MENU');

    public function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from('user_menu');

        if (isset($_POST['search']['value'])) {
            $this->db->like('MENU', $_POST['search']['value']);
            $this->db->or_like('ICON', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('SEQUENCE', 'ASC');
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
        $this->db->from('user_menu');
        return $this->db->count_all_results();
    }

    public function getMenu()
    {
        $this->db->select('ID, MENU, ICON, SEQUENCE');
        $this->db->from('user_menu');
        $this->db->order_by('SEQUENCE ASC');
        return $this->db->get();
    }

    public function getMenuById($menu_id)
    {
        $this->db->select('ID, MENU, ICON, SEQUENCE');
        $this->db->from('user_menu');
        $this->db->where('ID', $menu_id);
        return $this->db->get();
    }

    public function addMenu($data)
    {
        $this->db->insert('user_menu', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function editMenu($data, $menu_id)
    {
        $update = $this->db->update('user_menu', $data, array('ID' => $menu_id));
        return $update;
    }

    public function deleteMenu($menu_id)
    {
        try {
            $this->db->db_debug = FALSE;
            $delete = $this->db->delete('user_menu', array('ID' => $menu_id));
            return $delete;
        } catch (Exception $e) {
            return false;
        }
    }
}
