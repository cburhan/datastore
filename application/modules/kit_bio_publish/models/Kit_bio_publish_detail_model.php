<?php
class Kit_bio_publish_detail_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //PUBLISH BIO HISTORICAL
    var $select_column = array('ID', 'KODE_PEMBANGKIT', 'NAMA_PEMBANGKIT', 'FILE_ID', 'TAHUN', 'TARGET_PEMAKAIAN_BIO', 'INTENSITAS_EMISI_BIO', 'KAPASITAS_MAX_PENYIMPANAN_BIO', 'KAPASITAS_MAX_BONGKAR_HARIAN_BIO');
    var $order_column = array('ID', 'KODE_PEMBANGKIT', 'NAMA_PEMBANGKIT', 'FILE_ID');

    public function make_query($id)
    {
        $this->db->select($this->select_column);
        $this->db->from('pembangkit_bio_publish');
        $this->db->where('FILE_ID', $id);

        if (isset($_POST['search']['value'])) {
            $this->db->like('NAMA_PEMBANGKIT', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('KODE_PEMBANGKIT', 'ASC');
        }
    }

    public function make_datatables($id)
    {
        $this->make_query($id);

        if (isset($_POST['length']) && isset($_POST['start'])) {
            if ($_POST['length'] != -1) {
                $this->db->limit($_POST['length'], $_POST['start']);
            }
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data($id)
    {
        $this->make_query($id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_all_data($id)
    {
        $this->db->select('*');
        $this->db->from('pembangkit_bio_publish');
        $this->db->where('FILE_ID', $id);
        return $this->db->count_all_results();
    }
}
