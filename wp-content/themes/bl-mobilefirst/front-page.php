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
 * @version 1.4.3
 */

get_header();

$bl_pagedata = array(
	'header h1'  => '브릿지라잇 어학원',
	'slide id'   => 1752,
	'event id'   => 2071,
	'call title' => '전화상담&예약',
	'call text'  => '문의전화',
	'map title'  => '위치안내',
	'map text'   => '위치안내',
	'curr title' => '커리큘럼',
	'curr text'  => '커리큘럼',
	'camp title' => '방학영어캠프',
	'camp text'  => '영어캠프',
	'enrol title'=> '입학과정',
	'enrol text' => '입학과정',
	'faq title'  => '자주묻는질문',
	'faq text'   => 'FAQ',
	'news no'    => '<p>앗, 아무 뉴스도 없습니다. 하지만 우리는 열심히 공부하고 있어요!^^</p>',
	'event no'   => '오늘도 영어열공 중',
	'holiday'    => '* 빨강색 일정은 휴원',
	'why intro'  => '브릿지라잇 어학원의 건물은 작은 영어권 도시입니다. 선생님들, 학생들 모두가 영어로 대화하는 장면이 브릿지라잇에서는 일상입니다. 가이드가 확실한 영어권 도시로 \'매일\' 여행오세요.',
	'why alt'    => '브릿지라잇 본관 전경 (야간)',
	'curr intro' => '초등 1학년부터 중학 3학년까지를 모두 아우르는 단계별 강의들이 개설 되어 있습니다. 모든 레벨에서 영어의 전 영역인 말하기, 듣기, 읽기, 쓰기를 종합적으로 학습합니다.',
	'curr alt'   => '브릿지라잇 커리큘럼 로드맵',
	'go intro'   => '많은 이들이 영어를 가르칩니다. 그렇지만 모든 아이들이 학원 가기를 좋아하는 건 아닙니다. 브릿지라잇의 영어수업은 지식 뿐 아니라 재미와 행복을 함께 전합니다. 신나서 가는 학원, 브릿지라잇은 그 방향으로 갑니다.',
	'go alt'     => '여름방학 영어뮤지컬 캠프'
);

if ( $GLOBALS['pll_lang'] !== 'pll_ko' ) {
	$bl_pagedata['header h1']   = 'Bridge Light English Language School';
	$bl_pagedata['slide id']    = 2239;
	$bl_pagedata['event id']    = 2236;
	$bl_pagedata['call title']  = 'Dial Now';
	$bl_pagedata['call text']   = 'Dial Now';
	$bl_pagedata['map title']   = 'Location';
	$bl_pagedata['map text']    = 'Location';
	$bl_pagedata['curr title']  = 'Curriculum';
	$bl_pagedata['curr text']   = 'Curriculum';
	$bl_pagedata['camp title']  = 'English Camps';
	$bl_pagedata['camp text']   = 'English Camps';
	$bl_pagedata['enrol title'] = 'Admission';
	$bl_pagedata['enrol text']  = 'Admission';
	$bl_pagedata['faq title']   = 'Frequently Asked Questions';
	$bl_pagedata['faq text']    = 'FAQ';
	$bl_pagedata['news no']     = '<p>Oops, there is no news. However, we are studying here! :)</p>';
	$bl_pagedata['event no']    = 'We\'re enjoying learning English now!';
	$bl_pagedata['holiday']     = '* Red events mean closing';
	$bl_pagedata['why intro']   = 'The building of Bridge Light is a small English-spoken village. 브릿지라잇 어학원의 건물은 작은 영어권 도시입니다. 선생님들, 학생들 모두가 영어로 대화하는 장면이 브릿지라잇에서는 일상입니다. 가이드가 확실한 영어권 도시로 \'매일\' 여행오세요.';
	$bl_pagedata['why alt']     = 'Bridge Light Main Building';
	$bl_pagedata['curr intro']  = 'Step-by-step lectures are ready to embrace elementary 1st grade to middle school 3rd. 모든 레벨에서 영어의 전 영역인 말하기, 듣기, 읽기, 쓰기를 종합적으로 학습합니다.';
	$bl_pagedata['curr alt']    = 'Bridge Light Curriculum Roadmap';
	$bl_pagedata['go intro']    = 'Many teach English. 그렇지만 모든 아이들이 학원 가기를 좋아하는 건 아닙니다. 브릿지라잇의 영어수업은 지식 뿐 아니라 재미와 행복을 함께 전합니다. 신나서 가는 학원, 브릿지라잇은 그 방향으로 갑니다.';
	$bl_pagedata['go alt']      = 'English Musical Camp in Summer Vacation';
}
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<div id="bl-front-page" class="bl-wp-page">

			<header id="bl-main-title" class="bl-main-title">
				<h1><?php echo $bl_pagedata['header h1'] ?></h1>
			</header>

			<div class="bl-content-top">
				<div class="bl-slides">
				<?php
				$slides = json_decode( get_post_field( 'post_content', $bl_pagedata['slide id'] ) );
				$loading = 'eager';

				foreach ( (array) $slides as $s ) :
				?>
					<a href="<?php echo $s->link ?>">
						<div class="bl-link-wrapper">
							<img loading="<?php echo $loading ?>" class="size-medium wp-image-<?php echo $s->attach ?>" src="<?php echo $s->src ?>" srcset="<?php echo wp_get_attachment_image_srcset( $s->attach ) ?>" sizes="100vw" />
							<div class="bl-slide-title"><h2><?php echo $s->title ?></h2></div>
							<div class="bl-slide-caption"><?php echo $s->caption ?></div>
						</div>
					</a>
				<?php
				$loading = 'lazy';
				endforeach;
				?>
				</div>
				<div class="creed">
					<img loading="auto" src="/wp-content/themes/bl-mobilefirst/assets/images/widescreen/creed_en.jpg?ver=1.0" width="320" height="270" alt="교육 신조" />
				</div>
			</div>

			<div id="bl-quick-menu">
				<div class="tele"><a href="tel:033-243-5757"><i class="bl-sp icon-call" title="<?php echo $bl_pagedata['call title'] ?>"></i><span><?php echo $bl_pagedata['call text'] ?></span></a></div>
				<div class="appt"><a href="/admission/appt-and-visit/"><i class="bl-sp icon-map" title="<?php echo $bl_pagedata['map title'] ?>"></i><span><?php echo $bl_pagedata['map text'] ?></span></a></div>
				<div class="curr"><a href="/curriculum/course-overview/"><i class="bl-sp icon-book" title="<?php echo $bl_pagedata['curr title'] ?>"></i><span><?php echo $bl_pagedata['curr text'] ?></span></a></div>
				<div class="camp"><a href="/curriculum/english-camp/"><i class="bl-sp icon-devel" title="<?php echo $bl_pagedata['camp title'] ?>"></i><span><?php echo $bl_pagedata['camp text'] ?></span></a></div>
				<div class="admt"><a href="/curriculum/admission-process/"><i class="bl-sp icon-mortar" title="<?php echo $bl_pagedata['enrol title'] ?>"></i><span><?php echo $bl_pagedata['enrol text'] ?></span></a></div>
				<div class="faq"><a href="/admission/faq/"><i class="bl-sp icon-faq" title="<?php echo $bl_pagedata['faq title'] ?>"></i><span><?php echo $bl_pagedata['faq text'] ?></span></a></div>
			</div>

			<div class="bl-down-arrow-wrapper">
				<svg class="bl-down-arrow">
					<use xlink:href="#icon-angle-down" />
				</svg>
			</div>

			<div id="bl-news" class="bl-block">
				<div class="bl-block-header">
					<h2 class="bl-block-title">News</h2>
					<div class="bl-inline-link"><a href="/news-n-events##news">All News</a></div>
				</div>

				<?php
				$current_raw = 0;
				$current_ymd = '0000-00-00';
				$weekago_raw = 0;
				$weekago_ymd = '0000-00-00';

				$query = new WP_Query( array( 'category_name' => 'news' ) );
				if ( ! $query->have_posts() ) :
					echo $bl_pagedata['news no'];
				else :
					// 최근 글을 하나 이상 보여줌
					$query->the_post();
					while ( true ) :
				?>

				<a href="<?php the_permalink() ?>">
					<div class="bl-news-item">
						<div class="bl-block-header-media">
							<?php the_post_thumbnail() ?>
						</div>
						<div class="bl-wrap bl-block-content">
							<h2><?php the_title() ?></h2>
							<p class="bl more-link"><?php the_excerpt() ?></p>
						</div>
					</div>
				</a>

				<?php
						$query->the_post();

						$current_raw = strtotime( get_the_date( 'Y-m-d' ) );
						$current_ymd = get_the_date( 'Y-m-d' );
						$weekago_raw = time() - ( 7 * 24 * 60 * 60 );
						$weekago_ymd = date( 'Y-m-d', $weekago_raw );

						// 일주일 이상 지난 글은 보여주지 않음
						if ( $current_raw < $weekago_raw || ! $query->have_posts() ) {
							break;
						}
					endwhile;
					wp_reset_postdata();
				endif;
				?>

			</div><!-- #bl-news -->

			<div id="bl-event" class="bl-block">
				<div class="bl-block-header">
					<h2 class="bl-block-title">Events</h2>
					<div class="bl-inline-link"><a href="/news-n-events##events">All Events</a></div>
				</div>
				<div class="bl-wrap">

				<?php
				// Events 글의 아이디로 그 글의 내용인 JSON 코드 파싱
				$events = json_decode( get_post_field( 'post_content', $bl_pagedata['event id'] ) );
				$count = 0;
				$startdatef = '';
				$enddatef = '';
				$noeventdatef = '';

				// public(공개형) 이벤트 중 pending(확정되지 않은) 이벤트를 제외하고,
				// 날짜가 한 달 이내인 이벤트는 true를 return
				function bl_is_displayable( $event ) {
					// $time_start = strtotime( $event->{"start"} );
					$time_end = strtotime( $event->{"end"} );
					$public = $event->{"public"} && ! $event->{"pending"};
					$nearfuture = strtotime( "today -2 days" ) < $time_end && $time_end <= strtotime( "+30 days", time() );

					return $public && $nearfuture;
				}

				foreach ( (array) $events as $ev ) :
					// 표시되어야 할 이벤트인 경우만 화면 출력,
					// 하루 이벤트이면 (시작일과 종료일이 같음) 시작일만 표시, 기간을 가진 이벤트이면 시작일과 종료일을 함께 표시
					// 연속된 기간이 아닌 경우, 예로 시작일은 17일, 종료일은 19일, 18일은 해당 없음 같은 경우 그 사이에 ' ~ ' 대신에 ', '를 사용)
					if ( bl_is_displayable( $ev ) ) :
						$count++;
						$one_day = $ev->{"start"} == $ev->{"end"};
						$starttime = strtotime( $ev->{"start"} );
						$endtime = strtotime( $ev->{"end"} );
						// echo date( "Y-m-d H:i:s", strtotime($ev->{"start"}) )." / ".date( "Y-m-d H:i:s", strtotime($ev->{"end"}) )."<br>";

						if ( $GLOBALS['pll_lang'] !== 'pll_ko' ) {
							$startdatef = date( "M j D", $starttime );
							$enddatef = date( substr_compare( $ev->{"start"}, substr( $ev->{"end"}, 5, 2 ), 5, 2) == 0 ? "j D" : "M j D", $endtime );
							$noeventdatef = date( "M j D", time() );
						} else {
							$startdatef = blmobilefirst_w2k( date( "n\월 j\일 D", $starttime ) );
							$enddatef = blmobilefirst_w2k( date( substr_compare( $ev->{"start"}, substr( $ev->{"end"}, 5, 2 ), 5, 2) == 0 ? "j\일 D" : "n\월 j\일 D", $endtime ) );
							$noeventdatef = blmobilefirst_w2k( date( "n\월 j\일 D", time() ) );
						}
				?>
					<div class="bl-event-item<?php echo $ev->{"holiday"} ? ' bl-holiday' : ''; ?>" data-date="<?php echo $ev->{"start"} ?>">
						<div class="bl-tear-off">
							<div class="t-o-day"><?php echo date( "j", $starttime ) ?></div>
							<div class="t-o-mon"><?php echo date( "M", $starttime ) ?></div>
						</div>
						<div class="bl-event-info">
							<h2 class="e-i-title"><?php echo $ev->{"title"} ?></h2>
							<div class="e-i-date">
								<time itemprop="startDate" datetime="<?php echo $ev->{"start"} ?>"><?php echo $startdatef ?></time><?php if ( ! $one_day ) : ?><time itemprop="endDate" datetime="<?php echo $ev->{"end"} ?>"><?php echo $starttime == strtotime( "-1 day", $endtime ) || isset( $ev->{"separated"} ) ? ', ': ' ~ ' ?><?php echo $enddatef ?></time><?php endif; ?>
							</div>
							<div class="e-i-extra"><?php echo $ev->{"extra"} ?></div>
						</div>
					</div>
				<?php
					endif;
				endforeach;

				if ( $count == 0 ) :
					$today = date( "Y-m-d" );
					// $now = time();
				?>
					<div class="bl-event-item" data-date="<?php echo $today ?>">
						<div class="bl-tear-off">
							<div class="t-o-day"><?php echo date( "j" ) ?></div>
							<div class="t-o-mon"><?php echo date( "M" ) ?></div>
						</div>
						<div class="bl-event-info">
							<h2 class="e-i-title"><?php echo $bl_pagedata['event no'] ?></h2>
							<div class="e-i-date">
								<time itemprop="startDate" datetime="<?php echo $today ?>"><?php echo $noeventdatef ?></time>
							</div>
							<div class="e-i-extra"></div>
						</div>
					</div>
				<?php
				endif;
				?>
					<div class="bl-event-comment"><?php echo $bl_pagedata['holiday'] ?></div>
				</div>
			</div><!-- #bl-event -->

			<div id="bl-why-bl-frontpage" class="bl-block">
				<div class="bl-block-header">
					<h2 class="bl-block-title">Why Bridge Light</h2>
				</div>
				<a href="/about/why-bridge-light/">
					<div class="bl-link-wrapper">
						<div class="bl-block-header-media">
							<img loading="lazy" class="size-medium wp-image-2020" src="/wp-content/uploads/2020/02/main-building-at-night.jpg" srcset="<?php echo wp_get_attachment_image_srcset( 2020 ) ?>" sizes="100vw" alt="<?php echo $bl_pagedata['why alt'] ?>" />
						</div>
						<div class="bl-wrap">
							<p class="bl"><?php echo $bl_pagedata['why intro'] ?></p>
						</div>
					</div>
				</a>
			</div>

			<div id="bl-curriculum" class="bl-block">
				<div class="bl-block-header">
					<h2 class="bl-block-title">Curriculum</h2>
				</div>
				<a href="/curriculum/course-overview/">
					<div class="bl-link-wrapper">
						<div class="bl-block-header-media">
							<img loading="lazy" class="size-medium wp-image-2023" src="/wp-content/uploads/2020/02/Graphic-Roadmap-2019-09v2.jpg" srcset="<?php echo wp_get_attachment_image_srcset( 2023 ) ?>" sizes="100vw" alt="<?php echo $bl_pagedata['curr alt'] ?>" />
						</div>
						<div class="bl-wrap">
							<p class="bl"><?php echo $bl_pagedata['curr intro'] ?></p>
						</div>
					</div>
				</a>
			</div>

			<div id="bl-go-with-us" class="bl-block">
				<div class="bl-block-header">
					<h2 class="bl-block-title">Let's go with us</h2>
				</div>
				<a href="/admission/admission-process/">
					<div class="bl-link-wrapper">
						<div class="bl-block-header-media">
							<img loading="lazy" class="size-medium wp-image-802" src="/wp-content/uploads/2019/04/summer-musical-camp-2018.jpg" srcset="<?php echo wp_get_attachment_image_srcset( 802 ) ?>" sizes="100vw" alt="<?php echo $bl_pagedata['go alt'] ?>" />
						</div>
						<div class="bl-wrap">
							<p class="bl"><?php echo $bl_pagedata['go intro'] ?></p>
						</div>
					</div>
				</a>
			</div>

		</div><!-- #bl-front-page ->

	</main><!-- #main -->
</div><!-- #primary -->

<div class="bl-dev-code">
	<?php
/*		var_dump( $tt ); echo '<p></p>';
		var_dump( $st ); echo '<p></p>';
		var_dump( $et ); echo '<p></p>';
		var_dump( $pb ); echo '<p></p>';
		var_dump( $nf ); echo '<p></p>';
		echo '<p>t:'.time().'</p>';
		echo '<p>t30:'.strtotime( "+30 days", time() ).'</p>';
*/	?>
</div>

<?php get_footer();
