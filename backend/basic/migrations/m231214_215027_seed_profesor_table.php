<?php

use yii\db\Migration;

/**
 * Class m231214_215027_seed_profesor_table
 */
class m231214_215027_seed_profesor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $profesorData = [
            [
                'nombre' => 'Juan',
                'apellido' => 'Pérez',
                'mostrar' => 'Sí',
            ],
            [
                'nombre' => 'María',
                'apellido' => 'Gómez',
                'mostrar' => 'Sí',
            ],
            [
                'nombre' => 'Pedro',
                'apellido' => 'López',
                'mostrar' => 'No',
            ],
            [
                'nombre' => 'Ana',
                'apellido' => 'Martínez',
                'mostrar' => 'Sí',
            ],
            [
                'nombre' => 'Luis',
                'apellido' => 'Rodríguez',
                'mostrar' => 'No',
            ],
        ];

        $this->batchInsert('{{%profesor}}', ['nombre', 'apellido', 'mostrar'], $profesorData);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%profesor}}', ['nombre' => 'Juan', 'apellido' => 'Pérez']);
        $this->delete('{{%profesor}}', ['nombre' => 'María', 'apellido' => 'Gómez']);
        $this->delete('{{%profesor}}', ['nombre' => 'Pedro', 'apellido' => 'López']);
        $this->delete('{{%profesor}}', ['nombre' => 'Ana', 'apellido' => 'Martínez']);
        $this->delete('{{%profesor}}', ['nombre' => 'Luis', 'apellido' => 'Rodríguez']);
    }
}
