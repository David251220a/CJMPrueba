<?php

namespace App\Imports;

use App\PlanillaMensualImports;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use DB;

use Carbon\Carbon;
use Response;
use illuminate\Support\Collection;
use PhpOffice \ PhpSpreadsheet \ Shared \ Date;

class PlanillaImport implements ToModel
{
    private $Fecha_Planilla = 0;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function model(array $row)
    {   
        $date = Carbon::now();

        $this->Fecha_Planilla = $row[0][0];

        return new PlanillaMensualImports([
            //

            'IdInstitucion'=> auth()->id(),
            'Fecha_Planilla'=> Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0])),
            'Mes'=> Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0]))->month,
            'Año'=> Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0]))->year,
            'Cedula'=> $row[1] ,
            'Nombre'=> $row[2] ,
            'Apellido'=> $row[3] ,
            'IdTipo_Aporte'=> $row[4] ,
            'Tipo_Aporte_Descripcion'=> $row[5] ,
            'Salario'=> $row[6] ,
            'Aporte'=> $row[7] ,
            'Primera_Asignacion'=> $row[8] ,
            'Diferencia_Asignacion'=> $row[9] ,
            'RSA'=> $row[10] ,


        ]);
    }

    public function getRowFiel(): date
    {
        return $this->Fecha_Planilla;
    }

}
