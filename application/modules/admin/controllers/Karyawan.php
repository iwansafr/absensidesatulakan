<?php defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->db->cache_off();
    $this->load->model('esg_model');
    $this->load->model('admin_model');
    $this->load->library('esg');
    $this->load->library('ZEA/zea');
    $this->esg_model->init();
  }
  public function index()
  {
    $this->load->view('index');
  }
  public function list()
  {
    $this->load->view('index');
  }
  public function clear_list()
  {
    $this->load->view('admin/karyawan/list');
  }
  public function edit()
  {
    $this->load->view('index');
  }
  public function rekap($id = 0)
  {
    $this->load->view('index',['id'=>$id]);
  }
  public function jabatan_edit()
  {
    $this->load->view('index');
  }
  public function jabatan_list()
  {
    $this->load->view('index');
  }
  public function jabatan_clear_list()
  {
    $this->load->view('admin/karyawan/jabatan_list');
  }
  public function rekap_bulanan()
  {
    $year = date('Y');
    $month = date('m');
    $theYear = $this->input->get('year');
    $theMonth = $this->input->get('month');
    if(!empty($theYear)){
      $year = $theYear;
    }
    if(!empty($theMonth)){
      $month = $theMonth;
    }
    $totalDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $absensi = $this->db->query('SELECT * FROM absensi WHERE MONTH(visit_time) = ? AND YEAR(visit_time) = ?',[$theMonth, $theYear])->result_array();
    $karyawan = $this->db->query('SELECT * FROM karyawan')->result_array();
    $output = [];

      foreach ($karyawan as $key => $value) {
        foreach ($absensi as $absensiKey => $absensiValue) {
          if($absensiValue['karyawan_id'] == $value['id']){
            $output[$value['id']]['absensi'][date('Y-m-d', strtotime($absensiValue['visit_time']))][$absensiValue['status']] = $absensiValue;
            $output[$value['id']]['profil'] = $value;
            for($i=1;$i<$totalDay;$i++){
              if(empty($output[$value['id']]['absensi'][date('Y-m-d', strtotime($year.'-'.$month.'-'.$i))])){
                $output[$value['id']]['absensi'][date('Y-m-d', strtotime($year.'-'.$month.'-'.$i))] = null;
                $output[$value['id']]['profil'] = $value;
              }
            }
          }
        }
      }
    $this->load->view('index',['year'=>$year,'month'=>$month, 'totalDay'=>$totalDay,'karyawan'=>$karyawan,'absensi'=>$absensi,'output'=>$output]);
  }
}
