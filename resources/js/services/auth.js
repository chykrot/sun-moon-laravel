export default {  
    /**
     * Formats and stores the auth access in sessionStorage
     */
    setAuth (data) {  
      localStorage.setItem('token', JSON.stringify(data))
    },
  
    /**
     * Gets the auth access in sessionStorage.
     */
    getAuth () {
      return JSON.parse(localStorage.getItem('token'))
    },

    /**
     * Removes token from sessionStorage
     */
    flush () {
      localStorage.removeItem('token')
      localStorage.removeItem('user')
    },
    

    setUser (data) {  
      localStorage.setItem('user', JSON.stringify(data))
    },


    getUser () {
      return JSON.parse(localStorage.getItem('user'))
    },
}