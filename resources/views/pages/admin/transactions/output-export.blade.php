<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Laporan transaction Masyarakat</title>

  <style>
    .thead{
    background-color: #3B82F6;
    color: #ffffff;

    }
  </style>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
  <div class="container mt-5">
    <div class="title text-center mb-5">
      <h2>Laporan Transaksi Penjualan</h2>
    </div>
    <table class="table table-bordered">
      <thead class="thead">
        <tr>
          <th>No</th>
          <th scope="col">Kode Transaksi</th>
          <th scope="col">Nama Pelanggan</th>
          <th scope="col">Jumlah Order</th>
          <th scope="col">Total Harga</th>
          {{-- <th scope="col">Status Transaksi</th> --}}
          <th scope="col">Status Pengiriman</th>
          <th scope="col">Tanggal Transaksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($transactions as $transaction)
        <tr>
          <td>{{$loop->iteration}} </td>
          <td>{{ $transaction->code }}</td>
          <td>{{ $transaction->user->name }}</td>
          <td>{{ $transaction->quantity_order }}</td>
          <td>{{ $transaction->total_price }}</td>
          {{-- <td>{{ $transaction->transaction_status }}</td> --}}
          <td>{{ $transaction->shipping_status }}</td>
          <td>{{ $transaction->created_at->format('l, d F Y') }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>

</html>
