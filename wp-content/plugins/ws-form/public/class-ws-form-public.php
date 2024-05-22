<?php

	#[AllowDynamicProperties]
	class WS_Form_Public {

		// The ID of this plugin.
		private $plugin_name;

		// The version of this plugin.
		private $version;

		// Customizer
		private $customizer;

		// Conversational
		private $conversational = false;

		// CSS inline
		private $css_inline;

		// Form index (Incremented for each rendered with a shortcode)
		public $form_instance = 1;

		// Error index
		public $error_index = 0;

		// Debug
		public $debug = false;

		// JSON
		public $wsf_form_json = array();

		// Footer JS
		public $footer_js = '';

		// Deregister scripts
		private $deregister_scripts = array();

		// Is ACF activated?
		public $acf_activated;

		// CSS
		public $ws_form_css;

		// Enqueuing
		public $enqueue_css_layout = false;
		public $enqueue_css_skin = false;
		public $enqueue_css_debug = false;
		public $enqueue_css_conversational = false;
		public $enqueue_css_loader = false;
		public $enqueue_css_custom = false;

		public $enqueue_js_form_common = false;
		public $enqueue_js_form_public = false;
		public $enqueue_js_form_debug = false;
		public $enqueue_js_form_conversational = false;
		public $enqueue_js_wp_media = false;
		public $enqueue_js_wp_editor = false;
		public $enqueue_js_wp_html_editor = false;
		public $enqueue_js_input_mask = false;
		public $enqueue_js_sortable = false;
		public $enqueue_js_signature_pad = false;
		public $enqueue_js_datetime_picker = false;
		public $enqueue_js_color_picker = false;
		public $enqueue_js_password_strength = false;
		public $enqueue_js_select2 = false;
		public $enqueue_js_dropzonejs = false;
		public $enqueue_js_intl_tel_input = false;

		public $enqueue_js_analytics = false;
		public $enqueue_js_calc = false;
		public $enqueue_js_captcha = false;
		public $enqueue_js_cascade = false;
		public $enqueue_js_checkbox = false;
		public $enqueue_js_color = false;
		public $enqueue_js_conditional = false;
		public $enqueue_js_conversational = false;
		public $enqueue_js_date = false;
		public $enqueue_js_date_translate = false;
		public $enqueue_js_ecommerce = false;
		public $enqueue_js_file = false;
		public $enqueue_js_geo = false;
		public $enqueue_js_google_map = false;
		public $enqueue_js_google_address = false;
		public $enqueue_js_google_route = false;
		public $enqueue_js_legal = false;
		public $enqueue_js_loader = false;
		public $enqueue_js_password = false;
		public $enqueue_js_progress = false;
		public $enqueue_js_radio = false;
		public $enqueue_js_rating = false;
		public $enqueue_js_section_repeatable = false;
		public $enqueue_js_select = false;
		public $enqueue_js_signature = false;
		public $enqueue_js_tab = false;
		public $enqueue_js_tel = false;
		public $enqueue_js_textarea = false;
		public $enqueue_js_tracking = false;

		public $enqueue_js_custom = false;

		// Enqueued
		public $enqueued_css_layout = false;
		public $enqueued_css_skin = false;
		public $enqueued_css_debug = false;
		public $enqueued_css_conversational = false;
		public $enqueued_css_loader = false;
		public $enqueued_css_custom = false;

		public $enqueued_js_form_common = false;
		public $enqueued_js_form_public = false;
		public $enqueued_js_form_debug = false;
		public $enqueued_js_form_conversational = false;
		public $enqueued_js_wp_media = false;
		public $enqueued_js_wp_editor = false;
		public $enqueued_js_wp_html_editor = false;
		public $enqueued_js_input_mask = false;
		public $enqueued_js_sortable = false;
		public $enqueued_js_signature_pad = false;
		public $enqueued_js_datetime_picker = false;
		public $enqueued_js_color_picker = false;
		public $enqueued_js_password_strength = false;
		public $enqueued_js_select2 = false;
		public $enqueued_js_dropzonejs = false;
		public $enqueued_js_intl_tel_input = false;

		public $enqueued_js_analytics = false;
		public $enqueued_js_calc = false;
		public $enqueued_js_captcha = false;
		public $enqueued_js_cascade = false;
		public $enqueued_js_checkbox = false;
		public $enqueued_js_color = false;
		public $enqueued_js_conditional = false;
		public $enqueued_js_conversational = false;
		public $enqueued_js_date = false;
		public $enqueued_js_date_translate = false;
		public $enqueued_js_ecommerce = false;
		public $enqueued_js_file = false;
		public $enqueued_js_geo = false;
		public $enqueued_js_google_map = false;
		public $enqueued_js_google_address = false;
		public $enqueued_js_google_route = false;
		public $enqueued_js_legal = false;
		public $enqueued_js_loader = false;
		public $enqueued_js_password = false;
		public $enqueued_js_progress = false;
		public $enqueued_js_radio = false;
		public $enqueued_js_rating = false;
		public $enqueued_js_section_repeatable = false;
		public $enqueued_js_select = false;
		public $enqueued_js_signature = false;
		public $enqueued_js_tab = false;
		public $enqueued_js_tel = false;
		public $enqueued_js_textarea = false;
		public $enqueued_js_tracking = false;

		public $enqueued_js_custom = false;

		public $enqueued_all = false;
		public $enqueued_visual_builder = false;
		public $enqueued_core = false;

		// Public dependencies
		public $public_dependencies;

		// Config filtering
		public $field_types = array();

		// Initialize the class and set its properties.
		public function __construct() {

			$this->plugin_name = WS_FORM_NAME;
			$this->version = WS_FORM_VERSION;
			$this->customizer = (WS_Form_Common::get_query_var('customize_theme') !== '');
			$this->css_inline = (WS_Form_Common::option_get('css_inline'));
			$this->acf_activated = class_exists('ACF');
			$this->ws_form_css = new WS_Form_CSS();
			$this->ws_form_css->init();
			$this->public_dependencies = array($this->plugin_name . '-form-common');

			add_action('wsf_enqueue_all', array($this, 'enqueue_all'), 10, 0);
			add_action('wsf_enqueue_visual_builder', array($this, 'enqueue_visual_builder'), 10, 0);
			add_action('wsf_enqueue_core', array($this, 'enqueue_core'), 10, 0);

			// Dynamic enqueuing
			if(!WS_Form_Common::option_get('enqueue_dynamic', true)) {

				add_action('wp_enqueue_scripts', function() {

					do_action('wsf_enqueue_all');

				}, 10, 0);
			}
		}

		public function enqueue_core() {

			if(!$this->enqueued_core) {

				// Set filters to true
				add_filter('wsf_enqueue_css_layout', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_css_skin', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_form_common', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_form_public', function($enqueue) { return true; }, 99999, 1);

				// Custom
				add_filter('wsf_enqueue_css_custom', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_custom', function($enqueue) { return true; }, 99999, 1);

				// Process enqueues
				self::enqueue();

				$this->enqueued_core = true;
			}
		}

		public function enqueue_visual_builder() {

			if(!$this->enqueued_visual_builder) {

				// Core
				add_filter('wsf_enqueue_css_layout', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_css_skin', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_form_common', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_form_public', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_sortable', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_select2', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_input_mask', function($enqueue) { return true; }, 99999, 1);

				// Disable debug
				add_filter('wsf_enqueue_js_form_debug', function($enqueue) { return false; }, 99999, 1);

				// Field types
				add_filter('wsf_enqueue_js_captcha', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_checkbox', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_select', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_radio', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_tab', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_tel', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_intl_tel_input', function($enqueue) { return true; }, 99999, 1);
				// Custom
				add_filter('wsf_enqueue_css_custom', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_custom', function($enqueue) { return true; }, 99999, 1);

				// Process enqueues
				self::enqueue();

				$this->enqueued_visual_builder = true;
			}
		}

		public function enqueue_all() {

			if(!$this->enqueued_all) {

				// Core
				add_filter('wsf_enqueue_css_layout', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_css_skin', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_form_common', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_form_public', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_sortable', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_select2', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_input_mask', function($enqueue) { return true; }, 99999, 1);

				// Field types
				add_filter('wsf_enqueue_js_captcha', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_checkbox', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_radio', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_select', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_tab', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_tel', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_intl_tel_input', function($enqueue) { return true; }, 99999, 1);
				// Custom
				add_filter('wsf_enqueue_css_custom', function($enqueue) { return true; }, 99999, 1);
				add_filter('wsf_enqueue_js_custom', function($enqueue) { return true; }, 99999, 1);

				// Process enqueues
				self::enqueue();

				$this->enqueued_all = true;
			}
		}

		public function init() {

			// Preview engine
			new WS_Form_Preview();

		}

		public function wp() {

			// Get post
			global $post;
			$GLOBALS['ws_form_post_root'] = isset($post) ? $post : null;
		}

		// Shortcode: ws_form
		public function shortcode_ws_form($atts, $content = null) {

			// Form ID
			$form_id = isset($atts['id']) ? absint($atts['id']) : false;

			// Element
			$element = isset($atts['element']) ? $atts['element'] : 'form';

			// Element ID
			$element_id = isset($atts['element_id']) ? $atts['element_id'] : false;

			// Class
			$class = isset($atts['class']) ? $atts['class'] : false;

			// Published?
			$published = isset($atts['published']) ? ($atts['published'] == 'true') : true;

			// Preview?
			$preview = isset($atts['preview']) ? ($atts['preview'] == 'true') : false;


			// Form HTML?
			$form_html = isset($atts['form_html']) ? ($atts['form_html'] == 'true') : true;

			// Visual builder?
			$visual_builder = isset($atts['visual_builder']) ? ($atts['visual_builder'] == 'true') : false;

			// Query string overrides
			if(WS_Form_Common::get_query_var('wsf_published') === 'false') { $published = false; }

			// Check for preview mode
			if($preview) {

				// Reset form instance (This is required to ensure wp_head calls resulting in do_shortcode('ws-form') don't stack up on each other)
				if(isset($this->wsf_form_json[$form_id])) { unset($this->wsf_form_json[$form_id]); }
				$this->form_instance = 1;
			}

			// Template ID
			$form_object = false;
			$template_id = isset($atts['template_id']) ? $atts['template_id'] : false;
			if($template_id !== false) {
				
				$ws_form_template = new WS_Form_Template();
				$ws_form_template->id = $template_id;
				
				try {
					
					$ws_form_template->read();
					$form_object = $ws_form_template->form_object;

					// Change meta data
					$form_object->meta->class_form_wrapper = 'wsf-demo';
					$form_object->meta->label_render = '';
					$form_object->meta->form_action = '#';

					$published = false;

				} catch (Exception $e) {}
			}

			// Visual builder
			if($visual_builder) {

				$published = false;
			}

			if(
				(($form_id > 0) && ($form_object === false)) ||
				(($form_id === false) && ($form_object !== false))
			) {

				$ws_form_form = New WS_Form_Form();

				if($form_id > 0) {

					// Embed form data (Avoids an API call)
					$ws_form_form->id = $form_id;

					try {

						if($published) {

							$form_object = $ws_form_form->db_read_published(true);

						} else {

							$form_object = $ws_form_form->db_read(true, true, false, true);
						}

					} catch(Exception $e) { return $e->getMessage(); }
				}

				if($form_object !== false) {

					// Filter
					$form_object = apply_filters('wsf_pre_render_' . $form_id, $form_object, $preview);
					$form_object = apply_filters('wsf_pre_render', $form_object, $preview);

					// Pre-process form data
					self::form_pre_process($form_object);

					// Change form so it is public ready
					$ws_form_form->form_public($form_object);
				}

				// Get form HTML
				$return_value = ($form_html ? self::form_html($this->form_instance++, $form_object, $element, $published, $preview, $element_id, $visual_builder, $class) : '');

				$return_value = apply_filters('wsf_shortcode', $return_value, $atts, $content);

				return $return_value;

			} else {

				// Error
				return __('Invalid form ID', 'ws-form');
			}
		}

		// Footer scripts
		public function wp_footer() {

			// If no forms enqueued, skip this
			if(count($this->wsf_form_json) == 0) { return; };

			// If visual builder enqueued, do not filter field types
			if($this->enqueued_visual_builder) { $this->field_types = array(); }

			// Field type filtering
			if(count($this->field_types) > 0) { $this->field_types = array_unique($this->field_types); }

			echo "\n<script id=\"wsf-wp-footer\">\n/* <![CDATA[ */\n";	// phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped

			// Embed config data (Avoids an API call)
			$json_config = wp_json_encode(WS_Form_Config::get_config(false, $this->field_types));
			echo sprintf("window.wsf_form_json_config = %s;\n", $json_config);	// phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
			$json_config = null;

			// Init form data
			echo "window.wsf_form_json = [];\n";	// phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
			echo "window.wsf_form_json_populate = [];\n";	// phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped

			// Footer JS
			echo $this->footer_js;	// phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
			$this->footer_js = null;

			echo "/* ]]> */\n</script>\n\n";	// phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
		}

		// Footer scripts - Pre-Process
		public function form_pre_process(&$form_object) {

			// If REST request, abandon this
			if(WS_Form_Common::is_rest_request()) { return; }

			// Enqueue WS Form
			$this->enqueue_js_form_common = true;
			$this->enqueue_js_form_public = true;
			$this->enqueue_css_layout = true;
			$this->enqueue_css_skin = true;

			// Enqueue custom
			$this->enqueue_js_custom = true;
			$this->enqueue_css_custom = true;

			// Apply restrictions
			$ws_form_form = new WS_Form_Form();
			$ws_form_form->apply_restrictions($form_object);

			// Field types
			$field_types = WS_Form_Config::get_field_types_flat();

 			// Determine enqueues
			$groups = isset($form_object->groups) ? $form_object->groups : array();

			// Enqueue tabs
			if(count($groups) > 1) {

				$this->enqueue_js_tab = true;
			}

			foreach($groups as $group_key => $group) {

				$sections = isset($group->sections) ? $group->sections : array();

				foreach($sections as $section_key => $section) {

					// Enqueue section repeatable
					if(WS_Form_Common::get_object_meta_value($section, 'section_repeatable') === 'on') {

						$this->enqueue_js_section_repeatable = true;
					}

					$fields = isset($section->fields) ? $section->fields : array();

					// Process fields
					foreach($fields as $field_key => $field) {

						// Get field type
						if(!isset($field->type)) { continue; }
						$field_type = $field->type;

						// Check field type
						if(!isset($field_types[$field_type])) { continue; }

						// Add field type to array (This is used later on to filter the field configs rendered on the page)
						$this->field_types[] = $field_type;

						// Check to see if an input_mask is set
						if(!$this->enqueue_js_input_mask) {

							$input_mask = WS_Form_Common::get_object_meta_value($field, 'input_mask', '');
							if($input_mask !== '') { $this->enqueue_js_input_mask = true; }

						}

						// Check by field type
						switch($field_type) {

							// Select, checkbox and radios
							case 'select' :
							case 'checkbox' :
							case 'radio' :
								$data_grid_clear = false;

								$cascade = (WS_Form_Common::get_object_meta_value($field, sprintf('%s_cascade', $field_type), '') === 'on');

								// Cascade
								if($cascade) {

									$cascade_ajax = (WS_Form_Common::get_object_meta_value($field, sprintf('%s_cascade_ajax', $field_type), '') === 'on');

									if($cascade_ajax) {

										$data_grid_clear = true;
									}

									// Enqueue cascade
									$this->enqueue_js_cascade = true;
								}

								switch($field_type) {

									// Select
									case 'select' :
									case 'price_select' :

										// E-commerce
										if($field_type === 'price_select') {

											$this->enqueue_js_ecommerce = true;
										}

										// Select2 AJAX
										$select2 = (WS_Form_Common::get_object_meta_value($field, 'select2', '') === 'on');

										if(
											$select2 ||
											WS_Form_Common::get_object_meta_value($field, 'select_min', '') ||
											WS_Form_Common::get_object_meta_value($field, 'select_max', '')
										) {
											$this->enqueue_js_select = true;
										}

										if($select2) {

											if(!$cascade && WS_Form_Common::get_object_meta_value($field, 'select2_ajax', '')) {

												$data_grid_clear = true;
											}

											// Enqueue select
											$this->enqueue_js_select2 = true;
										}

										break;

									// Checkbox
									case 'checkbox' :
									case 'price_checkbox' :

										// E-commerce
										if($field_type === 'price_checkbox') {

											$this->enqueue_js_ecommerce = true;
										}

										if(
											WS_Form_Common::get_object_meta_value($field, 'select_all', '') ||
											WS_Form_Common::get_object_meta_value($field, 'checkbox_min', '') ||
											WS_Form_Common::get_object_meta_value($field, 'checkbox_max', '')
										) {

											$this->enqueue_js_checkbox = true;
										}

										break;

									// Radio
									case 'radio' :
									case 'price_radio' :

										$this->enqueue_js_radio = true;

										if($field_type === 'price_radio') {

											$this->enqueue_js_ecommerce = true;
										}

										break;
								}

								if($data_grid_clear) {

									// Get data grid meta key
									$field_type = $field->type;

									switch($field_type) {

										case 'select' :

											$data_grid_meta_key = 'data_grid_select';
											break;

										case 'price_select' :

											$data_grid_meta_key = 'data_grid_select_price';
											break;

										case 'checkbox' :

											$data_grid_meta_key = 'data_grid_checkbox';
											break;

										case 'price_checkbox' :

											$data_grid_meta_key = 'data_grid_checkbox_price';
											break;

										case 'radio' :

											$data_grid_meta_key = 'data_grid_radio';
											break;

										case 'price_radio' :

											$data_grid_meta_key = 'data_grid_radio_price';
											break;
									}

									// Clear group data
									if(
										isset($field->meta->{$data_grid_meta_key}->groups) &&
										is_array($field->meta->{$data_grid_meta_key}->groups) &&
										isset($field->meta->{$data_grid_meta_key}->groups[0])
									) {
										if(isset($field->meta->{$data_grid_meta_key}->groups[0]->rows)) {

											$field->meta->{$data_grid_meta_key}->groups[0]->rows = array();
										}

										$group_index = 1;

										while(isset($field->meta->{$data_grid_meta_key}->groups[$group_index])) {

											unset($field->meta->{$data_grid_meta_key}->groups[$group_index++]);
										}
									}
								}

								break;

							// Telephone
							case 'tel' :

								$intl_tel_input = WS_Form_Common::get_object_meta_value($field, 'intl_tel_input', '');
								if($intl_tel_input) {

									$this->enqueue_js_intl_tel_input = true;
									$this->enqueue_js_tel = true;

									$intl_tel_input_initial_country = WS_Form_Common::get_object_meta_value($field, 'intl_tel_input_initial_country', '');
									if($intl_tel_input_initial_country) {

										$this->enqueue_js_geo = true;
									}
								}

								break;

							// Text Area
							case 'textarea' :

								// Check to see if a textarea field is using wp_editor or wp_html_editor
								$input_type_textarea = WS_Form_Common::get_object_meta_value($field, 'input_type_textarea', '');
								if($input_type_textarea == 'tinymce') { $this->enqueue_js_wp_editor = true; }
								if($input_type_textarea == 'html') { $this->enqueue_js_wp_html_editor = true; }
								if($input_type_textarea != '') { $this->enqueue_js_textarea = true; }

								// Check to see if the media library should be enqueued
								if(
									WS_Form_Common::can_user('upload_files') &&
									(WS_Form_Common::get_object_meta_value($field, 'visual_editor_media', '') == 'on')
								) {

									$this->enqueue_js_wp_media = true;
								}

								break;

							// Captcha
							case 'recaptcha' :
							case 'hcaptcha' :
							case 'turnstile' :

								$this->enqueue_js_captcha = true;
						}

						do_action('wsf_form_pre_process_field', $field);

						$field = null;
					}
				}
			}

			self::enqueue();
		}

		// Enqueue
		public function enqueue() {

			if(apply_filters('wsf_public_enqueue', true)) {

				if(apply_filters('wsf_public_enqueue_external', true)) {

					self::enqueue_external();
				}

				if(apply_filters('wsf_public_enqueue_internal', true)) {

					self::enqueue_internal();
				}
			}

			do_action('wsf_enqueue');
		}

		// Enqueue - External
		public function enqueue_external() {

			// Get enqueue args
			$enqueue_args = WS_Form_Common::get_enqueue_args();

			// External scripts
			$external = WS_Form_Config::get_external();

			// Base dependencies
			$dependencies_base = apply_filters('wsf_enqueue_js_dependencies', array('jquery'));

			// JS - Input Mask - 5.0.3
			if(!$this->enqueued_js_input_mask && apply_filters('wsf_enqueue_js_input_mask', $this->enqueue_js_input_mask)) {

				// External - Input Mask Bundle
				$dependencies = apply_filters('wsf_enqueue_js_input_mask_dependencies', $dependencies_base);
				wp_enqueue_script($this->plugin_name . '-external-inputmask', $external['inputmask_js']['js'], $dependencies, $external['inputmask_js']['version'], $enqueue_args);
				$this->enqueued_js_input_mask = true;
			}

			// JS - International telephone input - Version 17.0.13
			if(!$this->enqueued_js_intl_tel_input && apply_filters('wsf_enqueue_js_intl_tel_input', $this->enqueue_js_intl_tel_input)) {

				// External - International telephone input - JS
				$dependencies = apply_filters('wsf_enqueue_js_intl_tel_input_dependencies', $dependencies_base);
				wp_enqueue_script($this->plugin_name . '-external-intl-tel-input', $external['intl_tel_input_js']['js'], $dependencies, $external['intl_tel_input_js']['version'], $enqueue_args);

				// External - International telephone input - CSS
				wp_enqueue_style($this->plugin_name . '-external-intl-tel-input', $external['intl_tel_input_css']['js'], array(), $external['intl_tel_input_css']['version'], 'all');

				$this->enqueued_js_intl_tel_input = true;
			}
			// If a textarea exists in a form that requires wp_editor or wp_code_editor, enqueue the scripts
			global $wp_version;

			// WP Editor
			if(
				!$this->enqueued_js_wp_editor && 
				apply_filters('wsf_enqueue_js_wp_editor', $this->enqueue_js_wp_editor) &&
				(WS_Form_Common::version_compare($wp_version, '4.8') >= 0) &&
				user_can_richedit()
			) {

				// Media for 'Add Media' button
				if(
					!$this->enqueued_js_wp_editor && 
					apply_filters('wsf_enqueue_js_wp_media', $this->enqueue_js_wp_media) &&
					WS_Form_Common::can_user('upload_files')
				) {

					wp_enqueue_media();

					$this->enqueued_js_wp_media = true;
				}

				wp_enqueue_editor();

				$this->enqueued_js_wp_editor = true;
			}

			// WP HTML Editor
			if(
				!$this->enqueued_js_wp_html_editor && 
				apply_filters('wsf_enqueue_js_wp_html_editor', $this->enqueue_js_wp_html_editor) &&
				(WS_Form_Common::version_compare($wp_version, '4.9') >= 0) &&
				(!is_user_logged_in() || (wp_get_current_user()->syntax_highlighting))
			) {

				wp_enqueue_code_editor(array('type' => 'text/html'));

				$this->enqueued_js_wp_html_editor = true;
			}

			do_action('wsf_enqueue_external');
		}

		// Enqueue - Internal
		public function enqueue_internal() {

			// Minified scripts?
			$min = SCRIPT_DEBUG ? '' : '.min';

			// RTL?
			$rtl = is_rtl() ? '.rtl' : '';

			// Get enqueue args
			$enqueue_args = WS_Form_Common::get_enqueue_args();

			// Base dependencies
			$dependencies_base = apply_filters('wsf_enqueue_js_dependencies', array('jquery'));

			// Get uploads base directory and ensure paths are https (Known bug with wp_upload_dir)
			$upload_dir_base_url = WS_Form_Common::get_upload_dir_base_url();

			// JS - Common
			if(!$this->enqueued_js_form_common && apply_filters('wsf_enqueue_js_form_common', $this->enqueue_js_form_common)) {

				// Enqueued scripts settings
				$ws_form_settings = self::localization_object($this->debug);

				// WS Form script - Common
				$dependencies = apply_filters('wsf_enqueue_js_form_common_dependencies', $dependencies_base);
				wp_register_script($this->plugin_name . '-form-common', sprintf('%sshared/js/ws-form%s.js', WS_FORM_PLUGIN_DIR_URL, $min), $dependencies, $this->version, $enqueue_args);
				wp_localize_script($this->plugin_name . '-form-common', 'ws_form_settings', $ws_form_settings);
				wp_enqueue_script($this->plugin_name . '-form-common');

				$this->enqueued_js_form_common = true;
			}

			// JS - Analytics
			self::enqueue_internal_do('public-analytics', 'common', 'analytics', 'analytics');

			// JS - Captcha
			self::enqueue_internal_do('public-captcha', 'common', 'captcha', 'captcha');

			// JS - Cascade
			self::enqueue_internal_do('public-cascade', 'common', 'cascade', 'cascade');

			// JS - Checkbox
			self::enqueue_internal_do('public-checkbox', 'common', 'checkbox', 'checkbox');

			// JS - Radio
			self::enqueue_internal_do('public-radio', 'common', 'radio', 'radio');

			// JS - Select
			self::enqueue_internal_do('public-select', 'common', 'select', 'select');

			// JS - Tab
			self::enqueue_internal_do('public-tab', 'common', 'tab', 'tab');

			// JS - Tab
			self::enqueue_internal_do('public-tel', 'common', 'tel', 'tel');

			// JS - Tab
			self::enqueue_internal_do('public-textarea', 'common', 'textarea', 'textarea');

			// JS - Tracking
			self::enqueue_internal_do('public-tracking', 'common', 'tracking', 'tracking');

			// JS - Public
			self::enqueue_internal_do('public', true, 'form-public', 'form_public');
			// CSS - Layout
			if(!$this->enqueued_css_layout && apply_filters('wsf_enqueue_css_layout', $this->enqueue_css_layout)) {

				if(WS_Form_Common::is_block_editor()) {

					// If we are in the block editor, we enqueue the layout CSS using WS Form framework
					wp_enqueue_style($this->plugin_name . '-layout', WS_Form_Common::get_api_path('helper/ws-form-css?wsf_block_editor=true'), array(), $this->version, 'all');

				} else {

					// Regular enqueue
					if(
						(
							WS_Form_Common::option_get('css_layout', true) &&
							(WS_Form_Common::option_get('framework', 'ws-form') == 'ws-form')
						) ||
						$this->conversational
					) {

						if($this->customizer || ($this->css_inline && !is_admin())) {

							add_action('wp_footer', function() {

								// Output public CSS
								$css = $this->ws_form_css->get_layout(null, $this->customizer, is_rtl());

								// Output is already escaped
								echo $this->ws_form_css->inline($css);	// phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped

							}, 100);

						} else {

							$css_compile = WS_Form_Common::option_get('css_compile', false);

							wp_enqueue_style($this->plugin_name . '-layout', $css_compile ? sprintf('%s/ws-form/%s/public.layout%s%s.css', $upload_dir_base_url, WS_FORM_CSS_FILE_PATH, $rtl, $min) : WS_Form_Common::get_api_path('helper/ws-form-css'), array(), $this->version, 'all');
						}
					}
				}
	
				$this->enqueued_css_layout = true;
			}

			// CSS - Skin
			if(!$this->enqueued_css_skin && apply_filters('wsf_enqueue_css_skin', $this->enqueue_css_skin)) {

				if(WS_Form_Common::is_block_editor()) {

					// If we are in the block editor, we enqueue the skin CSS using WS Form framework
					wp_enqueue_style($this->plugin_name . '-skin', WS_Form_Common::get_api_path('helper/ws-form-css-skin?wsf_block_editor=true'), array(), $this->version, 'all');

				} else {

					if(
						(
							WS_Form_Common::option_get('css_skin', true) &&
							(WS_Form_Common::option_get('framework', 'ws-form') == 'ws-form')
						) ||
						$this->conversational
					) {

						if($this->customizer || ($this->css_inline && !is_admin())) {

							add_action('wp_footer', function() {

								// Output public CSS
								$css_skin = $this->ws_form_css->get_skin(null, $this->customizer, is_rtl());

								// Output is already escaped
								echo $this->ws_form_css->inline($css_skin);	// phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped

							}, 100);

						} else {

							$css_compile = WS_Form_Common::option_get('css_compile', false);

							$this->ws_form_css->skin_load();

							wp_enqueue_style($this->plugin_name . '-skin', $css_compile ? sprintf('%s/ws-form/%s/public.skin%s%s%s.css', $upload_dir_base_url, WS_FORM_CSS_FILE_PATH, $this->ws_form_css->skin_file, $rtl, $min) : WS_Form_Common::get_api_path(sprintf('helper/ws-form-css-skin?wsf_skin_id=%s', $this->ws_form_css->skin_id)), array(), $this->version, 'all');
						}
					}
				}

				$this->enqueued_css_skin = true;
			}


 			// JS - Custom
			if(!$this->enqueued_js_custom && apply_filters('wsf_enqueue_js_custom', $this->enqueue_js_custom)) {

				do_action('wsf_enqueue_scripts', $enqueue_args);

				$this->enqueued_js_custom = true;
			}

 			// CSS - Custom
			if(!$this->enqueued_css_custom && apply_filters('wsf_enqueue_css_custom', $this->enqueue_css_custom)) {

				do_action('wsf_enqueue_styles');

				$this->enqueued_css_custom = true;
			}

			do_action('wsf_enqueue_internal');
		}

		// Enqueue and internal script
		public function enqueue_internal_do($script, $dependency = 'common', $script_id = false, $prop = false) {

			// Check attributes
			if($script_id === false) { $script_id = $script; }
			if($prop === false) { $prop = $script; }
			$prop_enqueued = sprintf('enqueued_js_%s', $prop);
			$prop_enqueue = sprintf('enqueue_js_%s', $prop);
			$hook_name = sprintf('wsf_enqueue_js_%s', $prop);

			// Check if already enqueued
			if(
				$this->{$prop_enqueued} ||
				!apply_filters($hook_name, $this->{$prop_enqueue})
			) {
				return;
			}

			// Minified scripts?
			$min = SCRIPT_DEBUG ? '' : '.min';

			// RTL?
			$rtl = is_rtl() ? '.rtl' : '';

			// Get enqueue args
			$enqueue_args = WS_Form_Common::get_enqueue_args();

			// Script ID
			$script_id_full = sprintf('%s-%s', $this->plugin_name, $script_id);

			// Add script to dependencies for public
			if($dependency !== true) {

				$this->public_dependencies[] = $script_id_full;
			}

			// Enqueue
			wp_enqueue_script(

				$script_id_full,
				sprintf('%spublic/js/ws-form-%s%s.js', WS_FORM_PLUGIN_DIR_URL, $script, $min),
				($dependency === true) ? $this->public_dependencies : array(sprintf('%s-form-%s', $this->plugin_name, $dependency)),
				$this->version,
				$enqueue_args
			);

			$this->{$prop_enqueued} = true;

			do_action(sprintf('wsf_enqueue_%s', $script));
		}

		// WP print scripts
		public function wp_print_scripts() {

			// Get registered scripts
			global $wp_scripts;
			if(!isset($wp_scripts->registered)) { return; }

			// Do not run if there are no deregister scripts
			if(count($this->deregister_scripts) === 0) { return; }

			foreach($wp_scripts->registered as $handle => $script) {

				if(!isset($script->src)) { continue; }

				foreach($this->deregister_scripts as $deregister_script) {

					if(strpos($script->src, $deregister_script) !== false) {

						unset($wp_scripts->registered[$handle]);
					}
				}
			}
		}

		// Enqueue - Debug
		public function wp_scripts_debug() {

			global $wp_scripts, $wp_styles;

			echo '<table><thead><tr><th>Handle</th><th>URL</th><th>Dependencies</th></thead><tbody>';	// phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped

			foreach($wp_scripts->registered as $registered) {

				echo sprintf(	// phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped

					"<tr><td>%s</td><td>%s</td><td>%s</td></tr>",
					esc_html($registered->handle),
					esc_html($registered->src),
					esc_html(implode(', ', $registered->deps))
				);
			}

			echo '</tbody></table>';	// phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
		}

		// Form - Divi - AJAX - Form
		public function ws_form_divi_form() {

			$atts = array('id' => WS_Form_Common::get_query_var('form_id'), 'visual_builder' => true);

			$this->form_instance = WS_Form_Common::get_query_var('instance_id');

			echo self::shortcode_ws_form($atts);	// phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped

			wp_die();
		}

		// Form - HTML
		public function form_html($form_instance, $form_object, $element = 'form', $published = true, $preview = false, $element_id = false, $visual_builder = false, $class = false) {

			if($form_object === false) { return __('Unpublished form', 'ws-form'); }
			if(!is_object($form_object)) { return __('Invalid form data', 'ws-form'); }
			if(!isset($form_object->id)) { return __('Invalid form data', 'ws-form'); }

			// Get form ID
			$form_id = $form_object->id;

			// Do not render if draft or trash
			switch($form_object->status) {

				case 'draft' :
				case 'trash' :

					if($published) { return ''; };
			}

			// Init framework config
			$framework_id = WS_Form_Common::option_get('framework', WS_FORM_DEFAULT_FRAMEWORK);
			$frameworks = WS_Form_Config::get_frameworks();
			$framework = $frameworks['types'][$framework_id];

			// Check for form attributes
			$form_attributes = '';

			// Preview attribute
			if(!$published) { $form_attributes .= ' data-preview'; }

			// Visual builder attribute
			if($visual_builder) { $form_attributes .= ' data-visual-builder'; }

			// CSS - Framework
			if((isset($framework['css_file'])) && ($framework['css_file'] != '')) {

				$css_file_path = plugin_dir_url(__FILE__) . 'css/frameworks/' . $framework['css_file'];
				wp_enqueue_style($this->plugin_name . '-framework', $css_file_path, array(), $this->version, 'all');
			}

			// Form action
			$form_action = WS_Form_Common::get_api_path() . 'submit';

			// Check for custom form action
			$form_action_custom = trim(WS_Form_Common::get_object_meta_value($form_object, 'form_action', ''));
			if($form_action_custom != '') { $form_action = $form_action_custom; }

			// Filter - Form action
			$form_action = apply_filters('wsf_shortcode_form_action', $form_action);

			// Form method
			$form_method = 'POST';
			$form_method = apply_filters('wsf_shortcode_form_method', $form_method);

			// Form attribute - id
			$form_attr_id = ($element_id === false) ? 'ws-form-' . $form_instance : $element_id;

			// Form attribute - data-wsf-custom-id
			$form_attr_data_custom_id = ($element_id === false) ? '' : ' data-wsf-custom-id';

			// Form attribute - data-instance-id
			if($visual_builder) { $form_instance = false; }
			$form_attr_data_instance_id = ($form_instance !== false) ? sprintf(' data-instance-id="%u"', esc_attr($form_instance)) : '';

			// Form attribute - class
			$form_attr_class = ($class === false) ? '' : ' ' . $class;

			// Form wrapper
			switch($element) {

				case 'form' :

					$return_value = sprintf('<form action="%s" class="wsf-form wsf-form-canvas%s" id="%s"%s data-id="%u"%s method="%s"%s></form>', esc_attr($form_action), esc_attr($form_attr_class), esc_attr($form_attr_id), $form_attr_data_custom_id, esc_attr($form_id), $form_attr_data_instance_id, esc_attr($form_method), $form_attributes);
					break;

				default :

					$return_value = sprintf('<%1$s class="wsf-form wsf-form-canvas%2$s" id="%3$s"%4$s data-id="%5$u"%6$s%7$s></%1$s>', $element, esc_attr($form_attr_class), esc_attr($form_attr_id), $form_attr_data_custom_id, esc_attr($form_id), $form_attr_data_instance_id, $form_attributes);
					break;
			}

			// Shortcode filter
			$return_value = apply_filters('wsf_shortcode', $return_value);

			// Build JSON
			$form_json = wp_json_encode($form_object);

			// Form data (Only render once per form ID)
			if(!isset($this->wsf_form_json[$form_id])) {

				// Form JSON
				$this->footer_js .= sprintf("window.wsf_form_json[%u] = %s;", $form_id, $form_json) . "\n";

				// Form JSON populate
				$populate_array = self::get_populate_array($form_json);
				$populate_array = apply_filters('wsf_populate', $populate_array);
				if(($populate_array !== false) && count($populate_array) > 0) {

					$this->footer_js .= sprintf("window.wsf_form_json_populate[%u] = %s;", $form_id, wp_json_encode($populate_array)) . "\n";
				}

				$this->wsf_form_json[$form_id] = true;
			}

			// Add view
			$ws_form_form_stat = New WS_Form_Form_Stat();
			if($ws_form_form_stat->form_stat_check() && (WS_Form_Common::option_get('add_view_method') == 'server')) {

				// Log view
				$ws_form_form_stat->form_id = $form_id;
				$ws_form_form_stat->db_add_view();
			}

			return $return_value;
		}

		public function localization_object($debug = false) {

			global $post, $wp_version;

			// Stats
			$ws_form_form_stat = New WS_Form_Form_Stat();

			// API path
			$api_path = WS_Form_Common::get_api_path();

			// Skin
			$enable_cache = !(WS_Form_Common::get_query_var('customize_theme') !== '');

			// Skin - Spacing small
			$skin_spacing_small = WS_Form_Common::option_get('skin_spacing_small', '', false, $enable_cache, true);
			if($skin_spacing_small == '') { $skin_spacing_small = 5; }

			// Skin - Spacing small
			$skin_grid_gutter = WS_Form_Common::option_get('skin_grid_gutter', '', false, $enable_cache, true);
			if($skin_grid_gutter == '') { $skin_grid_gutter = 20; }

			// NONCE enabled
			$nonce_enabled = is_admin() || is_user_logged_in() || WS_Form_Common::option_get('security_nonce');

			// Localization array
			$return_array = array(

				// Nonce - WordPress
				'x_wp_nonce'			=> $nonce_enabled ? wp_create_nonce('wp_rest') : '',
				'wsf_nonce_field_name'	=> WS_FORM_POST_NONCE_FIELD_NAME,
				'wsf_nonce'				=> $nonce_enabled ? wp_create_nonce(WS_FORM_POST_NONCE_ACTION_NAME) : '',

				// URL
				'url_ajax'				=> $api_path,
				'url_ajax_namespace'	=> WS_FORM_RESTFUL_NAMESPACE,
				'url_plugin'			=> WS_FORM_PLUGIN_DIR_URL,
				// Should framework CSS be rendered? (WS Form framework only)
				'css_framework'			=> WS_Form_Common::option_get('css_framework', true),

				// Max upload size
				'max_upload_size'		=> absint(WS_Form_Common::option_get('max_upload_size', 0)),

				// Field prefix
				'field_prefix'			=> WS_FORM_FIELD_PREFIX,

				// Date / time format
				'date_format'			=> get_option('date_format'),
				'time_format'			=> get_option('time_format'),
				'gmt_offset'			=> get_option('gmt_offset'),

				// Locale
				'locale'				=> get_locale(),

				// Stat
				'stat'					=> ($ws_form_form_stat->form_stat_check() && (WS_Form_Common::option_get('add_view_method', '') == '')),

				// Skin - Spacing small
				'skin_spacing_small'	=> $skin_spacing_small,

				// Skin - Grid gutter
				'skin_grid_gutter'		=> $skin_grid_gutter,

				// RTL
				'rtl'					=> is_rtl(),

				// Submit hash
				'wsf_hash'				=> self::get_submit_hash(),

				// WP Media
				'wp_media'				=> $this->enqueue_js_wp_media,

				// Geolocation by IP lookup method
				'ip_lookup_method'		=> WS_Form_Common::option_get('ip_lookup_method')
			);
			// WP Editor
			if(
				apply_filters('wsf_enqueue_js_wp_editor', $this->enqueue_js_wp_editor) &&
				(WS_Form_Common::version_compare($wp_version, '4.8') >= 0) &&
				user_can_richedit()
			) {

				// TinyMCE toolbars - Compact
				$return_array['tinymce_toolbar1_compact'] = apply_filters('wsf_tinymce_toolbar1_compact', 'bold italic underline strikethrough | bullist numlist | alignleft aligncenter alignright alignjustify | link unlink | pastetext | undo redo | fullscreen');
				$return_array['tinymce_toolbar2_compact'] = apply_filters('wsf_tinymce_toolbar2_compact', '');
				$return_array['tinymce_toolbar3_compact'] = apply_filters('wsf_tinymce_toolbar3_compact', '');
				$return_array['tinymce_toolbar4_compact'] = apply_filters('wsf_tinymce_toolbar4_compact', '');

				// TinyMCE plugins - Compact
				$return_array['tinymce_plugins_compact'] = apply_filters('wsf_tinymce_plugins_compact', 'lists media paste tabfocus fullscreen wordpress wpautoresize wpdialogs wpeditimage wpemoji wpgallery wplink wptextpattern wpview');
	
				// TinyMCE toolbars - Full
				$return_array['tinymce_toolbar1_full'] = apply_filters('wsf_tinymce_toolbar1_full', 'formatselect bold italic underline strikethrough | bullist numlist | alignleft aligncenter alignright alignjustify | link unlink | wp_adv');
				$return_array['tinymce_toolbar2_full'] = apply_filters('wsf_tinymce_toolbar2_full', 'forecolor | pastetext | hr | removeformat charmap | outdent indent blockquote | wp_more | undo redo | fullscreen');
				$return_array['tinymce_toolbar3_full'] = apply_filters('wsf_tinymce_toolbar3_full', '');
				$return_array['tinymce_toolbar4_full'] = apply_filters('wsf_tinymce_toolbar4_full', '');

				// TinyMCE plugins - Full
				$return_array['tinymce_plugins_full'] = apply_filters('wsf_tinymce_plugins_full', 'charmap colorpicker hr lists media paste tabfocus textcolor fullscreen wordpress wpautoresize wpdialogs wpeditimage wpemoji wpgallery wplink wptextpattern wpview');
			}

			// Pass through post ID
			if(isset($post) && ($post->ID > 0)) {

				$return_array['post_id'] = $post->ID;
			}

			return $return_array;
		}

		// Get submit hash
		public function get_submit_hash() {

			// Get hash from query string
			$wsf_hash = WS_Form_Common::get_query_var('wsf_hash');

			if($wsf_hash !== '') {

				// Decode wsf_hash
				$wsf_hash_array = json_decode($wsf_hash);

				// Chech wsf_hash
				if(
					is_null($wsf_hash_array) ||
					!is_array($wsf_hash_array)

				) {

					WS_Form_Common::throw_error(__('Invalid hash ID (get_submit_hash)', 'ws-form'));
					wp_die();
				}

				foreach($wsf_hash_array as $wsf_hash) {

					// Check hash
					if(
						!isset($wsf_hash->id) ||
						!isset($wsf_hash->hash) ||
						!WS_Form_Common::check_submit_hash($wsf_hash->hash)
					) {

						WS_Form_Common::throw_error(__('Invalid hash ID (get_submit_hash)', 'ws-form'));
						wp_die();
					}
				}

				return $wsf_hash_array;

			} else {

				return '';
			}
		}

		// Populate from action
		public function get_populate_array($form_json) {

			// Get populate data
			$form_object = json_decode($form_json);

			// Check form populate is enabled
			$form_populate_enabled = WS_Form_Common::get_object_meta_value($form_object, 'form_populate_enabled', '');
			if(!$form_populate_enabled) { return false; }

			// Read form populate data - Action ID
			$form_populate_action_id = WS_Form_Common::get_object_meta_value($form_object, 'form_populate_action_id', '');
			if($form_populate_action_id == '') { return false; }
			if(!isset(WS_Form_Action::$actions[$form_populate_action_id])) { return false; }

			// Get action
			$action = WS_Form_Action::$actions[$form_populate_action_id];

			// Check get method exists
			if(!method_exists($action, 'get')) { return false; }

			// Read form populate data - List ID
			$action_get_require_list_id = isset($action->get_require_list_id) ? $action->get_require_list_id : true;
			if($action_get_require_list_id) {

				$form_populate_list_id = WS_Form_Common::get_object_meta_value($form_object, 'form_populate_list_id', '');
				if($form_populate_list_id == '') { return false; }
			}

			// Read form populate data - Field mapping
			$form_populate_field_mapping = WS_Form_Common::get_object_meta_value($form_object, 'form_populate_field_mapping', array());

			if(method_exists($action, 'get_tags')) {

				// Read form populate data - Tag mapping
				$form_populate_tag_mapping = WS_Form_Common::get_object_meta_value($form_object, 'form_populate_tag_mapping', array());
			}

			// Get user data
			$current_user = wp_get_current_user();

			// Set list ID
			if($action_get_require_list_id) {

				$action->list_id = $form_populate_list_id;
			}

			// Try to get action data
			try {

				$get_array = $action->get($form_object, $current_user);

			} catch(Exception $e) { return false; }

			if(
				($get_array === false) ||
				!is_array($get_array)

			) { return false; }

			$data = array();

			// Process field mapping data
			$field_mapping_lookup = array();
			if(is_array($form_populate_field_mapping)) {

				foreach($form_populate_field_mapping as $field_mapping) {

					$action_field = $field_mapping->form_populate_list_fields;
					$ws_form_field = $field_mapping->ws_form_field;

					if(!isset($field_mapping_lookup[$action_field])) {

						$field_mapping_lookup[$action_field] = $ws_form_field;
					}
				}
			}

			// Map fields
			if(
				isset($get_array['fields']) &&
				is_array($get_array['fields'])
			) {

				foreach($get_array['fields'] as $id => $value) {

					if($id === '') { continue; }

					if(is_numeric($id)) {

						$data[WS_FORM_FIELD_PREFIX . $id] = $value;

					} else {

						if(isset($field_mapping_lookup[$id])) {

							$data[WS_FORM_FIELD_PREFIX . $field_mapping_lookup[$id]] = $value;
						}
					}
				}
			}

			// Map fields (Repeatable)
			if(
				isset($get_array['fields_repeatable']) &&
				is_array($get_array['fields_repeatable'])
			) {

				foreach($get_array['fields_repeatable'] as $id => $values) {

					if($id === '') { continue; }

					if(!is_array($values)) { continue; }

					foreach($values as $repeatable_index => $value) {

						if(is_numeric($id)) {

							$data[WS_FORM_FIELD_PREFIX . $id . '_' . ($repeatable_index + 1)] = $value;

						} else {

							if(isset($field_mapping_lookup[$id])) {

								$data[WS_FORM_FIELD_PREFIX . $field_mapping_lookup[$id] . '_' . ($repeatable_index + 1)] = $value;
							}
						}
					}
				}
			}

			// Tag mapping
			if(
				method_exists($action, 'get_tags') &&
				is_array($form_populate_tag_mapping) &&
				isset($get_array['tags']) &&
				is_array($get_array['tags'])
			) {

				$tag_mapping_array = array();
				foreach($get_array['tags'] as $id => $value) {

					if($value) {

						$tag_mapping_array[] = $id;
					}
				}

				foreach($form_populate_tag_mapping as $tag_mapping) {

					$ws_form_field = $tag_mapping->ws_form_field;

					$data[WS_FORM_FIELD_PREFIX . $ws_form_field] = $tag_mapping_array;
				}
			}

			// Section repeatable
			if(
				isset($get_array['section_repeatable']) &&
				is_array($get_array['section_repeatable'])
			) {

				$section_repeatable = $get_array['section_repeatable'];

			} else {

				$section_repeatable = array();
			}

			return array('action_label' => $action->label, 'data' => $data, 'section_repeatable' => $section_repeatable);
		}

		public function nonce_user_logged_out($uid = 0, $action = false) {

			return ($action === WS_FORM_POST_NONCE_ACTION_NAME) ? 0 : $uid;
		}

	}
