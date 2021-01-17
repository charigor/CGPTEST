import Pagination from "../components/Pagination";

new Vue({
    el:  '#clients',
    // store:  store,
    components: { Pagination },
    data: {
        clients: window.Laravel.clients,
        edit: false,
        form: {
            id:  '',
            name: '',
            description: ''
        }
    },
    computed: {

    },
    methods: {
        openModal(data = null) {
            this.edit = false
            this.clearForm();
            $(this.$refs.modalClients).modal('show');
            if(data) {
                this.edit = true
                this.form.id   = data.id
                this.form.name = data.name
                this.form.description = data.description
            }

        },
        createClient() {
            axios.post(
                `/clients`,
                this.form,
                // { headers: {"Authorization" : `Bearer ${localStorage.getItem('token')}`}}

            )
                .then( response => {
                    this.clients = response.data.clients
                    $(this.$refs.modalClients).modal('hide');
                    // toast.fire({
                    //     icon: 'success',
                    //     title: response.data.message
                    // })
                    // Fire.$emit('ActionCategory');


                })
                .catch( (error) => {
                    // this.errors.record(error.response.data)
                    // this.$Progress.fail()
                });
        },
        updateClient() {
            axios.put(
                `/clients/${this.form.id}`,
                this.form,
                // { headers: {"Authorization" : `Bearer ${localStorage.getItem('token')}`}}

            )
                .then( response => {
                    // console.log(response.data.companies)
                    this.clients.data.map(item => {
                        if(item.id == response.data.client.id); {

                        }
                    })
                    this.clients.data.filter(function(item,self){
                        if(item.id == response.data.client.id){
                            item.name = response.data.client.name
                            item.description = response.data.client.description
                        }
                        return self
                    });
                    $(this.$refs.modalClients).modal('hide');
                    // toast.fire({
                    //     icon: 'success',
                    //     title: response.data.message
                    // })
                    // Fire.$emit('ActionCategory');


                })
                .catch( (error) => {
                    console.log(error)
                    // this.errors.record(error.response.data)
                    // this.$Progress.fail()
                });
        },
        deleteClient(id) {
            axios.delete(
                `/clients/${id}`,
                // { headers: {"Authorization" : `Bearer ${localStorage.getItem('token')}`}}

            )
                .then( response => {
                    this.clients = response.data.clients
                    $(this.$refs.modalClients).modal('hide');
                    // toast.fire({
                    //     icon: 'success',
                    //     title: response.data.message
                    // })
                    // Fire.$emit('ActionCategory');


                })
                .catch( (error) => {
                    console.log(error)
                    // this.errors.record(error.response.data)
                    // this.$Progress.fail()
                });
        },
        clearForm() {
            this.form = {
                name: '',
                description: ''
            }
        }
    },

    created(){

    },

    mounted(){
        console.log('mounted clients')
    }
})
