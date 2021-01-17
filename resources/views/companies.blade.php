@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="companies">
        <h1 class="text-black-50">Companies</h1>
        <div class="row">
            <div class="col-12 text-right mb-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" @click="openModal()">
                    Create Company
                </button>
            </div>
        </div>
            <div class="row" v-if="companies">
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

                                    <tr v-for="company in companies.data" :key="company.id">
                                        <td> @{{ company.id }}</td>
                                        <td> @{{ company.name }}</td>
                                        <td>
                                            @{{ company.description }}
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <button class="btn btn-success m-1" @click="openModal(company)"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger m-1" @click="deleteCompany(company.id)"><i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                        <Pagination :data="companies"></Pagination>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        <div class="modal fade"  ref="modalCompanies" id="modal-companies" aria-hidden="true" style="display:none">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Companies Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="companies-name">Companies name</label>
                                    <input type="text" v-model="form.name" class="form-control" name="companies" id="companies-name">
                                </div>
                                <div class="form-group">
                                    <label for="companies-description">Companies description</label>
                                    <textarea class="form-control" v-model="form.description" name="companies-description" cols="30"
                                              id="companies-description"
                                              rows="10"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="updateCompany()" v-if="edit">Update company</button>
                        <button type="button" class="btn btn-primary" @click="createCompany()" v-if="!edit">Save company</button>
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
            'companies' => $companies,
]) !!}
    </script>
@endpush
@push('afterJs')
    <script src="{{ mix('/js/pages/companies.js') }}"></script>
@endpush
