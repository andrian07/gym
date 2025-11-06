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
        $this->db->where('transaction_type', 'Member');
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
        $this->db->where('transaction_type', 'Member');
        $query = $this->db->get();
        return $query;
    }

    public function register_daily_list($search, $length, $start)
    {
        $this->db->select('*');
        $this->db->from('transaction_register');
        $this->db->join('ms_member', 'transaction_register.member_id = ms_member.member_id');
        $this->db->join('transaction_register_daily', 'transaction_register.transaction_register_id = transaction_register_daily.transaction_register_id');
        if($search != null){
            $this->db->where('transaction_register_inv like "%'.$search.'%"');
            $this->db->or_where('member_name like "%'.$search.'%"');
        }
        $this->db->where('transaction_type', 'Daily');
        $this->db->limit($length);
        $this->db->offset($start);
        $query = $this->db->get();
        return $query;
    }

    public function register_daily_list_count($search)
    {
        $this->db->select('count(*) as total_row');
        $this->db->from('transaction_register');
        $this->db->join('ms_member', 'transaction_register.member_id = ms_member.member_id');
        $this->db->join('transaction_register_daily', 'transaction_register.transaction_register_id = transaction_register_daily.transaction_register_id');
        if($search != null){
            $this->db->where('transaction_register_inv like "%'.$search.'%"');
            $this->db->or_where('member_name like "%'.$search.'%"');
        }
        $this->db->where('transaction_type', 'Daily');
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

    public function save_register($data_insert)
    {
        $this->db->trans_start();
        $this->db->insert('transaction_register', $data_insert);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    public function save_register_detail($data_insert_detail)
    {
        $this->db->trans_start();
        $this->db->insert('transaction_register_detail', $data_insert_detail);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    public function last_register()
    {
        $query = $this->db->query("select transaction_register_inv from transaction_register order by transaction_register_id  desc limit 1");
        $result = $query->result();
        return $result;
    }

    public function get_register($transaction_register_id)
    {
        $query = $this->db->query("select * from transaction_register a, ms_member c where a.member_id = c.member_id and a.transaction_register_id = '".$transaction_register_id."'");
        $result = $query->result();
        return $result;
    }

    public function get_detail_register($transaction_register_id)
    {
        $query = $this->db->query("select * from transaction_register_detail join ms_class on transaction_register_detail.class_id = ms_class.class_id left join ms_coach on transaction_register_detail.transaction_register_coach_id = ms_coach.coach_id and transaction_register_id = '".$transaction_register_id."';");
        $result = $query->result();
        return $result;
    }

    public function get_promo_info($promo_id)
    {
        $this->db->select('*');
        $this->db->from('ms_promo');
        $this->db->where('ms_promo_id', $promo_id);
        $query = $this->db->get();
        return $query;
    }

    public function get_member_info($member_id)
    {
        $this->db->select('*');
        $this->db->from('ms_member');
        $this->db->where('member_id', $member_id);
        $query = $this->db->get();
        return $query;
    }

    public function get_class_info($class_id)
    {
        $this->db->select('*');
        $this->db->from('ms_class');
        $this->db->where('class_id', $class_id);
        $query = $this->db->get();
        return $query;
    }

    public function get_pt_info($pt_id)
    {
        $this->db->select('*');
        $this->db->from('ms_coach');
        $this->db->where('coach_id ', $pt_id);
        $query = $this->db->get();
        return $query;
    }

    public function get_pt_info_month($package_sesion)
    {
        $this->db->select('*');
        $this->db->from('ms_pt_package');
        $this->db->where('ms_pt_package_session ', $package_sesion);
        $query = $this->db->get();
        return $query;
    }

}

?>