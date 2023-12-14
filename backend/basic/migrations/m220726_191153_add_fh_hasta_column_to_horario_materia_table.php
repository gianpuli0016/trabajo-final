<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%horario_materia}}`.
 */
class m220726_191153_add_fh_hasta_column_to_horario_materia_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%horario_materia}}', 'fh_hasta', $this->timestamp()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%horario_materia}}', 'fh_hasta');
    }
}
