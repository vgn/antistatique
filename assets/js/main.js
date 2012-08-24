/*
 * Antistatique.net
 * Javascript file
 */

jQuery(function($) {
    $('#newsletter_form').submit(function (e) {
        var $form = $(this);
        $form.find('.alert').hide();
        e.preventDefault();
        $.getJSON(
            this.action + "?callback=?",
            $(this).serialize(),
            function (response) {
                if (200 === response.Status) {
                    $form.find('.alert-success').show();
                    $('#newsletter_form').reset();
                } else {
                    $form.find('.alert-error').show();
                }
            }
        );
    });
});
