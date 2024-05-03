<?php

namespace App\Imports;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Hash;
class PetImport implements ToCollection, WithHeadingRow 
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
    foreach ($rows as $row) 
        {
            try {
                $user = User::where('name',$row['username'])->firstOrFail();
               }

            catch(ModelNotFoundException $ex) {
                $user = new User();
                $user->name = $row['username'];
                $user->title = $row['title'];
                $user->addressline = $row['addressline'];
                $user->town=$row['town'];
                $user->phone = $row['phone'];
                $user->role = 'Customer';
                $user->email = $row['email'];
                $user->password = Hash::make($row['password']);
                $user->save();
            }
           
            $pet = new Pet();
            $pet->name = $row['name'];
            $pet->type = $row['type'];
            $pet->save();
            $pet->user()->attach($user->id);
        }
    }
}