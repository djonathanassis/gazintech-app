<template>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Home Page</h1>
        <div class="mb-4">
            <input type="text" v-model="search" placeholder="Search developers" 
            class="border border-gray-300 rounded-md px-3 py-2 wr-2" />
            <button @click="searchDevelopers" 
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Search</button>
        </div>
        <div v-if="error" class="text-red-500">{{ error }}</div>
        <div v-else-if="loading">Carregando...</div>
        <div v-else>
        <DataTable :headers="headers" :data="tableData" />
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import DataTable from '~/components/DataTable.vue';
import { useGet } from '~/composables/useApi';

const search = ref('');
const tableData = ref([])
const loading = ref(false)
const error = ref(null)

const headers = [
  { key: 'nivel', label: 'Nivel' },
];

onMounted(() => {
  fetchDevelopers()
})


const fetchDevelopers = async () => {
  loading.value = true
  error.value = null
  try {
    const { data, error: apiError } = await useGet('/api/niveis')
    if (apiError.value) {
      throw new Error(apiError.value.message)
    }
  
    tableData.value = data.value.data
  } catch (e) {
    console.error('Erro ao buscar desenvolvedores:', e)
    error.value = 'Ocorreu um erro ao carregar os dados. Por favor, tente novamente.'
  } finally {
    loading.value = false
  }
}


const searchDevelopers = () => {
  // Implementar a lógica de busca aqui
  console.log('Buscando por:', search.value);
};

</script>

