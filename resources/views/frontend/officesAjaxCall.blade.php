<script>
    $(document).ready(function () {
        $('select[name="region"]').on('change', function () {
            var parishID = $(this).val();
            var url = '{{ route("office.getParishes", ":id") }}';
            if (parishID) {
                $.ajax({
                    url: url.replace(':id', parishID),
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="parish"]').empty();
                        $('select[name="local_church"]').empty();

                        $('select[name="parish"]').append(
                            '<option value="">Select</option>');
                        $.each(data, function (key, value) {
                            $('select[name="parish"]').append('<option value="' +
                                value.reg_number + '">' + value.name +
                                '</option>');
                        });
                    }
                });
            } else {
                $('select[name="parish"]').empty();
            }
        });
        $('select[name="parish"]').on('change', function () {
            var churchID = $(this).val();
            var url = '{{ route("office.getChurches", ":id") }}';
            if (churchID) {
                $.ajax({
                    url: url.replace(':id', churchID),
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="local_church"]').empty();
                        $('select[name="local_church"]').append(
                            '<option value="">Select</option>');
                        $.each(data, function (key, value) {
                            $('select[name="local_church"]').append(
                                '<option value="' +
                                value.reg_number + '">' + value.name +
                                '</option>');
                        });
                    }
                });
            } else {
                $('select[name="local_church"]').empty();
            }
        });

    });
</script>
