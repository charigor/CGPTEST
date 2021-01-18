import PaginationVue from "../components/PaginationVue";

new Vue({
    el:  '#api',
    components: { PaginationVue },
    data: {
        data: '',
        companyId: '',
        clientId: '',
        paginator: ''
    },
    computed: {

    },
    methods: {
        async getClientCompanies() {
                const res = await this.callApi('get', `/api/clients/${this.clientId}`)
                this.data = res.data
        },
        async getCompanies(){
            const res = await this.callApi('get', '/api/companies')
                this.data = res.data


        },
        async getAllClients(){
            const res = await this.callApi('get', '/api/clients')
            this.data = res.data


        },
        async getClients(){
            const res = await this.callApi('get', `/api/companies/${this.companyId}`)
            this.data = res.data
        },
        async getData(page_url) {
            let url = page_url
            const res = await this.callApi('get', url)
            this.data = res.data

        },

    },

    created(){

    },

    mounted(){
        console.log('api clients')
    }
})
