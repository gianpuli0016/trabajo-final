<?php

namespace app\modules\apiv1\models;




class Materia extends \app\models\Materia
{
    public function fields()
    {
        return ['id', 'nombre', 'profesor', 'carrera'];
    }

    public function extraFields()
    {
        return ['cant_alumnos'];
    }
}

