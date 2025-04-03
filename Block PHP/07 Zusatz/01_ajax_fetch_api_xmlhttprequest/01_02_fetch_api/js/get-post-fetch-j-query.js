$('#getDataJquery').on('click', function () {
    $.ajax({
        url: 'data/example.json',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            $('#getOutputJquery').text(JSON.stringify(data, null, 2));
        },
        error: function (xhr, status, error) {
            console.error('Fehler bei der GET-Anfrage:', status, error);
        }
    });
});

$('#postDataJquery').on('click', function () {
    const postData = {
        name: 'Max Mustermann',
        alter: 30,
        stadt: 'Berlin'
    };

    $.ajax({
        url: 'https://httpbin.org/post',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(postData),
        success: function (data) {
            $('#postOutputJquery').text(JSON.stringify(data, null, 2));
        },
        error: function (xhr, status, error) {
            console.error('Fehler bei der POST-Anfrage:', status, error);
        }
    });
});
