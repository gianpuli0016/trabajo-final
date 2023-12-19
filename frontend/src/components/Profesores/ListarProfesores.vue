<template>
    <div>
        <h1 class="titulo">GESTIÓN DE PROFESORES</h1>
        <v-table height="500px" theme="light" class="tabla">
        <thead>
        <tr>
            <th class="text-left">
                ID
            </th>
            <th class="text-left">
            Nombre
            </th>
            <th class="text-left">
            Apellido
            </th>
        </tr>
        </thead>
        <tbody>
        <tr
            v-for="item in profesores"
            :key="item.name"
        >
            <td>{{ item.id }}</td>
            <td>{{ item.nombre }}</td>
            <td>{{ item.apellido }}</td>
 
        </tr>
        </tbody>
        </v-table>
        <v-btn elevation="2" @click="redireccionarACrearProfesor" color="primary" class="custom-btn">
        Crear Profesor
        </v-btn>
    </div>
</template>

<script>

export default {
    name: "ListarProfesores",
    components: {},
    data: () => ({
        headers: [
        { text: 'ID', value: 'id' },
        { text: 'Nombre', value: 'nombre' },
        { text: 'Apellido', value: 'Apellido' }
        ],
        profesores: [],
    }),
    created() {
        this.listarProfesores();
    },
    methods: {
        listarProfesores() {
            var that = this;
            this.axios.get('/apiv1/profesor')
            .then(function (response) {
                that.profesores = response.data;
            })
        },
        redireccionarACrearProfesor() {
            this.$router.push({ name: "CrearProfesor" }); // Redireccionar al componente Crear
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