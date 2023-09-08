<?php
class BioMaster_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //BIO MASTER
    var $select_column = array('ID', 'TIPE', 'TIPE_TEXT', 'TIPE_COLOR', 'FILE', 'CREATED_BY', 'CREATED_ON');
    var $order_column = array('ID', 'CREATED_BY');

    public function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from('bio_master');

        if (isset($_POST['search']['value'])) {
            $this->db->group_start();
            $this->db->like('TIPE_TEXT', $_POST['search']['value']);
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
        $this->db->from('bio_master');
        return $this->db->count_all_results();
    }

    public function getBioMasterById($rob_id)
    {
        $this->db->select('*');
        $this->db->from('bio_master');
        $this->db->where('ID', $rob_id);
        return $this->db->get()->row_array();
    }

    public function addBioMaster($data)
    {
        $this->db->insert('bio_master', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function editBioMaster($data, $rob_id)
    {
        $update = $this->db->update('bio_master', $data, array('ID' => $rob_id));
        return $update;
    }

    public function deleteBioMaster($rob_id)
    {
        try {
            $this->db->db_debug = FALSE;
            $delete = $this->db->delete('bio_master', array('ID' => $rob_id));
            return $delete;
        } catch (Exception $e) {
            return false;
        }
    }
}
