<template>
    <div>
      <h1 class="titulo">ELIMINAR RESERVA</h1>
      <v-form ref="form" v-model="valid" lazy-validation>
        <v-select
          v-model="reservaSeleccionada"
          :items="reservas"
          label="Seleccionar Reserva"
          item-title="observacion"
          item-value="id"
          outlined
          required
        ></v-select>
  
        <v-btn @click="eliminarReserva" color="primary">
          Eliminar Reserva
        </v-btn>
      </v-form>
    </div>
  </template>
  
  <script>
  export default {
    name: "EliminarReserva",
    data: () => ({
      valid: true,
      reservas: [],
      reservaSeleccionada: null,
    }),
    created() {
      this.cargarReservas();
    },
    methods: {
      cargarReservas() {
        var that = this;
        this.axios
          .get("/apiv1/reservaaula")
          .then(function (response) {
            that.reservas = response.data;
            console.log(that.reservas)
          })
          .catch(function (error) {
            console.error("Error al cargar las reservas:", error);
          });
      },
      eliminarReserva() {
        if (this.$refs.form.validate()) {
          var that = this;
          // Realizar la solicitud DELETE para eliminar la reserva seleccionada
          this.axios
            .delete(`/apiv1/reservaaula/${that.reservaSeleccionada}`)
            .then((response) => {
              console.log("Reserva eliminada con éxito:", response.data);

              // Filtrar la lista de reservas para excluir la reserva eliminada
              that.reservas = that.reservas.filter(
                (reserva) => reserva.id !== that.reservaSeleccionada
              );
              // Limpiar la selección
              that.reservaSeleccionada = null;
            })
            .catch((error) => {
              console.error("Error al eliminar la reserva:", error);
            });
        }
      },
    },
  };
  </script>
  
  <style scoped>
  /* Puedes agregar estilos específicos para este componente si es necesario */
  </style>
  