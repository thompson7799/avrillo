<script setup lang="ts">
import type {
  Quote
} from '~/types/'

interface Params {
  refresh?: boolean
}
const endpointParams = ref<Params>({})

const { data: quotes, refresh } = await useFetch<{ data: Quote[]; }>('api/ye-quotes', {
  params: endpointParams.value,
})

const refreshQuotes = () => {
  endpointParams.value.refresh = true

  refresh()
}
</script>
<template>
  <div>
    <div class="flex flex-col items-center justify-center">
      <p class="py-2 text-center">
        These are your current Kanye Quotes, you can either wait 1 minute for
        new ones, or hit the refresh button to get new ones now!
      </p>
      <button
        class="mb-4 flex w-fit transform items-center rounded-lg bg-indigo-600 px-4 py-2 font-medium tracking-wide text-white transition-colors duration-300 hover:bg-indigo-500 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-80"
        @click="refreshQuotes()"
      >
        <svg
          class="mx-1 h-5 w-5"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 20 20"
          fill="currentColor"
        >
          <path
            fill-rule="evenodd"
            d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
            clip-rule="evenodd"
          />
        </svg>
        <span class="mx-1">Refresh</span>
      </button>
      <div v-if="quotes">
        <hr class="w-full" />
        <blockquote
          v-for="quoteItem in quotes.data"
          :key="quoteItem.quote"
          class="mt-4 w-full text-center text-xl font-semibold italic"
        >
          <svg
            class="h-8 w-8 text-gray-400 dark:text-gray-600"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="currentColor"
            viewBox="0 0 18 14"
          >
            <path
              d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z"
            />
          </svg>
          <p>"{{ quoteItem.quote }}"</p>
        </blockquote>
      </div>
    </div>
  </div>
</template>
