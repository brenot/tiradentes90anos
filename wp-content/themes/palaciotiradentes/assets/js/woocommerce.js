jQuery(document).ready(function ($) {

    "use strict";
    /**
     * Ajax get Select Show product
     **/
    $(document).on('change', '.sort-number', function () {
        var data = {
            action: 'essence_show_product_via_ajax',
            loop_product: $('.sort-number').val(),
        }

        $.post(ajaxurl, data, function (response) {
            console.log(response);
            if ($('form.woocommerce-ordering .orderby').length) {
                console.log('ok');
                $('form.woocommerce-ordering .orderby').trigger('change');
            }
        });
    });
    /**
     * End ajax
     **/

    /** This file content js for each function, widget or shortcode you chosen. **/
    $(".orderby,#pa_color,#pa_size,#calc_shipping_country,#color,#size,.sort-number").chosen({
        disable_search_threshold: 10
    });
    //Widget Categories
    $( ".sidebar li.cat-parent" ).append( "<span class='ts-cart-children'></span>" );
    $('.cat-parent .ts-cart-children').on( "click", function() {
      $(this).parent().find('.children').slideToggle();
      $(this).toggleClass('show');
    });    
    // Script load ajx
    $(document).ajaxComplete(function (event, xhr, settings) {
        $(".orderby,#pa_color,#pa_size,#calc_shipping_country,#color,#size,.sort-number").chosen({
            disable_search_threshold: 10
        });
    });
    
    // Target quantity inputs on product pages
    $('input.qty:not(.product-quantity input.qty)').each(function () {
        var min = parseFloat($(this).attr('min'));

        if (min && min > 0 && parseFloat($(this).val()) < min) {
            $(this).val(min);
        }
    });

    $(document).on('click', '.quantity .plus, .quantity .minus', function (e) {

        // Get values
        var $qty = $(this).closest('.quantity').find('.qty'),
            currentVal = parseFloat($qty.val()),
            max = parseFloat($qty.attr('max')),
            min = parseFloat($qty.attr('min')),
            step = $qty.attr('step');

        // Format values
        if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
        if (max === '' || max === 'NaN') max = '';
        if (min === '' || min === 'NaN') min = 0;
        if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

        // Change the value
        if ($(this).is('.plus')) {

            if (max && ( max == currentVal || currentVal > max )) {
                $qty.val(max);
            } else {
                $qty.val(currentVal + parseFloat(step));
            }

        } else {

            if (min && ( min == currentVal || currentVal < min )) {
                $qty.val(min);
            } else if (currentVal > 0) {
                $qty.val(currentVal - parseFloat(step));
            }

        }

        // Trigger change event
        $qty.trigger('change');

        e.preventDefault();

    });
    // Switch between products listview and gridview
    $(document).on('click', '.products-sort-views .products-change-view', function (e) {

        var $this = $(this);
        if ($this.hasClass('active')) {
            return false;
        }

        if ($this.hasClass('products-grid-view')) {
            $('.products-wraps').addClass('products-grid').removeClass('products-list');
            $('.products-wraps.columns-4 .product').addClass('col-sm-3').removeClass('row');
            $('.products-wraps.columns-3 .product').addClass('col-sm-4').removeClass('row');
            $('.products-wraps .tr-product-media').removeClass('col-sm-4');
            $('.products-wraps .tr-product-info').removeClass('col-sm-8');
        }
        else {
            $('.products-wraps').removeClass('products-grid').addClass('products-list');
            $('.products-wraps .product').removeClass('col-sm-3').addClass('row');
            $('.products-wraps .product').removeClass('col-sm-4').addClass('row');
            $('.products-wraps .tr-product-media').addClass('col-sm-4');
            $('.products-wraps .tr-product-info').addClass('col-sm-8');
        }

        $('.products-sort-views .products-change-view').removeClass('active');
        $this.addClass('active');

        e.preventDefault();

    });
}); // Close jQuery for frontend