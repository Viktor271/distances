<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Full Stack Developer practical test</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body><br><br><br>
<div class="container">
    <div class="row">
        <div class="col-sm-2">
            <select id="my-dropdown">
                <option selected disabled>select city</option>
            </select>
        </div>

        <div class="col-sm-2">
            <input type="text" id="slider-value" value="use slide for distance" disabled>
        </div>

        <div class="col-sm-4">

            <div id="slider"></div>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <table class="table" id="my-table">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Distance (km)</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>



<script>
    $.get('https://vik-bb.ru/App/ajax.php', {action: 'getAll'}, function(data){
        let res = $.parseJSON(data);
        let dropdown = $('#my-dropdown');

        res.forEach(function(item, i, data) {
            dropdown.append($('<option>').val(item).text(item));
        });
    });

    $('#my-dropdown').change(function(){
        $.get('https://vik-bb.ru/App/ajax.php', {action: 'getDistance', city: $(this).val()}, function(data){
            let res = $.parseJSON(data);
            $('#my-table tbody > tr').remove();
            res.forEach(function(item, i, res) {
                let tr = '<tr>';
                tr += '<td>' + item.name + '</td>';
                tr += '<td>' + item.distance + '</td>';
                tr += '</tr>';
                $('#my-table > tbody:last-child').append(tr);
            });
        });
    });

    $('#slider').slider({
        min: 0,
        max: 500,
        value: 50,
        slide: function(event, ui) {
            $('#slider-value').val(ui.value);
        },
        change: function(event, ui) {
            $(this).trigger('sliderchange', ui.value);
        }
    });

    $('#slider').on('sliderchange', function(event, value) {

        $('#my-table tbody tr').each(function() {
            if ($(this).find('td:eq(1)').text() > value) {
                $(this).hide();
            }
            if ($(this).find('td:eq(1)').text() < value) {
                $(this).show();
            }
        });

    });

</script>
