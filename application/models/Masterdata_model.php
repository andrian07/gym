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
        $this->db->insert('ms_member', $data_insert);
    }

    public function last_member_code()
    {
        $query = $this->db->query("select member_code from ms_member order by member_id desc limit 1");
        $result = $query->result();
        return $result;
    }
    

    //end member


    //class
    
    public function class_list($search, $length, $start)
    {
        $this->db->select('*');
        $this->db->from('ms_class');
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
        $query = $this->db->query("select * from schedule_class a, ms_coach b where a.coach_id = b.coach_id  and class_id='".$id."' order by schedule_sort asc, schedule_time_start asc");
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
        $this->db->set('is_active', 'N');
        $this->db->where('class_id ', $class_id);
        $this->db->update('ms_class');
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

    //coach
    
    public function coach_list($search, $length, $start)
    {
        $this->db->select('*');
        $this->db->from('ms_coach');
        if($search != null){
            $this->db->where('coach_code like "%'.$search.'%"');
            $this->db->or_where('coach_name like "%'.$search.'%"');
        }
        $this->db->limit($length);
        $this->db->offset($start);
        $query = $this->db->get();
        return $query;
    }
    
    public function coach_list_count($search)
    {
        $this->db->select('count(*) as total_row');
        $this->db->from('ms_coach');
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

    //end coach




    
}

?>