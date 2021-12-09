<template>
  <input class="outline-none border w-full p-2 rounded-sm my-2" :placeholder="placeholder" :type="type"
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
  props: ['errors', 'modelValue', 'type', 'placeholder'],
  emits: ['update:modelValue']
})
</script>