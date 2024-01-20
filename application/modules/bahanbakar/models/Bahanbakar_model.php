<?php
class Bahanbakar_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //BAHAN BAKAR
    var $select_column = array('ID', 'KODE_BAHAN_BAKAR', 'NAMA_BAHAN_BAKAR');
    var $order_column = array('ID', 'KODE_BAHAN_BAKAR', 'NAMA_BAHAN_BAKAR');

    public function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from('bahan_bakar');

        if (isset($_POST['search']['value'])) {
            $this->db->like('KODE_BAHAN_BAKAR', $_POST['search']['value']);
            $this->db->or_like('NAMA_BAHAN_BAKAR', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
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
        $this->db->from('bahan_bakar');
        return $this->db->count_all_results();
    }

    public function getBahanBakar()
    {
        $this->db->select('*');
        $this->db->from('bahan_bakar');
        $this->db->order_by('ID ASC');
        return $this->db->get();
    }

    public function getBahanBakarById($bahanbakar_id)
    {
        $this->db->select('*');
        $this->db->from('bahan_bakar');
        $this->db->where('ID', $bahanbakar_id);
        return $this->db->get();
    }

    public function getBahanBakarByKode($kode)
    {
        $this->db->select('*');
        $this->db->from('bahan_bakar');
        $this->db->where('KODE_BAHAN_BAKAR', $kode);
        return $this->db->get();
    }

    public function addBahanBakar($data)
    {
        $this->db->insert('bahan_bakar', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function editBahanBakar($data, $bahanbakar_id)
    {
        $update = $this->db->update('bahan_bakar', $data, array('ID' => $bahanbakar_id));
        return $update;
    }

    public function deleteBahanBakar($bahanbakar_id)
    {
        try {
            $this->db->db_debug = FALSE;
            $delete = $this->db->delete('bahan_bakar', array('ID' => $bahanbakar_id));
            return $delete;
        } catch (Exception $e) {
            return false;
        }
    }
}
