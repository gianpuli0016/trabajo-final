<?php

use yii\db\Migration;

/**
 * Class m231214_221041_seed_reserva_aula
 */
class m231214_221041_seed_reserva_aula extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $reservaAulaData = [
            [
                'id_aula' => 1, 
                'fh_desde' => '2023-01-01 08:00:00',
                'fh_hasta' => '2023-01-01 10:00:00',
                'observacion' => 'Clase de Matemáticas',
            ],
            [
                'id_aula' => 2,
                'fh_desde' => '2023-01-02 14:00:00',
                'fh_hasta' => '2023-01-02 16:00:00',
                'observacion' => 'Presentación de Proyectos',
            ],

        ];

        $this->batchInsert('{{%reserva_aula}}', ['id_aula', 'fh_desde', 'fh_hasta', 'observacion'], $reservaAulaData);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->delete('{{%reserva_aula}}', ['observacion' => 'Clase de Matemáticas']);
        $this->delete('{{%reserva_aula}}', ['observacion' => 'Presentación de Proyectos']);

    }
}
