<?php

class api_model extends CI_Model {


    public function checkregisterdaily($phone, $schedule_class_id)
    {
        $this->db->select('*');
        $this->db->from('transaction_register_daily');
        $this->db->join('transaction_register', 'transaction_register_daily.transaction_register_id = transaction_register.transaction_register_id');
        $this->db->join('ms_member', 'transaction_register.member_id = ms_member.member_id');
        $this->db->where('member_phone', $phone);
        $this->db->where('transaction_register_daily.schedule_class_id', $schedule_class_id);
        $query = $this->db->get();
        return $query;
    }

}

?>