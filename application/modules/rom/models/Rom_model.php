<?php
class Rom_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //MENU
    var $select_column = array('ID', 'WEEK', 'BULAN', 'BLN', 'TAHUN', 'FILE', 'TIPE', 'CREATED_BY', 'CREATED_ON');
    var $order_column = array('ID', 'TAHUN', 'TIPE', 'CREATED_BY');

    public function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from('rom');

        if (isset($_POST['search']['value'])) {
            $this->db->group_start();
            $this->db->like('TAHUN', $_POST['search']['value']);
            $this->db->or_like('BULAN', $_POST['search']['value']);
            $this->db->or_like('FILE', $_POST['search']['value']);
            $this->db->or_like('CREATED_BY', $_POST['search']['value']);
            $this->db->group_end();
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('TAHUN', 'DESC');
            $this->db->order_by('BLN', 'DESC');
            $this->db->order_by('WEEK', 'DESC');
            $this->db->order_by('TIPE', 'DESC');
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
        $this->db->from('rob');
        return $this->db->count_all_results();
    }

    public function getRomById($rom_id)
    {
        $this->db->select('*');
        $this->db->from('rom');
        $this->db->where('ID', $rom_id);
        return $this->db->get()->row_array();
    }

    public function addRom($data)
    {
        $this->db->insert('rom', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function editRom($data, $rom_id)
    {
        $update = $this->db->update('rom', $data, array('ID' => $rom_id));
        return $update;
    }

    public function deleteRom($rom_id)
    {
        try {
            $this->db->db_debug = FALSE;
            $delete = $this->db->delete('rom', array('ID' => $rom_id));
            return $delete;
        } catch (Exception $e) {
            return false;
        }
    }
}
