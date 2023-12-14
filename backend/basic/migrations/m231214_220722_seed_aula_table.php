<?php

use yii\db\Migration;

/**
 * Class m231214_220722_seed_aula_table
 */
class m231214_220722_seed_aula_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $aulaData = [
            [
                'descripcion' => 'Aula 101',
                'ubicacion' => 'Edificio Principal',
                'cant_pcs' => 20,
                'cant_proyector' => 1,
                'aforo' => 30,
                'es_climatizada' => true,
            ],
            [
                'descripcion' => 'Aula 201',
                'ubicacion' => 'Edificio Principal',
                'cant_pcs' => 15,
                'cant_proyector' => 1,
                'aforo' => 25,
                'es_climatizada' => false,
            ],
            [
                'descripcion' => 'Laboratorio de Informática',
                'ubicacion' => 'Edificio de Ciencias',
                'cant_pcs' => 30,
                'cant_proyector' => 2,
                'aforo' => 40,
                'es_climatizada' => true,
            ],
            
        ];

        $this->batchInsert('{{%aula}}', ['descripcion', 'ubicacion', 'cant_pcs', 'cant_proyector', 'aforo', 'es_climatizada'], $aulaData);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
        $this->delete('{{%aula}}', ['descripcion' => 'Aula 101']);
        $this->delete('{{%aula}}', ['descripcion' => 'Aula 201']);
        $this->delete('{{%aula}}', ['descripcion' => 'Laboratorio de Informática']);
        
    }
}
