<template>
    <div>
      <h1 class="titulo">PLAN DE ESTUDIO</h1>
      <h2>Carrera: {{ nombreCarrera }}</h2>
      <v-table height="500px" theme="light" class="tabla">
        <thead>
          <tr>
            <th class="text-left">Materia</th>
            <th class="text-left">Nombre</th>
            <th class="text-left">Catedra</th>
            <th class="text-left">Año</th>
            <th class="text-left">Periodo</th>
            <th class="text-left">Correlativas</th>
            <th class="text-left">Acciones</th> <!-- Nueva columna para acciones -->
            <!-- Otras columnas relevantes del plan de estudios -->
          </tr>
        </thead>
        <tbody>
          <tr v-for="materia in materias" :key="materia.id">
            <td>{{ materia.id }}</td>
            <td>{{ materia.nombre }}</td>
            <td>{{ materia.profesor.apellido + ', ' + materia.profesor.nombre}}</td>
            <td>{{ '1'}}</td>
            <td>{{ '1º Cuatrimestre'}}</td>
            <td>
            <v-btn color="primary">Ver</v-btn>
            </td>
            <td>
            <v-btn @click="actualizarMateria(materia.id)" color="primary">Editar</v-btn>
            </td>
            <!-- Otras celdas relevantes del plan de estudios -->
          </tr>
        </tbody>
      </v-table>
      <v-btn @click="agregarMateria(this.tuCarreraId)" color="primary">Agregar Materia</v-btn>
    </div>
</template>
  
<script>
    export default {
    name: "PlanDeEstudio",
    data: () => ({
        tuCarreraId: null,
        materias: [],
        nombreCarrera: "",
    }),
    created() {
      // Cuando se crea el componente, cargar las materias del plan de estudios
      this.tuCarreraId = this.$route.params.idCarrera;
      this.cargarNombreCarrera(); 
      this.cargarMaterias();
    },
    methods: {
        cargarMaterias() {
            var that = this;
            // Hacer una solicitud al servidor para obtener las materias asociadas a la carrera
            this.axios
            .get(`/apiv1/materia?filter[id_carrera]=${that.$data.tuCarreraId}`)
            .then((response) => {
                that.materias = response.data;
            })
            .catch((error) => {
                console.error("Error al cargar materias", error);
            });
        },
        actualizarMateria(id) {
            this.$router.push({ name: "ActualizarMateria", params: { materiaId: id } });
        },
        agregarMateria(id) {
            this.$router.push({ name: "CrearMateria", params: { idCarrera: id } });
        },
        cargarNombreCarrera() {
            this.axios.get(`/apiv1/carrera/${this.tuCarreraId}`)
                .then((response) => {
                this.nombreCarrera = response.data.nombre;
                })
                .catch((error) => {
                console.error("Error al cargar el nombre de la carrera", error);
                });
        },
    },
    
    };
</script>
  
<style scoped>
.titulo {
  font-size: 32px;
  font-weight: bold;
  color: #35424a;
  text-align: center;
  margin-bottom: 20px;
  margin-top: 20px;
  text-transform: uppercase;
}

.tabla {
  margin-bottom: 20px;
}
</style>
  