<?php

namespace App\Imports;

use App\Models\ServiceArea;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ServiceAreaImport implements ToModel, WithStartRow
{

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * @param array $row
     */
    public function model(array $row)
    {
        $auth_user = Auth::guard('web')->user();

        return new ServiceArea([
            'city_id'     => $row[0],
            'provider_id' => $auth_user->id,
        ]);
    }
}
