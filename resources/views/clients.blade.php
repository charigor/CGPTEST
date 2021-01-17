@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="clients">
        <h1 class="text-black-50">Clients</h1>
        <div class="row">
            <div class="col-12 text-right mb-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" @click="openModal()">
                    Create Client
                </button>
            </div>
        </div>

        <div class="row" v-if="clients">
            <div class="col-md-12">
                <div class="card">

                    <!-- /.card-header -->

                    <div class="card-body">

                        <table class="table table-bordered">
                            <thead>

                            <tr>
                                <th style="width: 10px">#</th>
                                <th>name</th>
                                <th>description</th>
                                <th style="width: 40px">action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="client in clients.data" :key="client.id">
                                <td> @{{ client.id }}</td>
                                <td> @{{ client.name }}</td>
                                <td>
                                    @{{ client.description }}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-success m-1"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger m-1"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                    <Pagination :data="clients"></Pagination>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
        </div>
        <div class="modal fade" ref="modalClients" id="modal-companies" aria-hidden="true" style="display:none">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Clients Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="client-name">Client name</label>
                                    <input type="text" v-model="form.name" class="form-control" name="client"
                                           id="client-name">
                                </div>
                                <div class="form-group">
                                    <label for="client-description">Client description</label>
                                    <textarea class="form-control" v-model="form.description"
                                              name="client-description" cols="30"
                                              id="client-description"
                                              rows="10"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="updateClient()" v-if="edit">Update
                            client
                        </button>
                        <button type="button" class="btn btn-primary" @click="createClient()" v-if="!edit">Save
                            client
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    </div>
@endsection
@push('beforeJs')
    <script>
        window.Laravel = {!! json_encode([
            'clients' => $clients,
]) !!}
    </script>
@endpush

@push('afterJs')
    <script src="{{ mix('/js/pages/clients.js') }}"></script>
@endpush
