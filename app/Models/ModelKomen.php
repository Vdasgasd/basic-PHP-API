<?php 

namespace App\Models;

use CodeIgniter\Model;

class ModelKomen extends Model{

    protected $table = "comentor";
    protected $primarykey = "id";
    protected $allowedFields =['username','comment'];


    protected $validationRules = [
        'username'=>'required',
        

    ];
    protected $validationMessages=[
        'username'=>[
            'required' => 'silakan masukan nama'
        ]
        ];
}
 


?>