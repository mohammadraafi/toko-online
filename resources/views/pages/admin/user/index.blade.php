@extends('layouts.admin')

@section('title', 'User')
    
@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
    <div class="dashboard-heading">
        <h2 class="dashboard-title">Pelanggan</h2>
        <p class="dashboard-subtitle">
            Daftar Pelanggan
        </p>
    </div>
    <div class="dashboard-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <a href="{{route('user.create')}}" class="btn btn-primary mb-3"> + Add New User</a> --}}
                        <div class="table-responsive">
                            <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                <thead>
                                    <tr>
                                        {{-- <th>ID</th> --}}
                                        <th>Nama</th>
                                        <th>Email</th>
                                        {{-- <th>Roles</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            // ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
                type: 'GET',
                
            },
            columns: [
                // {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                // {data: 'roles', name: 'roles'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searcable: false,
                    width: '15%'
                },
            ],
            order: [
                    [0, 'asc']
                ]
        });
        });
    </script>
@endpush