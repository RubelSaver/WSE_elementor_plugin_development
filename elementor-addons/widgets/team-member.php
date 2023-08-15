<?php
class Wse_Team_Members_Addon extends \Elementor\Widget_Base {

	public function get_name() {
		return 'Rubel_team_members';
	}

	public function get_title() {
		return esc_html__( 'Team Members', 'elementor-addon' );
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
			'Rubel_addon_Title',
			[
				'label' => esc_html__( 'WSE Addon', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'WSE Team Members', 'elementor-addon' ),
			]
		);

		$this->add_control(
			'designation',
			[
				'label' => esc_html__( 'Designation', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Rubel Ahamed', 'elementor-addon' ),
			]
		);

		$this->add_control(
			'Hover-title',
			[
				'label' => esc_html__( 'Hover Title', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Hover', 'elementor-addon' ),
			]
		);

		$this->add_control(
			'Hover-Content',
			[
				'label' => esc_html__( 'Hover Content', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Hover Text', 'elementor-addon' ),
			]
		);

		$this->add_control(
			'Photo',
			[
				'label' => esc_html__( 'Photo', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'Social_Icons',
			[
				'label' => esc_html__( 'Social Icon', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'icon',
						'label' => esc_html__( 'Icon', 'elementor-addon' ),
						'type' => \Elementor\Controls_Manager::ICONS,
					],
					[
						'name' => 'link',
						'label' => esc_html__( 'Link', 'elementor-addon' ),
						'type' => \Elementor\Controls_Manager::URL,
					],

				],
			]
		);

		$this->add_control(
			'Style',
			[
				'label' => esc_html__( 'Style', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default'  => 'style1',
				'options'  => [
					'style1' => esc_html__( 'style 1', 'elementor-addon' ),
					'style2' => esc_html__( 'style 2', 'elementor-addon' ),
				],
			]
		);

	
		$this->end_controls_section();
		
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		
		<div class="wse-team-members wse-team-members-<?php echo $settings['Style'];?>">
			<?php 
			if (array_key_exists('Photo', $settings) && !empty($settings['Photo']['url'])): ?>

				<div class="wse-team-member-photo">
					<?php echo wp_get_attachment_image($settings['Photo']['id'], 'large'); ?>
				</div>
				<?php endif;?>

			<div class="wse-team-members-info">
					<h3><?php echo $settings['title'];?></h3>

					<?php
						if(array_key_exists('designation', $settings) && !empty($settings['designation'])): ?>
					<p><?php echo $settings['designation'];?></p>
					<?php endif;?>
			</div>
				<div class="team-member-hover">
						<div class="social-links">
							<?php foreach($settings['Social_Icons'] as $Icon):
								$is_external = $Icon['link']['is_external'] == '0' ? ' target = "_blank"' : '' ;
							?>
							<a href="<?php echo $Icon['link']['url']; ?>" target="<?php echo $is_external; ?>"><i class="<?php echo $Icon['icon']['value']; ?>"></i></a>
							<?php endforeach;?>
						</div>
						<div class="hover-text">
							<h3><?php echo $settings['Hover-title'];?></h3>
							<?php
								if(array_key_exists('Hover-Content', $settings) && !empty($settings['Hover-Content'])): ?>
							<p><?php echo $settings['Hover-Content'];?></p>
							<?php endif;?>
						</div>
				</div>
		</div>
	<?php
	}
}