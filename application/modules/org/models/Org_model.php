<?php
class Org_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //ORG
    var $select_column = array('ID', 'SHORT_ORG', 'LONG_ORG', 'PARENT_ID', 'LEVEL', 'IS_ACTIVE');
    var $order_column = array('ID');

    public function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from('org');
        // $this->db->join('user_role c', 'b.ROLE_ID = c.ID');

        if (isset($_POST['search']['value'])) {
            $this->db->like('SHORT_ORG', $_POST['search']['value']);
            $this->db->or_like('LONG_ORG', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('PARENT_ID', 'ASC');
            $this->db->order_by('LONG_ORG', 'ASC');
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
        $this->db->from('org');
        return $this->db->count_all_results();
    }

    public function getOrgByLevel($level)
    {
        return $this->db->get_where('org', array('LEVEL' => $level))->result_array();
    }

    public function getOrg()
    {
        $this->db->select('*');
        $this->db->from('org');
        $this->db->where('ID!=', 1);
        return $this->db->get();
    }

    public function getOrgAll()
    {
        $this->db->select('*');
        $this->db->from('org');
        return $this->db->get();
    }

    public function addOrg($data)
    {
        $this->db->insert('org', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return NULL;
        }
    }

    public function editOrg($data, $org_id)
    {
        $update = $this->db->update('org', $data, array('ID' => $org_id));
        return $update;
    }

    public function deleteOrg($org_id)
    {
        try {
            $this->db->db_debug = FALSE;
            $delete = $this->db->delete('org', array('ID' => $org_id));
            return $delete;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getOrgById($id)
    {
        $this->db->select('*');
        $this->db->from('org');
        $this->db->where('ID', $id);
        return $this->db->get();
    }

    public function get_parent_by_child($id)
    {
        $child = $this->db->get_where('org', array('ID' => $id))->row_array();
        if (!empty($child)) {
            return $this->get_parent_recursive($child['PARENT_ID']);
        }
        return array(); // Jika child tidak ditemukan atau tidak memiliki parent
    }

    private function get_parent_recursive($parent_id)
    {
        $parent = $this->db->get_where('org', array('ID' => $parent_id))->row_array();
        if (!empty($parent)) {
            $result = $this->get_parent_recursive($parent['PARENT_ID']);
            $result[] = $parent;
            return $result;
        }
        return array(); // Jika parent tidak ditemukan atau mencapai root
    }
}
