<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<script type="text/javascript">
    var snapToken = '{{ $snapToken }}';
    snap.pay(snapToken, {
        onSuccess: function(result) {
            window.location.href = "{{ route('pembayaran.sukses') }}";
        },
        onPending: function(result) {
            alert("Pembayaran menunggu konfirmasi");
        },
        onError: function(result) {
            window.location.href = "{{ route('pembayaran.gagal') }}";
        }
    });
</script>
