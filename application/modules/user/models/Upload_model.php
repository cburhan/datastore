<?php
class Upload_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function file_uploaded()
    {
        $this->db->select('*');
        $this->db->from('upload_pegawai');
        $this->db->order_by('CREATED_ON DESC');
        return $this->db->get();
    }

    public function add_upload($data)
    {
        $this->db->insert('upload_pegawai', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function edit_upload($data, $file_id)
    {
        $update = $this->db->update('upload_pegawai', $data, array('ID' => $file_id));
        return $update;
    }

    public function get_file_by_id($file_id)
    {
        $this->db->select('ID, FILE, STATUS');
        $this->db->from('upload_pegawai');
        $this->db->where('ID', $file_id);
        return $this->db->get()->row_array();
    }

    public function get_log_upload($file_id)
    {
        $this->db->select('a.ID, a.UPLOAD_ID, a.NIP, a.USERNAME, a.FULLNAME, a.EMAIL, a.ORG_ID, a.SHORT_ORG, a.LONG_ORG, a.SHORT_TITLE, a.LONG_TITLE, a.TIPE');
        $this->db->from('upload_pegawai_log a');
        $this->db->join('upload_pegawai b', 'a.UPLOAD_ID = b.ID');
        $this->db->where('a.UPLOAD_ID', $file_id);
        return $this->db->get();
    }

    public function get_not_username($username)
    {
        $this->db->where('USERNAME', $username);
        $n = $this->db->get('user');
        return $n;
    }

    public function exe_upload($data)
    {
        $this->db->insert('user', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function insert_log($data_log)
    {
        $this->db->insert('upload_pegawai_log', $data_log);
    }
}
