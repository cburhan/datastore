<?php
class Rob_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //MENU
    var $select_column = array(
        'ID', 'KODE_PEMBANGKIT', 'NAMA_PEMBANGKIT', 'CREATED_BY', 'CREATED_ON', 'CHANGED_BY', 'CHANGED_ON',
        'BULAN', 'TAHUN', 'RENCANA_PEMBEBANAN', 'MERIT_ORDER', 'TAHUN', 'CF',
        'SISTEM', 'BAHAN_BAKAR'
    );
    var $order_column = array('ID', 'TAHUN', 'TIPE', 'CREATED_BY');

    public function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from('rob');

        if (isset($_POST['search']['value'])) {
            $this->db->group_start();
            $this->db->like('TAHUN', $_POST['search']['value']);
            $this->db->or_like('BULAN', $_POST['search']['value']);
            $this->db->or_like('CREATED_BY', $_POST['search']['value']);
            $this->db->group_end();
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('TAHUN', 'DESC');
            $this->db->order_by('SISTEM', 'DESC');
            $this->db->order_by('ID', 'ASC');
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

    public function getRob()
    {
        $this->db->select('*');
        $this->db->from('rob');
        $this->db->order_by('TAHUN ASC, BULAN ASC, SISTEM ASC, ID ASC');
        return $this->db->get();
    }

    public function getRobById($rob_id)
    {
        $this->db->select('*');
        $this->db->from('rob');
        $this->db->where('ID', $rob_id);
        return $this->db->get()->row_array();
    }

    public function addRob($data)
    {
        $this->db->insert('rob', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function editRob($data, $rob_id)
    {
        $update = $this->db->update('rob', $data, array('ID' => $rob_id));
        return $update;
    }

    public function editRobByKode($data, $kode, $bulan, $tahun)
    {
        $update = $this->db->update('rob', $data, array('KODE_PEMBANGKIT' => $kode, 'BULAN' => $bulan, 'TAHUN' => $tahun));
        return $update;
    }

    public function deleteRob($rob_id)
    {
        try {
            $this->db->db_debug = FALSE;
            $delete = $this->db->delete('rob', array('ID' => $rob_id));
            return $delete;
        } catch (Exception $e) {
            return false;
        }
    }
}
