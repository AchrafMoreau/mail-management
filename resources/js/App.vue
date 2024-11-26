<template>
  <div class="flex">
    <!-- Première colonne (menu) -->
    <nav class="w-1/4 bg-gray-200 p-4">
      <ul>
        <li><router-link to="/gestion-courrier">Gestion de courrier</router-link></li>
        <li><router-link to="/gestion-decharges">Gestion de décharges</router-link></li>
        <li><router-link to="/historique">Historique</router-link></li>
      </ul>
    </nav>

    <!-- Deuxième colonne (contenu dynamique) -->
    <main class="w-3/4 p-4">
      <router-view></router-view> <!-- Affiche le composant correspondant à la route -->
    </main>
  </div>
</template>

<script>
export default {
  name: 'App',
};
</script>

<style>
/* Ajoutez ici les styles spécifiques si nécessaire */
</style>
