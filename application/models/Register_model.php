<?php

class register_model extends CI_Model {

    public function register_list($search, $length, $start)
    {
        $this->db->select('*');
        $this->db->from('transaction_register');
        $this->db->join('ms_member', 'transaction_register.member_id = ms_member.member_id');
        if($search != null){
            $this->db->where('transaction_register_inv like "%'.$search.'%"');
            $this->db->or_where('member_name like "%'.$search.'%"');
        }
        $this->db->limit($length);
        $this->db->offset($start);
        $query = $this->db->get();
        return $query;
    }

    public function register_list_count($search)
    {
        $this->db->select('count(*) as total_row');
        $this->db->from('transaction_register');
        $this->db->join('ms_member', 'transaction_register.member_id = ms_member.member_id');
        if($search != null){
            $this->db->where('transaction_register_inv like "%'.$search.'%"');
            $this->db->or_where('member_name like "%'.$search.'%"');
        }
        $query = $this->db->get();
        return $query;
    }

    public function save_member_kuisioner($data_insert_kuisioner)
    {
        $this->db->trans_start();
        $this->db->insert('ms_member_question', $data_insert_kuisioner);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

}

?>