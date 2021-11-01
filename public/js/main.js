$.ajaxSetup(
    {
        headers:
        {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    }
);
$('#report_input #score').on('change', function(){
    $.ajax({
        method: 'POST',
        url:  "/dashboard/reports/"+$(this).attr('data-id'),
        data: {value: $(this).val()}
      });
})
