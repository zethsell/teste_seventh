<template>
  <main-template>
    <h2>OLa</h2>
  </main-template>
</template>
<script>
import AxiosService from "@/services/axios-service";
import MainTemplate from "@/templates/MainTemplate";

export default {
  name: 'UserEdit',
  components: {MainTemplate},
  data() {
    return {
      user: {},
    }
  },
  created() {
    this.loadUser(this.$route.params.id)
  },
  methods: {
    loadUser: async function (id) {
      const response = await AxiosService.getContent("users/" + id);

      if (response.status === 200) {
        this.user = response.data
        console.log(this.user)
      }
    }
  }
}
</script>