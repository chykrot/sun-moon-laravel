<template>
  <div>
    <nav class="relative w-full flex flex-wrap items-center justify-between py-3 bg-gray-100 text-gray-500 hover:text-gray-700 focus:text-gray-700 shadow-lg">
      <div class="container-fluid w-full flex flex-wrap items-center justify-between px-6">
        <div class="container-fluid">
          <a class="text-xl text-black">Song App</a>
        </div>
        <ul class="flex" v-if="user">
          <li class="mr-6">
            <a class="cursor-pointer text-black-400 hover:text-black-700">Logged in as: <b>{{ user.name }}</b></a>
          </li>
          <li class="mr-6">
            <a class="cursor-pointer text-blue-500 hover:text-blue-800" @click="logout()">Logout</a>
          </li>
        </ul>
        <ul class="flex" v-else>
          <li class="mr-6">
            <a class="cursor-pointer text-blue-500 hover:text-blue-800" @click="redirectLogin()">Login</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container mx-auto">

      <div class="flex flex-wrap justify-center px-3 pt-10">
        <div class="w-full lg:w-1/3">
          <section class="py-6 xl:bg-contain bg-top bg-no-repeat">
            <div class="container mx-auto">
              <each-song v-for="song in songs" :song="song" :key="song.id">
                <h1>{{ song.title }}</h1>
                <p>{{ song.lyrics }}</p>
              </each-song>
            </div>
          </section>

          <div class="flex flex-wrap max-w-5xl mx-auto">
            <div class="w-full px-3 mb-3">
              <div class="p-2 bg-white shadow rounded">
                <nav aria-label="Page navigation">
                  <ul class="inline-flex">
                    <li>
                      <button
                        class="h-10 px-5 text-blue-500 transition-colors duration-150 bg-white border border-r-0 border-indigo-600 rounded-l-lg focus:shadow-outline hover:bg-indigo-100"
                        @click="prevPage()">
                        Prev
                      </button>
                    </li>
                    <li>
                      <button
                        class="h-10 px-5 text-blue-500 transition-colors duration-150 bg-white border border-indigo-600 rounded-r-lg focus:shadow-outline hover:bg-indigo-100"
                        @click="nextPage()">
                        Next
                      </button>
                    </li>
                  </ul>
                </nav>
                <div v-if="totals && totals.total">
                  <span>Page {{ totals.current_page }} of
                    {{ totals.last_page }}</span>
                  <span> Total of {{ totals.total }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="w-full lg:w-2/3">
          <section v-if="selectedSong" class="py-6 px-3">
            <div class="container p-6 mx-auto bg-white shadow rounded">
              <div class="pb-6">
                <span class="text-2xl text-blue-600 font-semibold">{{ selectedSong.title }}</span>

                <p class="mt-4">
                  Pupolarized by: {{ selectedSong.artist }}
                </p>

                <p class="mt-4">
                  Created:
                  {{ formatDate(selectedSong.created_at) }}
                </p>

                <div class="pre-wrap font-semibold mt-6">{{ selectedSong.lyrics }}</div>
              </div>
            </div>

            <div class="pt-6">
              <button
                class="cursor-pointer text-blue-500 bg-transparent border border-solid border-blue-500 hover:bg-blue-500 hover:text-white active:bg-blue-600 font-bold uppercase text-sm px-5 py-3 rounded outline-none focus:outline-none mr-1 mb-1"
                type="button" style="transition: all 0.15s ease" v-on:click="showCreate()">
                Create
              </button>
            </div>
          </section>
        </div>
      </div>
    </div>

    <modal v-if="modalUpdate" :details="info"></modal>
    <create-modal v-if="modalCreate"></create-modal>
  </div>
</template>

<script>
  import AuthService from '../services/auth'
  import EachSong from "./EachSong.vue";
  import Modal from "./Modal.vue";
  import CreateModal from "./CreateModal.vue";
  import bus from "../utility/bus";
  import moment from "moment";

  export default {
    components: {
      EachSong,
      Modal,
      CreateModal,
    },
    computed: {
      user() {
        return AuthService.getUser() 
      }
    },
    data() {
      return {
        songs: null,
        selectedSong: null,
        modalUpdate: false,
        modalCreate: false,
        totals: null,
        info: null
      };
    },
    mounted() {

      axios.defaults.headers.common = {'Authorization': `Bearer ${AuthService.getAuth()}`}

      bus.$on('editSong', (payload) => {
        this.editSong(payload.song)
      })

      bus.$on('hideUpdate', (payload) => {
        this.hideUpdate()
      })

      bus.$on("deleteSong", (payload) => {
        this.deleteSong(payload.id);
      });

      bus.$on("updateSong", (payload) => {
        this.updateSong(payload);
      });

      bus.$on("showDetails", (payload) => {
        this.showDetails(payload);
      });

      bus.$on("closeCreateModal", (payload) => {
        this.hideCreate();
      });

      bus.$on("createSong", (payload) => {
        this.createSong(payload);
      });

      this.getSongs();
    },
    methods: {
      getSongs($page = 1) {
        axios
          .get(`/api/songs?page=${$page}`, {
            email: this.email,
            password: this.password,
          })
          .then(({ data }) => {
            this.songs = data.data;
            this.totals = data;
            this.selectedSong = data.data[0];
          })
          .catch(({ response }) => alert("Something went wrong"));
      },

      deleteSong(id) {
        axios
          .delete(`/api/songs/${id}`)
          .then(({ data }) => {
            this.getSongs();
          })
          .catch(({ response }) => alert("Something went wrong"));
      },

      updateSong(params) {
        axios
          .patch(`/api/songs/${params.id}`, params)
          .then(({ data }) => {
            this.hideUpdate()
            this.getSongs();
          })
          .catch(({ response }) => alert("Something went wrong"));
      },

      showDetails(song) {
        this.selectedSong = song;
      },

      showCreate() {
        this.modalCreate = true;
      },

      hideCreate() {
        this.modalCreate = false;
      },

      showUpdate() {
        this.modalCreate = true;
      },

      hideUpdate() {
        this.modalUpdate = false;
      },

      createSong(params) {
        axios
          .post(`/api/songs`, params)
          .then(({ data }) => {
            this.hideCreate();
            this.getSongs();
          })
          .catch(({ response }) => alert("Something went wrong"));
      },

      prevPage() {
        let page = 1;
        if (this.totals.current_page > 1) {
          page = this.totals.current_page - 1;
        }
        this.getSongs(page);
      },

      nextPage() {
        let page;
        if (this.totals.current_page < this.totals.last_page) {
          page = this.totals.current_page + 1;
        }
        if (this.totals.current_page === this.totals.last_page) {
          page = this.totals.current_page;
        }
        this.getSongs(page);
      },

      formatDate(date) {
        return moment(String(date)).format("ll");
      },

      logout() {
        axios.post(`/api/logout`)
        .then(({ data }) => { 
          AuthService.flush()
          this.$router.push('/login')
        })
        .catch(({ response }) => alert('Something went wrong'));
      },

      editSong(params) {
        this.info = params
        this.modalUpdate = true
      },

      redirectLogin() {
        this.$router.push('/login')
      }
    },
  };
</script>

<style scoped>
  .pre-wrap {
    white-space: pre-wrap;
  }
</style>