<template>
  <login-template>
    <div class="bg-white rounded-md w-full h-full sm:h-auto  sm:w-1/3 md:w-1/4 flex flex-col justify-between">
      <img class="sm:rounded-t-md" src="@/assets/logo.jpg" alt="no pic">
      <div class="px-6 mt-2">
        <input class="outline-none border w-full p-2 rounded-sm my-2" placeholder="Nome" type="text"
               v-model="user.name">
        <input class="outline-none border w-full p-2 rounded-sm my-2" placeholder="Email" type="email"
               v-model="user.email">
        <input class="outline-none border w-full p-2 rounded-sm my-2" placeholder="Senha" type="password"
               v-model="user.password">
        <input class="outline-none border w-full p-2 rounded-sm my-2" placeholder="Confirmação de Senha" type="password"
               v-model="user.password_confirmation">
        <span v-if="!passwordConfirmation" class="text-md text-red-600 w-full flex justify-start">* As senhas não coincidem!</span>
      </div>
      <div class="flex p-6">
        <button class="border bg-dark-blue w-full text-gray-50 hover:bg-blue-900 p-2 rounded-sm my-2 mr-2">
          Salvar
        </button>
        <router-link :to="{name:'Login'}"
                     class="border w-full p-2 rounded-sm my-2 hover:bg-gray-200">
          Cancelar
        </router-link>
      </div>
    </div>
  </login-template>
</template>
<script>

import {defineComponent} from "vue";
import LoginTemplate from '@/templates/LoginTemplate'

export default defineComponent({
  name: 'Login',
  components: {
    LoginTemplate
  },
  created() {
    if (localStorage.getItem('user')) {
      this.$router.push('/');
    }
  },
  data() {
    return {
      user: {}
    }
  },
  computed: {
    passwordConfirmation() {
      return (this.user.password_confirmation === this.user.password)
    },
  },
})
</script>