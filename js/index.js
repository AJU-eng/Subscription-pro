jQuery(document).ready(function($) {
    (function($) {
        // Find the element with class 'form-field' and add inline CSS
        $('p.form-field').each(function() {
            $(this).css({
                'background-color': 'black',
                'padding': '0'
            });
        });
    })(jQuery);
});