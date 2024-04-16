<script setup lang="ts">
import { storeToRefs } from 'pinia'

const authStore = useAuthStore()
const { token } = storeToRefs(authStore)
</script>
<template>
  <div>
    <div v-if="token" class="relative">
      <button
        class="absolute top-0 right-4 h-16 w-16 text-gray-500"
        @click="authStore.logout"
      >
        Log out
      </button>
    </div>
    <div class="flex h-screen items-center justify-center bg-gray-200 px-6">
      <div
        class="w-full max-w-md rounded-md bg-white p-6 shadow-md"
        :class="{'max-w-2xl': token}"
      >
        <div class="flex items-center justify-center">
          <span class="text-2xl font-semibold text-gray-700">
            Avrillo Quotes!
          </span>
        </div>
        <slot />
      </div>
    </div>
  </div>
</template>
