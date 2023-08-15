<?php
class Wse_promo_box_Addon extends \Elementor\Widget_Base {

	public function get_name() {
		return 'Promo_Box';
	}

	public function get_title() {
		return esc_html__( 'Promo Box', 'elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	protected function register_controls(){
		// Content Tab Start

		$this->start_controls_section(
			'Promo_Box_addon_Title',
			[
				'label' => esc_html__( 'Promo Box', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'elementor-addon' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Sildenafil' , 'elementor-addon' ),
					'label_block' => true,
				]
			);

			$repeater->add_control(
				'sub_title',
				[
					'label' => esc_html__( 'Sub title', 'elementor-addon' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Erectile Dysfunction' , 'elementor-addon' ),
					'label_block' => true,
				]
			);

			$repeater->add_control(
				'Photo',
				[
					'label' => esc_html__( 'Photo', 'elementor-addon' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'label_block' => true,
				]
			);

			$repeater->add_control(
				'btn_text_1',
				[
					'label' => esc_html__( 'Buttion text 1', 'elementor-addon' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Start Visit' , 'elementor-addon' ),
					'show_label' => true,
				]
			);

			$repeater->add_control(
				'btn_Link_1',
				[
					'label' => esc_html__( 'Buttion Link 1', 'elementor-addon' ),
					'type' => \Elementor\Controls_Manager::URL,
					'show_label' => true,
				]
			);

			$repeater->add_control(
				'btn_text_2',
				[
					'label' => esc_html__( 'Buttion text 2', 'elementor-addon' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Startisit' , 'elementor-addon' ),
					'show_label' => true,
				]
			);

			$repeater->add_control(
				'btn_Link_2',
				[
					'label' => esc_html__( 'Buttion Link 2', 'elementor-addon' ),
					'type' => \Elementor\Controls_Manager::URL,
					'show_label' => true,
				]
			);

			$this->add_control(
				'boxes',
				[
					'label' => esc_html__( 'Promos', 'elementor-addon' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'title_field' => '{{{ title }}}',
				]
			);

			$this->add_control(
				'carousel',
				[
					'label' => esc_html__( 'Carousel', 'elementor-addon' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'no',
				]
			);
	

		$this->end_controls_section();
		
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		$html = '';

		if ($settings['carousel'] == 'yes') {
			$html .= '<script>
				jQuery(document).ready(function($){
					$(".promo-boxes").slick({
						slidesToShow: 5,
						dots: true,
						arrows: false,
						centerMode: true,
						autoplay: true,
					});
				});
			</script>';
		}

        $html .= '<div class="promo-boxes promo-boxes-'.$settings['carousel'].'">';

        foreach($settings['boxes'] as $box){

            $html .= '<div class="single-promo-boxes">';
            if(!empty($box['sub_title'])) {
                $html .= '<h4>'.$box['sub_title'].'</h4>';
            }
            if(!empty($box['title'])) {
                $html .= '<h3>'.$box['title'].'</h3>';
            }

			$html .= '<div class="promo-box-star">';
			$html .= '<i class="fa fa-star"></i>';
			$html .= '<i class="fa fa-star"></i>';
			$html .= '<i class="fa fa-star"></i>';
			$html .= '<i class="fa fa-star"></i>';
			$html .= '<i class="fa fa-star"></i>';
			$html .= '</div>';

			$html .= '<div class="single-promo-image">' 
			. wp_get_attachment_image($box['Photo']['id'], 'medium') . '</div>';


			if(!empty($box['btn_text_1'])) {
                $html .= '<div><a href="'.$box['btn_Link_1']['url'].'" class="single-promo-btn">'.$box['btn_text_1'].'</a></div>';
            }

			if(!empty($box['btn_text_2'])) {
                $html .= '<div><a href="'.$box['btn_Link_2']['url'].'" class="single-promo-btn2">'.$box['btn_text_2'].'</a></div>';
            }
            



            $html .='</div>';
        }

        $html .= '</div>';

        echo $html;

	
	}
}