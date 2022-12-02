@extends('layouts.admin')

@section('title', 'Store Dashboard')

@section('content')
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="section-content section-dashboard-home" data-aos="fade-up">
            <div class="container-fluid">
                <div class="dashboard-heading">
                    <h2 class="dashboard-title">#{{ $transaction->code }}</h2>
                    <p class="dashboard-subtitle">
                        Detail Transaksi
                    </p>
                </div>

                <div class="dashboard-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                @forelse ($transactionDetails as $transactionDetail)
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <img src="{{ Storage::url($transactionDetail->product->galleries->first()->photos ?? '') }}"
                                                    alt="" class="w-100 mb-3" />
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <div class="row">

                                                    <div class="col-12 col-md-6">
                                                        <div class="product-title">Nama Produk</div>
                                                        <div class="product-subtitle">
                                                            {{ $transactionDetail->product->name }}
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="product-title">Harga</div>
                                                        <div class="product-subtitle">
                                                            Rp. {{ number_format($transactionDetail->price) }}
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="product-title">Kode Detail Transaksi</div>
                                                        <div class="product-subtitle">
                                                            {{ $transactionDetail->code }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse

                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12 mt-4">
                            <h5>
                                Informasi Pengiriman
                            </h5>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="product-title">Nama Penerima</div>
                                    <div class="product-subtitle">
                                        {{ $transactionDetail->transaction->user->name }}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="product-title">Nomor Telepon</div>
                                    <div class="product-subtitle">
                                        {{ $transactionDetail->transaction->user->phone_number }}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="product-title">Alamat Lengkap</div>
                                    <div class="product-subtitle">
                                        {{ $transaction->user->address->detail }}
                                    </div>
                                </div>
                                {{-- <div class="col-12 col-md-6">
                                    <div class="product-title">Alamat Lengkap</div>
                                    <div class="product-subtitle">
                                        {{ $transactionDetail->transaction->user->address_two }}
                                    </div>
                                </div> --}}
                                <div class="col-12 col-md-6">
                                    <div class="product-title">
                                        Provinsi
                                    </div>
                                    <div class="product-subtitle">
                                        {{ $alamat[0]->prov}}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="product-title">Kota</div>
                                    <div class="product-subtitle">
                                        {{ $alamat[0]->kota}}

                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="product-title">Resi Pengiriman</div>
                                    <div class="product-subtitle">
                                        {{ $transactionDetail->transaction->resi}}

                                    </div>
                                </div>
                                {{-- <div class="col-12 col-md-6">
                                    <div class="product-title">Kode Pos</div>
                                    <div class="product-subtitle">{{ $transactionDetail->transaction->user->zip_code }}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="product-title">Negara</div>
                                    <div class="product-subtitle">
                                        {{ $transactionDetail->transaction->user->country }}
                                    </div>
                                </div> --}}
                                <div class="col-12 mb-5">
                                    <button type="button" class="btn btn-success mb-2" data-toggle="modal"
                                        data-target="#update-resi-{{ $transaction->id }}">
                                        Update Status Pengiriman
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="update-resi-{{ $transaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Status Pengiriman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="transactionDetails">
                    <form action="{{ route('dashboard-transaction-update', $transaction->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <div class="product-title">Status Pengiriman</div>
                                <select name="shipping_status" id="status" class="form-control" v-model="status">
                                    <option value="Belum dikirim">Belum dikirim</option>
                                    <option value="Dikirim">Dikirim</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <template v-if="status == 'Dikirim'">
                                <div class="col-md-5">
                                    <div class="product-title">
                                        Masukan Resi
                                    </div>
                                    <input class="form-control" type="text" name="resi" id="openStoreTrue"
                                        v-model="resi" />
                                </div>
                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-success btn-block mt-4">
                                        Update Resi
                                    </button>
                                </div>
                            </template>
                        </div>
                        <div class="modal-footer mt-2">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
               
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
        var transactionDetails = new Vue({
            el: "#transactionDetails",
            data: {
                status: "{{ $transaction->shipping_status }}",
                resi: "{{ $transaction->resi }}",
            },
        });
    </script>
@endpush
