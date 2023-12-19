<template>
    <div>
        <h1>PROFESORES</h1>

        <v-btn @click="redireccionarAListarProfesores" color="primary" class="mr-4">
        Listar Profesores
        </v-btn>

        <v-text-field
        v-model="registro.nombre"
        label="Nombre"
        required
        ></v-text-field>
        <v-text-field
        v-model="registro.apellido"
        label="Apellido"
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
    </div>
</template>

<script>
import BotoneraAbm from "../BotoneraAbm.vue";

export default {
    name: "AbmProfesores",
    components: { BotoneraAbm },
    data: () => ({
        registro: {
            id: null,
            nombre: '',
            apellido: ''
        },
        currentPage: 0,
        pageCount: 0,
        totalCount: 0,
        cargando: false,
    }),
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
            console.log('/apiv1/profesor?per-page=1&page=' + page)
            this.cargando = true;
            var that = this;
            this.axios.get('/apiv1/profesor?per-page=1&page=' + page)
                .then(function (response) {
                    if (response.data.length > 0) {
                      // handle success
                      that.registro.id = response.data[0].id
                      that.registro.nombre = response.data[0].nombre
                      that.registro.apellido = response.data[0].apellido
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
                'nombre': this.registro.nombre,
                'apellido': this.registro.apellido,
                'mostrar': "si"
            }  
            console.log(data)
            var that = this;
            this.axios.post('/apiv1/profesor', data)
                .then(function (response) {
                    // handle success
                    console.log(response);
                    alert('Registro Guardado!!')
                    that.registro.id = response.data.id
                    that.registro.nombre = ''
                    that.registro.apellido = ''
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
            this.axios.delete('/apiv1/profesor/'+ this.registro.id)
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
              that.loadData(parseInt(that.currentPage));
            });
        },
        redireccionarAListarProfesores() {
        this.$router.push({ name: 'ListarProfesores' });
        },
        resetForm() {
            this.registro = {
            id: null,
            nombre: '',
            apellido: ''
            };
        },
    },
    mounted() {
        this.resetForm();
    }

}

</script>