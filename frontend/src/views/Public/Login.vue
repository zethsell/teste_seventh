<template>
  <login-template>
    <div class="bg-white rounded-md w-full h-full sm:h-auto sm:w-1/3 md:w-1/4 flex flex-col justify-between">
      <img class="sm:rounded-t-md" src="@/assets/logo.jpg" alt="no pic">
      <form @submit.prevent="login">
        <div class="px-6 mt-6">
          <input class="outline-none border w-full p-2 rounded-sm my-2" placeholder="Email" type="email"
                 v-model="form.email">
          <span v-if="errors.email" class="text-md text-red-600 w-full flex justify-start">* {{
              errors.email[0]
            }}</span>
          <input class="outline-none border w-full p-2 rounded-sm my-2" placeholder="Senha" type="password"
                 v-model="form.password">
          <span v-if="errors.password" class="text-md text-red-600 w-full flex justify-start">* {{
              errors.password[0]
            }}</span>
        </div>
        <div class="flex p-6">
          <button class="border bg-dark-blue w-full text-gray-50 hover:bg-blue-900 p-2 rounded-sm my-2 mr-2"
                  type="submit">
            Entrar
          </button>
          <router-link :to="{name:'Registration'}"
                       class="border w-full p-2 rounded-sm my-2 hover:bg-gray-200">
            Cadastrar-se
          </router-link>
        </div>
      </form>
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
    if (localStorage.getItem('user')){
      this.$router.push('/');
    }
  },
  data() {
    return {
      errors: {},
      form: {},
    }
  },
  methods: {
    login: async function () {
      await this.axios.post(process.env.VUE_APP_ROOT_API + 'login', this.form)
          .then((response) => {
            if (response.status === 401) {
              alert('Verifique os dados digitados!');
            }

            if (response.status === 200) {
              localStorage.setItem('user', JSON.stringify(response.data.user))
              this.$router.push('/');
            }
          })
          .catch((errors) => {
            this.errors = errors.response.data.errors
          })
    }
  }
})
</script>