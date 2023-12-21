<template>
  <div>
    <h1 class="titulo">HORARIOS DE LA MATERIA</h1>

    <!-- Verificar si hay horarios -->
    <template v-if="horarios.length > 0">
      <v-table height="500px" theme="light" class="tabla">
        <thead>
          <tr>
            <th class="text-left">Día</th>
            <th class="text-left">Hora Desde</th>
            <th class="text-left">Hora Hasta</th>
            <th class="text-left">Aula</th>
            <th class="text-left">Observación</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="horario in horarios" :key="horario?.reserva?.id">
            <template v-if="horario?.reserva">
              <td>{{ horario?.reserva.dia || 'N/A' }}</td>
              <td>{{ formatHora(horario?.reserva.fh_desde) || 'N/A' }}</td>
              <td>{{ formatHora(horario?.reserva.fh_hasta) || 'N/A' }}</td>
              <td>{{ obtenerDescripcionAula(horario?.reserva.id_aula) || 'N/A' }}</td>
              <td>{{ horario?.reserva.observacion || 'N/A' }}</td>
            </template>
            <template v-else>
              <td colspan="5">Datos de horario no disponibles</td>
            </template>
          </tr>
        </tbody>
      </v-table>
    </template>

    <template v-else>
      <div>
        <p>No hay horarios establecidos para esta materia. Debe realizar una reserva para establecer los horarios de la materia.</p>
      </div>
    </template>
  </div>
</template>

<script>
export default {
  name: "ListarHorarios",
  data: () => ({
    horarios: [],
    aula: {},
    idAula: null,
    descripcionesAula: {}, 
  }),
  created() {
    this.listarHorarios();
  },
  methods: {
    listarHorarios() {
      var that = this;
      this.axios
        .get(`/apiv1/horariomateria?filter[id_materia]=${that.$route.params.materiaId}`)
        .then(function (response) {
          console.log(response.data)
          that.horarios = response.data;
          that.idAula = that.horarios[0]?.reserva?.id_aula;
          console.log(that.idAula);
        });
    },
    formatHora(fecha) {
      return new Date(fecha).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    },
    obtenerDescripcionAula(idAula) {
      var that = this;
      // Verificar si ya tenemos la descripción en el almacenamiento local
      if (that.descripcionesAula[idAula]) {
        return that.descripcionesAula[idAula];
      }
      // Si no, realizar la llamada a la API
      this.axios.get(`/apiv1/reservaaula?filter[id_aula]=${idAula}`)
        .then(response => {
          that.aula = response.data[0]?.aula;
          console.log(that.aula);
          const descripcion = that.aula?.descripcion;
          console.log(descripcion);
          // Almacenar la descripción en el almacenamiento local
          that.descripcionesAula[idAula] = descripcion;
        })
        .catch(error => {
          console.error('Error al obtener información del aula', error);
        });
    }
  },
};
</script>
