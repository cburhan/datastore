<?php
class Kit_bio_historical_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //BIO HISTORICAL
    var $select_column = array('ID', 'TAHUN', 'KODE_PEMBANGKIT', 'NAMA_PEMBANGKIT', 'TARGET_PEMAKAIAN_BIO', 'INTENSITAS_EMISI_BIO', 'KAPASITAS_MAX_PENYIMPANAN_BIO', 'KAPASITAS_MAX_BONGKAR_HARIAN_BIO');
    var $order_column = array('ID', 'TAHUN');

    public function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from('pembangkit_bio_historical');

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
            $this->db->order_by('KODE_PEMBANGKIT', 'ASC');
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
        $this->db->from('pembangkit_bio_historical');
        return $this->db->count_all_results();
    }

    public function getBioHistorical()
    {
        $this->db->select('*');
        $this->db->from('pembangkit_bio_historical');
        $this->db->order_by('TAHUN ASC');
        return $this->db->get();
    }

    public function getBioHistoricalById($id)
    {
        $this->db->select('*');
        $this->db->from('pembangkit_bio_historical');
        $this->db->where('ID', $id);
        return $this->db->get();
    }

    public function addBioHistorical($data)
    {
        $this->db->insert('pembangkit_bio_historical', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function editBioHistorical($data, $id)
    {
        $update = $this->db->update('pembangkit_bio_historical', $data, array('ID' => $id));
        return $update;
    }

    public function deleteBioHistorical($id)
    {
        try {
            $this->db->db_debug = FALSE;
            $delete = $this->db->delete('pembangkit_bio_historical', array('ID' => $id));
            return $delete;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getBioHistoricalExist($tahun, $kit)
    {
        $this->db->select('*');
        $this->db->from('pembangkit_bio_historical');
        $this->db->where('TAHUN', $tahun);
        $this->db->where('PEMBANGKIT_ID', $kit);
        return $this->db->get();
    }

    //KIT BIO
    public function getPembangkitBio()
    {
        $this->db->select('*');
        $this->db->from('pembangkit');
        $this->db->where('IS_BIOMASA', 1);
        return $this->db->get();
    }

    //PUBLISH
    public function addBioHistoricalPublish($data)
    {
        $this->db->insert('pembangkit_bio_publish', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function addBioHistoricalPublishFile($data)
    {
        $this->db->insert('pembangkit_bio_publish_file', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function editBioHistoricalPublishFile($data, $id)
    {
        $update = $this->db->update('pembangkit_bio_publish_file', $data, array('ID' => $id));
        return $update;
    }

    public function getBioHistoricalPublish()
    {
        $this->db->select('KODE_PEMBANGKIT, NAMA_PEMBANGKIT, TAHUN, TARGET_PEMAKAIAN_BIO, INTENSITAS_EMISI_BIO, KAPASITAS_MAX_PENYIMPANAN_BIO, KAPASITAS_MAX_BONGKAR_HARIAN_BIO');
        $this->db->from('pembangkit_bio_historical');
        $this->db->order_by('ID ASC');
        return $this->db->get();
    }
}
