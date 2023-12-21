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
        // Insertar datos solo si la tabla existe
        if ($this->db->schema->getTableSchema('{{%reserva_aula}}') !== null) {
            $reservaAulaData = [
                [
                    'id_aula' => 15, 
                    'fh_desde' => '2023-01-01 08:00:00',
                    'fh_hasta' => '2023-01-01 10:00:00',
                    'dia' => 'Lunes',
                    'observacion' => 'Tecnicatura Desarrollo Web',
                ],
                [
                    'id_aula' => 16,
                    'fh_desde' => '2023-01-01 14:00:00',
                    'fh_hasta' => '2023-01-01 16:00:00',
                    'dia' => 'Martes',
                    'observacion' => 'Ingeniería en Informática',
                ],
            ];

            $this->batchInsert('{{%reserva_aula}}', ['id_aula', 'fh_desde', 'fh_hasta', 'dia', 'observacion'], $reservaAulaData);
        } else {
            echo "La tabla {{%reserva_aula}} no existe. Los datos no se han insertado.\n";
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Eliminar datos solo si la tabla existe
        if ($this->db->schema->getTableSchema('{{%reserva_aula}}') !== null) {
            $this->delete('{{%reserva_aula}}', ['observacion' => 'Tecnicatura Desarrollo Web']);
            $this->delete('{{%reserva_aula}}', ['observacion' => 'Ingeniería en Informática']);
        } else {
            echo "La tabla {{%reserva_aula}} no existe. No hay datos para eliminar.\n";
        }
    }
}
