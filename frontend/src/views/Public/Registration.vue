<template>
  <login-template>
    <div class="bg-white rounded-md w-full h-full sm:h-auto  sm:w-1/3 md:w-1/4 flex flex-col justify-between">
      <img class="sm:rounded-t-md" src="@/assets/logo.jpg" alt="no pic">
      <form @submit.prevent="save">
        <div class="px-6 mt-2">
          <auth-input placeholder="Nome" type="text"
                      v-model="user.name" :errors="errors.name ? errors.name[0] : null"/>
          <auth-input placeholder="Email" type="email"
                      v-model="user.email" :errors="errors.name ? errors.email[0] : null"/>
          <auth-input placeholder="Senha" type="password"
                      v-model="user.password" :errors="errors.name ? errors.password[0] : null"/>
          <auth-input placeholder="Confirme a Senha" type="password"
                      v-model="user.password_confirmation"/>
          <span v-if="!passwordConfirmation" class="text-md text-red-500 flex justify-start">* As senhas digitadas são diferentes!</span>
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
      </form>
    </div>
  </login-template>
</template>
<script>

import {defineComponent} from "vue";
import LoginTemplate from '@/templates/LoginTemplate'
import AuthInput from "@/components/AuthInput";

export default defineComponent({
  name: 'Login',
  components: {
    LoginTemplate,
    AuthInput
  },
  created() {
    if (localStorage.getItem('user')) {
      this.$router.push('/');
    }
  },
  data() {
    return {
      user: {},
      errors: {}
    }
  },
  computed: {
    passwordConfirmation() {
      return (this.user.password_confirmation === this.user.password)
    },
  },
  methods: {
    save: async function () {
      console.log(this.user)
      await this.axios.post(process.env.VUE_APP_ROOT_API + 'registration', this.user)
          .then((response) => {
            if (response.status === 200) {
              this.login(this.user);
            }
          })
          .catch((errors) => {
            this.errors = errors.response.data.errors
          })
    },
    login: async function (user) {
      await this.axios.post(process.env.VUE_APP_ROOT_API + 'login', user)
          .then((response) => {
            if (response.status === 401) {
              alert('Verifique os dados digitados!');
            }

            if (response.status === 200) {
              localStorage.setItem('user', JSON.stringify(response.data.user))
              this.$router.push('/');
            }
          })
    }
  }
})
</script>