<!DOCTYPE html>
<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Dependent Dropdown Example</title>
</head>
<body>
    <div>
        <label for="hotels">Select a hotel:</label>
        <select id="hotels">
            <option value="">Select a hotel</option>
            @foreach($hotels as $hotel)
                <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="rooms">Select a room:</label>
        <select id="rooms" >
            <option value="">Select a room</option>
        </select>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        $("#hotels").change(function () {
            var hotel_id = $(this).val();
            $.ajax({
                url: '/fetchrooms/' + hotel_id,
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    if (response['rooms'].length > 0) {
                        $("#rooms").empty(); // Clear the existing options before adding new ones
                        $.each(response['rooms'], function (key, value) {
                            $("#rooms").append("<option value='" + value['id'] + "'>" + value['name'] + "</option>");
                        });
                    }
                },
                error: function (xhr, status, error) {
                    // Handle errors if needed
                }
            });
        });
    });
</script>

</body>
</html>
