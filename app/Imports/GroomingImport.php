<?php

namespace App\Imports;

use App\Models\Grooming;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GroomingImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Grooming([
            'description'       => $row['description'],
            'title'             => $row['title'],
            'grooming_cost'     => $row['grooming_cost'],
            // 'email'     => $row['email'],
            // 'password'     => $row['password'], 
        ]);
    }
}