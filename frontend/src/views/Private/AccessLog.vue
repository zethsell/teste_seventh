<template>
  <main-template title="Usuários">
    <template #content>
      <div class="w-full flex flex-col  justify-center">
        <!-- Header -->
        <div class="flex flex-row justify-between my-2 px-10">
          <h2 class="text-2xl">Log de Acessos</h2>
        </div>

        <!-- List -->
        <div class="divide-y divide-gray-200 flex flex-col justify-center px-10">
          <div
              v-for="(log, index) in logs"
              :key="log.id"
              class="bg-gray-50 sm:h-12 flex flex-row justify-between items-center p-1 w-full h-full"
              :class=" index === Object.keys(logs).length - 1 ? 'rounded-b-md' : index === 0 ? 'rounded-t-md' : '' ">
            <div class=" flex flex-col sm:flex-row justify-between w-full h-full items-center px-2">
              <div class="flex w-full justify-start items-center sm:items-center">
                <strong class="mr-1">Data Login: </strong>
                <span>{{ this.date(log.created_at) }}</span>
              </div>
              <div class="flex w-full justify-start">
                <strong class="mr-1">Hora Login: </strong>
                <span>{{ this.time(log.created_at) }}</span>
              </div>
              <div class="flex w-full justify-start">
                <strong class="mr-1">Usuário: </strong>
                <span>{{ log.user.name }}</span>
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

export default defineComponent({
  components: {
    MainTemplate,
  },
  data() {
    return {
      logs: {},
    }
  },
  created() {
    this.loadLog();
  },

  methods: {
    loadLog: async function () {

      await this.axios.get(process.env.VUE_APP_ROOT_API + 'access_logs', {headers: authHeader()})
          .then((response) => {
            if (response.status === 200) {
              this.logs = response.data.logs;
            }
          })
          .catch((errors) => {
            alert(errors);
          })
    },
  }
});
</script>