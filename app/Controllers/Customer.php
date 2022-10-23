<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CustomerClassicModel;

class Customer extends ResourceController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->model = new CustomerClassicModel();
        $validation = \Config\Services::validation();
    }

    // get all product
    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond($data, 200);
    }
 
    // get single product
    public function show($id = null)
    {
        $data = $this->model->getWhere(['customerNumber' => $id])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }
 
    // create a product
    public function create()
    {
        try {
            // print_r($this->request->getVar());die();
            $validation = $this->validate([
                'customer_name'              => 'required|alpha_space|min_length[3]|max_length[50]',
                'contact_last_name'           => 'required|alpha_space|min_length[3]|max_length[50]',
                'contact_first_name'          => 'required|alpha_space|min_length[3]|max_length[50]',
                'phone'                     => 'required|numeric|min_length[6]|max_length[14]',
                'address_line1'              => 'required|alpha_numeric_space|min_length[3]|max_length[50]',
                'address_line2'              => 'permit_empty|alpha_numeric_space|min_length[3]|max_length[50]',
                'city'                      => 'required|alpha_space|min_length[2]|max_length[50]',
                'state'                     => 'permit_empty|alpha_space|min_length[2]|max_length[50]',
                'postal_code'                => 'permit_empty|numeric|min_length[3]|max_length[10]',
                'country'                   => 'required|alpha_space|min_length[3]|max_length[50]',
                'sales_rep_employee_number'    => 'permit_empty|numeric|min_length[3]|max_length[50]',
                'credit_limit'               => 'permit_empty|decimal|min_length[3]|max_length[50]',
            ]);
    
            if (!$validation) {
                return $this->failValidationErrors($this->validator->getErrors());
            }

            $data = [
                'customerName'              => $this->request->getVar('customer_name'),
                'contactLastName'           => $this->request->getVar('contact_last_name'),
                'contactFirstName'          => $this->request->getVar('contact_first_name'),
                'phone'                     => $this->request->getVar('phone'),
                'addressLine1'              => $this->request->getVar('address_line1'),
                'addressLine2'              => $this->request->getVar('address_line2'),
                'city'                      => $this->request->getVar('city'),
                'state'                     => $this->request->getVar('state'),
                'postalCode'                => $this->request->getVar('postal_code'),
                'country'                   => $this->request->getVar('country'),
                'salesRepEmployeeNumber'    => $this->request->getVar('sales_rep_employee_number'),
                'creditLimit'               => $this->request->getVar('credit_limit')
            ];

            $this->model->insert($data);
            if($this->model->affectedRows()) {
                $response = [
                    'status'   => 200,
                    'messages' => [
                        'success' => 'Data Saved'
                    ]
                ];
            } else {
                log_message('error', 'message error create customer data => '.$this->model->error());
                $response = [
                    'status'   => 200,
                    'messages' => [
                        'success' => 'Fail Save Data'
                    ]
                ];
            }
            
            return $this->respondCreated($response, 200);
        } catch (Exception $e) {
            log_message('error', 'message Exception error create customer data => '.$e->getMessage());
            $response = [
                'status'   => 500,
                'messages' => [
                    'success' => 'Fail Save Data'
                ]
            ];
            return $this->respondCreated($response, 200);
        } catch (\Throwable $e) {
            log_message('error', 'message Throwable error create customer data => '.json_encode($this->model->error()));
            $response = [
                'status'   => 500,
                'messages' => [
                    'success' => 'Fail Save Data'
                ]
            ];
            return $this->respondCreated($response, 200);
        }
    }
 
    // // update product
    // public function update($id = null)
    // {
    //     $model = new ProductModel();
    //     $json = $this->request->getJSON();
    //     if($json){
    //         $data = [
    //             'product_name' => $json->product_name,
    //             'product_price' => $json->product_price
    //         ];
    //     }else{
    //         $input = $this->request->getRawInput();
    //         $data = [
    //             'product_name' => $input['product_name'],
    //             'product_price' => $input['product_price']
    //         ];
    //     }
    //     // Insert to Database
    //     $model->update($id, $data);
    //     $response = [
    //         'status'   => 200,
    //         'error'    => null,
    //         'messages' => [
    //             'success' => 'Data Updated'
    //         ]
    //     ];
    //     return $this->respond($response);
    // }
 
    // // delete product
    // public function delete($id = null)
    // {
    //     $model = new ProductModel();
    //     $data = $model->find($id);
    //     if($data){
    //         $model->delete($id);
    //         $response = [
    //             'status'   => 200,
    //             'error'    => null,
    //             'messages' => [
    //                 'success' => 'Data Deleted'
    //             ]
    //         ];
             
    //         return $this->respondDeleted($response);
    //     }else{
    //         return $this->failNotFound('No Data Found with id '.$id);
    //     }
         
    // }
}
