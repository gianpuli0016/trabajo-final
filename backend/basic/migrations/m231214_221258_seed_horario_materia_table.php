<?php

use yii\db\Migration;

/**
 * Class m231214_221258_seed_horario_materia_table
 */
class m231214_221258_seed_horario_materia_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $horarioMateriaData = [
            [
                'id_materia' => 6, 
                'id_reserva' => 1, 
                'fh_desde' => '2023-01-01 08:00:00',
                'fh_hasta' => '2023-01-01 10:00:00',
            ],
            [
                'id_materia' => 3, 
                'id_reserva' => 2,
                'fh_desde' => '2023-01-02 14:00:00',
                'fh_hasta' => '2023-01-02 16:00:00',
            ],
            
        ];

        $this->batchInsert('{{%horario_materia}}', ['id_materia', 'id_reserva', 'fh_desde', 'fh_hasta'], $horarioMateriaData);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%horario_materia}}', ['fh_desde' => '2023-01-01 08:00:00']);
        $this->delete('{{%horario_materia}}', ['fh_desde' => '2023-01-02 14:00:00']);
    }
}