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
    el: '#companies',
    // store:  store,
    components: {Pagination, Multiselect, PaginationVue},
    data: {
        companies: window.Laravel.companies,
        errors: new Errors(),
        edit: false,
        form: {
            id: '',
            name: '',
            description: ''
        },
        value: [],
        options: [],
        show: false
    },
    computed: {},
    methods: {
        openModal(data = null) {
            this.edit = false
            this.show = false
            this.errors.errors = {}
            this.clearForm();

            $(this.$refs.modalCompanies).modal('show');
            if (data) {
                this.getData()
                this.value = data.clients ? data.clients : []
                this.edit = true
                this.form.id = data.id
                this.form.name = data.name
                this.form.description = data.description

            }

        },
        createCompany() {

            axios.post(
                `/companies`,
                this.form,
            )
                .then(response => {
                    this.companies = response.data.companies
                    $(this.$refs.modalCompanies).modal('hide');
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
        updateCompany() {
            this.form.value = this.value.map((item) => {
                return item.id
            })
            axios.put(
                `/companies/${this.form.id}`,
                this.form,
            )
                .then(response => {
                    this.companies.data.filter(function (item, self) {
                        if (item.id == response.data.company.id) {
                            item.name = response.data.company.name
                            item.description = response.data.company.description
                            item.clients = response.data.company.clients
                        }
                        return self
                    });
                    $(this.$refs.modalCompanies).modal('hide');

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
                    console.log(error)
                    this.errors.record(error.response.data)
                });
        },
        deleteCompany(id) {
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
                        `/companies/${id}`,

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

                            this.companies = response.data.companies
                        })
                        .catch((error) => {
                            console.log(error)
                            this.errors.record(error.response.data)
                        });
                }
            })
        },
        clearForm() {
            this.form = {
                name: '',
                description: ''
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
        onSelect() {
            this.show = false
        },
        onTouch() {
            this.show = false
        },
        async getData(page_url) {
            let url = page_url || '/api/clients'
            const res = await this.callApi('get', url)
            this.paginator = res.data
            this.options = this.paginator.data
            this.show = url == '/api/clients' ? false : true

        },
    },

})
