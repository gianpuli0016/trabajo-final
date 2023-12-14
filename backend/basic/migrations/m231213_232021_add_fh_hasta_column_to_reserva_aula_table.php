<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%reserva_aula}}`.
 */
class m231213_232021_add_fh_hasta_column_to_reserva_aula_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%reserva_aula}}', 'fh_hasta', $this->timestamp()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%reserva_aula}}', 'fh_hasta');
    }
}