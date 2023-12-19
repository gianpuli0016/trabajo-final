<template>
    <div>
        <h1>AULAS</h1>

        <v-table theme="dark">
        <thead>
        <tr>
            <th class="text-left">
                ID
            </th>
            <th class="text-left">
            Descripción
            </th>
            <th class="text-left">
            Ubicacion
            </th>
            <th class="text-left">
            Cantidad PC
            </th>
            <th class="text-left">
            Cantidad Proyector
            </th>
            <th class="text-left">
            Aforo
            </th>
            <th class="text-left">
            Climatizada
            </th>
        </tr>
        </thead>
        <tbody>
        <tr
            v-for="item in aulas"
            :key="item.name"
        >
            <td>{{ item.id }}</td>
            <td>{{ item.descripcion }}</td>
            <td>{{ item.ubicacion }}</td>
            <td>{{ item.cant_pcs }}</td>
            <td>{{ item.cant_proyector }}</td>
            <td>{{ item.aforo }}</td>
            <td>{{ item.es_climatizada }}</td>
 
        </tr>
        </tbody>
        </v-table>
        
        <h1>Agregar nueva aula</h1>
        <v-text-field
        v-model="registro.descripcion"
        label="Descripción"
        required
        ></v-text-field>
        <v-text-field
        v-model="registro.ubicacion"
        label="Ubicación"
        required
        ></v-text-field>
        <v-text-field
        v-model="registro.aforo"
        label="Aforo"
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
import BotoneraAbm from "./BotoneraAbm.vue";

export default {
    name: "AbmAulas",
    components: { BotoneraAbm },
    data: () => ({
        registro: {
            id: null,
            descripcion: null,
            ubicacion: null,
            cant_pcs: 0,
            cant_proyector: 0,
            aforo: 0,
            es_climatizada: false
        },
        currentPage: 0,
        pageCount: 0,
        totalCount: 0,
        cargando: false,
        headers: [
        { text: 'ID', value: 'id' },
        { text: 'Descripción', value: 'descripcion' },
        { text: 'Ubicación', value: 'ubicacion' },
        { text: 'PCs', value: 'cant_pcs' },
        { text: 'Proyector', value: 'cant_proyector' },
        { text: 'Aforo', value: 'aforo' },
        { text: 'Climatizada', value: 'es_climatizada' },
        { text: 'Acciones', value: 'acciones' },
        ],
        aulas: [],
    }),
    created() {
        this.listarAulas();
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
            console.log('/apiv1/aula?per-page=1&page=' + page)
            this.cargando = true;
            var that = this;
            this.axios.get('/apiv1/aula?per-page=1&page=' + page)
                .then(function (response) {
                    if (response.data.length > 0) {
                      // handle success
                      that.registro.id = response.data[0].id
                      that.registro.descripcion = response.data[0].descripcion
                      that.registro.ubicacion = response.data[0].ubicacion
                      that.registro.cant_pcs = response.data[0].cant_pcs
                      that.registro.cant_proyector= response.data[0].cant_proyector
                      that.registro.aforo = response.data[0].aforo
                      that.registro.es_climatizada = response.data[0].es_climatizada
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
                'descripcion': this.registro.descripcion,
                'ubicacion': this.registro.ubicacion,
                'cant_pcs': this.registro.cant_pcs,
                'cant_proyector': this.registro.cant_proyector,
                'aforo': this.registro.aforo,
                'es_climatizada': this.registro.es_climatizada
            }  
            console.log(data)
            var that = this;
            this.axios.post('/apiv1/aula', data)
                .then(function (response) {
                    // handle success
                    console.log(response);
                    alert('Registro Guardado!!')
                    that.registro.id = response.data.id
                    that.registro.descripcion = ''
                    that.registro.ubicacion = ''
                    that.registro.cant_pcs = response.data.cant_pcs
                    that.registro.cant_proyector = response.data.cant_proyector
                    that.registro.aforo = response.data.aforo
                    that.registro.es_climatizada = response.data.es_climatizada
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
            this.axios.delete('/apiv1/aula/'+ this.registro.id)
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
              that.loadData(parseInt(this.currentPage));
            });
        },
        listarAulas() {
            var that = this;
            this.axios.get('/apiv1/aula')
            .then(function (response) {
                that.aulas = response.data;
            })
        },
        resetForm() {
            this.registro = {
            id: null,
            descripcion: '',
            ubicacion: '',
            cant_pcs: 0,
            cant_proyector: 0,
            aforo: 0,
            es_climatizada: false,
            };
        },
    },
    mounted() {
        this.resetForm();
    }

}

</script>