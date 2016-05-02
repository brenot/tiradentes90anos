jQuery(document).ready(function ($) {



    "use strict";



    function essence_core_init_date_picker() {

        $('.ts-date-picker').each(function () {

            var $this = $(this);

            $this.datetimepicker({

                //debug:true

            });

        });

    }



    essence_core_init_date_picker();



    // Ajax event

    $(document).ajaxComplete(function (event, xhr, settings) {



        essence_core_init_date_picker();



    });



    //Portfolio Setting.

    var essencePosttypeMetasdepConfig = {

        1: {

            'selector': '.cmb2-id-essence-portfolio-slider', // Selectors dependency on "dep"

            'dep': '#essence_portfolio-type',

            'compare': '=',

            'value': 'slider'

        },

        2: {

            'selector': '.cmb2-id-essence-portfolio-video', // Selectors dependency on "dep"

            'dep': '#essence_portfolio-type',

            'compare': '=',

            'value': 'video'

        },

        3: {

            'selector': '.cmb2-id-essence-portfolio-soundcloud', // Selectors dependency on "dep"

            'dep': '#essence_portfolio-type',

            'compare': '=',

            'value': 'soundcloud'

        },

        4: {

            'selector': '.cmb2-id-essence-member-custom-link', // Selectors dependency on "dep"

            'dep': '#essence_member_link_type',

            'compare': '=',

            'value': 'custom'

        },



        // For custom logo

        5: {

            'selector': '.cmb2-id-essence-custom-logo', // Selectors dependency on "dep"

            'dep': '#essence_use_custom_logo',

            'compare': '=',

            'value': 'yes'

        },



        // For custom title, breadcrumb

        6: {

            'selector': '.cmb2-id-essence-custom-title', // Selectors dependency on "dep"

            'dep': '#essence_show_title',

            'compare': '=',

            'value': 'custom'

        },

        7: {

            'selector': '.cmb2-id-essence-title-colorpicker', // Selectors dependency on "dep"

            'dep': '#essence_show_title',

            'compare': '<>',

            'value': 'disable'

        },

        8: {

            'selector': '.cmb2-id-essence-breadcrumb-color, .cmb2-id-essence-breadcrumb-hover-color, .cmb2-id-essence-breadcrumb-cur-page-color, .cmb2-id-essence-breadcrumb-sep-color', // Selectors dependency on "dep"

            'dep': '#essence_show_breadcrumb',

            'compare': '=',

            'value': 'yes'

        },



        // For custom header

        9: {

            'selector': '.cmb2-id-essence-header-type, .cmb2-id-essence-section-revolution, .cmb2-id-essence-scroll-down-style', // Selectors dependency on "dep"

            'dep': '#essence_use_custom_header',

            'compare': '=',

            'value': 'yes'

        },

        10: {

            'selector': '.cmb2-id-essence-custom-header-img', // Selectors dependency on "dep"

            'dep': '#essence_section_revolution',

            'compare': '=',

            'value': ''

        },

        11: {

            'selector': '.cmb2-id-essence-custom-scroll-down-img', // Selectors dependency on "dep"

            'dep': '#essence_scroll_down_style',

            'compare': '=',

            'value': 'custom'

        },



        // For post formats

        12: {

            'selector': '.cmb2-id-ts-post-0', // Selectors dependency on "dep"

            'dep': '#post-format-0',

            'compare': 'checked',

            'value': '0'

        },

        13: {

            'selector': '.cmb2-id-ts-post-aside', // Selectors dependency on "dep"

            'dep': '#post-format-aside',

            'compare': 'checked',

            'value': 'aside'

        },

        14: {

            'selector': '.cmb2-id-ts-post-image', // Selectors dependency on "dep"

            'dep': '#post-format-image',

            'compare': 'checked',

            'value': 'image'

        },

        15: {

            'selector': '.cmb2-id-ts-post-audio-embed', // Selectors dependency on "dep"

            'dep': '#post-format-audio',

            'compare': 'checked',

            'value': 'audio'

        },

        16: {

            'selector': '.cmb2-id-ts-post-video-embed', // Selectors dependency on "dep"

            'dep': '#post-format-video',

            'compare': 'checked',

            'value': 'video'

        },

        17: {

            'selector': '.cmb2-id-ts-image-gallery', // Selectors dependency on "dep"

            'dep': '#post-format-gallery',

            'compare': 'checked',

            'value': 'gallery'

        },

        18: {

            'selector': '.cmb2-id-ts-quote-author', // Selectors dependency on "dep"

            'dep': '#post-format-quote',

            'compare': 'checked',

            'value': 'quote'

        },

        19: {

            'selector': '.cmb2-id-ts-post-link', // Selectors dependency on "dep"

            'dep': '#post-format-link',

            'compare': 'checked',

            'value': 'link',

        },
        20: {

            'selector': '.cmb2-id-essence-add-title-tab-1,.cmb2-id-essence-add-desc-tab-1,.cmb2-id-essence-add-title-tab-2,.cmb2-id-essence-add-desc-tab-2,.cmb2-id-essence-add-title-tab-3,.cmb2-id-essence-add-desc-tab-3,.cmb2-id-essence-add-title-tab-4,.cmb2-id-essence-add-desc-tab-4', // Selectors dependency on "dep"

            'dep': '#essence_product-enable',

            'compare': '=',

            'value': 'show',

        }

    };



    function essence_page_update_display_dep_metas() {



        $.each(essencePosttypeMetasdepConfig, function (i, val) {



            var compare = val['compare'] == '' ? '=' : val['compare'];

            var indent = false;

            var indent2 = false;

            var indent3 = false;

            if (val.hasOwnProperty('indent')) {

                indent = val['indent'];

            }

            if (val.hasOwnProperty('indent2')) {

                indent2 = val['indent2'];

            }

            if (val.hasOwnProperty('indent3')) {

                indent3 = val['indent3'];

            }



            if (indent) {

                $(val['selector']).css({'padding-left': '4%'});

            }

            if (indent2) {

                $(val['selector']).css({'padding-left': '7%'});

            }

            if (indent3) {

                $(val['selector']).css({'padding-left': '10%'});

            }



            switch (compare) {



                case '=':

                    if ($(val['dep']).val() != val['value']) {

                        $(val['selector']).css({'display': 'none'});

                    }

                    else {

                        $(val['selector']).css({'display': ''});

                    }

                    break;



                case 'checked':

                    console.log($(val['dep']).val());

                    console.log(val['value']);

                    if ($(val['dep']).is(':checked') && $(val['dep']).val() == val['value']) {

                        $(val['selector']).css({'display': ''});

                    }

                    else {

                        $(val['selector']).css({'display': 'none'});

                    }

                    break;



                case '!=':

                case '<>':

                    if ($(val['dep']).val() == val['value']) {

                        $(val['selector']).css({'display': 'none'});

                    }

                    else {

                        $(val['selector']).css({'display': ''});

                    }

                    break;



                case 'in':



                    if (val['value'].indexOf($(val['dep']).val() + ',') >= 0 || val['value'].indexOf(', ' + $(val['dep']).val()) >= 0 || val['value'].indexOf(',' + $(val['dep']).val()) >= 0) {

                        $(val['selector']).css({'display': ''});

                    }

                    else {

                        $(val['selector']).css({'display': 'none'});

                    }

                    break;

            }



            // Check dependency on parrent

            if ($(val['dep']).closest('.rwmb-field, *[class^="cmb-type-"], *[class*=" cmb-type-"]').is(':hidden')) {

                $(val['selector']).css({'display': 'none'});

            }

            else {

            }

        });



    }



    function essence_init_dep_metas() {

        essence_page_update_display_dep_metas();

        $.each(essencePosttypeMetasdepConfig, function (i, val) {

            $(document).on('change', val['dep'], function () {

                essence_page_update_display_dep_metas();

            });

        });

    }



    essence_init_dep_metas();



    $(document).on('click', '#poststuff .handlediv, #poststuff .hndle', function (e) {

        essence_page_update_display_dep_metas();

    });



    //Post settings

    function essence_core_post_format_setting() {



        var post_metas = $('#ts_post_metabox');



        var image_gallery       =  $('.cmb2-id-ts-image-gallery');

        var post_image          =  $('.cmb2-id-ts-post-image');

        var post_video_embed    =  $('.cmb2-id-ts-post-video-embed');

        var post_audio_embed    =  $('.cmb2-id-ts-post-audio-embed');

        var quote_content       =  $('.cmb2-id-ts-quote-content');

        var quote_author        =  $('.cmb2-id-ts-quote-author');





        var post_format_standard    = $( '#post-format-0' );

        var post_format_image       = $('#post-format-image');

        var post_format_gallery     = $('#post-format-gallery');

        var post_format_video       = $('#post-format-video');

        var post_format_audio       = $('#post-format-audio');

        var post_format_quote       = $('#post-format-quote');



        if (post_format_image.is(':checked')) {

            post_metas.fadeIn();

            image_gallery.hide();

            post_image.fadeIn();

            post_video_embed.hide();

            post_audio_embed.hide();

            quote_content.hide();

            quote_author.hide();



        } else if (post_format_gallery.is(':checked')) {

            post_metas.fadeIn();

            image_gallery.fadeIn();

            post_image.hide();

            post_video_embed.hide();

            post_audio_embed.hide();

            quote_content.hide();

            quote_author.hide();



        } else if (post_format_video.is(':checked')) {

            post_metas.fadeIn();

            image_gallery.hide();

            post_image.hide();

            post_video_embed.fadeIn();

            post_audio_embed.hide();

            quote_content.hide();

            quote_author.hide();



        } else if (post_format_audio.is(':checked')) {

            post_metas.fadeIn();

            image_gallery.hide();

            post_image.hide();

            post_video_embed.hide();

            post_audio_embed.fadeIn();

            quote_content.hide();

            quote_author.hide();



        } else if (post_format_quote.is(':checked')) {

            post_metas.fadeIn();

            image_gallery.hide();

            post_image.hide();

            post_video_embed.hide();

            post_audio_embed.hide();

            quote_content.fadeIn();

            quote_author.fadeIn();



        }else{

            post_metas.hide();

        }

    }

    //var select_type = $('#post-formats-select input');

//    essence_core_post_format_setting();

//    select_type.change(function() {

//        essence_core_post_format_setting();

//    });





});