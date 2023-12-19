<?php

namespace app\modules\apiv1\controllers;

use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;

/**
 * Default controller for the `apiv1` module
 */
class BaseController extends ActiveController
{
    public static function allowedDomains()
    {
        return ['http://localhost:8080'];
    }

    function behaviors()
    {
        $behaviors = parent::behaviors();
        
        return array_merge($behaviors, [
            'corsFilter'  => [
                'class' => Cors::class,
                'cors'  => [
                    'Origin'                           => static::allowedDomains(),
                    'Access-Control-Request-Method'    => ['POST', 'GET', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age'           => 3600,                 // Cache (seconds)
                    'Access-Control-Allow-Headers' => ['authorization', 'X-Requested-With', 'content-type'],
                    'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page', 'X-Pagination-Page-Count', 'X-Pagination-Total-Count']
                ],
            ],
        ]);
    }

    //agregar dataFilter clave configurada para usar ActiveDataFilter que procesa la consulta de filtro en el modelo buscado
    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['dataFilter'] = [
            'class' => \yii\data\ActiveDataFilter::class,
            'searchModel' => $this->modelClass,
        ];

        return $actions;
    }
}
