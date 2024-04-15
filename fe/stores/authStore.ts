import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', () => {
    const authToken = useCookie('authToken')
    const user = ref(null)

    const token = computed(() => {
        return authToken.value
    })

    const login = async (email: string, password: string) => {
        const { data } = await useFetch<{ access_token: string; }>('api/login', {
            method: "POST",
            params: {
                email,
                password
            }
        })

        if (data.value?.access_token) {
            authToken.value = data.value.access_token
            navigateTo({ name: 'index' })
        }
    }

    const logout = async () => {
        authToken.value = null
        navigateTo({ name: 'login' })
    }
  
    return { token, user, login, logout }
  })