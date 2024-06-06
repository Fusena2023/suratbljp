<?php

namespace App\Imports;

use App\Models\Karyawan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportSurat implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        return new Karyawan([
            'nama' => $row[1],
            'kriteriapemohon' => $row[2],
            'notlpn' => $row[3],
            'foto' => $row[4]
        ]);
    }
}
