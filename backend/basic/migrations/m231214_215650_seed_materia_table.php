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

        // Obtener el ID de cada carrera
        $idCarreraDesarrolloWeb = $this->getIdCarrera('Tecnicatura Desarrollo Web');
        $idCarreraInformatica = $this->getIdCarrera('Ingeniería en Informática');
        $idCarreraMatematicas = $this->getIdCarrera('Licenciatura en Matemáticas');
        $idCarreraContable = $this->getIdCarrera('Analista Contable');
        $idCarreraIngles = $this->getIdCarrera('Profesorado de Ingles');

        // Obtener el ID de cada profesor
        $idProfesorJuanPerez = $this->getIdProfesor('Juan', 'Pérez');
        $idProfesorMariaGomez = $this->getIdProfesor('María', 'Gómez');
        $idProfesorPedroLopez = $this->getIdProfesor('Pedro', 'López');
        $idProfesorAnaMartinez = $this->getIdProfesor('Ana', 'Martínez');

        // Materias para Tecnicatura Desarrollo Web
        $materiaData[] = ['nombre' => 'Diseño de Páginas Web', 'id_carrera' => $idCarreraDesarrolloWeb, 'id_profesor' => $idProfesorJuanPerez];
        $materiaData[] = ['nombre' => 'Programación Frontend', 'id_carrera' => $idCarreraDesarrolloWeb, 'id_profesor' => $idProfesorMariaGomez];
        $materiaData[] = ['nombre' => 'Mantenimiento de Sitios Web', 'id_carrera' => $idCarreraDesarrolloWeb, 'id_profesor' => $idProfesorPedroLopez];
        $materiaData[] = ['nombre' => 'Diseño Responsivo', 'id_carrera' => $idCarreraDesarrolloWeb, 'id_profesor' => $idProfesorAnaMartinez];
        $materiaData[] = ['nombre' => 'Programación Backend', 'id_carrera' => $idCarreraDesarrolloWeb, 'id_profesor' => $idProfesorJuanPerez];
        $materiaData[] = ['nombre' => 'Frameworks de Desarrollo Web', 'id_carrera' => $idCarreraDesarrolloWeb, 'id_profesor' => $idProfesorMariaGomez];

        // Materias para Ingeniería en Informática
        $materiaData[] = ['nombre' => 'Programación Avanzada', 'id_carrera' => $idCarreraInformatica, 'id_profesor' => $idProfesorJuanPerez];
        $materiaData[] = ['nombre' => 'Bases de Datos', 'id_carrera' => $idCarreraInformatica, 'id_profesor' => $idProfesorMariaGomez];
        $materiaData[] = ['nombre' => 'Redes de Computadoras', 'id_carrera' => $idCarreraInformatica, 'id_profesor' => $idProfesorPedroLopez];
        $materiaData[] = ['nombre' => 'Sistemas Operativos', 'id_carrera' => $idCarreraInformatica, 'id_profesor' => $idProfesorAnaMartinez];
        $materiaData[] = ['nombre' => 'Inteligencia Artificial', 'id_carrera' => $idCarreraInformatica, 'id_profesor' => $idProfesorJuanPerez];
        $materiaData[] = ['nombre' => 'Desarrollo de Software', 'id_carrera' => $idCarreraInformatica, 'id_profesor' => $idProfesorMariaGomez];

        // Materias para Licenciatura en Matemáticas
        $materiaData[] = ['nombre' => 'Álgebra Lineal', 'id_carrera' => $idCarreraMatematicas, 'id_profesor' => $idProfesorPedroLopez];
        $materiaData[] = ['nombre' => 'Cálculo Integral', 'id_carrera' => $idCarreraMatematicas, 'id_profesor' => $idProfesorAnaMartinez];
        $materiaData[] = ['nombre' => 'Geometría Analítica', 'id_carrera' => $idCarreraMatematicas, 'id_profesor' => $idProfesorJuanPerez];
        $materiaData[] = ['nombre' => 'Teoría de Números', 'id_carrera' => $idCarreraMatematicas, 'id_profesor' => $idProfesorMariaGomez];
        $materiaData[] = ['nombre' => 'Análisis Matemático', 'id_carrera' => $idCarreraMatematicas, 'id_profesor' => $idProfesorPedroLopez];
        $materiaData[] = ['nombre' => 'Ecuaciones Diferenciales', 'id_carrera' => $idCarreraMatematicas, 'id_profesor' => $idProfesorAnaMartinez];

        // Materias para Analista Contable
        $materiaData[] = ['nombre' => 'Contabilidad General', 'id_carrera' => $idCarreraContable, 'id_profesor' => $idProfesorPedroLopez];
        $materiaData[] = ['nombre' => 'Legislación Tributaria', 'id_carrera' => $idCarreraContable, 'id_profesor' => $idProfesorAnaMartinez];
        $materiaData[] = ['nombre' => 'Auditoría Contable', 'id_carrera' => $idCarreraContable, 'id_profesor' => $idProfesorJuanPerez];
        $materiaData[] = ['nombre' => 'Costos y Presupuestos', 'id_carrera' => $idCarreraContable, 'id_profesor' => $idProfesorMariaGomez];
        $materiaData[] = ['nombre' => 'Contabilidad Financiera', 'id_carrera' => $idCarreraContable, 'id_profesor' => $idProfesorPedroLopez];
        $materiaData[] = ['nombre' => 'Matemáticas Financieras', 'id_carrera' => $idCarreraContable, 'id_profesor' => $idProfesorAnaMartinez];

        // Materias para Profesorado de Inglés
        $materiaData[] = ['nombre' => 'Gramática Inglesa', 'id_carrera' => $idCarreraIngles, 'id_profesor' => $idProfesorMariaGomez];
        $materiaData[] = ['nombre' => 'Literatura en Inglés', 'id_carrera' => $idCarreraIngles, 'id_profesor' => $idProfesorAnaMartinez];
        $materiaData[] = ['nombre' => 'Conversación en Inglés', 'id_carrera' => $idCarreraIngles, 'id_profesor' => $idProfesorJuanPerez];
        $materiaData[] = ['nombre' => 'Fonética Inglesa', 'id_carrera' => $idCarreraIngles, 'id_profesor' => $idProfesorMariaGomez];
        $materiaData[] = ['nombre' => 'Cultura Inglesa', 'id_carrera' => $idCarreraIngles, 'id_profesor' => $idProfesorPedroLopez];
        $materiaData[] = ['nombre' => 'Metodología de la Enseñanza del Inglés', 'id_carrera' => $idCarreraIngles, 'id_profesor' => $idProfesorAnaMartinez];


        $this->batchInsert('{{%materia}}', ['nombre', 'id_carrera', 'id_profesor'], $materiaData);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->delete('{{%materia}}', ['nombre' => 'Diseño de Páginas Web']);
        $this->delete('{{%materia}}', ['nombre' => 'Programación Frontend']);
        $this->delete('{{%materia}}', ['nombre' => 'Mantenimiento de Sitios Web']);
        $this->delete('{{%materia}}', ['nombre' => 'Diseño Responsivo']);
        $this->delete('{{%materia}}', ['nombre' => 'Programación Backend']);
        $this->delete('{{%materia}}', ['nombre' => 'Frameworks de Desarrollo Web']);

        $this->delete('{{%materia}}', ['nombre' => 'Programación Avanzada']);
        $this->delete('{{%materia}}', ['nombre' => 'Bases de Datos']);
        $this->delete('{{%materia}}', ['nombre' => 'Redes de Computadoras']);
        $this->delete('{{%materia}}', ['nombre' => 'Sistemas Operativos']);
        $this->delete('{{%materia}}', ['nombre' => 'Inteligencia Artificial']);
        $this->delete('{{%materia}}', ['nombre' => 'Desarrollo de Software']);

        $this->delete('{{%materia}}', ['nombre' => 'Álgebra Lineal']);
        $this->delete('{{%materia}}', ['nombre' => 'Cálculo Integral']);
        $this->delete('{{%materia}}', ['nombre' => 'Geometría Analítica']);
        $this->delete('{{%materia}}', ['nombre' => 'Teoría de Números']);
        $this->delete('{{%materia}}', ['nombre' => 'Análisis Matemático']);
        $this->delete('{{%materia}}', ['nombre' => 'Ecuaciones Diferenciales']);

        $this->delete('{{%materia}}', ['nombre' => 'Contabilidad General']);
        $this->delete('{{%materia}}', ['nombre' => 'Legislación Tributaria']);
        $this->delete('{{%materia}}', ['nombre' => 'Auditoría Contable']);
        $this->delete('{{%materia}}', ['nombre' => 'Costos y Presupuestos']);
        $this->delete('{{%materia}}', ['nombre' => 'Contabilidad Financiera']);
        $this->delete('{{%materia}}', ['nombre' => 'Matemáticas Financieras']);

        $this->delete('{{%materia}}', ['nombre' => 'Gramática Inglesa']);
        $this->delete('{{%materia}}', ['nombre' => 'Literatura en Inglés']);
        $this->delete('{{%materia}}', ['nombre' => 'Conversación en Inglés']);
        $this->delete('{{%materia}}', ['nombre' => 'Fonética Inglesa']);
        $this->delete('{{%materia}}', ['nombre' => 'Cultura Inglesa']);
        $this->delete('{{%materia}}', ['nombre' => 'Metodología de la Enseñanza del Inglés']);

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
