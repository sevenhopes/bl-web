<?php
/**
 * The front page template file
 *
 * 첫페이지로 정적인 페이지(static page)를 선택했을 때 보여짐
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BridgeLight
 * @subpackage BridgeLight_MobileFirst
 * @since 1.0
 * @version 1.1
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<div id="bl-front-page-ko" class="bl-wp-page">
			<header id="bl-main-title" class="bl-main-title">
				<h1>브릿지라잇 어학원</h1>
			</header>

			<div class="bl-slides">
			<?php
			$slides = json_decode( get_post_field( 'post_content', 1752 ) );

			foreach ( (array) $slides as $s ) :
			?>
				<a href="<?php echo $s->link ?>">
					<div class="bl-link-wrapper">
						<img src="<?php echo $s->img ?>" />
						<div class="bl-title"><h2><?php echo $s->title ?></h2></div>
						<div class="bl-caption"><?php echo $s->caption ?></div>
					</div>
				</a>
			<?php
			endforeach;
			?>
			</div>

			<div id="bl-front-menu">
				<div><a href="tel:033-243-5757"><img src="http://www.bridgelightels.com/m/wp-content/themes/2017-child/assets/images/icon-call.png" alt="전화상담&예약" /><span>문의전화</span></a></div>
				<div><a href="http://www.bridgelightels.com/m/admission/appt-and-visit/"><img src="http://www.bridgelightels.com/m/wp-content/themes/2017-child/assets/images/icon-map.png" alt="위치안내" /><span>위치안내</span></a></div>
				<div><a href="http://www.bridgelightels.com/m/curriculum/course-overview/"><img src="http://www.bridgelightels.com/m/wp-content/themes/2017-child/assets/images/icon-school.png" alt="커리큘럼" /><span>커리큘럼</span></a></div>
				<div><a href="http://www.bridgelightels.com/m/curriculum/english-camp/"><img src="http://www.bridgelightels.com/m/wp-content/themes/2017-child/assets/images/icon-devel.png" alt="방학영어캠프" /><span>영어캠프</span></a></div>
				<div><a href="http://www.bridgelightels.com/m/curriculum/study-in-america/"><img src="http://www.bridgelightels.com/m/wp-content/themes/2017-child/assets/images/icon-travel.png" alt="미국현지체험연수" /><span>미국연수</span></a></div>
				<div><a href="http://www.bridgelightels.com/m/admission/faq/"><img src="http://www.bridgelightels.com/m/wp-content/themes/2017-child/assets/images/icon-faq.png" alt="자주묻는질문" /><span>FAQ</span></a></div>
			</div>

			<div class="bl-indicator-wrapper">
				<svg class="bl-indicator">
					<use xlink:href="#icon-angle-down" />
				</svg>
			</div>

			<div id="bl-news" class="bl-block">
				<div class="bl-block-header">
					<h2 class="bl-block-title">News</h2>
					<div class="bl-inline-link"><a href="http://www.bridgelightels.com/m/news-n-events/#news">All News</a></div>
				</div>

				<?php
				$query = new WP_Query( array( 'category_name' => 'news' ) );
				if ( $query->have_posts() ) :
					// 최근 글을 하나 이상 보여줌. 일주일 이상 지난 글은 보여주지 않음.
					$query->the_post();
					while ( $query->have_posts() ) :
				?>

				<a href="<?php the_permalink(); ?>">
					<div class="bl-news-item">
						<div class="bl-block-header-media">
							<?php the_post_thumbnail(); ?>
						</div>
						<div class="bl-wrap bl-block-content">
							<h2><?php the_title(); ?></h2>
							<p class="bl more-link"><?php the_excerpt(); ?></p>
						</div>
					</div>
				</a>

				<?php
						if ( strtotime( get_the_date( 'Y-m-d' ) ) < time() - ( 7 * 24 * 60 * 60 ) ) {
							break;
						}
						$query->the_post();
					endwhile;
					wp_reset_postdata();
				else :
					echo "<p>앗, 아무 뉴스도 없습니다. 머쓱하네요. 머쓱타드 :p</p>";
				endif;
				?>

			</div>

			<div id="bl-event" class="bl-block">
				<div class="bl-block-header">
					<h2 class="bl-block-title">Events</h2>
					<div class="bl-inline-link"><a href="http://www.bridgelightels.com/m/news-n-events/#events">All Events</a></div>
				</div>
				<div class="bl-wrap">

				<?php
				// Events 글의 아이디로 그 글의 내용인 JSON 코드 파싱
				$events = json_decode( get_post_field( 'post_content', 1697 ) );

				foreach ( (array) $events as $ev ) :
					$starttime = strtotime( $ev->{"start"} );

					if ( $starttime >= strtotime( "+30 days", time() ) ) {
						break;
					}

					if ( is_frontpage_event( $ev ) ) :
					// echo date( "Y-m-d H:i:s", strtotime($ev->{"start"}) )." / ".date( "Y-m-d H:i:s", strtotime($ev->{"end"}) )."<br>";
				?>
					<div class="bl-event-item<?php echo $ev->{"holiday"} ? ' bl-holiday' : ( $ev->{"public"} ? '' : ' staff-event'); ?>" data-date="<?php echo $ev->{"start"} ?>">
						<div class="bl-tear-off">
							<div class="t-o-day"><?php echo date( "j", $starttime ) ?></div>
							<div class="t-o-mon"><?php echo date( "M", $starttime ) ?></div>
						</div>
						<div class="bl-event-info">
							<h2 class="e-i-title"><?php echo $ev->{"title"} ?></h2>
							<div class="e-i-date">
								<time itemprop="startDate" datetime="<?php echo $ev->{"start"} ?>"><?php echo bl_w2k( date( "n\월 j\일 D", $starttime ) ) ?></time><?php if ( $ev->{"end"} ) : $endtime = strtotime( $ev->{"end"} ); ?><time itemprop="endDate" datetime="<?php echo $ev->{"end"} ?>"><?php echo $starttime == strtotime( "-1 day", $endtime ) ? ', ' : ' ~ ' ?><?php echo bl_w2k( date( substr_compare( $ev->{"start"}, substr( $ev->{"end"}, 5, 2 ), 5, 2) == 0 ? "j\일 D" : "n\월 j\일 D", $endtime ) ) ?></time><?php endif; ?>
							</div>
							<div class="e-i-extra"><?php echo $ev->{"extra"} ?></div>
						</div>
					</div>
				<?php
					endif;
				endforeach;

				function is_frontpage_event( $ev ) {
					$public = $ev->{"public"} && ! $ev->{"pending"};
					$recent_start = strtotime( "+2 day", strtotime( $ev->{"start"} ) ) >= time();
					$recent_end = strtotime( $ev->{"start"} ) <= strtotime( "+30 days", time() );

					return $public && $recent_start && $recent_end;
				}
				?>
					<div class="bl-event-comment">* 빨강색 일정은 휴원</div>
				</div>
			</div>

			<div id="bl-why-bl-frontpage" class="bl-block">
				<div class="bl-block-header">
					<h2 class="bl-block-title">Why Bridge Light</h2>
				</div>
				<a href="http://www.bridgelightels.com/m/about/why-bridge-light/">
					<div class="bl-link-wrapper">
						<div class="bl-block-header-media">
							<img src="http://www.bridgelightels.com/m/wp-content/uploads/2019/04/main-building-at-night.jpg" alt="" width="1200" height="675" />
						</div>
						<div class="bl-wrap">
							<p class="bl">브릿지라잇 어학원의 건물은 작은 영어권 도시입니다. 선생님들, 학생들 모두가 영어로 대화하는 장면이 브릿지라잇에서는 일상입니다. 가이드가 확실한 영어권 도시로 '매일' 여행오세요.</p>
						</div>
					</div>
				</a>
			</div>

			<div id="bl-curriculum" class="bl-block">
				<div class="bl-block-header">
					<h2 class="bl-block-title">Curriculum</h2>
				</div>
				<a href="http://www.bridgelightels.com/m/curriculum/course-overview/">
					<div class="bl-link-wrapper">
						<div class="bl-block-header-media">
							<img class="wp-image-423 bl-center-overflow" src="http://www.bridgelightels.com/m/wp-content/uploads/2019/01/Graphic-Roadmap-2019-01v4.jpg" alt="Bridge Light Curriculum Map" width="1440" height="900" />
						</div>
						<div class="bl-wrap">
							<p class="bl">초등 1학년부터 중학 3학년까지를 모두 아우르는 단계별 강의들이 개설 되어 있습니다. 모든 레벨에서 영어의 전 영역인 말하기, 듣기, 읽기, 쓰기를 종합적으로 학습합니다.</p>
						</div>
					</div>
				</a>
			</div>

			<div id="bl-go-with-us" class="bl-block">
				<div class="bl-block-header">
					<h2 class="bl-block-title">Go with us</h2>
				</div>
				<a href="http://www.bridgelightels.com/m/admission/admission-process/">
					<div class="bl-link-wrapper">
						<div class="bl-block-header-media">
							<img class="wp-image-405" src="http://www.bridgelightels.com/m/wp-content/uploads/2019/04/summer-musical-camp-2018.jpg" alt="Summer Musical Camp" width="1200" height="675" />
						</div>
						<div class="bl-wrap">
							<p class="bl">많은 이들이 영어를 가르칩니다. 그치만 모든 아이들이 학원 가기를 좋아하는 건 아닙니다. 브릿지라잇의 영어수업은 지식 뿐 아니라 재미와 행복을 함께 전합니다. 신나서 가는 학원, 브릿지라잇은 그 방향으로 갑니다.</p>
						</div>
					</div>
				</a>
			</div>

			<?php
			// 페이지 중 하나인 전면 페이지(프론트 페이지)의 내용을 보여줌.
			// if ( have_posts() ) :
			// 	while ( have_posts() ) :
			// 		the_post();
			// 		the_content();
			// 	endwhile;
			// else :
			// 	get_template_part( 'template-parts/post/content', 'none' );
			// endif;
			?>

		</div>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
