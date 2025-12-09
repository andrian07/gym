<?php

class setting_model extends CI_Model {

    //payment
    public function payment_list($search, $length, $start)
    {
        $this->db->select('*');
        $this->db->from('ms_payment');
        if($search != null){
            $this->db->where('payment_name like "%'.$search.'%"');
        }
        $this->db->where('payment_active', 'Y');
        $this->db->limit($length);
        $this->db->offset($start);
        $query = $this->db->get();
        return $query;
    }

    public function payment_list_count($search)
    {
        $this->db->select('count(*) as total_row');
        $this->db->from('ms_payment');
        if($search != null){
            $this->db->where('payment_name like "%'.$search.'%"');
        }
        $this->db->where('payment_active', 'Y');
        $query = $this->db->get();
        return $query;
    }

    public function save_payment($data_insert)
    {
        $this->db->insert('ms_payment', $data_insert);
    }

    public function edit_payment($data_edit, $payment_id)
    {
        $this->db->set($data_edit);
        $this->db->where('payment_id', $payment_id);
        $this->db->update('ms_payment');
    }

    public function delete_payment($payment_id)
    {
        $this->db->set('payment_active', 'N');
        $this->db->where('payment_id', $payment_id);
        $this->db->update('ms_payment');
    }
    //end payment


    //personaltrainingprice
    public function personaltrainingprice_list($search, $length, $start)
    {
        $this->db->select('*');
        $this->db->from('ms_pt_price');
        if($search != null){
            $this->db->where('ms_pt_price_name like "%'.$search.'%"');
        }
        $this->db->where('ms_pt_price_active', 'Y');
        $this->db->limit($length);
        $this->db->offset($start);
        $query = $this->db->get();
        return $query;
    }

    public function personaltrainingprice_list_count($search)
    {
        $this->db->select('count(*) as total_row');
        $this->db->from('ms_pt_price');
        if($search != null){
            $this->db->where('ms_pt_price_name like "%'.$search.'%"');
        }
        $this->db->where('ms_pt_price_active', 'Y');
        $query = $this->db->get();
        return $query;
    }

    public function save_personaltrainingprice($data_insert)
    {
        $this->db->insert('ms_pt_price', $data_insert);
    }

    public function edit_personaltrainingprice($data_edit, $pt_price_id)
    {
        $this->db->set($data_edit);
        $this->db->where('ms_pt_price_id', $pt_price_id);
        $this->db->update('ms_pt_price');
    }

    public function delete_personaltrainingprice($ms_pt_price_id )
    {
        $this->db->set('ms_pt_price_active', 'N');
        $this->db->where('ms_pt_price_id ', $ms_pt_price_id);
        $this->db->update('ms_pt_price');
    }

    public function ptsession_list($search, $length, $start)
    {
        $this->db->select('*');
        $this->db->from('ms_pt_package');
        $this->db->where('ms_pt_package_active', 'Y');
        $this->db->limit($length);
        $this->db->offset($start);
        $query = $this->db->get();
        return $query;
    }

    public function ptsession_list_count($search)
    {
        $this->db->select('count(*) as total_row');
        $this->db->from('ms_pt_package');
        $this->db->where('ms_pt_package_active', 'Y');
        $query = $this->db->get();
        return $query;
    }

    public function save_session($data_insert)
    {
        $this->db->insert('ms_pt_package', $data_insert);
    }

    public function edit_session($data_insert, $pt_package_id)
    {
        $this->db->set($data_insert);
        $this->db->where('ms_pt_package_id', $pt_package_id);
        $this->db->update('ms_pt_package');
    }
    //end personaltrainingprice



}

?>