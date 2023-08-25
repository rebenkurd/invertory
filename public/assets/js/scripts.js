
// Delete Alert
if ($('#row-delete').length) {
    $(document).on('click','#row-delete',function(e){
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
    title: 'Are you sure?',
    text: "Delete This Data?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
        window.location.href = link
        Swal.fire(
        'Deleted!',
        'Your file has been deleted.',
        'success'
        )
    }
    })
});

}

// data table
$('#table').dataTable({
    responsive:true,
});
// data table
$('#table-report').dataTable({
    responsive:true,
});

$(window).on('load', function() {
    if (feather) {
        feather.replace({
            width: 14,
            height: 14
        });
    }
})
