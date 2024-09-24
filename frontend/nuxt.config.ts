// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  modules: ['@nuxtjs/tailwindcss'],
  components: true,
  runtimeConfig: {
    public: {
      apiBase: 'http://localhost' // substitua pela URL do seu backend
    }
  },
})
