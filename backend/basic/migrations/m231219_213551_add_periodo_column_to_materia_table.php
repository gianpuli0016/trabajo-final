<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%materia}}`.
 */
class m231219_213551_add_periodo_column_to_materia_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%materia}}', 'periodo', $this->string(50)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%materia}}', 'periodo');
    }
}
