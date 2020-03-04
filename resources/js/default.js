$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('.data-table').DataTable();
    $('.data-table').on("click", ".delete", function(){
        var data = $(this).val();
        var language = $('#language').val();
        $.ajax({
            url: '/'+language+'/translation/'+data,
            type: 'DELETE',
            success: function(response) {    
                //alert(response.original);
            }
        });
        table.row($(this).parents('tr')).remove().draw(false);
    });


    $('.add-ro').on("click", function(){
        var original = $('#original').val(); 
        var ro = $('#ro').val();
        var original_required = document.getElementById("original_required");
        var ro_required = document.getElementById("ro_required");
        original_required.style.display = "none";
        ro_required.style.display = "none";
        if(original != '' && ro != '' ) {
            var language = $('#language').val();
            $.ajax({
                url: '/'+language+'/translation',
                type: 'POST',
                data: {'original':original, 'ro':ro},
                success: function(response) {
                   
                    var row = table.row.add( [ original, ro, '' ] )
                    .draw()
                    .node();

                    $(row.children[2]).html( $('<button />', {
                        value: original,
                        class: 'btn btn-default btn-sm delete',
                        type: 'button',
                        html: '<span class="glyphicon glyphicon-trash">Trash</span>'
                    }));

                    $('#original').val('');
                    $('#ro').val('');
                }
            });
        } 
        if(original=='') {
            original_required.style.display = "block";
        } 
        if(ro=='') {
            ro_required.style.display = "block"; 
        }
    });

    $('.language').on('changed.bs.select', function (event, clickedIndex, newValue, oldValue) {
        if ($(this).val()!='' ) {
            var url = window.location.href;
            var newUrl = url.replace(oldValue, $(this).val());
            window.location = newUrl;
        }
    });

});
 