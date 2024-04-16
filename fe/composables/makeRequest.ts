export const useMakeRequest = async <T>(
  url: string,
  options: Parameters<typeof $fetch>[1] = {},
) => {
  const authStore = useAuthStore()

  options.headers = {
    ...(options.headers || {}),
    Authorization: 'Bearer ' + authStore.token,
    Accept: "application/json",
  }

  return $fetch(`http://localhost:80/${url}`, {
    onRequest({ options }) {
      if (authStore.token) {
        options.headers = {
          ...(options.headers || {}),
          Authorization: 'Bearer ' + authStore.token,
        }
      }
    },
    onResponse: ({ response }) => {
      switch (response.status) {
        case 401:
        case 419:
          authStore.logout()
          break
      }
    },
    ...options,
  })
}