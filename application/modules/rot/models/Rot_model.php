<?php
class Rot_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //ROT
    var $select_column = array(
        'ID', 'KODE_PEMBANGKIT', 'NAMA_PEMBANGKIT', 'CREATED_BY', 'CREATED_ON', 'CHANGED_BY', 'CHANGED_ON',
        'JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AUG', 'SEP', 'OKT', 'NOV', 'DES', 'TAHUN', 'CF',
        'SISTEM', 'BAHAN_BAKAR'
    );
    var $order_column = array('ID', 'TAHUN');

    public function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from('rot');

        if (isset($_POST['search']['value'])) {
            $this->db->group_start();
            $this->db->like('KODE_PEMBANGKIT', $_POST['search']['value']);
            $this->db->or_like('NAMA_PEMBANGKIT', $_POST['search']['value']);
            $this->db->or_like('TAHUN', $_POST['search']['value']);
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
        $this->db->from('rot');
        return $this->db->count_all_results();
    }

    public function getRot()
    {
        $this->db->select('*');
        $this->db->from('rot');
        $this->db->order_by('TAHUN ASC, SISTEM ASC, ID ASC');
        return $this->db->get();
    }

    public function getRotById($rot_id)
    {
        $this->db->select('*');
        $this->db->from('rot');
        $this->db->where('ID', $rot_id);
        return $this->db->get()->row_array();
    }

    public function addRot($data)
    {
        $this->db->insert('rot', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function editRot($data, $rot_id)
    {
        $update = $this->db->update('rot', $data, array('ID' => $rot_id));
        return $update;
    }

    public function editRotByKode($data, $kode, $tahun)
    {
        $update = $this->db->update('rot', $data, array('KODE_PEMBANGKIT' => $kode, 'TAHUN' => $tahun));
        return $update;
    }

    public function deleteRot($rot_id)
    {
        try {
            $this->db->db_debug = FALSE;
            $delete = $this->db->delete('rot', array('ID' => $rot_id));
            return $delete;
        } catch (Exception $e) {
            return false;
        }
    }
}
