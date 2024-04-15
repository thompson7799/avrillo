export default defineNuxtConfig({
  devtools: { enabled: true },
  modules: ['@nuxtjs/tailwindcss', '@pinia/nuxt', "@nuxt/eslint"],
  runtimeConfig: {
    apiProxyUrl: 'http://localhost:80'
  },
  eslint: {
    config: {
      stylistic: {
        indent: 'tab',
        semi: true,
      }
    }
  }
})