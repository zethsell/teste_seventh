<template>
  <button class="m-1 border py-1 px-2 rounded-md hover:bg-white hover:text-github-background w-10 h-10">
    <slot/>
  </button>
</template>
<script>
import {defineComponent} from "vue";

export default defineComponent({
  props: ['type']
})
</script>