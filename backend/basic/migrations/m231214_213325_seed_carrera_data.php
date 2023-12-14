<?php

use yii\db\Migration;

/**
 * Class m231214_213325_seed_carrera_data
 */
class m231214_213325_seed_carrera_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $carreraData = [
            [
                'nombre' => 'Tecnicatura Desarrollo Web',
            ],
            [
                'nombre' => 'Ingeniería en Informática',
            ],
            [
                'nombre' => 'Licenciatura en Matemáticas',
            ],
            [
                'nombre' => 'Analista Contable',
            ],
            [
                'nombre' => 'Profesorado de Ingles',
            ],
            
        ];

        $this->batchInsert('{{%carrera}}', ['nombre'], $carreraData);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
        $this->delete('{{%carrera}}', ['nombre' => 'Tecnicatura Desarrollo Web']);
        $this->delete('{{%carrera}}', ['nombre' => 'Ingeniería en Informática']);
        $this->delete('{{%carrera}}', ['nombre' => 'Licenciatura en Matemáticas']);
        $this->delete('{{%carrera}}', ['nombre' => 'Analista Contable']);
        $this->delete('{{%carrera}}', ['nombre' => 'Profesorado de Ingles']);
        
    }
}
