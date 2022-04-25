$(document).ready(function() {
    $('#table-backoffice-article').DataTable({
        language: {
            url: '/js/dataTables.french.json'
        },
        "aoColumnDefs": [
            { 'bSortable': false, 'aTargets': [ 2,5,7,8,9,10,11,12 ] }
        ]
    });
});

$(document).ready(function() {
    $('#table-backoffice-user').DataTable({
        language: {
            url: '/js/dataTables.french.json'
        },
        "aoColumnDefs": [
            { 'bSortable': false, 'aTargets': [ 5,9 ] }
        ]
    });
});

$(document).ready(function() {
    $('#table-backoffice-commande').DataTable({
        language: {
            url: '/js/dataTables.french.json'
        },
        "aoColumnDefs": [
            { 'bSortable': false, 'aTargets': [6] }
        ]
    });
});
$(document).ready(function() {
    $('#table-backoffice-category').DataTable({
        language: {
            url: '/js/dataTables.french.json'
        },
        "aoColumnDefs": [
            { 'bSortable': false, 'aTargets': [ 3 ] }
        ]
    });
});