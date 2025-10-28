<?php

class transaction_model extends CI_Model {

    //daily
    public function save_transaction($data_insert_register)
    {
        $this->db->trans_start();
        $this->db->insert('transaction_register', $data_insert_register);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    public function save_transaction_daily($insert_transaction_register_daily)
    {
        $this->db->trans_start();
        $this->db->insert('transaction_register_daily', $insert_transaction_register_daily);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    public function get_class_id($schedule_class_id)
    {
        $query = $this->db->query("select * from schedule_class where schedule_class_id  = '".$schedule_class_id."'");
        $result = $query->result();
        return $result;
    }

    public function save_abssence($data_insert)
    {
        $this->db->trans_start();
        $this->db->insert('absence', $data_insert);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    //end daily


}

?>