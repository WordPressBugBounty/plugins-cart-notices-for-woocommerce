<?php
if ( ! class_exists( 'brnotices_free_funnels' ) ) {
	class brnotices_free_funnels {
		public $plugin_name;
		public $version_capability_name;

		function __construct() {
			$this->plugin_name = 'notices';
			$this->version_capability_name = 'brfr_get_plugin_version_capability_cart_notices';

			//delete_option('berocket_admin_notices');
			//update_option('berocket_last_close_notices_time', 1);
			$this->spring_premium_days_2026();
			$this->halloween_2026();
		}

		public function spring_premium_days_2026(): void {
			$type = $this->get_plugin_type();

			$name       = 'spring_premium_days_2026';
			$media      = '?utm_source=' . $type . '_plugin&utm_medium=admin_notice&utm_campaign=spring_2026&utm_content=top_banner_cta&utm_term=' . $this->plugin_name;
			$start_time = mktime(0, 0, 0, 4, 13, 2026);
			$end_time   = mktime(23, 59, 59, 4, 17, 2026);
			$c_notice   = berocket_admin_notices::get_notice_by_priority_and_name( 19, $name );

			$is_closed = false;
			if ( isset( $c_notice['closed'] ) and $c_notice['closed'] > 0 ) {
				$is_closed = true;
			}

			if ( ! $is_closed and $start_time <= time() and $end_time > time() ) {
				new berocket_admin_notices( array(
					'start'     => $start_time,
					'end'       => $end_time,
					'name'      => $name,
					'html'      => '
				<div class="berocket-notice-template-big">
					<div class="berocket-notice-description-container">
						<h1 style="padding-top: 0;line-height: 0.8;">🌿 Spring Premium Days - <b class="br-notice-text-label">Save 30% on Premium</b> Plugins!</h1>
						<h3>Build a faster, smarter, and more profitable WooCommerce store</h3>
						<ul style="font-size: 16px">
							<li>Faster product discovery and smoother navigation</li>
							<li>Smart features to boost conversions and engagement</li>
							<li>Priority support to save your time and resolve issues faster</li>
						</ul>
						<p><i>30% OFF applies to all BeRocket plugins.</i></p>
					</div>
					<div class="berocket-notice-actions-container">
						<div class="berocket-notice-countdown-container">
							<span class="berocket-notice-countdown-title">Hurry Up! Deal ends in:</span>
							<ul class="berocket-notice-countdown-timer" data-endtime="' . ($end_time) . '">
								<li class="berocket-notice-countdown-days"><span>0</span><br />Days</li>
								<li class="berocket-notice-countdown-hours"><span>0</span><br />Hours</li>
								<li class="berocket-notice-countdown-minutes"><span>0</span><br />Minutes</li>
								<li class="berocket-notice-countdown-seconds"><span>0</span><br />Seconds</li>
							</ul>
						</div>
						<div class="berocket-notice-buttons-container">
							<a href="https://berocket.com/plugins/' . $media . '" 
							   class="button notice-action-link not_berocket_button" target="_blank" 
							   style="position: static; display: inline-block; right: 0; top: 0; margin: 0;font-size: 24px;padding-left: 25px;padding-right: 25px;">Get Premium → 30% OFF</a>
						</div> 
					</div>
				</div>',
					'type'      => 'warning',
					'righthtml' => '<span class="berocket-notice-dismiss notice-dismiss berocket_no_thanks" role="button" tabindex="0">
						<span class="screen-reader-text">
						<input class="berocket-notice-dismiss-check" type="checkbox" value="1">Dismiss this notice.
						</span>
					</span>',
					'subscribe' => false,
					'priority'  => 19,
					'image'     => '',
				) );

				$this->br_show_admin_notice_sign();
				$this->br_show_admin_notice_timer();
			}
		}

		public function halloween_2026(): void {
			$type = $this->get_plugin_type();

			$name       = 'halloween_2026';
			$media      = '?utm_source=' . $type . '_plugin&utm_medium=admin_notice&utm_campaign=halloween_2026&utm_content=top_banner_cta&'.
			              'utm_term=' . $this->plugin_name;
			$start_time = 1792969200; // 26/10
			$end_time   = 1793573999; // 1/11
			$c_notice   = berocket_admin_notices::get_notice_by_priority_and_name( 19, $name );

			$is_closed = false;
			if ( isset( $c_notice['closed'] ) and $c_notice['closed'] > 0 ) {
				$is_closed = true;
			}

			if ( ! $is_closed and $start_time <= time() and $end_time > time() ) {
				new berocket_admin_notices( array(
					'start'     => $start_time,
					'end'       => $end_time,
					'name'      => $name,
					'html'      => '
				<style>/* Scoped component: no fonts, trackers, framework or external asset requests. */
					[data-br-halloween-promo] {
					  --br-promo-ink: #1d0b4a;
					  --br-promo-purple: #742eff;
					  --br-promo-border: #d6baff;
					  container: br-halloween / inline-size;
					  position: relative;
					  isolation: isolate;
					  width: 99%;
					  min-width: 0;
					  margin: 16px 0 24px;
					  overflow: hidden;
					  border: 1px solid var(--br-promo-border);
					  border-radius: 18px;
					  background: radial-gradient(ellipse at 4% 100%, #e6d5ff 0, transparent 42%), linear-gradient(105deg, #f8f2ff, #f2ebff 70%, #f6efff);
					  color: var(--br-promo-ink);
					  font-family: Arial, Helvetica, sans-serif;
					  font-size: 16px;
					  line-height: 1.45;
					  text-align: left;
					}
					[data-br-halloween-promo] *,
					[data-br-halloween-promo] *::before,
					[data-br-halloween-promo] *::after { box-sizing: border-box; }
					[data-br-halloween-promo] .br-halloween-promo__layout {
					  display: grid;
					  grid-template-columns: clamp(145px, 16cqi, 195px) minmax(0, 1fr) clamp(225px, 23cqi, 280px);
					  gap: clamp(18px, 2.2cqi, 32px);
					  align-items: center;
					  min-height: 220px;
					  padding: 26px 24px 22px;
					}
					[data-br-halloween-promo] .br-halloween-promo__layout::before {
					  content: "";
					  position: absolute;
					  z-index: -1;
					  top: -28px;
					  right: 36px;
					  width: 165px;
					  height: 165px;
					  background: #742eff;
					  background: url("https://berocket.ams3.cdn.digitaloceanspaces.com/sale/halloween%202026/halloween-web.png") center / contain no-repeat;
				      -webkit-mask: none;
					  mask: none;
					  opacity: .13;
					  transform: scaleX(-1);
					  pointer-events: none;
					}
					[data-br-halloween-promo] .br-halloween-promo__art { position: relative; align-self: stretch; min-height: 170px; }
					[data-br-halloween-promo] .br-halloween-promo__logo {
					  position: relative;
					  z-index: 1;
					  display: flex;
					  align-items: center;
					  justify-content: center;
					  width: 100%;
					  max-width: 190px;
					  padding: 11px 14px;
					  border-radius: 19px;
					  background: linear-gradient(120deg, #321074, #20064f);
					}
					[data-br-halloween-promo] .br-halloween-promo__logo img { display: block; width: 100%; height: auto; max-width: 160px; }
					[data-br-halloween-promo] .br-halloween-promo__pumpkins {
					  position: absolute;
					  bottom: -27px;
					  left: -20px;
					  display: block;
					  width: calc(100% + 30px);
					  max-width: 235px;
					  height: auto;
					  pointer-events: none;
					}
					[data-br-halloween-promo] .br-halloween-promo__content {
					  min-width: 0;
					  width: fit-content;
                      margin: 0 auto;
                    }
					[data-br-halloween-promo] .br-halloween-promo__title {
					  margin: 0 0 13px;
					  padding: 0;
					  color: var(--br-promo-ink);
					  font-family: inherit;
					  font-size: clamp(25px, 3.15cqi, 42px);
					  font-weight: 800;
					  line-height: 1.15;
					  letter-spacing: -.04em;
					  text-wrap: balance;
					}
					[data-br-halloween-promo] .br-halloween-promo__discount {
					  display: inline-block;
					  color: #984214;
					  white-space: nowrap;
					}
					@supports (background-clip: text) {
					  [data-br-halloween-promo] .br-halloween-promo__discount {
					    background: linear-gradient(100deg, #7427df 5%, #a42bb6 47%, #c25500 78%);
					    background-clip: text;
					    -webkit-background-clip: text;
					    -webkit-text-fill-color: transparent;
					  }
					}
					[data-br-halloween-promo] .br-halloween-promo__description,
					[data-br-halloween-promo] .br-halloween-promo__code-line {
					  margin: 0;
					  padding: 0;
					  color: var(--br-promo-ink);
					  font-family: inherit;
					  font-size: clamp(14px, 1.5cqi, 18px);
					  line-height: 1.55;
					}
					[data-br-halloween-promo] .br-halloween-promo__code-line { margin-top: 15px; line-height: 1.9; }
					[data-br-halloween-promo] .br-halloween-promo__code {
					  display: inline-block;
					  margin: 2px 3px;
					  padding: 5px 11px;
					  border: 1px solid #b48aff;
					  border-radius: 9px;
					  background: #eee0ff;
					  color: #6520c9;
					  font-family: inherit;
					  font-size: 1em;
					  font-weight: 700;
					  line-height: 1.4;
					  letter-spacing: 0;
					  user-select: all;
					}
					[data-br-halloween-promo] .br-halloween-promo__ending { white-space: nowrap; }
					[data-br-halloween-promo] .br-halloween-promo__action {
					  display: flex;
					  flex-direction: column;
					  gap: 15px;
					  align-items: stretch;
					  justify-content: center;
					  min-width: 0;
					  padding: 22px 0 18px 18px;
					  border-left: 1px solid var(--br-promo-border);
					}
					[data-br-halloween-promo] .br-halloween-promo__dates {
					  margin: 0;
					  color: var(--br-promo-ink);
					  font-size: clamp(14px, 1.4cqi, 18px);
					  font-weight: 700;
					  line-height: 1.4;
					  text-align: center;
					}
					[data-br-halloween-promo] .br-halloween-promo__cta {
					  display: inline-flex;
					  gap: 8px;
					  align-items: center;
					  justify-content: center;
					  min-height: 48px;
					  padding: 14px 12px;
					  border: 1px solid transparent;
					  border-radius: 12px;
					  background: linear-gradient(110deg, #7624ee, #6b20e4);
					  box-shadow: 0 6px 15px #742eff28;
					  color: #fff;
					  font-family: inherit;
					  font-size: clamp(14px, 1.2cqi, 15px);
					  font-weight: 700;
					  line-height: 1.3;
					  text-align: center;
					  text-decoration: none;
					}
					[data-br-halloween-promo] .br-halloween-promo__cta:hover { background: #5c18ce; color: #fff; text-decoration: none; }
					[data-br-halloween-promo] .br-halloween-promo__arrow { flex: 0 0 auto; font-size: 22px; font-weight: 400; line-height: 1; }
					[data-br-halloween-promo] .br-halloween-promo__dismiss {
					  position: absolute;
					  z-index: 3;
					  top: 5px;
					  right: 5px;
					  display: grid;
					  place-items: center;
					  width: 40px;
					  height: 40px;
					  margin: 0;
					  padding: 0;
					  border: 0;
					  border-radius: 8px;
					  background: transparent;
					  box-shadow: none;
					  color: #68567a;
					  font: 30px/1 Arial, sans-serif;
					  cursor: pointer;
					}
					[data-br-halloween-promo] .br-halloween-promo__dismiss:hover { background: #e4d7f8; color: #2b104c; }
					[data-br-halloween-promo] .br-halloween-promo__cta:focus-visible,
					[data-br-halloween-promo] .br-halloween-promo__dismiss:focus-visible { outline: 3px solid #41207a; outline-offset: 3px; }
					[data-br-halloween-promo] .br-halloween-promo__sr-only {
					  position: absolute;
					  width: 1px;
					  height: 1px;
					  padding: 0;
					  overflow: hidden;
					  clip-path: inset(50%);
					  white-space: nowrap;
					  border: 0;
					}
					@container br-halloween (max-width: 1040px) {
					  [data-br-halloween-promo] .br-halloween-promo__layout { grid-template-columns: 145px minmax(0, 1fr); gap: 15px 24px; padding: 24px; }
					  [data-br-halloween-promo] .br-halloween-promo__art { grid-row: span 2; min-height: 185px; }
					  [data-br-halloween-promo] .br-halloween-promo__title { font-size: clamp(26px, 4cqi, 35px); margin-bottom: 10px; }
					  [data-br-halloween-promo] .br-halloween-promo__content { min-width: 0; width: auto; margin: 0; }
					  [data-br-halloween-promo] .br-halloween-promo__description,
					  [data-br-halloween-promo] .br-halloween-promo__code-line { font-size: 16px; }
					  [data-br-halloween-promo] .br-halloween-promo__code-line { margin-top: 9px; }
					  [data-br-halloween-promo] .br-halloween-promo__action { grid-column: 2; flex-direction: row; align-items: center; justify-content: flex-start; gap: 18px; border: 0; padding: 0; }
					  [data-br-halloween-promo] .br-halloween-promo__dates { text-align: left; font-size: 14px; }
					  [data-br-halloween-promo] .br-halloween-promo__cta { flex: 0 1 auto; font-size: 14px; padding: 12px 16px; }
					}
					@container br-halloween (max-width: 700px) {
					  [data-br-halloween-promo] .br-halloween-promo__layout { grid-template-columns: minmax(0, 1fr); gap: 14px; padding: 18px 20px 22px; }
					  [data-br-halloween-promo] .br-halloween-promo__art { grid-row: auto; min-height: 72px; }
					  [data-br-halloween-promo] .br-halloween-promo__logo { width: 150px; border-radius: 15px; padding: 10px 13px; }
					  [data-br-halloween-promo] .br-halloween-promo__pumpkins { width: 128px; max-width: none; left: auto; right: 22px; bottom: -8px; }
					  [data-br-halloween-promo] .br-halloween-promo__title { font-size: clamp(27px, 5.3cqi, 34px); }
					  [data-br-halloween-promo] .br-halloween-promo__description,
					  [data-br-halloween-promo] .br-halloween-promo__code-line { font-size: 15px; }
					  [data-br-halloween-promo] .br-halloween-promo__ending { display: none; }
					  [data-br-halloween-promo] .br-halloween-promo__action { grid-column: 1; flex-wrap: wrap; gap: 12px; }
					  [data-br-halloween-promo] .br-halloween-promo__dates { flex: 1 0 100%; }
					  [data-br-halloween-promo] .br-halloween-promo__cta { width: 100%; min-height: 48px; }
					  [data-br-halloween-promo] .br-halloween-promo__layout::before { width: 115px; height: 115px; right: 8px; opacity: .11; }
					}
					@container br-halloween (max-width: 360px) {
					  [data-br-halloween-promo] .br-halloween-promo__logo { width: 130px; }
					  [data-br-halloween-promo] .br-halloween-promo__pumpkins { width: 100px; right: 10px; bottom: -4px; }
					}
					@media (forced-colors: active) {
					  [data-br-halloween-promo] .br-halloween-promo__discount { -webkit-text-fill-color: currentColor; background: none; color: CanvasText; }
					  [data-br-halloween-promo] .br-halloween-promo__cta { border-color: LinkText; box-shadow: none; }
					}
				</style>
				<section class="br-halloween-promo"
					  data-br-halloween-promo
					  data-campaign="halloween-2026"
						  data-start="2026-10-26T00:00:00+01:00"
						  data-end="2026-11-02T00:00:00+01:00"
					  data-dismiss-scope="preview-user" data-preview="true" data-focus-after-dismiss="#preview-settings-title"
					  aria-label="BeRocket Halloween offer">
					  <div class="br-halloween-promo__layout">
					    <button class="br-halloween-promo__dismiss berocket-notice-dismiss berocket-notice-dismiss- berocket_no_thanks" type="button" aria-label="Dismiss Halloween offer">
					      <span class="berocket-notice-dismiss-check" aria-hidden="true">×</span>
					    </button>
					    <div class="br-halloween-promo__art">
					      <div class="br-halloween-promo__logo">
					        <img src="https://e8e3g4v6.rocketcdn.me/wp-content/uploads/2022/12/logo-with-text-white-237x70-1.png" alt="BeRocket" width="237" height="70" decoding="async">
					      </div>
					      <img class="br-halloween-promo__pumpkins" src="https://berocket.ams3.cdn.digitaloceanspaces.com/sale/halloween%202026/pumpkins-banner-2026.png" alt="" width="640" height="480" decoding="async">
					    </div>
					    <div class="br-halloween-promo__content">
					      <h2 class="br-halloween-promo__title">Halloween Sale <span class="br-halloween-promo__dash" aria-hidden="true">—</span> <span class="br-halloween-promo__discount">25% OFF</span></h2>
					      <p class="br-halloween-promo__description">Get more from your WooCommerce store with premium BeRocket plugins.</p>
					      <p class="br-halloween-promo__code-line">Use <code class="br-halloween-promo__code">HALLOWEEN25</code> at checkout. <span class="br-halloween-promo__ending">Offer ends November 1.</span></p>
					    </div>
					    <div class="br-halloween-promo__action">
					      <p class="br-halloween-promo__dates"><time datetime="2026-10-26">October 26</time><span aria-hidden="true">–</span><span class="br-halloween-promo__sr-only"> through </span><time datetime="2026-11-01">November 1</time><span class="br-halloween-promo__sr-only">, 2026, Paris time</span></p>
					      <a class="br-halloween-promo__cta" href="https://berocket.com/halloween-2026/' . $media . '" target="_blank" rel="noopener noreferrer">View the Halloween Sale <span class="br-halloween-promo__arrow" aria-hidden="true">→</span><span class="br-halloween-promo__sr-only"> (opens in a new tab)</span></a>
					    </div>
					  </div>
					</section>',
					'type'      => 'custom',
					'display_area' => 'settings',
					'righthtml' => '',
					'subscribe' => false,
					'priority'  => 19,
					'image'     => '',
				) );

				$this->br_show_admin_notice_sign();
			}
		}

		public function br_show_admin_notice_sign(): void {
			add_action('admin_head', function () {
				echo "
				<style>
				#toplevel_page_berocket_account .toplevel_page_berocket_account .wp-menu-name:after {
					content: '🎃';
					display: flex;
					vertical-align: top;
					box-sizing: border-box;
					margin: 0;
					padding: 0 5px;
					min-width: 22px;
					border-radius: 0;
					background-color: #0fc972;
					color: #fff;
					font-size: 18px;
					line-height: 1.6;
					text-align: center;
					z-index: 26;
					position: absolute;
					right: 10px;
					top: 2px;
					bottom: 2px;
					align-items: center;
					justify-content: center;
					font-weight: 600;
					opacity: 1;
					transition: opacity 0.5s ease;
				}
				#toplevel_page_berocket_account .toplevel_page_berocket_account .wp-menu-name.hideAfter:after {
					opacity: 0;
					pointer-events: none;
				}
				</style>
				";
			});
		}

		public function br_show_admin_notice_timer(): void {
			add_action('admin_head', function () {
				echo "
				<script>
				function berocket_notice_countdown() {
                    time = jQuery('.berocket-notice-countdown-timer').data('endtime')*1 - Math.floor(Date.now()/1000);
                    berocket_notice_countdown_timer(time);
                }
                function berocket_notice_countdown_timer(time) {
                    formatted_time = berocket_notice_countdown_timer_format_time(time);
                    jQuery('.berocket-notice-countdown-days span').text(formatted_time.days);
                    jQuery('.berocket-notice-countdown-hours span').text(formatted_time.hours);
                    jQuery('.berocket-notice-countdown-minutes span').text(formatted_time.minutes);
                    jQuery('.berocket-notice-countdown-seconds span').text(formatted_time.seconds);
                    if ( time > 0 ) {
                        setTimeout(berocket_notice_countdown_timer, 1000, time-1);
                    }
                }
                function berocket_notice_countdown_timer_format_time(totalSeconds) {
					const days = Math.floor(totalSeconds / 86400);
					totalSeconds %= 86400;
					
					const hours = Math.floor(totalSeconds / 3600);
					totalSeconds %= 3600;
					
					const minutes = Math.floor(totalSeconds / 60);
					const seconds = totalSeconds % 60;
					
					return { days, hours, minutes, seconds };
				}
				jQuery(document).ready(function () {
	                berocket_notice_countdown();
				});
				</script>
				<style>
				.berocket-notice-countdown-container {
					background: #ffd453;
					width: 516px;
					margin: 0 auto;
					border-radius: 10px;
					padding: 13px 0 7px;
				}
				.berocket-notice-countdown-title {
					font-size: 16px;
				}
				.berocket-notice.notice-warning ul.berocket-notice-countdown-timer {
					display: flex;
					gap: 10px;
					justify-content: center;
					margin-bottom: 0;
					padding-left: 10px !important;					
					padding-right: 10px !important;					
				}
				.berocket-notice-countdown-timer li {
					list-style-type: none;
					background: white;
					height: 60px;
					width: 80px;
					border-radius: 10px;
					font-size: 15px;
					padding: 10px 5px;
					box-sizing: border-box;
				}
				.berocket-notice-countdown-timer li span {
					font-size: 24px;
					font-weight: 700;
				}
				</style>
				";
			});
		}
		public function get_plugin_type(): string {
			$plugin_version_capability = apply_filters( $this->version_capability_name, 0 );
			return ( $plugin_version_capability >= 15 ) ? 'paid' : 'free';
		}
	}

	new brnotices_free_funnels();
}