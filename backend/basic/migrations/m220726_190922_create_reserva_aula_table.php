<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reserva_aula}}`.
 */
class m220726_190922_create_reserva_aula_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reserva_aula}}', [
            'id' => $this->primaryKey(),
            'id_aula' => $this->integer()->notNull(),
            'fh_desde' => $this->dateTime(), // Cambiando a dateTime
            'fh_hasta' => $this->dateTime(), // Cambiando a dateTime
            'dia' => $this->string(20)->notNull(), // Nueva columna para el día de la semana
            'observacion' => $this->string(256)->notNull(),
        ]);

        $this->addForeignKey('fk-reserva_aula-id_aula', 'reserva_aula', 'id_aula', 'aula', 'id', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-reserva_aula-id_aula', 'reserva_aula');

        $this->dropTable('{{%reserva_aula}}');
    }
}
