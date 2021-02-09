<table>
    <thead>
    <tr>
        <th style="font-weight: bold">Nomor Transaksi</th>
        <th style="font-weight: bold">Nama Merchant</th>
        <th style="font-weight: bold">Nama Pembeli</th>
        <th style="font-weight: bold">Nama Produk</th>
        <th style="font-weight: bold">Jumlah Pembelian</th>
        <th style="font-weight: bold">Harga Produk</th>
        <th style="font-weight: bold">Total Transaksi</th>
        <th style="font-weight: bold">Tanggal Transaksi</th>
        <th style="font-weight: bold">Status Transaksi</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transaksi as $item)
        <tr>
            <td>{{ $item->kode_transaksi }}</td>
            <td>{{ $item->merchant->nama_merchant }}</td>
            <td>{{ $item->pembeli->nama_pembeli }}</td>
            <td>{{ $item->produk->nama_produk }}</td>
            <td>{{ $item->total_produk }}</td>
            <td>{{ $item->produk->harga }}</td>
            <td>{{ $item->total_transaksi }}</td>
            <td>{{ date_format($item->created_at, 'd/m/Y') }}</td>
            @if ($item->status_transaksi == 4)
                <td>Transaksi sudah di Verifikasi</td>
            @else
                <td>Transaksi belum di Verifikasi</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
