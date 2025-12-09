<?php

class masterdata_model extends CI_Model {

    //group
    public function save_role($data_insert)
    {
        $this->db->insert('ms_role', $data_insert);
    }

    public function get_setting_permission($id){
        $query = $this->db->query("select * from ms_role a, ms_role_permision b, ms_module c where a.role_id = b.role_id and b.module_id = c.module_id and a.role_id = '".$id."';");
        $result = $query->result();
        return $result;
    }

    public function save_permision($data_insert_permision)
    {
        $this->db->insert('ms_role_permision', $data_insert_permision);
    }
    
    public function group_role()
    {
        $query = $this->db->query("select * from ms_role where is_active = 'Y'");
        $result = $query->result();
        return $result;
    }

    public function update_role($data_update, $role_id)
    {
        $this->db->set($data_update);
        $this->db->where('role_id ', $role_id);
        $this->db->update('ms_role');
    }

    public function delete_role($role_id)
    {
        $this->db->set('is_active', 'N');
        $this->db->where('role_id ', $role_id);
        $this->db->update('ms_role');
    }

    public function check_role($role_name)
    {
        $query = $this->db->query("select * from ms_role where role_name = '".$role_name."' and is_active = 'Y'");
        $result = $query->result();
        return $result;
    }
    //end group
    

    //member
    public function member_list($search, $length, $start)
    {
        $this->db->select('*');
        $this->db->from('ms_member');
        if($search != null){
            $this->db->where('member_code like "%'.$search.'%"');
            $this->db->or_where('member_name like "%'.$search.'%"');
        }
        $this->db->limit($length);
        $this->db->offset($start);
        $query = $this->db->get();
        return $query;
    }

    public function member_list_count($search)
    {
        $this->db->select('count(*) as total_row');
        $this->db->from('ms_member');
        if($search != null){
            $this->db->where('member_code like "%'.$search.'%"');
            $this->db->or_where('member_name like "%'.$search.'%"');
        }
        $query = $this->db->get();
        return $query;
    }

    public function check_member_nik($member_nik)
    {
        $query = $this->db->query("select * from ms_member where member_nik='".$member_nik."'");
        $result = $query->result();
        return $result;
    }

    public function check_member_phone($member_phone)
    {
        $query = $this->db->query("select * from ms_member where member_phone='".$member_phone."'");
        $result = $query->result();
        return $result;
    }

    public function check_member_email($member_email)
    {
        $query = $this->db->query("select * from ms_member where member_email='".$member_email."'");
        $result = $query->result();
        return $result;
    }

    public function get_member_by_id($id)
    {
        $query = $this->db->query("select * from ms_member where member_id='".$id."'");
        $result = $query->result();
        return $result;
    }

    public function get_member_detail_by_id($id)
    {
        $query = $this->db->query("select * from ms_member where member_id='".$id."'");
        $result = $query->result();
        return $result;
    }

    public function get_quisioner_member_by_id($id)
    {
        $query = $this->db->query("select * from ms_member_question where member_id='".$id."'");
        $result = $query->result();
        return $result;
    }

    public function get_quisioner_member2_by_id($id)
    {
        $query = $this->db->query("select * from ms_member_question2 where member_id='".$id."'");
        $result = $query->result();
        return $result;
    }

    public function get_class_by_member_id($id)
    {
        $query = $this->db->query("select * from ms_member where member_id='".$id."'");
        $result = $query->result();
        return $result;
    }

    public function delete_member($member_id)
    {
        $this->db->set('is_active', 'N');
        $this->db->where('member_id ', $member_id);
        $this->db->update('ms_member');
    }

    public function edit_member($data_edit, $member_id)
    {
        $this->db->set($data_edit);
        $this->db->where('member_id', $member_id);
        $this->db->update('ms_member');
    }
    
    public function save_member($data_insert)
    {
        $this->db->trans_start();
        $this->db->insert('ms_member', $data_insert);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    public function last_member_code()
    {
        $query = $this->db->query("select member_code from ms_member where member_type = 'Normal' order by member_id desc limit 1");
        $result = $query->result();
        return $result;
    }
    

    public function save_schedule_member($data_insert_schedule_member)
    {
        $this->db->trans_start();
        $this->db->insert('member_class', $data_insert_schedule_member);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    //end member


    //class

    public function class_list($search, $length, $start)
    {
        $this->db->select('*');
        $this->db->from('ms_class');
        $this->db->where('class_active', 'Y');
        if($search != null){
            $this->db->where('class_code like "%'.$search.'%"');
            $this->db->or_where('class_name like "%'.$search.'%"');
        }
        $this->db->limit($length);
        $this->db->offset($start);
        $query = $this->db->get();
        return $query;
    }

    public function class_list_count($search)
    {
        $this->db->select('count(*) as total_row');
        $this->db->from('ms_class');
        $this->db->where('class_active', 'Y');
        if($search != null){
            $this->db->where('class_code like "%'.$search.'%"');
            $this->db->or_where('class_name like "%'.$search.'%"');
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_class_by_id($id)
    {
        $query = $this->db->query("select * from ms_class where class_id='".$id."'");
        $result = $query->result();
        return $result;
    }

    public function get_class_schedule($id)
    {
        $query = $this->db->query("select * from schedule_class a, ms_coach b where a.coach_id = b.coach_id  and class_id='".$id."' and schedule_active = 'Y' order by schedule_sort asc, schedule_time_start asc");
        $result = $query->result();
        return $result;
    }

    public function get_class_code($class_id)
    {
        $query = $this->db->query("select class_code, class_name from ms_class where class_id = '".$class_id."'");
        $result = $query->result();
        return $result;
    }

    public function delete_class($class_id)
    {
        $this->db->set('class_active', 'N');
        $this->db->where('class_id', $class_id);
        $this->db->update('ms_class');
    }

    public function delete_schedule($schedule_id)
    {
        $this->db->set('schedule_active', 'N');
        $this->db->where('schedule_class_id', $schedule_id);
        $this->db->update('schedule_class');
    }

    public function edit_class($data_edit, $class_id)
    {
        $this->db->set($data_edit);
        $this->db->where('class_id', $class_id);
        $this->db->update('ms_class');
    }

    public function delete_class_expedisi($class_code)
    {
        $this->db->where('class_code ', $class_code);
        $this->db->delete('ms_class_expedisi');
    }

    public function save_class($data_insert)
    {
        $this->db->insert('ms_class', $data_insert);
    }

    public function save_schedule($data_insert)
    {
        $this->db->insert('schedule_class', $data_insert);
    }

    public function last_class_code()
    {
        $query = $this->db->query("select class_code from ms_class order by class_id desc limit 1");
        $result = $query->result();
        return $result;
    }

    //end class

    // class paket 

    public function class_package_list($search, $length, $start)
    {
        $this->db->select('*');
        $this->db->from('ms_class_package');
        $this->db->where('ms_class_package_active', 'Y');
        if($search != null){
            $this->db->where('ms_class_package_name like "%'.$search.'%"');
        }
        $this->db->limit($length);
        $this->db->offset($start);
        $query = $this->db->get();
        return $query;
    }

    public function class_package_list_count($search)
    {
        $this->db->select('count(*) as total_row');
        $this->db->from('ms_class_package');
        $this->db->where('ms_class_package_active', 'Y');
        if($search != null){
            $this->db->where('ms_class_package_name like "%'.$search.'%"');
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_package_class_temp()
    {
        $this->db->select('*');
        $this->db->from('temp_class_package_class');
        $this->db->join('ms_class', 'temp_class_package_class.class_id = ms_class.class_id');
        $query = $this->db->get();
        return $query;
    }

    public function check_class_package_input($add_class_package)
    {
        $this->db->select('*');
        $this->db->from('temp_class_package_class');
        $this->db->join('ms_class', 'temp_class_package_class.class_id = ms_class.class_id');
        $this->db->where('temp_class_package_class.class_id', $add_class_package);
        $query = $this->db->get();
        return $query;
    }

    public function save_class_package_temp($data_insert)
    {
        $this->db->insert('temp_class_package_class', $data_insert);
    }

    public function delete_class_package($id)
    {
        $this->db->where('ms_class_package_id', $id);
        $this->db->delete('ms_class_package');
    }

    public function delete_class_package_temp($id)
    {
        $this->db->where('temp_class_package_class_id ', $id);
        $this->db->delete('temp_class_package_class');
    }

    public function save_class_package($data_insert)
    {
        $this->db->trans_start();
        $this->db->insert('ms_class_package', $data_insert);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    public function get_temp_class_package()
    {
        $this->db->select('*');
        $this->db->from('temp_class_package_class');
        $this->db->join('ms_class', 'temp_class_package_class.class_id = ms_class.class_id');
        $query = $this->db->get();
        return $query;
    }

    public function save_class_package_detail($data_insert_detail)
    {
        $this->db->insert('ms_class_package_detail', $data_insert_detail);
    }

    public function clear_temp_class_package()
    {
        $this->db->truncate('temp_class_package_class');
    }
    // end class paket 

    //gym paket

    public function gym_list($search, $length, $start)
    {
        $this->db->select('*');
        $this->db->from('ms_gym_package');
        $this->db->where('ms_gym_package_active', 'Y');
        if($search != null){
            $this->db->where('ms_gym_package_name like "%'.$search.'%"');
        }
        $this->db->limit($length);
        $this->db->offset($start);
        $query = $this->db->get();
        return $query;
    }

    public function gym_list_count($search)
    {
        $this->db->select('count(*) as total_row');
        $this->db->from('ms_gym_package');
        $this->db->where('ms_gym_package_active', 'Y');
        if($search != null){
            $this->db->where('ms_gym_package_name like "%'.$search.'%"');
        }
        $query = $this->db->get();
        return $query;
    }

    public function save_gym_package($data_insert)
    {
        $this->db->insert('ms_gym_package', $data_insert);
    }

    public function get_edit_gym_package($id)
    {
        $query = $this->db->query("select * from ms_gym_package where ms_gym_package_id ='".$id."'");
        $result = $query->result();
        return $result;
    }

    public function edit_gym_package($data_edit, $paket_id)
    {
        $this->db->set($data_edit);
        $this->db->where('ms_gym_package_id', $paket_id);
        $this->db->update('ms_gym_package');
    }

    public function delete_gym_package($paket_id)
    {
        $this->db->set('ms_gym_package_active', 'N');
        $this->db->where('ms_gym_package_id', $paket_id);
        $this->db->update('ms_gym_package');
    }
    //end gym paket


     //pt paket

    public function pt_package_list($search, $length, $start)
    {
        $this->db->select('*');
        $this->db->from('ms_pt_package_price');
        $this->db->join('ms_pt_price', 'ms_pt_package_price.ms_pt_price_id = ms_pt_price.ms_pt_price_id');
        $this->db->join('ms_pt_package', 'ms_pt_package_price.ms_pt_package_id = ms_pt_package.ms_pt_package_id');
        $this->db->where('ms_pt_package_price_active', 'Y');
        if($search != null){
            $this->db->where('ms_pt_package_price_name like "%'.$search.'%"');
        }
        $this->db->limit($length);
        $this->db->offset($start);
        $query = $this->db->get();
        return $query;
    }

    public function pt_package_list_count($search)
    {
        $this->db->select('count(*) as total_row');
        $this->db->from('ms_pt_package_price');
        $this->db->join('ms_pt_price', 'ms_pt_package_price.ms_pt_price_id = ms_pt_price.ms_pt_price_id');
        $this->db->join('ms_pt_package', 'ms_pt_package_price.ms_pt_package_id = ms_pt_package.ms_pt_package_id');
        $this->db->where('ms_pt_package_price_active', 'Y');
        if($search != null){
            $this->db->where('ms_pt_package_price_name like "%'.$search.'%"');
        }
        $query = $this->db->get();
        return $query;
    }

    public function save_pt_package($data_insert)
    {
        $this->db->insert('ms_pt_package_price', $data_insert);
    }

    public function get_edit_pt_package($id)
    {
        $query = $this->db->query("select * from ms_pt_package_price where ms_pt_package_price_id ='".$id."'");
        $result = $query->result();
        return $result;
    }

    public function edit_pt_package($data_edit, $paket_id)
    {
        $this->db->set($data_edit);
        $this->db->where('ms_pt_package_price_id', $paket_id);
        $this->db->update('ms_pt_package_price');
    }

    public function delete_pt_package($paket_id)
    {
        $this->db->set('ms_pt_package_price_active', 'N');
        $this->db->where('ms_pt_package_price_id', $paket_id);
        $this->db->update('ms_pt_package_price');
    }
    //end pt paket

    //coach

    public function coach_list($search, $length, $start, $type)
    {
        $this->db->select('*');
        $this->db->from('ms_coach');
        $this->db->where('coach_type', $type);
        $this->db->join('ms_pt_price', 'ms_coach.coach_lvl = ms_pt_price.ms_pt_price_id', 'left');
        if($search != null){
            $this->db->where('coach_code like "%'.$search.'%"');
            $this->db->or_where('coach_name like "%'.$search.'%"');
        }
        $this->db->limit($length);
        $this->db->offset($start);
        $query = $this->db->get();
        return $query;
    }

    public function coach_list_count($search, $type)
    {
        $this->db->select('count(*) as total_row');
        $this->db->from('ms_coach');
        $this->db->where('coach_type', $type);
        $this->db->join('ms_pt_price', 'ms_coach.coach_lvl = ms_pt_price.ms_pt_price_id', 'left');
        if($search != null){
            $this->db->where('coach_code like "%'.$search.'%"');
            $this->db->or_where('coach_name like "%'.$search.'%"');
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_coach_by_id($id)
    {
        $query = $this->db->query("select * from ms_coach where coach_id='".$id."'");
        $result = $query->result();
        return $result;
    }

    public function get_coach_code($coach_id)
    {
        $query = $this->db->query("select coach_code, coach_name from ms_coach where coach_id = '".$coach_id."'");
        $result = $query->result();
        return $result;
    }

    public function delete_coach($coach_id)
    {
        $this->db->set('is_active', 'N');
        $this->db->where('coach_id ', $coach_id);
        $this->db->update('ms_coach');
    }

    public function edit_coach($data_edit, $coach_id)
    {
        $this->db->set($data_edit);
        $this->db->where('coach_id', $coach_id);
        $this->db->update('ms_coach');
    }

    public function delete_coach_expedisi($coach_code)
    {
        $this->db->where('coach_code ', $coach_code);
        $this->db->delete('ms_coach_expedisi');
    }

    public function save_coach($data_insert)
    {
        $this->db->insert('ms_coach', $data_insert);
    }

    public function last_coach_code()
    {
        $query = $this->db->query("select coach_code from ms_coach order by coach_id desc limit 1");
        $result = $query->result();
        return $result;
    }

    public function get_class_by_coach_id($id)
    {
        $query = $this->db->query("select * from schedule_class a, ms_class b where a.class_id = b.class_id and coach_id = '".$id."'");
        $result = $query->result();
        return $result;
    }

    public function check_coach_code($coach_code)
    {
        $query = $this->db->query("select * from ms_coach where coach_code = '".$coach_code."'");
        $result = $query->result();
        return $result;
    }

    public function get_class_pt()
    {
        $query = $this->db->query("select * from ms_pt_price where ms_pt_price_active = 'Y'");
        $result = $query->result();
        return $result;
    }

    //end coach

    //start promo

    public function save_promo($data_insert)
    {
        $this->db->insert('ms_promo', $data_insert);
    }

    public function promo_list($search, $length, $start)
    {
        $this->db->select('*');
        $this->db->from('ms_promo');
        $this->db->join('ms_gym_package', 'ms_promo.ms_promo_member_month = ms_gym_package.ms_gym_package_id', 'INNER');
        $this->db->from('ms_class_package', 'ms_promo.ms_promo_class_month = ms_class_package.ms_class_package_id', 'INNER');
        $this->db->from('ms_pt_package_price', 'ms_promo.ms_promo_pt_sesi = ms_pt_package_price.ms_pt_package_price_id', 'INNER');
        $this->db->where('ms_promo_active', 'Y');
        if($search != null){
            $this->db->where('ms_pormo_name like "%'.$search.'%"');
        }
        $this->db->group_by('ms_promo_id');
        $this->db->limit($length);
        $this->db->offset($start);
        $query = $this->db->get();
        return $query;
    }

    public function promo_list_count($search)
    {
        $this->db->select('count(*) as total_row');
        $this->db->from('ms_promo');
        $this->db->join('ms_gym_package', 'ms_promo.ms_promo_member_month = ms_gym_package.ms_gym_package_id', 'INNER');
        $this->db->from('ms_class_package', 'ms_promo.ms_promo_class_month = ms_class_package.ms_class_package_id', 'INNER');
        $this->db->from('ms_pt_package_price', 'ms_promo.ms_promo_pt_sesi = ms_pt_package_price.ms_pt_package_price_id', 'INNER');
        $this->db->where('ms_promo_active', 'Y');
        if($search != null){
            $this->db->where('ms_pormo_name like "%'.$search.'%"');
        }
        $this->db->group_by('ms_promo_id');
        $query = $this->db->get();
        return $query;
    }

    public function get_promo_id($id)
    {
        $query = $this->db->query("select * from ms_promo where ms_promo_id ='".$id."'");
        $result = $query->result();
        return $result;
    }

    public function delete_promo($promo_id){
        $this->db->set('ms_promo_active', 'N');
        $this->db->where('ms_promo_id', $promo_id);
        $this->db->update('ms_promo');
    }

    public function edit_promo($data_edit, $promo_id)
    {
        $this->db->set($data_edit);
        $this->db->where('ms_promo_id', $promo_id);
        $this->db->update('ms_promo');
    }
    //end promo


}

?>