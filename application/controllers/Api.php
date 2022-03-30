<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	function __construct(){
	parent::__construct();
	$this->load->model('MSudi');
	}

	public function index()
	{
        $status = array(
                'status' => 'Ok'
        );
		echo json_encode($status);
    }

    public function GetData()
    {
        $query = $this->MSudi->GetData('tbl_mahasiswa')->result();
        echo json_encode($query);
    }

    public function GetDataWhere()
    {
        $id=urldecode($this->uri->segment(3));
        $query = $this->MSudi->GetData('tbl_mahasiswa','id',$id)->result();
        echo json_encode($query);
    }
    public function PostData()
    {
        $data = [
            'npm' => urldecode($this->uri->segment(3)),
            'name' => urldecode($this->uri->segment(4)),
            'major' => urldecode($this->uri->segment(5)),
            'studyprogram' => urldecode($this->uri->segment(6)),
            'class' => urldecode($this->uri->segment(7))
        ];
        $input = $this->MSudi->AddData('tbl_mahasiswa', $data);
        if($input){
            redirect('Api');;
        } else {
            echo "Error";
        }
    }

    public function PutData()
    { 
        $id=urldecode($this->uri->segment(3));
        $update = [
            'npm' => urldecode($this->uri->segment(4)),
            'name' => urldecode($this->uri->segment(5)),
            'major' => urldecode($this->uri->segment(6)),
            'studyprogram' => urldecode($this->uri->segment(7)),
            'class' => urldecode($this->uri->segment(8))
    ];
        $update=$this->MSudi->UpdateData('tbl_mahasiswa','id',$id,$update);    
        if($update){
            redirect('Api');
        } else {echo 'Error';}
    }

    public function DeleteData()
    {
        $nis=urldecode($this->uri->segment(3));
        $delete=$this->MSudi->DeleteData('tbl_mahasiswa','npm',$nis);
        if($delete){
            redirect('Api');
        } else {echo 'Error';}
    }
}
