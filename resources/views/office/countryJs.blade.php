
<script>
    $(document).ready(function () {
    $('select[name="province"]').on('change', function () {
        var provinceID = $(this).val();
        var url = '{{ route("office.getDistricts", ":id") }}';
        if (provinceID) {
            $.ajax({
                url: url.replace(':id', provinceID),
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="district"]').empty();
                    $('select[name="sector"]').empty();
                    $('select[name="cell"]').empty();
                    $('select[name="village"]').empty();

                    $('select[name="district"]').append('<option value="">Select</option>');
                    $.each(data, function (key, value) {
                        $('select[name="district"]').append('<option value="' +
                        value.Dist_ID + '">' + value.District + '</option>');
                    });
                }
            });
        } else {
            $('select[name="district"]').empty();
        }
    });
});
$(document).ready(function () {
    $('select[name="district"]').on('change', function () {
        var districtID = $(this).val();
        var url = '{{ route("office.getSectors", ":id") }}';
        if (districtID) {
            $.ajax({
                url: url.replace(':id', districtID),
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="sector"]').empty();
                    $('select[name="cell"]').empty();
                    $('select[name="village"]').empty();
                    $('select[name="sector"]').append('<option value="">Select</option>');
                    $.each(data, function (key, value) {
                        $('select[name="sector"]').append('<option value="' +
                        value.Sect_ID + '">' + value.Sector + '</option>');
                    });
                }
            });
        } else {
            $('select[name="sector"]').empty();
        }
    });
});
$(document).ready(function () {
    $('select[name="sector"]').on('change', function () {
        var sectorID = $(this).val();
        var url = '{{ route("office.getCells", ":id") }}';
        if (sectorID) {
            $.ajax({
                url: url.replace(':id', sectorID),
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="cell"]').empty();
                    $('select[name="village"]').empty();

                    $('select[name="cell"]').append('<option value="">Select</option>');
                    $.each(data, function (key, value) {
                        $('select[name="cell"]').append('<option value="' +
                            value.Cell_ID + '">' + value.Cell + '</option>');
                    });
                }
            });
        } else {
            $('select[name="cell"]').empty();
        }
    });
});
$(document).ready(function () {
    $('select[name="cell"]').on('change', function () {
        var cellID = $(this).val();
        var url = '{{ route("office.getVillages", ":id") }}';
        if (cellID) {
            $.ajax({
                url: url.replace(':id', cellID),
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="village"]').empty();
                    $('select[name="village"]').append('<option value="">Select</option>');
                    $.each(data, function (key, value) {
                        $('select[name="village"]').append('<option value="' +
                        value.Vill_ID + '">' + value.Village + '</option>');
                    });
                }
            });
        } else {
            $('select[name="village"]').empty();
        }
    });
});
@if (old('id'))
    @if($errors->any())
        var myModal = new bootstrap.Modal(document.getElementById('editOffice'), {keyboard: false })
        myModal.show()
    @endif
@else
    @if($errors->any())
            var myModal = new bootstrap.Modal(document.getElementById('addModel'), { keyboard: false})
            myModal.show()
    @endif
@endif

</script>
