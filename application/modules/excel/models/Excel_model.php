<?php
class Excel_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //TEMPLATE
    var $select_column = array('ID', 'TEMPLATE', 'FILE', 'STATUS');
    var $order_column = array('ID', 'TEMPLATE', 'FILE', 'STATUS');

    public function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from('master_template');

        if (isset($_POST['search']['value'])) {
            $this->db->group_start();
            $this->db->like('TEMPLATE', $_POST['search']['value']);
            $this->db->group_end();
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('TEMPLATE');
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
        $this->db->from('master_template');
        return $this->db->count_all_results();
    }

    public function getExcelById($id)
    {
        $this->db->select('*');
        $this->db->from('master_template');
        $this->db->where('ID', $id);
        return $this->db->get()->row_array();
    }

    public function addExcel($data)
    {
        $this->db->insert('master_template', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function editExcel($data, $id)
    {
        $update = $this->db->update('master_template', $data, array('ID' => $id));
        return $update;
    }

    public function deleteExcel($id)
    {
        try {
            $this->db->db_debug = FALSE;
            $delete = $this->db->delete('master_template', array('ID' => $id));
            return $delete;
        } catch (Exception $e) {
            return false;
        }
    }
}
