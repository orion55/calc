jQuery(document).ready(function ($) {
    $(document).ready(function () {
        var area = $('#calc__area-num');
        var money = $('#calc__rub');
        var pipe = $('#calc__pipe');
        var lamp = $('#calc__lamp');
        var slider = $("#calc__slider");
        var texture = $("#calc__texture");

        var texture_cur = window.wp_data.price_texture[0];

        texture.selectmenu({
            icons: {button: "ui-icon-caret-1-s"},
            width: $('.calc__head').width() * 0.98,
            change: function (event, data) {
                texture_cur = window.wp_data.price_texture[data.item.index];
                calculate();
            }
        });

        slider.slider({
            min: 0, max: 100, value: 20, range: "min",
            change: function (event, ui) {
                area.text(ui.value);
                calculate();
            }
        });

        pipe.change(function () {
            calculate();
        });

        lamp.change(function () {
            calculate();
        });

        var calculate = function () {
            var sum = 0;

            sum += (parseInt(area.text()) || 0) * texture_cur;
            sum += (parseInt(pipe.val()) || 0) * window.wp_data.price_pipes;
            sum += (parseInt(lamp.val()) || 0) * window.wp_data.price_lamps;

            money.text(sum);
        };

        calculate();
    });
});
