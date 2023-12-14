<?php

namespace app\modules\apiv1\models;




class Aula extends \app\models\Aula
{
    public function fields(){
        return ['id', 'descripcion', 'ubicacion', 'cant_pcs', 'cant_proyector', 'aforo', 'es_climatizada'];
    }
}

