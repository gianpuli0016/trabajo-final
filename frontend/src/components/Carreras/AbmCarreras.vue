<template>
    <div>
        <h1 class="titulo">GESTIÓN DE CARRERAS</h1>
        <v-table fixed-header height="300px" theme="light" class="tabla">
        <thead>
        <tr>
            <th class="text-center">
                ID
            </th>
            <th class="text-center">
            Nombre
            </th>
            <th class="text-center">
            Plan De Estudio
            </th>
        </tr>
        </thead>
        <tbody class="text-center">
        <tr
            v-for="item in carreras"
            :key="item.name"
        >
            <td>{{ item.id }}</td>
            <td>{{ item.nombre }}</td>
            <td>
                <v-btn @click="verPlanEstudios(item.id)" color="primary" density="compact" rounded="xl">
                    Ver Plan de Estudios
                </v-btn>
            </td>
        </tr>
        </tbody>
        </v-table>
        <v-divider></v-divider>
        <container>
            <h2>AGREGAR NUEVA CARRERA</h2>
            <v-text-field
            v-model="registro.nombre"
            label="Nombre"
            required
            ></v-text-field>

            <BotoneraAbm
                @first="first()"
                @prev="prev()"
                @next="next()"
                @last="last()"
                @save="save()"
                @remove="remove()"
            >
            </BotoneraAbm>
        </container>
    </div>
</template>

<script>
import BotoneraAbm from "../BotoneraAbm.vue";

export default {
    name: "AbmCarrera",
    components: { BotoneraAbm },
    data: () => ({
        registro: {
            id: null,
            nombre: '',

        },
        currentPage: 0,
        pageCount: 0,
        totalCount: 0,
        cargando: false,
        headers: [
        { text: 'ID', value: 'id' },
        { text: 'Nombre', value: 'nombre' },
        ],
        carreras: [],
    }),
    created() {
        this.listarCarreras();
    },
    methods: {
        first(){
            this.loadData(1)
        },
        next(){
            this.loadData(parseInt(this.currentPage) + 1)
        },
        prev(){
            this.loadData(parseInt(this.currentPage) - 1)
        },
        last(){
            this.loadData(parseInt(this.pageCount))
        },
        loadData(page){
            console.log(page);
            console.log('/apiv1/carrera?per-page=1&page=' + page)
            this.cargando = true;
            var that = this;
            this.axios.get('/apiv1/carrera?per-page=1&page=' + page)
                .then(function (response) {
                    if (response.data.length > 0) {
                      // handle success
                      that.registro.id = response.data[0].id
                      that.registro.nombre = response.data[0].nombre
                      that.currentPage = response.headers["x-pagination-current-page"]
                      that.pageCount = response.headers["x-pagination-page-count"]
                      that.totalCount = response.headers["x-pagination-total-count"]
                    }
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                    that.cargando = false;
                });
        },
        save(){
            const data = {
                'nombre': this.registro.nombre
            }  
            console.log(data)
            var that = this;
            this.axios.post('/apiv1/carrera', data)
                .then(function (response) {
                    // handle success
                    console.log(response);
                    alert('Registro Guardado!!')
                    // Agrega la nueva carrera al array
                    that.carreras.push({
                        id: response.data.id,
                        nombre: response.data.nombre
                    });
                    that.registro.id = response.data.id
                    that.registro.nombre = ''
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
            
        remove(){
            var that = this;
            this.axios.delete('/apiv1/carrera/'+ this.registro.id)
            .then(function(response){
                //hadle success
                console.log(response);
                alert('Registro Eliminado!!')
                // Encuentra la posición de la carrera en el array
                const index = that.carreras.findIndex(carrera => carrera.id === that.registro.id);

                // Elimina la carrera del array
                if (index !== -1) {
                that.carreras.splice(index, 1);
                }

                // Restablece el formulario
                that.resetForm();
            }) 
            .catch(function (error) {
              // handle error
              console.log(error);
            })
        },
        listarCarreras() {
            var that = this;
            this.axios.get('/apiv1/carrera')
            .then(function (response) {
                that.carreras = response.data;
            })
        },
        resetForm() {
            this.registro = {
            id: null,
            nombre: '',
            };
        },
        verPlanEstudios(carreraId) {
            this.$router.push({ name: "PlanDeEstudio", params: { idCarrera: carreraId } });
        },
    },
    mounted() {
        this.resetForm();
    }

}

</script>

<style scoped>
.titulo {
    font-size: 32px;
    font-weight: bold;
    color: #35424a;
    text-align: center;
    margin-bottom: 20px;
    text-transform: uppercase;
}

.tabla {
    margin-bottom: 20px;
}
</style>