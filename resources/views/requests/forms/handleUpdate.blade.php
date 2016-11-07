<script type="text/javascript">
    function handleUpdate()
    {
        var select = $(this);
        var optional = $('.optional', select.parent());
        
        if (select.val() === '1') {
            optional.removeClass('hidden');
        } else {
            optional.addClass('hidden');
        }
    }

    $(document).ready(function() {
        $.each($('select'), handleUpdate);
        
        $('select').on('change', handleUpdate);
    });
</script>