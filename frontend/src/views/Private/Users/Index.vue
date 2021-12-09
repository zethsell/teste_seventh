<template>
  <main-template title="Usuários">
    <template #content>
      <div class="w-full flex flex-col  justify-center">
        <!-- Header -->
        <div class="flex flex-row justify-between my-2 px-10">
          <h2 class="text-2xl">Usuários</h2>
          <router-link v-if="user.admin" :to="{name:'UserCreate'}"
                       class="p-2 w-20 bg-dark-blue text-gray-50 rounded-md">Novo
          </router-link>
        </div>

        <!-- List -->
        <div class="divide-y divide-gray-200 flex flex-col justify-center px-10">
          <div
              v-for="(user, index) in users"
              :key="user.id"
              class="bg-gray-50 sm:h-12 flex flex-row justify-between items-center p-1 w-full h-full"
              :class=" index === Object.keys(users).length - 1 ? 'rounded-b-md' : index === 0 ? 'rounded-t-md' : '' ">
            <div class=" flex flex-col sm:flex-row justify-between w-full h-full items-center px-2">
              <div class="flex w-full justify-start items-center sm:items-center">
                <strong class="mr-1">Nome: </strong>
                <span>{{ user.name }}</span>
              </div>
              <div class="flex w-full justify-start">
                <strong class="mr-1">Email: </strong>
                <span>{{ user.email }}</span>
              </div>
              <div class="flex w-full justify-start">
                <strong class="mr-1">Nível: </strong>
                <span>{{ user.level.description }}</span>
              </div>
              <div class="flex flex-row sm:w-1/3 w-full h-full sm:items-center justify-end items-end">
                <icon-button class="text-blue-400 w-10 h-10" @click="editUser(user.id)">
                  <fa :icon="['fas', 'pencil-alt']"/>
                </icon-button>
                <icon-button
                    v-if="this.user.admin"
                    class="text-red-700 w-10 h-10"
                    @click="deleteUser(user.id)"
                >
                  <fa :icon="['fas', 'trash']"/>
                </icon-button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </template>
  </main-template>
</template>
<script>
import {defineComponent} from "vue";
import MainTemplate from '@/templates/MainTemplate'
import authHeader from '@/services/auth-header';
import IconButton from "@/components/IconButton";

export default defineComponent({
  components: {
    MainTemplate,
    IconButton
  },
  data() {
    return {
      users: {},
    }
  },
  created() {
    this.loadUsers();
  },
  computed: {
    user() {
      return JSON.parse(localStorage.getItem('user'))
    }
  },
  methods: {
    loadUsers: async function () {
      await this.axios.get(process.env.VUE_APP_ROOT_API + 'users', {headers: authHeader()})
          .then((response) => {
            if (response.status === 200) {
              this.users = response.data.users
            }
          })
          .catch((errors) => {
            alert(errors);
          })
    },
    editUser: function (id) {
      this.$router.push({name: 'UserEdit', params: {id: id}})
    },
    deleteUser: async function (id) {
      await this.axios.delete(process.env.VUE_APP_ROOT_API + 'users/' + id, {headers: authHeader()})
          .then((response) => {
            if (response.status === 200) {
              alert('Usuário removido com sucesso!')
              this.loadUsers()
              if (id === this.user.id) {
                localStorage.clear()
                this.$router.push({name: 'Login'})
              }
            }
          })
          .catch((errors) => {
            alert(errors);
          })
    }
  }

})
;
</script>