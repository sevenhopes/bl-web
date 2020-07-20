<?php
/**
 * Template Name: Staff Calendar
 *
 * 임직원 전용 학원 일정
 *
 * @package BridgeLight
 * @subpackage BridgeLight_MobileFirst
 * @since 2017 Child 1.0
 */

get_header(); ?>

<div id="bl-staff-only" class="wrap">

	<header class="bl-page-header">
		<h2 class="bl-page-title">Staff Events</h2>
	</header>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div id="events" class="bl-block">
				<!-- <div class="bl-block-header">
					<h2 class="bl-block-title">All Events</h2>
				</div> -->
				<div class="bl-wrap">
				<?php
				// Events 글의 아이디로 그 글의 내용인 JSON 코드 파싱
				$events = json_decode( get_post_field( 'post_content', 1697 ) );

				if ( $events ) :
					foreach ( $events as $ev ) :
						$starttime = strtotime( $ev->{"start"} );
				?>
					<div class="bl-event-item<?php echo $ev->{"holiday"} ? ' bl-holiday' : ( $ev->{"public"} ? '' : ' staff-event'); ?>" data-date="<?php echo $ev->{"start"} ?>">
						<div class="bl-tear-off">
							<div class="t-o-day"><?php echo $ev->{"pending"} ? '?' : date( "j", $starttime ) ?></div>
							<div class="t-o-mon"><?php echo date( "M", $starttime ) ?></div>
						</div>
						<div class="bl-event-info">
							<h2 class="e-i-title"><?php echo $ev->{"title"} ?></h2>
							<div class="e-i-date">
								<time itemprop="startDate" datetime="<?php echo $ev->{"start"} ?>"><?php echo bl_w2k( date( $ev->{"pending"} ? "n\월 \중" : "n\월 j\일 D", $starttime ) ) ?></time><?php if ( $ev->{"end"} && ! $ev->{'pending'} ) : $endtime = strtotime( $ev->{"end"} ); ?><time itemprop="endDate" datetime="<?php echo $ev->{"end"} ?>"><?php echo $starttime == strtotime( "-1 day", $endtime ) ? ', ' : ' ~ ' ?><?php echo bl_w2k( date( substr_compare( $ev->{"start"}, substr( $ev->{"end"}, 5, 2 ), 5, 2) == 0 ? "j\일 D" : "n\월 j\일 D", $endtime ) ) ?></time><?php endif; ?>
							</div>
							<div class="e-i-extra"><?php echo $ev->{"extra"} ?></div>
						</div>
					</div>
				<?php
					endforeach;
				else :
					echo "앗, 아무 이벤트도 없습니다. 머쓱하네요. 샌드위치엔 머쓱타드 :p\n";
				endif;
				?>
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php //사이드바 비활성 get_sidebar(); ?>

</div><!-- .wrap -->

<?php
get_footer();
