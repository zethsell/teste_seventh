<template>
  <main-template>
    <template #content>
      <div class="w-full flex justify-center p-6">
        <div class="w-full sm:w-1/2 md:1/3 flex flex-col justify-start">
          <h1 class="text-xl font-bold my-2">Novo Usuário</h1>
          <form @submit.prevent="save">
            <common-input title="Nome" v-model="user.name" :errors="errors.name ? errors.name[0] : null"/>
            <common-input title="Email" v-model="user.email" :errors="errors.email ? errors.email[0] : null"/>
            <span v-if="loggedIn.admin" class="flex justify-start mt-2 font-bold">Nivel</span>
            <select v-if="loggedIn.admin" class="w-full p-2 h-12 outline-none border w-full p-2 rounded-sm" v-model="user.level_id">
              <option v-for="level in levels" :key="level.id" class="rounded-sm" :value="level.id">
                {{ level.description }}
              </option>
            </select>
            <common-input type="password" title="Senha" v-model="user.password"
                          :errors="errors.password ? errors.password[0] : null"/>
            <common-input type="password" title="Confirmação de Senha" v-model="user.password_confirmation"/>
            <span v-if="!passwordConfirmation" class="text-md text-red-500 flex justify-start">* As senhas digitadas são diferentes!</span>
            <div class="flex mt-4">
              <button type="submit"
                      class="border bg-dark-blue w-full text-gray-50 hover:bg-blue-900 p-2 rounded-sm my-2 mr-2">
                Salvar
              </button>
              <router-link :to="{name:'UserIndex'}"
                           class="border w-full p-2 rounded-sm my-2 hover:bg-gray-200">
                Cancelar
              </router-link>
            </div>
          </form>
        </div>
      </div>
    </template>
  </main-template>
</template>
<script>
import MainTemplate from "@/templates/MainTemplate";
import CommonInput from "@/components/CommonInput";
import authHeader from "@/services/auth-header";

export default {
  name: 'UserEdit',
  components: {
    MainTemplate,
    CommonInput
  },
  data() {
    return {
      user: {},
      errors: {},
      levels: {}
    }
  },
  computed: {
    passwordConfirmation() {
      return (this.user.password_confirmation === this.user.password)
    },
    loggedIn() {
      return JSON.parse(localStorage.getItem('user'))
    }
  },
  created() {
    this.loadLevels()
    this.loadUser(this.$route.params.id)
  },
  methods: {
    save: async function () {
      console.log(this.user)
      await this.axios.put(process.env.VUE_APP_ROOT_API + 'users/' + this.user.id, this.user, {headers: authHeader()})
          .then((response) => {
            if (response.status === 200) {
              alert('Usuario atualizado com Sucesso!')
              this.$router.push({name: 'UserIndex'})
            }
          })
          .catch((errors) => {
            this.errors = errors.response.data.errors
          })
    },
    loadUser: async function (id) {
      await this.axios.get(process.env.VUE_APP_ROOT_API + 'users/' + id, {headers: authHeader()})
          .then((response) => {
            if (response.status === 200) {
              this.user = response.data.user
            }
          })
          .catch((errors) => {
            alert(errors);
          })
    },

    loadLevels: async function () {
      await this.axios.get(process.env.VUE_APP_ROOT_API + 'levels', {headers: authHeader()})
          .then((response) => {
            if (response.status === 200) {
              this.levels = response.data.levels
            }
          })
          .catch((errors) => {
            alert(errors);
          })
    },
  }
}
</script>