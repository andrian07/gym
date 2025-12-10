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

    public function member_list(){
        $query = $this->db->query("select * from ms_member where member_active = 'Y'");
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

    public function get_class_schedule($class_name, $hari)
    {
        $query = $this->db->query("select * from ms_class a, schedule_class b where a.class_id = b.class_id and class_name = '".$class_name."' and schedule_day = '".$hari."'");
        $result = $query->result();
        return $result;
    }

    public function pt_list()
    {
        $query = $this->db->query("select * from ms_coach where coach_type = 'PT' and coach_active = 'Y'");
        $result = $query->result();
        return $result;
    }

    public function pt_price()
    {
        $query = $this->db->query("select * from ms_pt_price where ms_pt_price_active = 'Y'");
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

    public function pt_package_price()
    {
        $query = $this->db->query("select * from ms_pt_package_price where ms_pt_package_price_active = 'Y'");
        $result = $query->result();
        return $result;
    }
    
    public function payment_list()
    { 
        $query = $this->db->query("select * from ms_payment where payment_active = 'Y'");
        $result = $query->result();
        return $result;
    }

    public function get_ms_pt_price($ms_pt_price_id)
    {
        $query = $this->db->query("select * from ms_pt_price where ms_pt_price_id  = '".$ms_pt_price_id."'");
        $result = $query->result();
        return $result;
    }

    public function gym_package()
    {
        $query = $this->db->query("select * from ms_gym_package where ms_gym_package_active = 'Y'");
        $result = $query->result();
        return $result;
    }

    public function class_package()
    {
        $query = $this->db->query("select * from ms_class_package where ms_class_package_active = 'Y'");
        $result = $query->result();
        return $result;
    }

    public function sales_list()
    {
        $query = $this->db->query("select * from ms_user a, ms_role b where a.user_role = b.role_id and b.role_name = 'Sales'");
        $result = $query->result();
        return $result;
    }

    public function role_list()
    {
        $this->db->select('*');
        $this->db->from('ms_role');
        $this->db->where('is_active', 'Y');
        $query = $this->db->get();
        return $query;
    }

    public function get_absence($title)
    {
        $this->db->select('*');
        $this->db->from('absence');
        $this->db->join('ms_class', 'ms_class.class_id = absence.absence_class_id');
        $this->db->where('absence_date = CURDATE()');
        $this->db->where('class_name', $title);
        $query = $this->db->get();
        return $query;
    }

    public function get_member_class($title, $hari, $name)
    {
        $this->db->select('ms_member.member_id, member_name, member_code, member_phone, class_name, schedule_day, schedule_time_start, "Member" as type_member, schedule_class.schedule_class_id , ms_class.class_id');
        $this->db->from('ms_class');
        $this->db->join('schedule_class', 'ms_class.class_id = schedule_class.class_id');
        $this->db->join('member_class', 'schedule_class.schedule_class_id = member_class.schedule_class_id');
        $this->db->join('ms_member', 'member_class.member_id = ms_member.member_id');
        $this->db->where('class_name', $title);
        $this->db->where('schedule_day', $hari);
        if($name != null){
            $this->db->where('(member_name like "%'.$name.'%" or member_phone like "%'.$name.'%")');
        }
        $this->db->where('member_active', 'Y');
        $query1 = $this->db->get_compiled_select();


        $this->db->select('ms_member.member_id, member_name, member_code, member_phone, class_name, schedule_day, schedule_time_start, "Non" as type_member, schedule_class.schedule_class_id, ms_class.class_id');
        $this->db->from('transaction_register_daily');
        $this->db->join('transaction_register', 'transaction_register_daily.transaction_register_id = transaction_register.transaction_register_id ');
        $this->db->join('schedule_class', 'transaction_register_daily.schedule_class_id = schedule_class.schedule_class_id');
        $this->db->join('ms_member', 'transaction_register.member_id = ms_member.member_id');
        $this->db->join('ms_class', 'schedule_class.class_id = ms_class.class_id');
        $this->db->where('class_name', $title);
        $this->db->where('schedule_day', $hari);
        if($name != null){
            $this->db->where('(member_name like "%'.$name.'%" or member_phone like "%'.$name.'%")');
        }
        $this->db->where('member_active', 'Y');
        $query2 = $this->db->get_compiled_select();

        $result = $this->db->query($query1 . ' UNION ' . $query2);
        return $result;
    }

    public function search_member($keyword)
    {
        $this->db->select('*');
        $this->db->from('ms_member');
        $this->db->where('(member_name like "%'.$keyword.'%" or member_phone like "%'.$keyword.'%")');
        $this->db->where('member_active', 'Y');
        $query = $this->db->get();
        return $query;
    }

    public function search_member_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('ms_member');
        $this->db->join('ms_member_question', 'ms_member.member_id = ms_member_question.member_id', 'left');
        $this->db->where('ms_member.member_id', $id);
        $this->db->where('member_active', 'Y');
        $query = $this->db->get();
        return $query;
    }

    public function search_ptselect($keyword, $id)
    {
        $this->db->select('*');
        $this->db->from('ms_coach');
        $this->db->where('(coach_name like "%'.$keyword.'%" or coach_code like "%'.$keyword.'%")');
        $this->db->where('coach_active', 'Y');
        $this->db->where('coach_type', 'PT');
        $this->db->where('coach_lvl', $id);
        $query = $this->db->get();
        return $query;
    }

}

?>