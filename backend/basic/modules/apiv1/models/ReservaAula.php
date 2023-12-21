<?php

namespace app\modules\apiv1\models;

class ReservaAula extends \app\models\ReservaAula
{
    public function fields()
    {
        return ['id', 'aula', 'fh_desde', 'fh_hasta', 'dia', 'observacion'];
    }
}

