<template>
    <div>
        <h1 class="titulo">GESTIÓN DE AULAS</h1>
        <v-table height="500px" theme="light" class="tabla">
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
            <td>{{ item.es_climatizada ? 'Sí' : 'No' }}</td>
 
        </tr>
        </tbody>
        </v-table>
        <v-btn elevation="2" @click="redireccionarACrearAula" color="primary" class="custom-btn">
        Crear Nueva Aula
        </v-btn>
    </div>
</template>

<script>

export default {
    name: "ListarAulas",
    components: {},
    data: () => ({
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
        listarAulas() {
            var that = this;
            this.axios.get('/apiv1/aula')
            .then(function (response) {
                that.aulas = response.data;
            })
        },
        redireccionarACrearAula() {
            this.$router.push({ name: "CrearAula" }); // Redireccionar al componente Crear
        },
        
    },
    mounted() {
        
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

.custom-btn {
  padding: 10px 20px;
  font-size: 16px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-bottom: 20px;
  transition: background-color 0.3s ease-in-out;
}
</style>