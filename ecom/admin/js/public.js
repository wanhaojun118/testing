// Change Language
function changeLanguage($language){
	 $.ajax({
        type: 'POST',
        url: "?pact=language",
        data: {
            language: $language
        },
        dataType: 'html',
        success: function (data) {
            location.reload();
        } 
    });
}

//Alert notice
function alert_notice($div, $notice) {
    $msg = "<div style=\"margin-top:10px;text-align:center\" class=\"alert alert-warning\">"+$notice+"</div>";
    $("#" + $div).html($msg);
    $("#" + $div).stop(true, false).fadeIn(300).fadeOut(10000);
}

function exportTableToCSV($table, filename) {

        var $rows = $table.find('tr:has(th),tr:has(td)'),

            // Temporary delimiter characters unlikely to be typed by keyboard
            // This is to avoid accidentally splitting the actual contents
            tmpColDelim = String.fromCharCode(11), // vertical tab character
            tmpRowDelim = String.fromCharCode(0), // null character

            // actual delimiter characters for CSV format
            colDelim = '","',
            rowDelim = '"\r\n"',

            // Grab text from table into CSV formatted string
            csv = '"' + $rows.map(function (i, row) {
                var $row = $(row),
                    $cols = $row.find('th,td');
	
                return $cols.map(function (j, col) {
                    var $col = $(col),
                        text = $col.text();

                    return text.replace(/"/g, '""'); // escape double quotes

                }).get().join(tmpColDelim);

            }).get().join(tmpRowDelim)
                .split(tmpRowDelim).join(rowDelim)
                .split(tmpColDelim).join(colDelim) + '"',

            // Data URI
            // csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);
            csvData = 'data:text/csv;charset=utf-8,\ufeff' + encodeURIComponent(csv);

        $(this)
            .attr({
            'download': filename,
                'href': csvData,
                'target': '_blank'
        });
}