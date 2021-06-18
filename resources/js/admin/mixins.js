import VueSweetalert2 from "vue-sweetalert2";
import 'sweetalert2/dist/sweetalert2.all';
import Vue from 'vue'

Vue.use(VueSweetalert2);

const adminNotifications = {
    methods : {
        notify(text, title = null, type) {
            this.$swal({
                text: text,
                title: title, 
                icon: type
            })
        }
    }
}

const globalFunctions = {
    methods : {
        convertObjectToFormData(my_obj) {
            let formData = new FormData();
            for(let index in my_obj) {
                if(my_obj[index]) {
                    formData.append(index, my_obj[index])
                }
            }
            return formData;
        }
    }
}

export {
    adminNotifications,
    globalFunctions
}