<?php
/**
 * Template Name: ABOUT 강사진
 *
 * 강사진
 *
 * @package BridgeLight
 * @subpackage BridgeLight_MobileFirst
 * @since 2017 Child 1.0
 */

get_header(); ?>

<?php
class Teacher {
	public $cssclass, $name, $title, $pos, $charge, $ext;
	function __construct( $cssclass, $title, $name, $charge = array("Basic Program"), $pos = "강사 / 교육연구부", $ext = "" ) {
		$this->cssclass = $cssclass;
		$this->title = $title;
		$this->name = $name;
		$this->charge = $charge;
		$this->pos = $pos;
		$this->ext = $ext;
	}
}
$teachers = array(
	new Teacher( "t-david",		"원장 데이빗 오어",			"오어 데이빗 'Mr. Orr'",	array("Stage Program"), "원장" ),
	new Teacher( "t-bomi",		"부원장 김보미",				"김 보 미 'Mrs. Orr'",		array("Basic Program","Stage Program"), "부원장" ),
	new Teacher( "t-yoomi",		"원감 김유미",					"김 유 미 'Mrs. Kim'",		array("입학 상담","Basic Program"), "원감" ),
	new Teacher( "t-peter", 	"팀장 이상인 (Peter)",	"이 상 인 'Peter'",			array("Stage Program","Special Program"), "팀장 / 교육연구부" ),
	new Teacher( "t-dean",		"팀장 윤영호 (Dean)",	"윤 영 호 'Dean'",				array("Stage Program", "Basic Program"), "팀장 / 교육연구부" ),
	new Teacher( "t-ethan", 	"실장 이혁수 (Ethan)",	"이 혁 수 'Ethan'",			array("IT, PR, HR"), "실장 / 시스템인터넷사업실" ),
	new Teacher( "t-eunji", 	"팀장 이은지", 				"이 은 지 'Eunji'",			array("교무 운용"), "팀장 / 교육연구부" ),
	new Teacher( "t-rachel",	"강사 함영진 (Rachel)","함 영 진 'Rachel'" ),
	new Teacher( "t-semie",		"강사 김승미 (Semie)",	"김 승 미 'Semie'" ),
	new Teacher( "t-angela",	"강사 김윤희 (Angela)","김 윤 희 'Angela'",			array("Stage Program") ),
	new Teacher( "t-jamie",		"강사 박진희 (Jamie)",	"박 진 희 'Jamie'" ),
	new Teacher( "t-elena",		"강사 정해린 (Elena)",	"정 해 린 'Elena'" ),
	new Teacher( "t-sheldon",	"강사 쉘든 와인거스트",	"와인거스트 쉘든",				array("Basic Program"), "강사 / 교육연구부" ),
	new Teacher( "t-finn",		"강사 핀 스킬톤",				"스킬톤 핀 'Finn'",			array("Stage Program","Basic Program") ),
	new Teacher( "t-irene",		"강사 윤윤주 (Irene)",	"윤 윤 주 'Irene'" ),
	new Teacher( "t-julia",		"강사 김지향 (Julia)",	"김 지 향 'Julia'" ),
	new Teacher( "t-scarlett","강사 이지현 (Scarlett)",	"이 지 현 'Scarlett'" ),
	new Teacher( "t-jessy",		"강사 양선정 (Jessy)", "양 선 정 'Jessy'" ),
	new Teacher( "t-yunah",		"강사 이윤아 (Yunah)", "이 윤 아 'Yunah'" ),
	new Teacher( "t-eva",			"강사 임연주 (Eva)",		"임 연 주 'Eva'" ),
	new Teacher( "t-judy",		"실장 곽내원 (Judy)",	"곽 내 원 'Judy'",				array("일반 상담"), "실장 / 상담관리실" )
);
?>

<div id="teachers" class="">

	<div class="bl-page-header">
		<div class="bl-page-title">Teachers</div>
		<h1 class="bl-heading">강사진</h1>
	</div>

	<div class="bl-block">
		<div class="bl-wrap-more">

			<?php
			foreach ($teachers as $t) :
			?>

			<div class="bl-t-profile">
				<div class="bl-t-pic">
					<i class="t-bl-sp <?php echo $t->cssclass ?>" title="<?php echo $t->title ?>"></i>
				</div>
				<div class="bl-t-info">
					<span class="bl-t-name" <?php echo $t->ext ?>><?php echo $t->name ?></span>
					<span class="bl-t-position" <?php echo $t->ext ?>><?php echo $t->pos ?></span>
					<?php
					foreach( $t->charge as $ch) :
					?>
						<span class="bl-t-charge"><?php echo $ch ?></span>
					<?php
					endforeach;
					?>
				</div>
			</div>

			<?php
			endforeach;
			?>

		</div>
	</div>

</div>

<?php
get_footer();
