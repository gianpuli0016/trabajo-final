<?php

use yii\db\Migration;

/**
 * Class m231214_215650_seed_materia_table
 */
class m231214_215650_seed_materia_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $materiaData = [];

        // Obtén el ID de cada carrera
        $idCarreraDesarrolloWeb = $this->getIdCarrera('Tecnicatura Desarrollo Web');
        $idCarreraInformatica = $this->getIdCarrera('Ingeniería en Informática');
        $idCarreraMatematicas = $this->getIdCarrera('Licenciatura en Matemáticas');
        $idCarreraContable = $this->getIdCarrera('Analista Contable');
        $idCarreraIngles = $this->getIdCarrera('Profesorado de Ingles');

        // Obtén el ID de cada profesor
        $idProfesorJuanPerez = $this->getIdProfesor('Juan', 'Pérez');
        $idProfesorMariaGomez = $this->getIdProfesor('María', 'Gómez');
        $idProfesorPedroLopez = $this->getIdProfesor('Pedro', 'López');
        $idProfesorAnaMartinez = $this->getIdProfesor('Ana', 'Martínez');

        // Materias para Tecnicatura Desarrollo Web
        $materiaData[] = ['nombre' => 'Diseño de Páginas Web', 'id_carrera' => $idCarreraDesarrolloWeb, 'id_profesor' => $idProfesorJuanPerez];
        $materiaData[] = ['nombre' => 'Programación Frontend', 'id_carrera' => $idCarreraDesarrolloWeb, 'id_profesor' => $idProfesorMariaGomez];

        // Materias para Ingeniería en Informática
        $materiaData[] = ['nombre' => 'Programación Avanzada', 'id_carrera' => $idCarreraInformatica, 'id_profesor' => $idProfesorJuanPerez];
        $materiaData[] = ['nombre' => 'Bases de Datos', 'id_carrera' => $idCarreraInformatica, 'id_profesor' => $idProfesorMariaGomez];

        // Materias para Licenciatura en Matemáticas
        $materiaData[] = ['nombre' => 'Álgebra Lineal', 'id_carrera' => $idCarreraMatematicas, 'id_profesor' => $idProfesorPedroLopez];
        $materiaData[] = ['nombre' => 'Cálculo Integral', 'id_carrera' => $idCarreraMatematicas, 'id_profesor' => $idProfesorAnaMartinez];

        // Materias para Analista Contable
        $materiaData[] = ['nombre' => 'Contabilidad General', 'id_carrera' => $idCarreraContable, 'id_profesor' => $idProfesorPedroLopez];
        $materiaData[] = ['nombre' => 'Legislación Tributaria', 'id_carrera' => $idCarreraContable, 'id_profesor' => $idProfesorAnaMartinez];

        // Materias para Profesorado de Ingles
        $materiaData[] = ['nombre' => 'Gramática Inglesa', 'id_carrera' => $idCarreraIngles, 'id_profesor' => $idProfesorMariaGomez];
        $materiaData[] = ['nombre' => 'Literatura en Inglés', 'id_carrera' => $idCarreraIngles, 'id_profesor' => $idProfesorAnaMartinez];

        $this->batchInsert('{{%materia}}', ['nombre', 'id_carrera', 'id_profesor'], $materiaData);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->delete('{{%materia}}', ['nombre' => 'Diseño de Páginas Web']);
        $this->delete('{{%materia}}', ['nombre' => 'Programación Frontend']);
        $this->delete('{{%materia}}', ['nombre' => 'Programación Avanzada']);
        $this->delete('{{%materia}}', ['nombre' => 'Bases de Datos']);
        $this->delete('{{%materia}}', ['nombre' => 'Álgebra Lineal']);
        $this->delete('{{%materia}}', ['nombre' => 'Cálculo Integral']);
        $this->delete('{{%materia}}', ['nombre' => 'Contabilidad General']);
        $this->delete('{{%materia}}', ['nombre' => 'Legislación Tributaria']);
        $this->delete('{{%materia}}', ['nombre' => 'Gramática Inglesa']);
        $this->delete('{{%materia}}', ['nombre' => 'Literatura en Inglés']);
    }

    /**
     * Obtiene el ID de una carrera por nombre.
     * @param string $nombre
     * @return int|null
     */
    private function getIdCarrera($nombre)
    {
        return $this->getDb()->createCommand('SELECT id FROM {{%carrera}} WHERE nombre = :nombre', [':nombre' => $nombre])->queryScalar();
    }

    /**
     * Obtiene el ID de un profesor por nombre y apellido.
     * @param string $nombre
     * @param string $apellido
     * @return int|null
     */
    private function getIdProfesor($nombre, $apellido)
    {
        return $this->getDb()->createCommand('SELECT id FROM {{%profesor}} WHERE nombre = :nombre AND apellido = :apellido', [':nombre' => $nombre, ':apellido' => $apellido])->queryScalar();
    }
}
