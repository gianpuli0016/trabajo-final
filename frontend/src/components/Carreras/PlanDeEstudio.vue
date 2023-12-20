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
          <th class="text-left">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <template v-for="(materia, index) in materiasOrdenadas" :key="materia.id">
          <tr>
            <td>{{ materia.id }}</td>
            <td>{{ materia.nombre }}</td>
            <td>{{ materia.profesor.apellido + ', ' + materia.profesor.nombre}}</td>
            <td>{{ materia.anio }}</td>
            <td>{{ materia.periodo }}</td>
            <td>
              <v-btn color="primary">Ver</v-btn>
            </td>
            <td>
              <v-btn @click="actualizarMateria(materia.id)" color="primary">Editar</v-btn>
            </td>
          </tr>
          <!-- Añade línea divisoria -->
          <td v-if="deberiaMostrarLinea(index)" colspan="7" class="linea"></td>
        </template>
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
    this.tuCarreraId = this.$route.params.idCarrera;
    this.cargarNombreCarrera();
    this.cargarMaterias();
  },
  computed: {
    materiasOrdenadas() {
      return this.materias.slice().sort((a, b) => {
        if (a.anio === b.anio) {
          return a.periodo.localeCompare(b.periodo);
        }
        return a.anio - b.anio;
      });
    },
  },
  methods: {
    cargarMaterias() {
      this.axios
        .get(`/apiv1/materia?filter[id_carrera]=${this.tuCarreraId}`)
        .then((response) => {
          this.materias = response.data;
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
      this.axios
        .get(`/apiv1/carrera/${this.tuCarreraId}`)
        .then((response) => {
          this.nombreCarrera = response.data.nombre;
        })
        .catch((error) => {
          console.error("Error al cargar el nombre de la carrera", error);
        });
    },
    // Determina si se debe mostrar la línea divisoria
    deberiaMostrarLinea(index) {
      return (
        index < this.materiasOrdenadas.length - 1 &&
        this.materiasOrdenadas[index].anio !== this.materiasOrdenadas[index + 1].anio
      );
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

.linea {
  border-top: 1px solid rgb(0, 127, 247); /* Estilo de la línea divisoria */
}
</style>
