<?php

namespace App\Imports;

use App\tmp_apo_Rendicion_Aporte_Importar;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use DB;

use Carbon\Carbon;
use Response;
use illuminate\Support\Collection;
use PhpOffice \ PhpSpreadsheet \ Shared \ Date;


class Apo_Rendicion_AporteImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $id_user = auth()->id();

        $rol = DB::table('users_config')   
        ->where('Id_User','=',$id_user)
        ->first();

        $id_rol = $rol->Id_Rol;
        $id_departamento = $rol->Id_Departamento;
        $id_institucion_municipal = $rol->Id_InstitucionMunicipal;

        return new tmp_apo_Rendicion_Aporte_Importar([

            'Id_Departamento'=> $id_departamento,
            'Id_InstitucionMunicipal'=> $id_institucion_municipal,
            'Fecha_Aporte'=> Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0])),
            'Cedula'=> $row[1],
            //'Mes'=> Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0]))->month,
            //'Año'=> Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0]))->year,            
            'Nombre'=> $row[2] ,
            'Apellido'=> $row[3] ,
            'Salario'=> $row[4] ,
            'Salario_Bonificacion'=> $row[5] ,
            'Aporte_Salario'=> $row[6] ,
            'Aporte_Bonificacion'=> $row[7] ,
            'Primera_Asignacion'=> $row[8] ,
            'Diferencia_Asignacion'=> $row[9] ,
            'RSA'=> $row[10] ,

        ]);
    }
}
