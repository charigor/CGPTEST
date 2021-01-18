@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="api">
        <h1 class="text-black-50">ApiTest</h1>
        <div class="row">
            <div class="col-12 text-right mb-2">
                <div class="row flex-column">
                    <div class="col-6 text-left  d-flex">
                        <button type="button" class="btn btn-primary m-1" data-toggle="modal" @click="getCompanies()">
                            Get All Companies
                        </button>
                    </div>
                    <div class="col-6 text-left d-flex">
                        <button type="button" class="btn btn-primary m-1" data-toggle="modal" @click="getClientCompanies()">
                            Get Companies by Client id
                        </button>
                        <input type="number" style="width: 70px" class="form-control m-1" v-model="clientId">
                    </div>
                    <div class="col-6 text-left  d-flex">

                        <button type="button" class="btn btn-primary m-1" data-toggle="modal" @click="getClients()">
                           Get Clients By Company Id
                        </button>
                        <input type="number"  style="width: 70px" class="form-control m-1" v-model="companyId">
                    </div>
                    <div class="col-6 text-left  d-flex">
                        <button type="button" class="btn btn-primary m-1" data-toggle="modal" @click="getAllClients()">
                            Get All Clients
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" v-if="data" v-cloak>
            <div class="col-md-12">
                <div class="card">

                    <!-- /.card-header -->

                    <div class="card-body">

                        <table class="table table-bordered">


                            <tbody>
                            <tr v-for="item in data.data" :key="item.id">
                                <td> @{{ item.id }}</td>
                                <td v-if="item.email">
                                    @{{ item.email }}
                                </td>
                                <td> @{{ item.name }}</td>
                                <td>
                                    @{{ item.description }}
                                </td>

                            </tr>
                            </tbody>

                        </table>
                    </div>
                    <pagination-vue v-if="data.total > 20" @get-data="getData"
                                    :data="data" ></pagination-vue>

                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
        </div>
    </div>
@endsection

@push('afterJs')
    <script src="{{ mix('/js/pages/api.js') }}"></script>
@endpush
