<?php
class Home_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getTotalRot()
    {
        $this->db->select('COUNT(ID) as ROT');
        $this->db->from('rot');
        return $this->db->get()->row_array();
    }

    public function getTotalRob()
    {
        $this->db->select('COUNT(ID) as ROB');
        $this->db->from('rob');
        return $this->db->get()->row_array();
    }

    public function getTotalRom()
    {
        $this->db->select('COUNT(ID) as ROM');
        $this->db->from('rom');
        return $this->db->get()->row_array();
    }

    public function getBioTrans()
    {
        $this->db->select('COUNT(ID) as BIO_T');
        $this->db->from('bio_trans');
        return $this->db->get()->row_array();
    }

    public function getBioMaster()
    {
        $this->db->select('COUNT(ID) as BIO_M');
        $this->db->from('bio_master');
        return $this->db->get()->row_array();
    }

    public function getGaspipaTrans()
    {
        $this->db->select('COUNT(ID) as GP_T');
        $this->db->from('gaspipa_trans');
        return $this->db->get()->row_array();
    }

    public function getGaspipaMaster()
    {
        $this->db->select('COUNT(ID) as GP_M');
        $this->db->from('gaspipa_master');
        return $this->db->get()->row_array();
    }

    public function getLngTrans()
    {
        $this->db->select('COUNT(ID) as LNG_T');
        $this->db->from('lng_trans');
        return $this->db->get()->row_array();
    }

    public function getLngMaster()
    {
        $this->db->select('COUNT(ID) as LNG_M');
        $this->db->from('lng_master');
        return $this->db->get()->row_array();
    }

    public function getBbmTrans()
    {
        $this->db->select('COUNT(ID) as BBM_T');
        $this->db->from('bbm_trans');
        return $this->db->get()->row_array();
    }

    public function getBbmMaster()
    {
        $this->db->select('COUNT(ID) as BBM_M');
        $this->db->from('bbm_master');
        return $this->db->get()->row_array();
    }

    public function getTotalUser()
    {
        $this->db->select('COUNT(ID) as U');
        $this->db->from('user');
        return $this->db->get()->row_array();
    }

    public function getLastRot()
    {
        $this->db->select('*');
        $this->db->from('rot');
        $this->db->order_by('ID', 'DESC');
        $this->db->limit(5);
        return $this->db->get()->result_array();
    }

    public function getLastRob()
    {
        $this->db->select('*');
        $this->db->from('rob');
        $this->db->order_by('ID', 'DESC');
        $this->db->limit(5);
        return $this->db->get()->result_array();
    }

    public function getLastRom()
    {
        $this->db->select('*');
        $this->db->from('rom');
        $this->db->order_by('ID', 'DESC');
        $this->db->limit(5);
        return $this->db->get()->result_array();
    }
}
