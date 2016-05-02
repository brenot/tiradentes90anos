jQuery(document).ready(function ($) {

    "use strict";

    // Count down (coming soon mode) for admin
    // Coming Soon Countdown
    $('.essence-countdown-wrap').each(function () {
        var $this = $(this);
        var countdown_to_date = $this.attr('data-countdown');

        if (typeof countdown_to_date == 'undefined' || typeof countdown_to_date == false) {
            var cd_class = $this.attr('class');
            if ($.trim(cd_class) != '') {
                cd_class = cd_class.split('essence-cms-date_');
                if (typeof cd_class[1] != 'undefined' && typeof cd_class[1] != false) {
                    countdown_to_date = cd_class[1];
                }
                console.log(cd_class);
            }
        }

        if (typeof countdown_to_date != 'undefined' && typeof countdown_to_date != false) {
            if ($this.hasClass('countdown-admin-menu')) { // For admin login
                $this.find('a').countdown(countdown_to_date, function (event) {
                    $this.find('a').html(
                        event.strftime(essence['html']['countdown_admin_menu'])
                    );
                });
            }
            else {
                $this.countdown(countdown_to_date, function (event) {
                    $this.html(
                        event.strftime(essence['html']['countdown'])
                    );
                });
            }
        }

    });

});