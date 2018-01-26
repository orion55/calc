<?php
/**
 * Generated by the WordPress Option Page generator
 * at http://jeremyhixon.com/wp-tools/option-page/
 */

class Calculator {
	private $calculator_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'calculator_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'calculator_page_init' ) );
	}

	public function calculator_add_plugin_page() {
		add_options_page(
			'Calculator', // page_title
			'Calculator', // menu_title
			'manage_options', // capability
			'calculator', // menu_slug
			array( $this, 'calculator_create_admin_page' ) // function
		);
	}

	public function calculator_create_admin_page() {
		$this->calculator_options = get_option( 'calculator_option_name' ); ?>

        <div class="wrap">
            <h2>Calculator</h2>
            <p>Calculator</p>
			<?php settings_errors(); ?>

            <form method="post" action="options.php">
				<?php
				settings_fields( 'calculator_option_group' );
				do_settings_sections( 'calculator-admin' );
				submit_button();
				?>
            </form>
        </div>
	<?php }

	public function calculator_page_init() {
		register_setting(
			'calculator_option_group', // option_group
			'calculator_option_name', // option_name
			array( $this, 'calculator_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'calculator_setting_section', // id
			'Settings', // title
			array( $this, 'calculator_section_info' ), // callback
			'calculator-admin' // page
		);

		add_settings_field(
			'___2_0', // id
			'Фактура матовая (руб.\\м2)', // title
			array( $this, '___2_0_callback' ), // callback
			'calculator-admin', // page
			'calculator_setting_section' // section
		);

		add_settings_field(
			'___2_1', // id
			'Фактура глянцевая (руб.\\м2)', // title
			array( $this, '___2_1_callback' ), // callback
			'calculator-admin', // page
			'calculator_setting_section' // section
		);

		add_settings_field(
			'___2_2', // id
			'Фактура сатиновая (руб.\\м2)', // title
			array( $this, '___2_2_callback' ), // callback
			'calculator-admin', // page
			'calculator_setting_section' // section
		);

		add_settings_field(
			'____3', // id
			'Цена труб (руб\\шт.)', // title
			array( $this, '____3_callback' ), // callback
			'calculator-admin', // page
			'calculator_setting_section' // section
		);

		add_settings_field(
			'_____4', // id
			'Цена осветительных приборов (руб\\шт.)', // title
			array( $this, '_____4_callback' ), // callback
			'calculator-admin', // page
			'calculator_setting_section' // section
		);
	}

	public function calculator_sanitize( $input ) {
		$sanitary_values = array();
		if ( isset( $input['___2_0'] ) ) {
			$sanitary_values['___2_0'] = sanitize_text_field( $input['___2_0'] );
		}

		if ( isset( $input['___2_1'] ) ) {
			$sanitary_values['___2_1'] = sanitize_text_field( $input['___2_1'] );
		}

		if ( isset( $input['___2_2'] ) ) {
			$sanitary_values['___2_2'] = sanitize_text_field( $input['___2_2'] );
		}

		if ( isset( $input['____3'] ) ) {
			$sanitary_values['____3'] = sanitize_text_field( $input['____3'] );
		}

		if ( isset( $input['_____4'] ) ) {
			$sanitary_values['_____4'] = sanitize_text_field( $input['_____4'] );
		}

		return $sanitary_values;
	}

	public function calculator_section_info() {

	}

	public function ___2_0_callback() {
		printf(
			'<input class="regular-text" type="text" name="calculator_option_name[___2_0]" id="___2_0" value="%s">',
			isset( $this->calculator_options['___2_0'] ) ? esc_attr( $this->calculator_options['___2_0'] ) : ''
		);
	}

	public function ___2_1_callback() {
		printf(
			'<input class="regular-text" type="text" name="calculator_option_name[___2_1]" id="___2_1" value="%s">',
			isset( $this->calculator_options['___2_1'] ) ? esc_attr( $this->calculator_options['___2_1'] ) : ''
		);
	}

	public function ___2_2_callback() {
		printf(
			'<input class="regular-text" type="text" name="calculator_option_name[___2_2]" id="___2_2" value="%s">',
			isset( $this->calculator_options['___2_2'] ) ? esc_attr( $this->calculator_options['___2_2'] ) : ''
		);
	}

	public function ____3_callback() {
		printf(
			'<input class="regular-text" type="text" name="calculator_option_name[____3]" id="____3" value="%s">',
			isset( $this->calculator_options['____3'] ) ? esc_attr( $this->calculator_options['____3'] ) : ''
		);
	}

	public function _____4_callback() {
		printf(
			'<input class="regular-text" type="text" name="calculator_option_name[_____4]" id="_____4" value="%s">',
			isset( $this->calculator_options['_____4'] ) ? esc_attr( $this->calculator_options['_____4'] ) : ''
		);
	}

}

if ( is_admin() ) {
	$calculator = new Calculator();
}

/*
 * Retrieve this value with:
 * $calculator_options = get_option( 'calculator_option_name' ); // Array of All Options
 * $___2_0 = $calculator_options['___2_0']; // Фактура матовая (руб.\\м2)
 * $___2_1 = $calculator_options['___2_1']; // Фактура глянцевая (руб.\\м2)
 * $___2_2 = $calculator_options['___2_2']; // Фактура сатиновая (руб.\\м2)
 * $____3 = $calculator_options['____3']; // Цена труб (руб\\шт.)
 * $_____4 = $calculator_options['_____4']; // Цена осветительных приборов (руб\\шт.)
 */

class calculator_shortcode {
	static $add_script;

	static function init() {
		add_shortcode( 'calculator', array( __CLASS__, 'calculator_func' ) );
		add_action( 'init', array( __CLASS__, 'register_script' ) );
		add_action( 'wp_footer', array( __CLASS__, 'js_variables' ) );
		add_action( 'wp_footer', array( __CLASS__, 'print_script' ) );
	}

	static function calculator_func( $atts ) {
		self::$add_script = true;
		$html             = '<div class="calc" id="calc">
        <div class="calc__box">
            <div class="calc__row calc__row--one">
                <div class="calc__section">
                    <h2 class="calc__head">Калькулятор<br/>Натяжных Потолков</h2>
                    <label for="calc__texture" class="calc__label">Выберите фактуру потолка</label>
                    <select name="calc__texture" id="calc__texture">
                        <option value="matt" selected data-option="1">Мат</option>
                        <option value="glossy" data-option="2">Глянец</option>
                        <option value="satin" data-option="3">Сатин</option>
                    </select>
                </div>
                <div class="calc__section">
                    <div class="calc__picture">
                        <img src="' . get_template_directory_uri() . '/calc/img/calc.jpg' . '" alt="calc__image" class="calc__image">
                    </div>
                </div>
            </div>
            <div class="calc__row calc__row--two">
                <div class="calc__slider-widget">
                    <div class="calc__text">Площадь потолков</div>
                    <div id="calc__slider" class="calc__slider">
                        <div class="calc__slider-number calc__slider-number--min">
                            <div class="calc__slider-block">
                                <div class="calc__delimiter"></div>
                                <div class="calc__slider-numeral--min">0</div>
                            </div>
                        </div>
                        <div class="calc__slider-number calc__slider-number--max">
                            <div class="calc__slider-block">
                                <div class="calc__delimiter calc__delimiter--max"></div>
                                <div class="calc__slider-numeral--max">100</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="calc__row calc__row--three">
                <div class="calc__pipe">
                    <label class="calc__label calc__pipe--label" for="calc__pipe" data-id="2">Количество труб</label>
                    <input class="calc__number" id="calc__pipe" type="number" name="calc__pipe" value="2" data-id="1"
                           min="0">
                </div>
                <div class="calc__lamp">
                    <label class="calc__label calc__lamp--label" for="calc__lamp" data-id="2">Количество осветительных
                        приборов</label>
                    <input class="calc__number" id="calc__lamp" type="number" name="calc__lamp" value="2" data-id="2"
                           min="0">
                </div>
            </div>
        </div>
        <div class="calc__total">
            <div class="calc__intotal">Примерная стоимость</div>
            <div class="calc__money">
                <div class="calc__rub" id="calc__rub">1111</div>
                <div class="calc__rubname">руб.</div>
            </div>
        </div>
    </div>';

		return $html;
	}

	static function register_script() {
		wp_register_script( 'calc-js', get_template_directory_uri() . '/calc/js/calc.js', array( 'jquery' ), time(), true );
		wp_register_style( 'calc', get_template_directory_uri() . '/calc/css/style_calc.css', array(), time(), 'all' );
	}

	static function print_script() {
		if ( ! self::$add_script ) {
			return;
		}
		wp_print_scripts( 'calc-js' );
		wp_enqueue_style( 'calc' );
	}

	static function js_variables() {
		if ( ! self::$add_script ) {
			return;
		}
		/*$img_url            = get_template_directory_uri() . '/calc/img';
		$calculator_options = get_option( 'calculator_option_name' ); // Array of All Options
		$_____2_0           = $calculator_options['_____2_0']; //  Цена площадь потолка (руб.\\м2)
		$____1              = $calculator_options['____1']; // Цена углов (руб.\\шт.)
		$_____2             = $calculator_options['_____2']; // Цена светильников / люстр (руб.\\шт.)
		$____3              = $calculator_options['____3']; // Цена труб (руб.\\шт.)
		$__4                = $calculator_options['__4']; // Фактура глянцевая
		$__5                = $calculator_options['__5']; // Фактура матовая
		$__6                = $calculator_options['__6']; // Фактура сатиновая
		$__7                = $calculator_options['__7']; // Фактура тканевая*/

		$variables = array(
//			'price_area'    => $_____2_0,
//			'price_corners' => $____1,
//			'price_lamps'   => $_____2,
//			'price_pipes'   => $____3,
//			'price_texture' => array( $__4, $__5, $__6, $__7 ),
		);
		echo( '<script type="text/javascript">window.wp_data=' . json_encode( $variables ) . ';</script>' );
	}
}

calculator_shortcode::init();