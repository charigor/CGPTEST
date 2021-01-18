import Pagination from "../components/Pagination";
import Multiselect from 'vue-multiselect'
import PaginationVue from "../components/PaginationVue";
import Swal from 'sweetalert2';

class Errors {
    constructor() {
        this.errors = {}
    }

    get(field) {
        if (this.errors[field]) {
            return this.errors[field][0];
        }
    }

    record(errors) {
        this.errors = errors.errors
    }
}

new Vue({
    el: '#clients',
    components: {Pagination, Multiselect, PaginationVue},
    data: {
        clients: window.Laravel.clients,
        errors: new Errors(),
        edit: false,
        form: {
            id: '',
            name: '',
            description: '',
            email: ''
        },
        value: [],
        options: [],
        show: false

    },
    methods: {
        openModal(data = null) {
            this.edit = false
            this.show = false
            this.errors.errors = {}
            this.clearForm();
            $(this.$refs.modalClients).modal('show');
            if (data) {
                this.getData()
                this.value = data.companies ? data.companies : []
                this.edit = true
                this.form.id = data.id
                this.form.name = data.name
                this.form.email = data.email
                this.form.description = data.description

            }

        },
        createClient() {
            axios.post(
                `/clients`,
                this.form,
            )
                .then(response => {
                    this.clients = response.data.clients
                    $(this.$refs.modalClients).modal('hide');

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    })

                })
                .catch((error) => {
                    this.errors.record(error.response.data)
                });
        },
        updateClient() {
            this.form.value = this.value.map((item) => {
                return item.id
            })
            axios.put(
                `/clients/${this.form.id}`,
                this.form,
            )
                .then(response => {

                    this.clients.data.filter(function (item, self) {
                        if (item.id == response.data.client.id) {
                            item.name = response.data.client.name
                            item.name = response.data.client.email
                            item.description = response.data.client.description
                            item.companies = response.data.client.companies
                        }
                        return self
                    });
                    $(this.$refs.modalClients).modal('hide');
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                })
                .catch((error) => {
                    this.errors.record(error.response.data)
                });
        },
        deleteClient(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(
                        `/clients/${id}`,
                    )
                        .then(response => {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: response.data.message,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            this.clients = response.data.clients
                        })
                        .catch((error) => {
                            this.errors.record(error.response.data)
                        });
                }
            })
        },
        clearForm() {
            this.form = {
                name: '',
                description: '',
                email: ''
            }
        },
        addTag(newTag) {
            const tag = {
                name: newTag,
                code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
            }

            this.options.push(tag)
            this.value.push(tag)
            this.show = false
        },
        async getData(page_url) {
            let url = page_url || '/api/companies'
            const res = await this.callApi('get', url)
            this.paginator = res.data
            this.options = this.paginator.data
            this.show = url == '/api/companies' ? false : true

        },
        onSelect() {
            this.show = false
        },
        onTouch() {
            this.show = false
        }

    },
})
