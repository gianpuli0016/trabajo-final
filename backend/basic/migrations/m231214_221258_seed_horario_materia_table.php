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
                'id_materia' => 22, 
                'id_reserva' => 3, 
            ],
            [
                'id_materia' => 30, 
                'id_reserva' => 4,
            ],
            
        ];

        $this->batchInsert('{{%horario_materia}}', ['id_materia', 'id_reserva'], $horarioMateriaData);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%horario_materia}}', ['id_materia' => 6]);
        $this->delete('{{%horario_materia}}', ['id_materia' => 3]);
    }
}