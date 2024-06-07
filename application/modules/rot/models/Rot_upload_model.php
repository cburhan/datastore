<?php
class Rot_upload_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function file_uploaded()
    {
        $this->db->select('*');
        $this->db->from('rot_upload');
        $this->db->order_by('UPLOAD_ON DESC');
        return $this->db->get();
    }

    public function add_upload($data)
    {
        $this->db->insert('rot_upload', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function edit_upload($data, $file_id)
    {
        $update = $this->db->update('rot_upload', $data, array('ID' => $file_id));
        return $update;
    }

    public function get_file_by_id($file_id)
    {
        $this->db->select('ID, FILE, STATUS, UPLOAD_BY, UPLOAD_ON, EXECUTED_BY, EXECUTED_ON');
        $this->db->from('rot_upload');
        $this->db->where('ID', $file_id);
        return $this->db->get()->row_array();
    }

    public function get_log_upload($file_id)
    {
        $this->db->select('*');
        $this->db->from('rot_upload_log');
        $this->db->where('UPLOAD_ID', $file_id);
        return $this->db->get();
    }

    public function insert_log($data_log)
    {
        $this->db->insert('rot_upload_log', $data_log);
    }

    public function get_not_kit($kode, $tahun)
    {
        $this->db->where('KODE_PEMBANGKIT', $kode);
        $this->db->where('TAHUN', $tahun);
        $n = $this->db->get('rot');
        return $n;
    }
}
