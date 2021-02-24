<?php

require APPPATH . 'libraries/REST_Controller.php';

class Cust extends REST_Controller{

  // construct
  public function __construct(){
    parent::__construct();
    $this->load->model('CustomerM');
    header('Access-Control-Allow-Origin:*');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
    die();
    }
  }

  // method index untuk menampilkan semua data customer menggunakan method get
  public function index_get(){
    $response = $this->CustomerM->all_cust();
    $this->response($response);
  }

  //method mengambil data cust berdasarkan ID
  public function custom_get($id=null){
    error_reporting(0);
    $response = $this->CustomerM->cust_id($id);
    $this->response($response);
  }
  // untuk menambah customer menaggunakan method post
  public function add_post(){
    $response = $this->CustomerM->add_cust(
        $this->post('name'),
        $this->post('email'),
        $this->post('password'),
        $this->post('gender'),
        $this->post('is_married'),
        $this->post('address')
      );
    $this->response($response);
  }

  // update data customer menggunakan method put
  public function update_put($key = NULL, $xss_clean = NULL){
    $response = $this->CustomerM->update_cust(
        $key,
        $this->put('name'),
        $this->put('email'),
        $this->put('password'),
        $this->put('gender'),
        $this->put('is_married'),
        $this->put('address')
      );
    $this->response($response);
  }

  // hapus data customer menggunakan method delete
  public function delete_delete($key=null,$xss_clean = NULL)
  {
    $response = $this->CustomerM->delete_cust($key);
    $this->response($response);
  }

}

?>
