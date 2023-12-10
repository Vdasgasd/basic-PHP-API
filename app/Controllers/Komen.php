<?php

namespace App\Controllers;


use CodeIgniter\API\ResponseTrait;
use App\Models\ModelKomen;



class Komen extends BaseController
{
    
    use ResponseTrait;
    function __construct()
    {
        $this->model = new ModelKomen();
    }
    public function index()
    {
        $data = $this->model->orderBy('id','asc')->findAll();
        return $this->respond($data,200);
    }
    public function show($id =null)
    {
        $data = $this->model->where('id',$id)->findAll();
        if($data){
            return $this->respond($data,200);
        } else {
            return $this->failNotFound("data tidak ditemukan untuk id $id");
        }
    }

    public function create(){
        // $data= [
        //     'username'=>$this->request->getVar('username'),
        //     'comment'=>$this->request->getVar('comment')
        // ];  
        // $this->model->save($data);
        $data = $this->request->getPost();
        if(!$this->model->save($data)){
            return $this->fail($this->model->errors());
        }
        $response = [
            'status'=>201,
            'error' => null,
            'Messages'=>[
                'success' => 'Berhasil memasukan data'
            ]
            ];
            return $this->respond($response);
    }



    public function update($id = null){
        $data = $this->request->getRawInput();
        $data['id']=$id;
        $isExists = $this->model->where('id',$id)->findAll();
        if(!$isExists){
            return $this->failNotFound("Data tidak ditemukan untuk id $id");
        }

        if(!$this->model->save($data)){
            return $this->fail($this->model->$data->errors());
        }

        $response = [
            'status'=>200,
            'error'=>null,
            'messages'=>[
                'success' => "data komen id $id berhasil di update"
            ]
            ];
            return $this->respond($response);
    }

    public function delete($id = null){
            $data = $this->model->where('id',$id)->findAll();
            if($data){$this->model->delete($id);
            $response = [
                'status'=>200,
                'error'=>null,
                'messages'=>[
                    'success' => "data berhasil dih+apus"
                ]
                ];
                return $this->respondDeleted($response);
            
            }else{
                  return $this->failNotFound('Data tidak ditemukan');
            }
    }

}
