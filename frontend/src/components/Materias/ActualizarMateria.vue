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
        :items="profesores"
        label="Profesor"
        item-title="nombre"
        item-value="id"
        required
      ></v-select>
  
      <BotoneraAbm @save="save"></BotoneraAbm>
    </div>
  </template>
  
  <script>
  import BotoneraAbm from "../BotoneraAbm.vue";
  
  export default {
    name: "ActualizarMateria",
    components: { BotoneraAbm },
    data() {
      return {
        registro: {
          id: null,
          nombre: "",
          id_carrera: null,
          id_profesor: "",
        },
        carreras: [],
        profesores: [],
        cargando: false,
      };
    },
    methods: {
      save() {
        const data = {
          nombre: this.registro.nombre,
          id_carrera: this.registro.id_carrera,
          id_profesor: this.registro.id_profesor,
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
          })
          .catch(function (error) {
            console.error("Error al cargar profesores", error);
          });
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
  