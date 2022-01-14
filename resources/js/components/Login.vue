<template>
  <div>

    <div class="grid grid-cols-3 gap-4 pt-40">

      <div></div>

      <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
        <div class="mb-4">
          <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
            Email
          </label>
          <input 
            class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker"
            type="text"
            placeholder="Email"
            v-model="email"
          />
        </div>
        <div class="mb-6">
          <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
            Password
          </label>
          <input 
            class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3"
            type="password" 
            placeholder="******************"
            v-model="password"
          />
        </div>
        <div class="flex items-center justify-between">

          <button 
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            @click="login()"
          >
            Login
          </button>
        </div>
      </div>

      <div></div>

    </div>
      
  </div>
</template>

<script>
  import axios from 'axios'
  import AuthService from '../services/auth'

  export default {
    components: {},
    computed: {},
    data() {
      return {
        email: null,
        password: null
      };
    },
    mounted() { },
    methods: {
      login() {
        axios.post(`/api/login`, {
          email: this.email,
          password: this.password,
        })
        .then(({ data }) => { 
          AuthService.setAuth(data.plainTextToken)
          this.$router.push('/')
        })
        .catch(({ response }) => alert('Something went wrong'));
      }
    },
  };
</script>