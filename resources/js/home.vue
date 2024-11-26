<template>
  <div class="home-container">
    <div class="stat-card">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75V19.5a.75.75 0 0 0 .75.75h6.75v-5.25a.75.75 0 0 1 .75-.75h2.25a.75.75 0 0 1 .75.75v5.25H20.25a.75.75 0 0 0 .75-.75V9.75a.75.75 0 0 0-.348-.624l-8.25-5.25a.75.75 0 0 0-.804 0l-8.25 5.25A.75.75 0 0 0 3 9.75Z" />
      </svg>
      <div class="stat-info">
        <h2>{{ courrierCount }}</h2>
        <p>Courriers reçus</p>
      </div>
    </div>
    <div class="stat-card">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
        <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
      </svg>
      <div class="stat-info">
        <h2>{{ dechargeCount }}</h2>
        <p>Décharges</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      courrierCount: 0,
      dechargeCount: 0,
    };
  },
  mounted() {
    this.fetchStats();
  },
  methods: {
    async fetchStats() {
      try {
        const response = await fetch('/api/home/stats');
        const data = await response.json();
        this.courrierCount = data.courrierCount;
        this.dechargeCount = data.dechargeCount;
      } catch (error) {
        console.error('Erreur lors de la récupération des statistiques :', error);
      }
    },
  },
};
</script>

<style>
.home-container {
  display: flex;
  justify-content: space-around;
  margin: 2rem;
}
.stat-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  padding: 1rem;
  background: #f9f9f9;
  border-radius: 0.5rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.stat-info h2 {
  font-size: 2rem;
  margin: 0.5rem 0;
}
.stat-info p {
  font-size: 1rem;
  color: #555;
}
</style>
