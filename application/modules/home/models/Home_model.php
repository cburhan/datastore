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
