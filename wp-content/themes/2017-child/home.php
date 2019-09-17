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
				$events = json_decode( get_post_field( 'post_content', 1697 ) );

				if ( $events ) :
					foreach ( $events as $ev ) :
						$starttime = strtotime( $ev->{"start"} );

						/* 공개 설정된 이벤트만 보여줌
						 * 날짜가 정해지지 않은 경우(pending) t-o-day의 텍스트를 '?'로 바꾸고, <time>태그 텍스트에서 날짜 표시 대신 '0월 중'으로 표시
						 * <time> 태그 부분에 대해:
						 *   bl_w2k는 영어 요일을 한글 요일로 바꾸어 줌 (예. Wed -> 수)
						 *   <time>내의 if문은 이벤트가 1일 이상인 경우(끝날짜가 존재하는 경우) 끝날짜 부분 추가
						 *   시작날짜와 끝날짜가 하루 차이면(딱 2일 이벤트의 경우), 날짜 사이에 '~' 대신 ',' 쉼표를 표시. 3일 이상 이벤트만 '~' 표시
						 *   1일 이상 이벤트 중에 다음달로 끝날짜가 넘어가는 경우(예. 1월 30일 ~ 2월 5일)에만 끝날짜의 월 표시
						 */
						if ( $ev->{"public"} ) :
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
						endif;
					endforeach;
				else :
					echo "앗, 아무 이벤트도 없습니다. 머쓱하네요. 머쓱타드 :p\n";
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
