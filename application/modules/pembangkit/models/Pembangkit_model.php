<?php
class Pembangkit_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //PEMABNGKIT
    var $select_column = array('ID', 'KODE_PEMBANGKIT', 'NAMA_PEMBANGKIT', 'KEPEMILIKAN', 'DAYA_TERPASANG', 'REGIONAL', 'SISTEM', 'IS_ACTIVE', 'SEQUENCE');
    var $order_column = array('ID', 'KODE_PEMBANGKIT', 'NAMA_PEMBANGKIT', 'KEPEMILIKAN', 'DAYA_TERPASANG', 'REGIONAL', 'SISTEM', 'IS_ACTIVE', 'SEQUENCE');

    public function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from('pembangkit');

        if (isset($_POST['search']['value'])) {
            $this->db->group_start();
            $this->db->like('KODE_PEMBANGKIT', $_POST['search']['value']);
            $this->db->or_like('NAMA_PEMBANGKIT', $_POST['search']['value']);
            $this->db->or_like('DAYA_TERPASANG', $_POST['search']['value']);
            $this->db->or_like('REGIONAL', $_POST['search']['value']);
            $this->db->or_like('SISTEM', $_POST['search']['value']);
            $this->db->group_end();
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
        $this->db->from('pembangkit');
        return $this->db->count_all_results();
    }

    public function getPembangkit()
    {
        $this->db->select('*');
        $this->db->from('pembangkit');
        $this->db->order_by('ID ASC');
        return $this->db->get();
    }

    public function getPembangkitById($pembangkit_id)
    {
        $this->db->select('*');
        $this->db->from('pembangkit');
        $this->db->where('ID', $pembangkit_id);
        return $this->db->get();
    }

    public function getPembangkitByKode($kode)
    {
        $this->db->select('*');
        $this->db->from('pembangkit');
        $this->db->where('KODE_PEMBANGKIT', $kode);
        return $this->db->get();
    }

    public function addPembangkit($data)
    {
        $this->db->insert('pembangkit', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function editPembangkit($data, $pembangkit_id)
    {
        $update = $this->db->update('pembangkit', $data, array('ID' => $pembangkit_id));
        return $update;
    }

    public function deletePembangkit($pembangkit_id)
    {
        try {
            $this->db->db_debug = FALSE;
            $delete = $this->db->delete('pembangkit', array('ID' => $pembangkit_id));
            return $delete;
        } catch (Exception $e) {
            return false;
        }
    }

    public function addPembangkitPublish($data)
    {
        $this->db->insert('pembangkit_publish', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function addPembangkitPublishFile($data)
    {
        $this->db->insert('pembangkit_publish_file', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function editPembangkitPublishFile($data, $id)
    {
        $update = $this->db->update('pembangkit_publish_file', $data, array('ID' => $id));
        return $update;
    }

    public function getPembangkitPublish()
    {
        $this->db->select('KODE_PEMBANGKIT, TIPE, NAMA_PEMBANGKIT, KEPEMILIKAN, DAYA_TERPASANG, SISTEM, REGIONAL, IS_BATUBARA, IS_GASPIPA, IS_LNG, IS_BIOMASA, IS_BBM, ID_BBO, KODE_MESIN, IS_ACTIVE');
        $this->db->from('pembangkit');
        $this->db->order_by('ID ASC');
        return $this->db->get();
    }
}
