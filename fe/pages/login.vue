<script setup lang="ts">
const authStore = useAuthStore()

const email = ref('')
const password = ref('')

const login = () => {
  authStore.login(email.value, password.value)
}
</script>

<template>
  <div class="p-4">
    <form class="mt-4" @submit.prevent="login">
      <label class="block">
        <span class="text-sm text-gray-700">Email</span>
        <input
          v-model="email"
          type="email"
          class="mt-1 block w-full rounded-md border-gray-200 p-2 focus:border-indigo-600 focus:ring focus:ring-indigo-500 focus:ring-opacity-40"
          autocomplete="username"
        />
      </label>

      <label class="mt-3 block">
        <span class="text-sm text-gray-700">Password</span>
        <input
          v-model="password"
          type="password"
          class="mt-1 block w-full rounded-md border-gray-200 p-2 focus:border-indigo-600 focus:ring focus:ring-indigo-500 focus:ring-opacity-40"
          autocomplete="current-password"
        />
      </label>

      <div class="mt-6">
        <button
          type="submit"
          class="w-full rounded-md bg-indigo-600 px-4 py-2 text-center text-sm text-white hover:bg-indigo-500 focus:outline-none"
        >
          Sign in
        </button>
      </div>
    </form>
  </div>
</template>
