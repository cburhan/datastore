<?php
class Kit_fsru_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //FSRU
    var $select_column = array('ID', 'FSRU', 'IS_ACTIVE');
    var $order_column = array('ID', 'FSRU');

    public function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from('pembangkit_fsru');

        if (isset($_POST['search']['value'])) {
            $this->db->like('FSRU', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('FSRU', 'ASC');
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
        $this->db->from('pembangkit_fsru');
        return $this->db->count_all_results();
    }

    public function getFsru()
    {
        $this->db->select('*');
        $this->db->from('pembangkit_fsru');
        $this->db->order_by('FSRU ASC');
        return $this->db->get();
    }

    public function getFsruById($id)
    {
        $this->db->select('*');
        $this->db->from('pembangkit_fsru');
        $this->db->where('ID', $id);
        return $this->db->get();
    }

    public function addFsru($data)
    {
        $this->db->insert('pembangkit_fsru', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function editFsru($data, $id)
    {
        $update = $this->db->update('pembangkit_fsru', $data, array('ID' => $id));
        return $update;
    }

    public function deleteFsru($id)
    {
        try {
            $this->db->db_debug = FALSE;
            $delete = $this->db->delete('pembangkit_fsru', array('ID' => $id));
            return $delete;
        } catch (Exception $e) {
            return false;
        }
    }
}
