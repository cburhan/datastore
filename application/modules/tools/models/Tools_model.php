<?php
class Tools_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //APPS
    public function getApps()
    {
        $this->db->select('ID, NAME, LOGO, LOGO_BIG, BG');
        $this->db->from('apps');
        $this->db->where('ID', 1);
        return $this->db->get();
    }

    public function editApps($data)
    {
        $update = $this->db->update('apps', $data, array('ID' => 1));
        return $update;
    }

    //BACKUP DB
    public function getBackupById($id)
    {
        $this->db->select('DB');
        $this->db->from('apps_db');
        $this->db->where('ID', $id);
        return $this->db->get()->row_array();
    }

    public function addBackup($data)
    {
        $this->db->insert('apps_db', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    //VERSION
    public function getVer()
    {
        $this->db->select('*');
        $this->db->from('apps_ver');
        $this->db->order_by('CREATED_ON', 'DESC');
        return $this->db->get();
    }

    public function addVer($data)
    {
        $this->db->insert('apps_ver', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function editVer($data, $id)
    {
        $update = $this->db->update('apps_ver', $data, array('ID' => $id));
        return $update;
    }

    public function getVerById($id)
    {
        $this->db->select('*');
        $this->db->from('apps_ver');
        $this->db->where('ID', $id);
        return $this->db->get()->row_array();
    }

    public function deleteVer($id)
    {
        try {
            $this->db->db_debug = FALSE;
            $delete = $this->db->delete('apps_ver', array('ID' => $id));
            return $delete;
        } catch (Exception $e) {
            return false;
        }
    }
}
