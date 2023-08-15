<?php
class Wse_Elementor_Addon extends \Elementor\Widget_Base {

	public function get_name() {
		return 'Rubel_Hello_world';
	}

	public function get_title() {
		return esc_html__( 'Hello World', 'elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'hello', 'world' ];
	}

	protected function register_controls(){
		// Content Tab Start

		$this->start_controls_section(
			'Rubel_addon_Title',
			[
				'label' => esc_html__( 'Rubel_addon_Title', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Hello world Programer', 'elementor-addon' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<p><?php echo $settings['title']?></p>

		<?php
	}
}