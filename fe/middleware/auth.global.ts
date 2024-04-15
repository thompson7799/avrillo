export default defineNuxtRouteMiddleware((to) => {
    const authStore = useAuthStore()

    if (!authStore.token && to.name !== 'login') {
        return navigateTo({ name: 'login' })
    }
})