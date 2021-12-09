<template>
  <!-- Menu Superior -->
  <up-bar/>

  <!-- Conteúdo -->
  <slot name="content"/>
</template>
<script>
import UpBar from "@/components/UpBar";

export default {
  components: {UpBar}
}
</script>