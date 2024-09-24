<template>
    <table class="w-full border-collapse">
        <thead>
            <tr>
                <th v-for="header in headers" 
                    :key="header.key" 
                    class="bg-gray-100 border border-gray-300 px-4 py-2 text-left font-bold">
                    {{ header.label }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(row, index) in data" 
                :key="row.id" 
                :class="{'bg-gray-50': index % 2 === 0}">
                <td v-for="header in headers" 
                    :key="header.key" 
                    class="border border-gray-300 px-4 py-2">
                    {{ row[header.key] }}
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script setup>
import { defineProps } from 'vue';

defineProps({
  headers: {
    type: Array,
    required: true
  },
  data: {
    type: Array,
    required: true
  }
});
</script>
