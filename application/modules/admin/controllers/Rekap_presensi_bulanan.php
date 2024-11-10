<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap_presensi_bulanan extends CI_Controller{
    public function index(){
        $this->load->view('index');
    }
}