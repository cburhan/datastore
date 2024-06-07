<?php
class Kit_demand_bulanan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //ROT
    var $select_column = array(
        'ID', 'KODE_PEMBANGKIT', 'NAMA_PEMBANGKIT', 'CREATED_BY', 'CREATED_ON', 'CHANGED_BY', 'CHANGED_ON',
        'KEBUTUHAN_PEMBANGKIT', 'BULAN', 'TAHUN', 'CF',
        'SISTEM', 'BAHAN_BAKAR'
    );
    var $order_column = array('ID', 'BULAN', 'TAHUN');

    public function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from('kit_demand_bulanan');

        if (isset($_POST['search']['value'])) {
            $this->db->group_start();
            $this->db->like('KODE_PEMBANGKIT', $_POST['search']['value']);
            $this->db->or_like('NAMA_PEMBANGKIT', $_POST['search']['value']);
            $this->db->or_like('BULAN', $_POST['search']['value']);
            $this->db->or_like('TAHUN', $_POST['search']['value']);
            $this->db->group_end();
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('TAHUN', 'DESC');
            $this->db->order_by('BULAN', 'DESC');
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
        $this->db->from('kit_demand_bulanan');
        return $this->db->count_all_results();
    }

    public function getKitDemandBulanan()
    {
        $this->db->select('*');
        $this->db->from('kit_demand_bulanan');
        $this->db->order_by('TAHUN ASC, BULAN ASC, SISTEM ASC, ID ASC');
        return $this->db->get();
    }

    public function getKitDemandBulananById($rot_id)
    {
        $this->db->select('*');
        $this->db->from('kit_demand_bulanan');
        $this->db->where('ID', $rot_id);
        return $this->db->get()->row_array();
    }

    public function addKitDemandBulanan($data)
    {
        $this->db->insert('kit_demand_bulanan', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function editKitDemandBulanan($data, $rot_id)
    {
        $update = $this->db->update('kit_demand_bulanan', $data, array('ID' => $rot_id));
        return $update;
    }

    public function editKitDemandBulananByKode($data, $kode, $tahun, $bulan)
    {
        $update = $this->db->update('kit_demand_bulanan', $data, array('KODE_PEMBANGKIT' => $kode, 'TAHUN' => $tahun, 'BULAN' => $bulan));
        return $update;
    }

    public function deleteKitDemandBulanan($rot_id)
    {
        try {
            $this->db->db_debug = FALSE;
            $delete = $this->db->delete('kit_demand_bulanan', array('ID' => $rot_id));
            return $delete;
        } catch (Exception $e) {
            return false;
        }
    }
}
