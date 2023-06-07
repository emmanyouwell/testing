<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\User;
use App\Models\Customer;
use Hash;

class CustomerSheetImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
         
            $user = User::create([
                'name' => $row['first_name'] . $row['last_name'] ,
                'email' => $row['email'],
                'password' => Hash::make('password'),
                'role'=>'customer'
            ]);
            $customer = $user->customer()->create([
                'fname' => $row['first_name'],
                'lname' => $row['last_name'],
                'addressline' => $row['address'],
                'town' => $row['town'],
                'phone' => $row['phone'],
                'zipcode' => 'default',
            ]);
        }
    }
}