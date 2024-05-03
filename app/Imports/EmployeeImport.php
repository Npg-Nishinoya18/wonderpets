<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ArtistImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Employee([
           'fname'     => $row['fname'],
           'lname'     => $row['lname'],
           'role'     => $row['role'],
           'email'     => $row['email'],
           'password'     => $row['password'], 
        ]);
    }
}



