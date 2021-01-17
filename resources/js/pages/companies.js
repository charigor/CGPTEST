 import Pagination from "../components/Pagination";
new Vue({
    el: '#companies',
    // store:  store,
    components: { Pagination },
    data: {
        companies: window.Laravel.companies,
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
            $(this.$refs.modalCompanies).modal('show');
            if(data) {
                this.edit = true
                this.form.id   = data.id
                this.form.name = data.name
                this.form.description = data.description
            }

        },
        createCompany() {
             axios.post(
                `/companies`,
                this.form,
                // { headers: {"Authorization" : `Bearer ${localStorage.getItem('token')}`}}

            )
                .then( response => {
                    this.companies = response.data.companies
                    $(this.$refs.modalCompanies).modal('hide');
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
        updateCompany() {
            axios.put(
                `/companies/${this.form.id}`,
                this.form,
                // { headers: {"Authorization" : `Bearer ${localStorage.getItem('token')}`}}

            )
                .then( response => {
                    // console.log(response.data.companies)
                    this.companies.data.map(item => {
                        if(item.id == response.data.company.id); {

                        }
                    })
                    this.companies.data.filter(function(item,self){
                        if(item.id == response.data.company.id){
                            item.name = response.data.company.name
                            item.description = response.data.company.description
                        }
                        return self
                    });
                    $(this.$refs.modalCompanies).modal('hide');
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
        deleteCompany(id) {
            axios.delete(
                `/companies/${id}`,
                // { headers: {"Authorization" : `Bearer ${localStorage.getItem('token')}`}}

            )
                .then( response => {
                    this.companies = response.data.companies
                    $(this.$refs.modalCompanies).modal('hide');
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
    }
})
