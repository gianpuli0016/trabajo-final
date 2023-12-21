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
            <th class="text-left">
            Reservas
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
            <td>
                <!-- Mostrar las observaciones de las reservas -->
                <ul v-if="item.reservas && item.reservas.length">
                    <li v-for="reserva in item.reservas" :key="reserva.id">
                        {{ reserva.observacion }}
                    </li>
                </ul>
                <span v-else>No hay reservas</span>
            </td>
            <td>
                <v-btn @click="asignarReserva(item.id)" color="primary">Asignar Reserva</v-btn>
            </td>
        </tr>
        </tbody>
        </v-table>
        <v-btn elevation="2" @click="redireccionarAEditarAulas" color="primary" class="custom-btn">
        Editar Aulas
        </v-btn>
        <v-btn elevation="2" @click="eliminarReserva" color="primary" class="custom-btn">
        Eliminar Reserva
        </v-btn>
        <v-dialog v-model="mostrarFormulario" max-width="600">
            <v-card>
                <v-card-title>Asignar Reserva</v-card-title>
                <v-card-text>
                    <!-- campos de formulario -->
                    <v-select 
                    v-model="dataHorarioMateria.id_materia" 
                    :items="materias"  
                    label="Materia" 
                    item-title="nombre" 
                    item-value="id"></v-select>

                    <v-text-field v-model="formularioReserva.fh_desde" label="Fecha y Hora Desde" type="time"></v-text-field>
                    <v-text-field v-model="formularioReserva.fh_hasta" label="Fecha y Hora Hasta" type="time"></v-text-field>
                    <v-text-field v-model="formularioReserva.dia" label="Día"></v-text-field>
                    <v-text-field v-model="formularioReserva.observacion" label="Observación"></v-text-field>
                </v-card-text>
                <v-card-actions>
                    <v-btn @click="guardarReserva" color="primary">Guardar</v-btn>
                    <v-btn @click="cerrarFormulario">Cancelar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
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
    mostrarFormulario: false,
    formularioReserva: {
        id:null,
        id_aula: null,
        fh_desde: null,
        fh_hasta: null,
        dia: null,
        observacion: null,
    },
    dataHorarioMateria:{
        id_materia: null,
        id_reserva: null,
    },
    materias: []
}),
created() {
    this.listarAulas();
    this.listarMaterias(); 
},
methods: {
    listarAulas() {
        var that = this;
        this.axios.get('/apiv1/aula')
        .then(function (response) {
            that.aulas = response.data;
            // Para cada aula, obtener las reservas
            that.aulas.forEach(aula => {
                that.obtenerReservas(aula.id);
            });
        })
    },
    redireccionarAEditarAulas() {
        this.$router.push({ name: "EditarAulas" }); // Redireccionar al componente Crear
    },
    eliminarReserva() {
        this.$router.push({ name: "EliminarReserva" }); // Redireccionar al componente Crear
    },
    obtenerReservas(idAula) {
        var that = this;
        this.axios.get(`/apiv1/reservaaula?filter[id_aula]=${idAula}`)
        .then(function (response) {
            // Asignar las reservas al aula correspondiente
            const aula = that.aulas.find(aula => aula.id === idAula);
            if (aula) {
                aula.reservas = response.data;
            }
        });
    },
    asignarReserva(idAula) {
        // Configura el formulario con valores predeterminados
        this.formularioReserva = {
            id_aula: idAula,
            fh_desde: null,
            fh_hasta: null,
            dia: null,
            observacion: null,
        };

        // Muestra el formulario
        this.mostrarFormulario = true;
    },
    guardarReserva() {
        var that = this;

        const diaPredeterminado = new Date().toISOString().split("T")[0];
        this.formularioReserva.fh_desde = `${diaPredeterminado}T${this.formularioReserva.fh_desde}`;
        this.formularioReserva.fh_hasta = `${diaPredeterminado}T${this.formularioReserva.fh_hasta}`;

        // Realiza la solicitud POST para asignar la reserva con los datos del formulario
        this.axios.post("/apiv1/reservaaula", that.formularioReserva)
            .then(response => {
                console.log("Reserva asignada con éxito:", response.data);

                // Asignar el horario de la materia
                const idReserva = response.data.id; // Ajusta esto según la estructura de tu respuesta
                this.asignarHorarioMateria(that.dataHorarioMateria.id_materia, idReserva);
                // Cierra el formulario después de guardar la reserva
                this.cerrarFormulario();
            })
            .catch(error => {
                console.error("Error al asignar la reserva:", error);
            });
    },

    cerrarFormulario() {
        // Cierra el formulario
        this.mostrarFormulario = false;
    },

    listarMaterias() {
        var that = this;
        this.axios.get('/apiv1/materia')
            .then(function (response) {
                that.materias = response.data;
                console.log(that.materias);
            })
            .catch(function (error) {
                console.error('Error al cargar las materias:', error);
            });
    },

    asignarHorarioMateria(idMateria, idReserva) {
        const datosHorarioMateria = {
            id_materia: idMateria,
            id_reserva: idReserva,
        };

        this.axios.post("/apiv1/horariomateria", datosHorarioMateria)
            .then(response => {
                console.log("Horario de materia asignado con éxito:", response.data);
            })
            .catch(error => {
                console.error("Error al asignar el horario de materia:", error);
            });
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
  margin-right: 10px;
  transition: background-color 0.3s ease-in-out;
}
</style>