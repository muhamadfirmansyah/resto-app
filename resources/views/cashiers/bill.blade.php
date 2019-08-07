<table border="0" style="border: 2px solid #000; padding: 20px 10px;">
    <tr>
        <td>ID Transaksi</td>
        <td>:</td>
        <td>{{ $bill->transaction_code }}</td>
    </tr>
    <tr>
        <td>Waktu, tanggal</td>
        <td>:</td>
        <td>
            {{-- {{ \Carbon\Carbon::createFromTimeStamp(strtotime($bill->created_at))->diffForHumans() }} --}}
            {{ $bill->created_at->parse()->format('h:m, d/m/d') }}
        </td>
    </tr>
    <tr>
        <td>Kasir</td>
        <td>:</td>
        <td>
            {{ $bill->user->name }}
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <hr>
            <p>Items</p>
            <table border="1" style="width: 100%; border-collapse: collapse">
                @foreach ($bill->transactionItems as $item)    
                    <tr>
                        <td style="padding: 5px;">{{ $item->menu }}</td>
                        <td style="padding: 5px;">{{ rp($item->price) }}</td>
                        <td style="padding: 5px;">{{ $item->qty }}</td>
                        <td style="padding: 5px;">{{ rp($item->amount) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" style="padding: 5px;">
                        Total
                    </td>
                    <td style="padding: 5px;">
                        {{ rp($bill->total) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 5px;">
                        Bayar
                    </td>
                    <td style="padding: 5px;">
                        {{ rp($bill->pay) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding: 5px;">
                        Kembalian
                    </td>
                    <td style="padding: 5px;">
                        {{ rp($bill->change) }}
                    </td>
                </tr>
            </table>
            <hr>
            <p style="text-align: center;">Terima kasih</p>
        </td>
    </tr>
</table>

<script>
    window.print();
</script>