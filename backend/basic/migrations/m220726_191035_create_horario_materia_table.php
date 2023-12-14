<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%horario_materia}}`.
 */
class m220726_191035_create_horario_materia_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%horario_materia}}', [
            'id' => $this->primaryKey(),
            'id_materia' => $this->integer()->notNull(),
            'id_reserva' => $this->integer()->Null(),
            'fh_desde' => $this->timestamp(),
            'fh_desde' => $this->timestamp()
        ]);

        $this->addForeignKey('fk-horario_materia-id_materia', 'horario_materia', 'id_materia', 'materia', 'id', 'CASCADE');
        $this->addForeignKey('fk-horario_materia-id_reserva', 'horario_materia', 'id_reserva', 'reserva_aula', 'id', 'CASCADE');
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-horario_materia-id_materia', 'horario_materia');
        $this->dropForeignKey('fk-horario_materia-id_reserva', 'horario_materia');

        $this->dropTable('{{%horario_materia}}');
    }
}
