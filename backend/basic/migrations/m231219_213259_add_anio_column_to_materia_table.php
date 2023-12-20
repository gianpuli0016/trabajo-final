<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%materia}}`.
 */
class m231219_213259_add_anio_column_to_materia_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%materia}}', 'anio', $this->integer()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%materia}}', 'anio');
    }
}
