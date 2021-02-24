<?php

// extends class Model
class CustomerM extends CI_Model{

  // response jika field ada yang kosong
  public function empty_response(){
    $response['code']=502;
    $response['message']="error";
    $response['result']='Field tidak boleh kosong';
    return $response;
  }

  // function untuk insert data ke tabel customers
  public function add_cust($name,$email,$password,$gender,$married,$address){

    if(empty($name) || empty($email) || empty($password) || empty($gender) || empty($married) || empty($address)){
      return $this->empty_response();
    }else{
      $data = array(
        "name"=>$name,
        "email"=>$email,
        "password"=>$password,
        "gender"=>$gender,
        "is_married"=>$married,
        "address"=>$address
      );

      $insert = $this->db->insert("customers", $data);

      if($insert){
        $response['code']=200;
        $response['message']="success";
        $response['result']='Data customer ditambahkan.';
        return $response;
      }else{
        $response['code']=502;
        $response['message']="failed";
        $response['result']='Data customer gagal ditambahkan.';
        return $response;
      }
    }

  }

  // mengambil semua data customer
  public function all_cust(){

    $all = $this->db->get("customers")->result();
    $response['code']=200;
    $response['message']="success";
    $response['result']=$all;
    return $response;

  }

  // mengambil semua data customer berdasarkan ID
  public function cust_id($id){
    if ($id == '') {
      return $this->empty_response();
    }
    else
    {
      $this->db->select('*');
      $this->db->from("customers");
      $this->db->where('id',$id);
      $all = $this->db->get()->result();
      $response['code']=200;
      $response['message']="success";
      $response['result']=$all;
      return $response;
    }
    

  }

  // hapus data customer
  public function delete_cust($id){

    if($id == ''){
      return $this->empty_response();
    }else{
      $where = array(
        "id"=>$id
      );

      $this->db->where($where);
      $delete = $this->db->delete("customers");
      if($delete){
        $response['code']=200;
        $response['message']="success";
        $response['result']='Data customer dihapus.';
        return $response;
      }else{
        $response['status']=502;
        $response['message']="failed";
        $response['result']='Data customer gagal dihapus.';
        return $response;
      }
    }

  }

  // update customer
  public function update_cust($id,$name,$email,$password,$gender,$married,$address){

    if($id == '' || empty($name) || empty($email) || empty($password) || empty($gender) || empty($married) || empty($address)){
      return $this->empty_response();
    }else{
      $where = array(
        "id"=>$id
      );

      $set = array(
        "name"=>$name,
        "email"=>$email,
        "password"=>$password,
        "gender"=>$gender,
        "is_married"=>$married,
        "address"=>$address
      );

      $this->db->where($where);
      $update = $this->db->update("customers",$set);
      if($update){
        $response['code']=200;
        $response['message']="success";
        $response['result']='Data customer diubah.';
        return $response;
      }else{
        $response['code']=502;
        $response['message']="failed";
        $response['result']='Data customer gagal diubah.';
        return $response;
      }
    }

  }

}

?>
