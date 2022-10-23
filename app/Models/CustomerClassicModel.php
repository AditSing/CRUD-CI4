<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerClassicModel extends Model
{
    protected $table      = 'customers';
    protected $primaryKey = 'customerNumber';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['customerName', 'contactLastName', 'contactFirstName', 'phone', 'addressLine1', 'addressLine2', 'city', 'state', 'postalCode', 'country', 'salesRepEmployeeNumber ', 'creditLimit'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [
    //     // 'customerName'              => 'required',
    //     // 'customerName'              => 'required|alpha_space|min_length[3]|max_length[50]',
    //     // 'contactLastName'           => 'required|alpha_space|min_length[3]|max_length[50]',
    //     // 'contactFirstName'          => 'required|alpha_space|min_length[3]|max_length[50]',
    //     // 'phone'                     => 'required|numeric|min_length[6]|max_length[14]',
    //     // 'addressLine1'              => 'required|alpha_numeric_space|min_length[3]|max_length[50]',
    //     // 'addressLine2'              => 'alpha_numeric_space|min_length[3]|max_length[50]',
    //     // 'city'                      => 'required|alpha_space|min_length[2]|max_length[50]',
    //     // 'state'                     => 'alpha_space|min_length[2]|max_length[50]',
    //     // 'postalCode'                => 'numeric|min_length[3]|max_length[10]',
    //     // 'country'                   => 'required|alpha_space|min_length[3]|max_length[50]',
    //     // 'salesRepEmployeeNumber'    => 'numeric|min_length[3]|max_length[50]',
    //     // 'creditLimit'               => 'decimal|min_length[3]|max_length[50]',
    // ];
    // protected $validationMessages = [
    //     // 'customerName' => [
    //     //     'required'   => 'Your baby name is missing.',
    //     // ],
    // ];
    // protected $validationRules = [
    //     'customerName'    => 'required|alpha'
    // ];

    // protected $validationMessages = [
    //     'customerName` ' => [
    //         'required' => 'Is required ({value})',
    //         'alpha' => 'Must only contain alpha chars ({value})'                
    //     ],
    // ];
    protected $skipValidation     = false;
}