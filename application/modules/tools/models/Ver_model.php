<?php
class Ver_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    var $select_column = array('ID', 'VER', 'TIPE', 'CREATED_BY', 'CREATED_ON');
    var $order_column = array('CREATED_ON');

    public function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from('apps_ver');

        if (isset($_POST['search']['value'])) {
            $this->db->group_start();
            $this->db->like('VER', $_POST['search']['value']);
            $this->db->or_like('TIPE', $_POST['search']['value']);
            $this->db->or_like('CREATED_BY', $_POST['search']['value']);
            $this->db->group_end();
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('CREATED_ON', 'DESC');
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
        $this->db->from('apps_ver');
        return $this->db->count_all_results();
    }

    public function max_major()
    {
        $this->db->select_max('MAJOR');
        $this->db->from('apps_ver');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function max_fitur()
    {
        $this->db->select_max('FITUR');
        $this->db->from('apps_ver');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function max_minor()
    {
        $this->db->select_max('MINOR');
        $this->db->from('apps_ver');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getVersion()
    {
        $this->db->select('*');
        $this->db->from('apps_ver');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getLastVersion()
    {
        $this->db->select('*');
        $this->db->from('apps_ver');
        $this->db->order_by('CREATED_ON', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
}
