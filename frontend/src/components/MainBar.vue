<template>
  <v-container>
    <v-app-bar density="compact">
      <v-list-item class="mx-auto">
        <v-img
          alt="Aulas Logo"
          class="shrink mr-2"
          contain
          :src="require('../assets/curza.png')"
          transition="scale-transition"
          width="40"
        />
      </v-list-item>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-app-bar-title class="ml-2">Aulas Curza</v-app-bar-title>
      <v-spacer></v-spacer>
      <v-btn icon>
        <v-icon>mdi-bell-outline</v-icon>
      </v-btn>
      <v-menu offset-y>
        <template v-slot:activator="{ on }">
          <v-btn icon v-on="on">
            <v-icon>mdi-account-circle-outline</v-icon>
          </v-btn>
        </template>
        <v-list>
          <v-list-item @click="goToProfile">
            <v-list-item-title>Mi Perfil</v-list-item-title>
          </v-list-item>
          <v-list-item @click="logout">
            <v-list-item-title>Cerrar Sesión</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>

    <!-- Menú desplegable -->
    <v-navigation-drawer app v-model="drawer">
      <!-- Contenido del menú desplegable -->
      <v-list>
        <v-list-item @click="goToHome">
          <v-list-item-title>HOME</v-list-item-title><v-icon>mdi-home</v-icon>
        </v-list-item>
        <v-list-item @click="goToAulas">
          <v-list-item-title>AULAS</v-list-item-title><v-icon>mdi-google-classroom</v-icon>
        </v-list-item>
        <v-list-item @click="goToProfesores">
          <v-list-item-title>PROFESORES</v-list-item-title><v-icon>mdi-account-group</v-icon>
        </v-list-item>
        <v-list-item @click="goToCarreras">
          <v-list-item-title>CARRERAS</v-list-item-title><v-icon>mdi-school</v-icon>
        </v-list-item>
        <!-- Agrega más elementos de navegación según sea necesario -->
      </v-list>
    </v-navigation-drawer>
  </v-container>
</template>

<script>
export default {
  name: 'MainBar',

  data: () => ({
    drawer: false, // Agrega la propiedad drawer para controlar el estado del menú desplegable
  }),
  methods: {
    goToProfile() {
      console.log('Ir a perfil...');
    },
    logout() {
      console.log('Cerrar sesión...');
    },
    goToAulas() {
      this.$router.push({ name: 'ListarAulas' });
      this.drawer = false;
    },
    goToProfesores() {
      this.$router.push({ name: 'ListarProfesores' });
      this.drawer = false;
    },
    goToCarreras() {
      this.$router.push({ name: 'AbmCarreras' });
      this.drawer = false;
    },
    goToHome() {
      this.$router.push({ name: 'AulasHome' });
      this.drawer = false;
    },
  },
};
</script>
