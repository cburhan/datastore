<?php
class Notif_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //Notif
    var $select_column = array(
        'ID', 'TO_ID', 'FROM', 'SUBJECT', 'MESSAGE', 'ICON', 'COLOR',
        'URL', 'STATUS', 'CREATED_ON', 'TO'
    );
    var $order_column = array('ID', 'TO_ID', 'FROM');

    public function make_query($user_id = NULL)
    {
        $this->db->select($this->select_column);
        $this->db->from('notif');
        $this->db->where('TO_ID', $user_id);

        if (isset($_POST['search']['value'])) {
            $this->db->group_start();
            $this->db->like('SUBJECT', $_POST['search']['value']);
            $this->db->or_like('MESSAGE', $_POST['search']['value']);
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
        $this->db->from('notif');
        $this->db->where('TO_ID', $user_id);
        return $this->db->count_all_results();
    }

    public function getNotifUnread($id)
    {
        $this->db->select('*');
        $this->db->from('notif');
        $this->db->where('TO_ID', $id);
        $this->db->where('STATUS', 'UNREAD');
        $this->db->order_by('ID', 'DESC');
        return $this->db->get();
    }

    public function getNotifById($id)
    {
        $this->db->select('*');
        $this->db->from('notif');
        $this->db->where('ID', $id);
        return $this->db->get();
    }

    public function addNotif($data)
    {
        $this->db->insert('notif', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function editNotif($data, $id)
    {
        $update = $this->db->update('notif', $data, array('ID' => $id));
        return $update;
    }

    public function editNotifbyURL($data, $url)
    {
        $update = $this->db->update('notif', $data, array('URL' => $url));
        return $update;
    }
}
