<template>
  <div>

    <div class="flex flex-wrap max-w-5xl mx-auto">
      <div class="w-full px-3 mb-3">
        <div class="p-6 bg-white shadow rounded">
          <div 
            class="cursor-pointer font-bold text-lg"
            @click="showDetails(song)"
          >
            {{ song.title }}
          </div>

          <div 
            class="cursor-pointer text-lg mt-2"
            @click="showDetails(song)"
          >
            {{ song.lyrics.substring(0, 70) + "..." }}
          </div>

          <div class="flex flex-row justify-between mt-2">
            <div class="flex flex-col">
              <div class="font-medium text-sm">{{ song.artist }}</div>
              <div class="text-sm text-gray-500">
                {{ formatDate(song.created_at) }}
              </div>
            </div>
            <div class="flex flex-col">
              
            </div>
            <div class="flex flex-col items-center">
              <span
                v-if="user" 
                class="cursor-pointer text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-orange-600 bg-orange-200 uppercase last:mr-0 mr-1"
                @click="edit(song)"
              >
                Update
              </span>

              <span
                v-if="user" 
                class="cursor-pointer text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-red-600 bg-red-200 uppercase last:mr-0 mr-1 mt-1"
                @click="remove(song.id)"
              >
                Delete
              </span>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</template>

<script>
  import AuthService from '../services/auth'
  import bus from '../utility/bus'
  import moment from 'moment'

  export default {
    props: ["song"],
    components: {},
    computed: {
      user() {
        return AuthService.getUser() 
      }
    },
    data() {
      return {

      };
    },
    mounted() { },
    methods: {
      edit(song) {
			  bus.$emit('editSong', { song })
		  },

      remove(id) {
			  bus.$emit('deleteSong', { id: id })
		  },

      showDetails(song) {
			  bus.$emit('showDetails', song)
		  },

      formatDate(date) {
        return moment(String(date)).format("ll")
      }

    },
  };
</script>