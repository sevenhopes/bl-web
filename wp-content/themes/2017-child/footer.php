<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

		</div><!-- #content -->

		<div class="bl-share-layer">
			<div class="bl-share-box">
				<div class="title-container">
					<span class="title">공유 하기</span>
					<a class="close">
						<svg class="icon icon-close"><use xlink:href="#icon-close"></use></svg>
					</a>
				</div>
				<div class="container-wrap">
					<div class="button-container">
						<a id="bl-share-kakao" href="javascript:;">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-kakaolink.png"/>
						</a>
						<a>
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icb-urlcopy.png"/>
						</a>
					</div>
				</div>
			</div>
		</div>

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="wrap">

				<div id="bl-social-links">
					<div><a href="http://blog.naver.com/blcorp" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-blog.png" alt="브릿지라잇 블로그" />블로그</a></div>
					<div><a href="http://blog.naver.com/bomikimorr" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-inside.png" alt="브릿지라잇 인사이드" />인사이드</a></div>
					<div><a href="https://www.facebook.com/bridgelightels/" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-fb.png" alt="브릿지라잇 페이스북" />페이스북</a></div>
				</div>

				<ul>
					<li>방문·상담 전 전화예약 필수</li>
					<li>전화 <a href="tel:033-243-5757">033-243-5757</a>, <a href="tel:033-243-8484">8484</a></li>
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

				<div class="bl-footer-logo">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icw-bl-logo.png" />
				</div>

			</div><!-- .wrap -->
		</footer><!-- #colophon -->
	</div><!-- .site-content-contain -->
</div><!-- #page -->
<?php wp_footer(); ?>

<script type='text/javascript'>
	// 카카오톡 링크 버튼 (네비게이션 메뉴 마지막 아이템. navigatoin-long.js 참조)
  //<![CDATA[
    Kakao.init('402e01df01114b3ef841e557210bc62f');
    // // 카카오링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
    Kakao.Link.createDefaultButton({
      container: '#bl-share-kakao',
      objectType: 'location',
      address: '강원도 춘천시 스포츠타운길 534 (온의동)',
      addressTitle: '브릿지라잇 어학원',
      content: {
        title: 'English-only, 브릿지라잇 어학원',
        description: '033-243-5757 #초중영어 #방학영어캠프 #미국연수 #영어생활화 #매일수업',
        imageUrl: 'http://www.bridgelightels.com/m/wp-content/uploads/2019/05/og-image-1200x630.jpg',
        link: {
          mobileWebUrl: 'http://bridgelightels.com/m',
          webUrl: 'http://bridgelightels.com'
        }
      },
      // social: {
      //   likeCount: 286,
      //   commentCount: 45,
      //   sharedCount: 845
      // },
      buttons: [
        {
          title: '웹으로 보기',
          link: {
            mobileWebUrl: 'http://bridgelightels.com/m',
            webUrl: 'http://bridgelightels.com'
          }
        }
      ]
    });
  //]]>
</script>

</body>
</html>
