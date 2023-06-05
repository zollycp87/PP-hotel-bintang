<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <p>{{ Session::get('success') }}</p>
    <form action="/logout" method="post">
        @csrf
        <button type="submit" class="dropdown-item d-flex align-items-center">
            <i class="bi bi-box-arrow-right"></i>
            <span>Keluar</span>
        </button>
    </form>
    <a href="{{ route('edit-profile', Auth::user()->id_user) }}">Ubah Profile</a>
    <br>

    {{-- Nyoba tanggal --}}
    <form action="" method="POST">
        <label for="start_date">Tanggal Mulai:</label>
        <input type="date" name="start_date" id="start_date">
    
        <label for="end_date">Tanggal Selesai:</label>
        <input type="date" name="end_date" id="end_date">
    
        <label for="price">Harga:</label>
        <input type="text" name="price" id="price" readonly>
    </form>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#start_date, #end_date').change(function() {
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN" : "{{ csrf_token() }}"
                }
            })
            if (startDate && endDate) {
                $.ajax({
                    url: '{{ route('calculate-price') }}',
                    type: 'POST',
                    data: {
                        start_date: startDate,
                        end_date: endDate
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#price').val(response.total_price);
                    },
                    error: function(xhr, status, error) {
                        console.log('Error calculating price:', error);
                    }
                });
            }
        });
    });
</script>

</html>
