<?php

namespace App\Exports;

use App\Models\UserModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UserModel::all();
    }
}
