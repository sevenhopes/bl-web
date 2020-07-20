<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BridgeLight
 * @subpackage BridgeLight_MobileFirst
 * @since 1.0
 * @version 1.3
 */

?>

		</div><!-- #content -->

		<div class="bl-share-layer">
			<div class="bl-share-box">
				<div class="title-container">
					<span class="title">공유하기</span>
					<div id="bl-close-sharelayer">
						<a href="">
							<div class="bl-x-wrapper">
								<div class="icon-close"></div>
							</div>
						</a>
					</div>
				</div>
				<div class="container-wrap">
					<div class="button-container">
						<div>
							<a id="bl-share-kakao" href="javascript:;">
								<i class="bl-sp icon-kakaolink"></i>
								<div>카카오톡</div>
							</a>
						</div>
						<div>
							<a id="bl-share-facebook" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>">
								<i class="bl-sp icon-fb-box"></i>
								<div>페이스북</div>
							</a>
						</div>
						<div id="bl-copy-page-url">
							<a href="">
								<i class="bl-sp icb-urlcopy"></i>
								<div>현재 페이지</div>
							</a>
						</div>
						<div id="bl-copy-home-url">
							<a href="">
								<i class="bl-sp icb-urlhomecopy"></i>
								<div>웹사이트 홈</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="wrap">

				<div id="bl-social-links">
					<div><a href="http://blog.naver.com/blcorp" target="_blank"><i class="bl-sp icon-blog" title="브릿지라잇 블로그"></i>블로그</a></div>
					<div><a href="http://blog.naver.com/bomikimorr" target="_blank"><i class="bl-sp icon-inside" title="브릿지라잇 인사이드"></i>인사이드</a></div>
					<div><a href="https://www.facebook.com/bridgelightels/" target="_blank"><i class="bl-sp icon-fb" title="브릿지라잇 페이스북"></i>페이스북</a></div>
				</div>

				<ul>
					<li>방문·상담 전 전화예약 필수</li>
					<li>전화 033-243-5757</li>
					<!-- <li>전화 <a href="tel:033-243-5757">033-243-5757</a>, <a href="tel:033-243-8484">8484</a></li> -->
					<li>팩스 033-243-8484</li>
					<li>평일 오후 2:00 ~ 9:00</li>
					<li>주말, 공휴일 휴무</li>
					<li>24433 강원도 춘천시 스포츠타운길 534 (온의동)</li>
					<li>춘천교육지원청 등록 제907호 브릿지라잇 어학원</li>
					<li>사업자등록번호 221-81-37802</li>
					<li>개인정보취급방침</li>
					<li>이메일무단수집거부</li>
					<li>ⓒ 브릿지라잇 2006-<?php echo date("Y"); ?></li>
				</ul>

				<!-- <div class="bl-footer-logo"></div> -->
				<svg class="bl-footer-logo" role="img">
					<use href="#svg-bl-logo" xlink:href="#svg-bl-logo"></use>
				</svg>
				<!-- <svg class="icon" style="width:50px;height:50px;" role="img"> -->
					<!-- <use href="#icon-search" xlink:href="#icon-search"></use> -->
					<!-- <use href="#bl-icon-close" xlink:href="#bl-icon-close"></use> -->
				<!-- </svg> -->

				<div class="bl-dev-code">
					<?php
						// echo $_SERVER['HTTP_USER_AGENT'] . "<br>";
						// echo '<p>c-raw: '.$current_raw.'</p>';
						// echo '<p>w-raw: '.$weekago_raw.'</p>';
						// echo '<p>c-ymd: '.$current_ymd.'</p>';
						// echo '<p>w-ymd: '.$weekago_ymd.'</p>';
					echo '<p>'.get_stylesheet_directory().'/inc/icon-functions.php'.'</p>';
					echo '<p>'.get_stylesheet_directory_uri().'/assets/images/bl-svg-icons.svg'.'</p>';
					?>
				</div>

			</div><!-- .wrap -->
		</footer><!-- #colophon -->

	</div><!-- .site-content-contain -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
