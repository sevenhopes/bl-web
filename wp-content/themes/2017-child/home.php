<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BridgeLight
 * @subpackage BridgeLight_MobileFirst
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div id="news-n-events" class="wrap">
	<?php if ( is_home() && ! is_front_page() ) : ?>
		<header class="bl-page-header">
			<h1 class="bl-page-title"><?php single_post_title(); ?></h1>
		</header>
	<?php else : ?>
	<header class="bl-page-header">
		<h2 class="bl-page-title"><?php _e( 'Posts', '2017-child' ); ?></h2>
	</header>
	<?php endif; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div id="news" class="bl-block">
				<div class="bl-block-header">
					<h2 class="bl-block-title">News</h2>
				</div>
				<div class="bl-wrap">

			<?php
			if ( have_posts() ) :

				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					if ( get_post_status() == 'publish' ) :
						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/post/content', get_post_format() );

					endif;

				endwhile;

				the_posts_pagination(
					array(
						'prev_text'          => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', '2017-child' ) . '</span>',
						'next_text'          => '<span class="screen-reader-text">' . __( 'Next page', '2017-child' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( '', '2017-child' ) . ' </span>',
					)
				);

			else :

				get_template_part( 'template-parts/post/content', 'none' );

			endif;
			?>

				</div>
			</div>

			<div id="events" class="bl-block">
				<div class="bl-block-header">
					<h2 class="bl-block-title">Events</h2>
				</div>
				<div class="bl-wrap">

				<?php
				// Events 글의 아이디로 그 글의 내용인 JSON 코드 파싱
				$events = json_decode( get_post_field( 'post_content', 2071 ) );
				$count = 0;

				// public(공개형) 이벤트 중 pending(확정되지 않은) 이벤트를 제외한 모든 이벤트는 true를 return
				function is_displayable( $event ) {
					$starttime = strtotime( $event->{"start"} );
					$endtime = strtotime( $event->{"end"} );
					$public = $event->{"public"} && ! $event->{"pending"};

					return $public; // && $nearfuture;
				}

				foreach ( (array) $events as $ev ) :
					// 표시되어야 할 이벤트인 경우만 화면 출력,
					// 하루 이벤트이면 (시작일과 종료일이 같음) 시작일만 표시, 기간을 가진 이벤트이면 시작일과 종료일을 함께 표시
					// 연속된 기간이 아닌 경우, 예로 시작일은 17일, 종료일은 19일, 18일은 해당 없음 같은 경우 그 사이에 ' ~ ' 대신에 ', '를 사용)
					if ( is_displayable( $ev ) ) :
						$count++;
						$one_day = $ev->{"start"} == $ev->{"end"};
						$starttime = strtotime( $ev->{"start"} );
						$endtime = strtotime( $ev->{"end"} );
						// echo date( "Y-m-d H:i:s", strtotime($ev->{"start"}) )." / ".date( "Y-m-d H:i:s", strtotime($ev->{"end"}) )."<br>";
				?>
					<div class="bl-event-item<?php echo $ev->{"holiday"} ? ' bl-holiday' : ''; ?>" data-date="<?php echo $ev->{"start"} ?>">
						<div class="bl-tear-off">
							<div class="t-o-day"><?php echo date( "j", $starttime ) ?></div>
							<div class="t-o-mon"><?php echo date( "M", $starttime ) ?></div>
						</div>
						<div class="bl-event-info">
							<h2 class="e-i-title"><?php echo $ev->{"title"} ?></h2>
							<div class="e-i-date">
								<time itemprop="startDate" datetime="<?php echo $ev->{"start"} ?>"><?php echo bl_w2k( date( "n\월 j\일 D", $starttime ) ) ?></time><?php if ( ! $one_day ) : $endtime = strtotime( $ev->{"end"} ); ?><time itemprop="endDate" datetime="<?php echo $ev->{"end"} ?>"><?php echo $starttime == strtotime( "-1 day", $endtime ) || isset( $ev->{"separated"} ) ? ', ': ' ~ ' ?><?php echo bl_w2k( date( substr_compare( $ev->{"start"}, substr( $ev->{"end"}, 5, 2 ), 5, 2) == 0 ? "j\일 D" : "n\월 j\일 D", $endtime ) ) ?></time><?php endif; ?>
							</div>
							<div class="e-i-extra"><?php echo $ev->{"extra"} ?></div>
						</div>
					</div>
				<?php
					endif;
				endforeach;

				if ( $count == 0 ) :
					$today = date( "Y-m-d" );
					$now = time();
				?>
					<div class="bl-event-item" data-date="<?php echo $today ?>">
						<div class="bl-tear-off">
							<div class="t-o-day"><?php echo date( "j" ) ?></div>
							<div class="t-o-mon"><?php echo date( "M" ) ?></div>
						</div>
						<div class="bl-event-info">
							<h2 class="e-i-title">오늘도 영어열공 중</h2>
							<div class="e-i-date">
								<time itemprop="startDate" datetime="<?php echo $today ?>"><?php echo bl_w2k( date( "n\월 j\일 D", $now ) ) ?></time>
							</div>
							<div class="e-i-extra"></div>
						</div>
					</div>
				<?php
				endif;
				?>
					<div class="bl-event-comment"><span class="bl-red">* 빨강색 일정은 휴원</span></div>
				</div>
			</div><!-- #events -->

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php //사이드바 비활성 get_sidebar(); ?>
</div><!-- .wrap -->

<?php
get_footer();
