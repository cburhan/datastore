<?php
class Log_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //USER
    var $select_column = array('ID', 'MODUL', 'ACTION', 'KETERANGAN', 'BROWSER', 'VER', 'IP', 'PLATFORM', 'CREATED_ON', 'USER_ID', 'USER', 'COLOR');
    var $order_column = array('CREATED_ON');

    public function make_query($user_id = NULL)
    {
        $this->db->select($this->select_column);
        $this->db->from('user_activity_log');
        if ($user_id != NULL) {
            $this->db->where('USER_ID', $user_id);
        }

        if (isset($_POST['search']['value'])) {
            $this->db->group_start();
            $this->db->like('USER', $_POST['search']['value']);
            $this->db->or_like('MODUL', $_POST['search']['value']);
            $this->db->or_like('KETERANGAN', $_POST['search']['value']);
            $this->db->group_end();
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('CREATED_ON', 'DESC');
        }
    }

    public function make_datatables($user_id = NULL)
    {
        $this->make_query($user_id);

        if (isset($_POST['length']) && isset($_POST['start'])) {
            if ($_POST['length'] != -1) {
                $this->db->limit($_POST['length'], $_POST['start']);
            }
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data($user_id = NULL)
    {
        $this->make_query($user_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_all_data($user_id = NULL)
    {
        $this->db->select('*');
        $this->db->from('user_activity_log');
        if ($user_id != NULL) {
            $this->db->where('USER_ID', $user_id);
        }
        return $this->db->count_all_results();
    }

    public function getUserActivity($user_id)
    {
        $this->db->select('*');
        $this->db->from('user_activity_log');
        $this->db->where('USER_ID', $user_id);
        $this->db->order_by('CREATED_ON', 'DESC');
        $this->db->limit(5);
        return $this->db->get();
    }
}
