import store from './../store'
import axios from 'axios'

store.subscribe((mutation) => {
    switch (mutation.type) {
        case 'auth/SET_TOKEN':
            if(mutation.payload){
                //set header for request in
                axios.defaults.headers.common['Authorization'] = `Bearer ${mutation.payload}`
                localStorage.setItem('token', mutation.payload)
            } else {
                axios.defaults.headers.common['Authorization'] = null
                localStorage.removeItem('token', mutation.payload)
            }
            break;
    }
})
