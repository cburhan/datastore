<?php
class Kit_regional_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //REGIONAL PEMBANGKIT
    var $select_column = array('ID', 'REGIONAL', 'IS_ACTIVE');
    var $order_column = array('ID', 'REGIONAL');

    public function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from('pembangkit_regional');

        if (isset($_POST['search']['value'])) {
            $this->db->like('REGIONAL', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('REGIONAL', 'ASC');
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
        $this->db->from('pembangkit_regional');
        return $this->db->count_all_results();
    }

    public function getRegional()
    {
        $this->db->select('*');
        $this->db->from('pembangkit_regional');
        $this->db->order_by('ID ASC');
        return $this->db->get();
    }

    public function getRegionalById($id)
    {
        $this->db->select('*');
        $this->db->from('pembangkit_regional');
        $this->db->where('ID', $id);
        return $this->db->get();
    }

    public function addRegional($data)
    {
        $this->db->insert('pembangkit_regional', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function editRegional($data, $id)
    {
        $update = $this->db->update('pembangkit_regional', $data, array('ID' => $id));
        return $update;
    }

    public function deleteRegional($id)
    {
        try {
            $this->db->db_debug = FALSE;
            $delete = $this->db->delete('pembangkit_regional', array('ID' => $id));
            return $delete;
        } catch (Exception $e) {
            return false;
        }
    }
}
