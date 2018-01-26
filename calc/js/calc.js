jQuery(function ($) {
    $(document).ready(function () {
        $("#calc__texture").selectmenu({
            icons: {button: "ui-icon-caret-1-s"},
            width: 358,
            classes: {
                "ui-selectmenu-text": "calc__ui-selectmenu-text",
                "ui-selectmenu-button": "calc__ui-button",
                "ui-menu-item": "calc__ui-menu-item",
                "ui-widget-content": "calc__ui-widget-content"
            }
        });

        $("#calc__slider").slider({
            min: 0, max: 100, value: 20, range: "min",
            classes: {
                "ui-slider-horizontal": "calc__ui-slider-horizontal",
                "ui-slider-handle": "calc__ui-slider-handle",
                "ui-slider-range": "calc__ui-slider-range"
            }
        });
    });
});
