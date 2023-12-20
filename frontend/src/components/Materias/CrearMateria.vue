<template>
    <div>
        <h1>Materias</h1>

        <v-text-field
        v-model="registro.nombre"
        label="Nombre"
        required
        ></v-text-field>

        <v-select
        v-model="registro.id_carrera"
        :items="carreras"
        label="Carrera"
        item-title="nombre"
        item-value="id"
        required
        >
        </v-select>

        <v-select
        v-model="registro.id_profesor"
        :items="profesoresConNombreCompleto"
        label="Profesor"
        item-title="nombreCompleto" 
        item-value="id"
        required
        >
        </v-select>

        <v-text-field
        v-model="registro.anio"
        label="Año"
        ></v-text-field>

        <v-text-field
        v-model="registro.periodo"
        label="Periodo"
        ></v-text-field>
        
        <BotoneraAbm
            @save="save()"
        >
        </BotoneraAbm>
    </div>
</template>

<script>
import BotoneraAbm from "../BotoneraAbm.vue";

export default {
    name: "CrearMateria",
    components: { BotoneraAbm },
    data(){ 
        return {
            registro: {
                id: null,
                nombre: '',
                id_carrera: null,
                id_profesor: '',
                anio:'',
                periodo: '',
            },
            carreras: [],
            profesores: [],
            profesoresConNombreCompleto: [],
            currentPage: 0,
            pageCount: 0,
            totalCount: 0,
            cargando: false,
        };
    },
    methods: {
        save(){
            const data = {
                'nombre': this.registro.nombre,
                'id_carrera': this.registro.id_carrera,
                'id_profesor': this.registro.id_profesor,
                'anio': this.registro.anio,
                'periodo': this.registro.periodo,
            } 
            console.log(data)
            var that = this;
            this.axios.post('/apiv1/materia', data)
                .then(function (response) {
                    // handle success
                    console.log(response);
                    alert('Registro Guardado!!')
                    that.registro.id = null
                    that.registro.nombre = ''
                    that.registro.id_carrera = ''
                    that.registro.id_profesor = ''
                    that.registro.anio = ''
                    that.registro.periodo = ''
                }
                ) 
                  .catch(function (error) {
                    // handle error
                    console.log(error);
                   })
                   .then(function () {
                    // always executed
                    that.cargando = false;
                    });
        },
        resetForm() {
            this.registro = {
                id: null,
                nombre: '',
                id_carrera: null,
                id_profesor: '',
                anio: '',
                periodo: '',
            };
        },
        cargarCarreras() {
            var that = this;
            this.axios
                .get("/apiv1/carrera")
                .then(function (response) {
                    that.carreras = response.data;
                    if (that.carreras.length > 0) {
                        // Obtener el ID de la carrera desde la URL y establecer como valor predeterminado
                        const idCarreraFromURL = that.$route.params.idCarrera;
                        const carreraSeleccionada = that.carreras.find(c => c.id === idCarreraFromURL);
                        that.registro.id_carrera = carreraSeleccionada ? carreraSeleccionada.id : null;
                    }
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
    },
    watch: {
        carreras: function(newCarreras) {
            if (newCarreras.length > 0) {
                const idCarreraFromURL = this.$route.params.idCarrera;
                const carreraSeleccionada = newCarreras.find(c => c.id == idCarreraFromURL);
                this.registro.id_carrera = carreraSeleccionada ? carreraSeleccionada.id : null;
            }
        }
    },
    mounted() {
        this.resetForm();
        this.cargarCarreras();
        this.cargarProfesores();
    }

}

</script>