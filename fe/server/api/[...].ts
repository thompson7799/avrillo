export default defineEventHandler(async (event) => {
    const { apiProxyUrl } = useRuntimeConfig()

    const path = apiProxyUrl + event.path
    
    return proxyRequest(event, path)
  })