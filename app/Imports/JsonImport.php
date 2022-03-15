<?php

namespace App\Imports;

use App\models\JsonResult;
use Maatwebsite\Excel\Concerns\ToModel;

class JsonImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new JsonResult([
            // "id" ; 
        ]);
    }
}
