<template>
  <main-template>
    <template #content>

      <div class="home">
        <img alt="Vue logo" src="../../assets/logo.png">

      </div>
    </template>
  </main-template>
</template>

<script>
// @ is an alias to /src


import MainTemplate from "../../templates/MainTemplate";

export default {
  name: 'Home',
  components: {
    MainTemplate

  }
}
</script>
