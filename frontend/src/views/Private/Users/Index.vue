<template>
  <main-template title="Usuários">
    <template #content>
      <div class="w-full flex flex-col  justify-center">
        <!-- Header -->
        <div class="flex flex-row justify-between my-2 px-10">
          <h2 class="text-2xl">Usuários</h2>
          <button @click="createUser">Novo</button>
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
                <icon-button class="text-blue-400 w-10 h-10" @click="editUser(user)">
                  <fa :icon="['fas', 'pencil-alt']"/>
                </icon-button>
                <icon-button
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
import AxiosService from "@/services/axios-service";
import IconButton from "../../../components/IconButton";

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

  methods: {
    loadUsers: async function () {
      const response = await AxiosService.getContent("users");
      this.users = response.data.users;
      console.log(this.users)
    },
  }
});
</script>