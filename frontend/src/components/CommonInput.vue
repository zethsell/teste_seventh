<template>

  <span v-if="title" class="flex justify-start font-bold mt-2">{{ title }}</span>
  <input class="outline-none border w-full p-2 rounded-sm" :placeholder="placeholder" :type="type"
         :value="modelValue" @input="$emit('update:modelValue',$event.target.value)"
  >
  <span v-if="errors" class="text-md text-red-600 w-full flex justify-start">
    * {{ errors }}
  </span>
</template>
<script>
import {defineComponent} from "vue";

export default defineComponent({
  name: 'AuthInput',
  props: ['errors', 'modelValue', 'type', 'placeholder', 'title'],
  emits: ['update:modelValue']
})
</script>