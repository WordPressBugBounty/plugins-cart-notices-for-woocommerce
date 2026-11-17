jQuery(function($) {
    var automaticSelector = 'div.berocket_cart_notice_auto';
    var shortcodeSelector = 'div.berocket_cart_notice_shortcode';
    if ($('.wp-block-woocommerce-cart, .wp-block-woocommerce-checkout').length) {
        if (!window.wp || !window.wp.data || !window.wc || !window.wc.wcBlocksData) {
            return;
        }
        var store = window.wc.wcBlocksData.CART_STORE_KEY || 'wc/store/cart';
        var lastAutomatic;
        var lastShortcode;
        function updateBlockNotices() {
            var cart = window.wp.data.select(store).getCartData();
            var notices = cart.extensions && cart.extensions['berocket-cart-notices'];
            if (!notices) {
                return;
            }
            if (window.brCartNoticeAutomatic && typeof notices.automatic === 'string' && notices.automatic !== lastAutomatic) {
                $(automaticSelector).html(notices.automatic);
                lastAutomatic = notices.automatic;
            }
            if (typeof notices.shortcode === 'string' && notices.shortcode !== lastShortcode) {
                $(shortcodeSelector).html($(notices.shortcode).html());
                lastShortcode = notices.shortcode;
            }
        }
        window.wp.data.subscribe(updateBlockNotices, store);
        updateBlockNotices();
        return;
    }

    // Block themes wrap the message in a content div inside the visible banner.
    function noticeContainers(notices) {
        return notices.map(function() {
            var notice = $(this);
            var container = notice.closest('.woocommerce-info, .woocommerce-message, .woocommerce-error, .wc-block-components-notice-banner');
            return container.length ? container[0] : notice.parent()[0];
        });
    }
    function prepareAutomaticContainer() {
        if (!window.brCartNoticeAutomatic || $(automaticSelector).length) {
            return;
        }
        var notices = noticeContainers($('.berocket_cart_notice').filter(function() {
            return !$(this).closest(shortcodeSelector).length;
        }));
        var container = $('<div class="woocommerce berocket_cart_notice_auto"></div>');
        if (notices.length) {
            container.insertBefore(notices.first()).append(notices);
        } else {
            // Use the existing WooCommerce notice location; never invent a builder placement.
            $('.woocommerce-notices-wrapper').first().append(container);
        }
    }

    function removeOldAutomaticNotices() {
        if (!$(automaticSelector).length) {
            return;
        }
        noticeContainers($('.berocket_cart_notice').filter(function() {
            return !$(this).closest(automaticSelector + ', ' + shortcodeSelector).length;
        })).remove();
    }

    prepareAutomaticContainer();
    $(document.body).on('added_to_cart removed_from_cart wc_fragments_refreshed wc_fragments_loaded', function() {
        prepareAutomaticContainer();
        removeOldAutomaticNotices();
    });
    // Coupons and quantity changes may replace the whole classic cart notice wrapper.
    $(document.body).on('updated_wc_div', prepareAutomaticContainer);
});
