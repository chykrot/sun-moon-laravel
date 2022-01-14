<template>
  <div>
    <div
      class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex p-6 lg:p-20">
      <div class="relative w-auto my-6 mx-auto max-w-6xl">
        <div
          class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none p-5">

            <div class="text-center justify-between p-5 border-b border-solid border-gray-300 rounded-t">
              <h3 class="text-xl font-semibold">
                Update Song
              </h3>
            </div>

            <div class="my-4 long-width">
              <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                Title
              </label>
              <input 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                type="text"
                placeholder="Title"
                v-model="info.title"
              />
            </div>

            <div class="my-4 long-width">
              <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                Artist
              </label>
              <input 
                class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3"
                type="text" 
                placeholder="Artist"
                v-model="info.artist"
              />
            </div>

            <div class="my-4 long-width">
              <label class="block text-grey-darker text-sm font-bold mb-2" for="lyrics">
                Lyrics
              </label>
              <textarea 
                class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3"
                rows="12" 
                placeholder="Lyrics"
                v-model="info.lyrics"
              />
            </div>


          <div class="flex items-center justify-end p-5 border-t border-solid border-gray-300 rounded-b">
            <button
              class="cursor-pointer text-blue-500 bg-transparent border border-solid border-blue-500 hover:bg-blue-500 hover:text-white active:bg-blue-600 font-bold uppercase text-sm px-5 py-3 rounded outline-none focus:outline-none mr-1 mb-1"
              type="button" style="transition: all 0.15s ease" v-on:click="hideUpdate()">
              Cancel
            </button>
            <button
              class="cursor-pointer text-blue-500 bg-transparent border border-solid border-blue-500 hover:bg-blue-500 hover:text-white active:bg-blue-600 font-bold uppercase text-sm px-5 py-3 rounded outline-none focus:outline-none mr-1 mb-1"
              type="button" style="transition: all 0.15s ease" v-on:click="updateSong()">
              Update
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="opacity-50 fixed inset-0 z-40 bg-black"></div>
  </div>
</template>

<script>
  import bus from "../utility/bus";

  export default {
    name: "modal",
    props: {
      details: {
        type: Object,
      }
    },
    mounted() {
      bus.$on('editSong', (payload) => {
        this.editSong(payload.song)
      })
    },
    data() {
      return {
        info: this.details,
        showModal: false,
      };
    },
    methods: {
      toggleModal() {
        this.showModal = !this.showModal;
      },

      editSong(params) {
        this.info = params
        this.showModal = true
      },

      updateSong() {
        bus.$emit('updateSong', this.info)
      },

      hideUpdate() {
        bus.$emit('hideUpdate', this.info)
      }
    },
  };
</script>

<style scoped>
.long-width {
  width: 40rem;
}
</style>