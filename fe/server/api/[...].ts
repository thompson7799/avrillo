import { useAuthStore } from "~/stores/authStore"
import { storeToRefs } from 'pinia'


export default defineEventHandler(async (event) => {
    const authStore = useAuthStore()
    const { token } = storeToRefs(authStore)
    const { apiProxyUrl } = useRuntimeConfig()

    const result = await $fetch(`${apiProxyUrl}${event.path}`, {
        method: event.method,
        headers: {
            Authorization: `Bearer ${token.value}`,
            "Accept": "application/json",
        }
    })
    return result
  })