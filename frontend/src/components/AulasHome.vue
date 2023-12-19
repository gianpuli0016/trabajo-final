<template>
  <v-container class="home-container">
    <v-row>
      <v-col class="text-center">
        <v-img
          alt="Aulas Logo"
          class="mx-auto"
          contain
          :src="require('../assets/curza.png')"
          width="150"
        />
        <h1 class="mt-4">¡Bienvenido a Gestion Curza!</h1>
        <h1 class="mt-4">Centro Universitario Regional Zona Atlántica</h1>
        <p>Plataforma para gestionar informacion academica.</p>
        <v-btn @click="explore" color="primary">Explorar Aulas</v-btn>
      </v-col>
    </v-row>
  </v-container>
  <v-footer class="d-flex flex-wrap justify-content-between align-items-center border-button" border>
    <p>© 2023 Trabajo Final</p>
    <v-spacer></v-spacer>
    <p>Desarrollado por: Pier Gianluca Pulichino</p>
  </v-footer>
  
</template>
  
<script>
export default {
  name: 'AulasHome',

  methods: {
    explore() {
      this.$router.push({ name: 'ListarAulas' });
    },
  },
};
</script>
  

<style scoped>
.home-container {
  min-height: 78vh; /* Mínimo 100% del alto de la pantalla */
  display: flex;
  flex-direction: column;
  overflow-y: hidden;
}

v-container {
  flex: 1; /* El contenido del v-container ocupa el espacio disponible */
}

.footer-v {
  margin-bottom: 0%;
}

</style>