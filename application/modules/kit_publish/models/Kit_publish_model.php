<?php
class Kit_publish_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //PUBLISH PEMBANGKIT
    var $select_column = array('ID', 'FILE', 'PUBLISH_BY', 'PUBLISH_ON');
    var $order_column = array('ID', 'FILE', 'PUBLISH_BY', 'PUBLISH_ON');

    public function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from('pembangkit_publish_file');

        if (isset($_POST['search']['value'])) {
            $this->db->like('PUBLISH_BY', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('PUBLISH_ON', 'DESC');
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
        $this->db->from('pembangkit_publish_file');
        return $this->db->count_all_results();
    }

    public function getPublishById($id)
    {
        $this->db->select('*');
        $this->db->from('pembangkit_publish_file');
        $this->db->where('ID', $id);
        return $this->db->get();
    }
}
