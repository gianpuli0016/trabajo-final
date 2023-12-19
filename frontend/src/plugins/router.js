import { createRouter, createWebHistory } from "vue-router";

import AulasHome from '../components/AulasHome';
import ListarAulas from '../components/Aulas/ListarAulas';
import CrearAula from '../components/Aulas/CrearAula';

import ListarProfesores from '../components/Profesores/ListarProfesores';
import CrearProfesor from '../components/Profesores/CrearProfesor';

import AbmCarreras from '../components/Carreras/AbmCarreras';
import PlanDeEstudio from '../components/Carreras/PlanDeEstudio';

import CrearMateria from '../components/Materias/CrearMateria';
import ActualizarMateria from '../components/Materias/ActualizarMateria';
//Vue.use(VueRouter)

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes: [
        {path: '/', name: 'AulasHome', component: AulasHome},
        {path: '/aulas', name: 'ListarAulas', component: ListarAulas},
        {path: '/aulas', name: 'CrearAula', component: CrearAula},

        {path: '/profesores', name: 'ListarProfesores', component: ListarProfesores},
        {path: '/profesores', name: 'CrearProfesor', component: CrearProfesor},

        {path: '/carreras', name: 'AbmCarreras', component: AbmCarreras},
        {path: '/carreras/:idCarrera/plan-estudio', name: 'PlanDeEstudio', component: PlanDeEstudio},

        {path: '/materias/:idCarrera', name: 'CrearMateria', component: CrearMateria},
        {path: '/materias/:materiaId', name: 'ActualizarMateria', component: ActualizarMateria}
    ]
})

export default router;