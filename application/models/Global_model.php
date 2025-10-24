<?php

class global_model extends CI_Model {

    public function save($data_insert_act)
    {
        $this->db->insert('activity_table', $data_insert_act);
    }

    public function check_access($user_role_id, $modul){
        $query = $this->db->query("select * from ms_role a, ms_role_permision b, ms_module c where a.role_id = b.role_id and b.module_id = c.module_id and a.role_id = '".$user_role_id."' and module_name = '".$modul."';");
        $result = $query->result();
        return $result;
    }

    public function coach_list(){
        $query = $this->db->query("select * from ms_coach where coach_active = 'Y'");
        $result = $query->result();
        return $result;
    }

    public function class_list(){
        $query = $this->db->query("select * from ms_class where class_active = 'Y'");
        $result = $query->result();
        return $result;
    }
    public function class_list_schedule(){
        $query = $this->db->query("select * from ms_class a, schedule_class b, ms_coach c where a.class_id = b.class_id and b.coach_id = c.coach_id and schedule_active = 'Y'");
        $result = $query->result();
        return $result;
    }

    public function get_schedule_class_info($schedule_class_id)
    {
        $query = $this->db->query("select * from ms_class a, schedule_class b, ms_coach c where a.class_id = b.class_id and b.coach_id = c.coach_id and schedule_active = 'Y' and schedule_class_id  = '".$schedule_class_id."'");
        $result = $query->result();
        return $result;
    }

    public function pt_list()
    {
        $query = $this->db->query("select * from ms_coach where coach_type = 'PT' and coach_active = 'Y'");
        $result = $query->result();
        return $result;
    }

    public function promo_list(){
        $query = $this->db->query("select * from ms_promo where ms_promo_active = 'Y'");
        $result = $query->result();
        return $result;
    }

    public function select_class($class_package){
        $query = $this->db->query("select * from ms_class where class_id  = '".$class_package."'");
        $result = $query->result();
        return $result;
    }

    public function select_promo($promo_id)
    {
        $query = $this->db->query("select * from ms_promo where ms_promo_id = '".$promo_id."' and ms_promo_active = 'Y'");
        $result = $query->result();
        return $result;
    }

    public function pt_package()
    {
        $query = $this->db->query("select * from ms_pt_package where ms_pt_package_active = 'Y'");
        $result = $query->result();
        return $result;
    }

    public function payment_list()
    {
        $query = $this->db->query("select * from ms_payment where payment_active = 'Y'");
        $result = $query->result();
        return $result;
    }

}

?>