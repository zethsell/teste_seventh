<template>
  <nav class="bg-dark-blue h-14 text-gray-50 flex justify-center px-4">
    <div class="h-full w-full  flex justify-between items-center">
      <div class="flex">
        <li class="h-12 flex flex-row p-4 items-center justify-start hover:text-gray-500  cursor-pointer">
          <fa :icon="['fas','home']" class="mr-2"/>
          <router-link :to="{name:'Home'}">Home</router-link>
        </li>
        <li class="h-12 flex flex-row p-4 items-center justify-start hover:text-gray-500  cursor-pointer">
          <fa :icon="['far','user']" class="mr-2"/>
          <router-link :to="{name:'UserIndex'}">Usuários</router-link>
        </li>
        <li v-if="user.admin"
            class="h-12 flex flex-row p-4 items-center justify-start  hover:text-gray-500  cursor-pointer">
          <fa :icon="['fas','book']" class="mr-2"/>
          <router-link :to="{name:'AccessLog'}">Log de Acesso</router-link>
        </li>
      </div>
      <div class="flex items-center ">
        <li class="h-12 flex flex-row p-4 items-center justify-start   group  hover:text-gray-500  cursor-pointer"
            @click="logout">
          <fa :icon="['fas','door-closed']" class="mr-2 visible absolute group-hover:invisible"/>
          <fa :icon="['fas','door-open']" class="mr-2 invisible group-hover:visible"/>
          <a>Sair</a>
        </li>
      </div>
    </div>
  </nav>
</template>
<script>

export default {
  name: 'UpBar',
  computed: {
    user() {
      return JSON.parse(localStorage.getItem('user'))
    }
  },
  methods: {
    logout() {
      localStorage.clear();
      this.$router.push({name: 'Login'})
    },
  }
}
</script>