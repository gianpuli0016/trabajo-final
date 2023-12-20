<template>
    <div>
      <h1>Actualizar Materia</h1>
  
      <v-text-field v-model="registro.nombre" label="Nombre" required></v-text-field>
  
      <v-select
        v-model="registro.id_carrera"
        :items="carreras"
        label="Carrera"
        item-title="nombre"
        item-value="id"
        required
        disabled
      ></v-select>
  
      <v-select
      v-model="registro.id_profesor"
      :items="profesoresConNombreCompleto"
      label="Profesor"
      item-title="nombreCompleto" 
      item-value="id"
      required
      >
      </v-select>

      <v-select
        v-model="registro.anio"
        :items="anios"
        label="Año"
        item-title="value"
        item-value="value"
        required
      ></v-select>

      <v-select
        v-model="registro.periodo"
        :items="periodos"
        label="Periodo"
        item-title="value"
        item-value="value"
        required
      ></v-select>
  
      <BotoneraAbm @save="save"></BotoneraAbm>
    </div>
  </template>
  
  <script>
  import BotoneraAbm from "../BotoneraAbm.vue";
  
  export default {
    name: "BotoneraAbm",
    components: { BotoneraAbm },
    data() {
      return {
        registro: {
          id: null,
          nombre: "",
          id_carrera: null,
          id_profesor: "",
          anio: null,
          periodo: '',
        },
        carreras: [],
        profesores: [],
        profesoresConNombreCompleto: [],
        cargando: false,
        anios: [1, 2, 3, 4, 5],
        periodos: [ "1er Cuatrimestre", "2do Cuatrimetre"]
      };
    },
    methods: {
      save() {
        const data = {
          nombre: this.registro.nombre,
          id_carrera: this.registro.id_carrera,
          id_profesor: this.registro.id_profesor,
          anio: this.registro.anio,
          periodo: this.registro.periodo
        };
        console.log(data);
        var that = this;
        this.axios
          .put(`/apiv1/materia/${this.registro.id}`, data)
          .then(function (response) {
            console.log(response);
            alert("Registro Actualizado!!");
          })
          .catch(function (error) {
            console.log(error);
          })
          .then(function () {
            that.cargando = false;
          });
      },
      cargarMateria(id) {
        var that = this;
        this.axios
          .get(`/apiv1/materia/${id}`)
          .then(function (response) {
            that.registro = response.data;
            // Buscar el índice de la carrera y asignar el valor
            const carreraIndex = that.carreras.findIndex(c => c.id === response.data.carrera.id);
            that.registro.id_carrera = carreraIndex !== -1 ? that.carreras[carreraIndex].id : null;

            // Buscar el índice del profesor y asignar el valor
            const profesorIndex = that.profesores.findIndex(p => p.id === response.data.profesor.id);
            that.registro.id_profesor = profesorIndex !== -1 ? that.profesores[profesorIndex].id : null;
          })
          .catch(function (error) {
            console.error("Error al cargar la materia", error);
          });
      },
      cargarCarreras() {
        var that = this;
        this.axios
          .get("/apiv1/carrera")
          .then(function (response) {
            that.carreras = response.data;
          })
          .catch(function (error) {
            console.error("Error al cargar carreras", error);
          });
      },
      cargarProfesores() {
          var that = this;
          this.axios
              .get("/apiv1/profesor")
              .then(function (response) {
                  that.profesores = response.data;
                  that.profesoresConNombreCompleto = that.profesores.map(function (profesor) {
                      return {
                          id: profesor.id,
                          nombreCompleto: profesor.apellido + ", " + profesor.nombre,
                          mostrar: profesor.mostrar
                      };
                  });
              })
              .catch(function (error) {
                  console.error("Error al cargar profesores", error);
              });
      },
      remove(){
          var that = this;
          this.axios.delete('/apiv1/materia/'+ this.registro.id)
          .then(function(response){
              //hadle success
              console.log(response);
              alert('Registro Eliminado!!')
          }) 
          .catch(function (error) {
            // handle error
            console.log(error);
            })
          .then(function () {
            // always executed
            that.cargando = false;
            that.resetForm();
          });
      },
      resetForm() {
          this.registro = {
            id: null,
            nombre: "",
            id_carrera: null,
            id_profesor: "",
            anio: null,
            periodo: '',
          };
      },
    },
    mounted() {
        const materiaId = this.$route.params.materiaId;
        this.cargarCarreras();
        this.cargarProfesores();
        this.cargarMateria(materiaId);
    },
  };
  </script>
  