<?php
/**
 * Template Name: ADMISSIONS 예약 및 방문
 *
 * 예약 및 방문
 *
 * @package BridgeLight
 * @subpackage BridgeLight_MobileFirst
 * @since 2017 Child 1.0
 */

get_header(); ?>

<div id="appt-and-visit" class="">

	<div class="bl-page-header">
		<div class="bl-page-title">Appointment & Visit</div>
		<h1 class="bl-heading">예약 및 방문</h1>
	</div>

	<div class="bl-block">
		<div class="bl-block-header">
			<h2 class="bl-block-title">전화 예약</h2>
		</div>

		<div class="bl-wrap">
			<ul>
				<li>전화번호 : 033-243-5757 / 033-243-8484</li>
				<li>영업시간 : 월 ~ 금, 오후 2:00 ~ 9:00</li>
				<li class="bl-ue">방문 전 꼭 전화로 예약을 부탁 드립니다.</li>
			</ul>
		</div>
	</div>

	<div class="bl-block">
		<div class="bl-block-header">
			<h2 class="bl-block-title">어학원 위치</h2>
		</div>

		<div class="bl-wrap">
			<h3>주소</h3>
			<ul>
				<li>도로명 : 강원도 춘천시 스포츠타운길 534</li>
				<li>지번명 : 강원도 춘천시 온의동 65-27</li>
			</ul>

			<h3>지도</h3>
			<div class="bl-wrap-more">
				<div id="bl-map"></div>
			</div>

			<h3>거리</h3>
			<div class="bl-wrap-more">
				<div id="bl-street"></div>
			</div>
		</div>
	</div>

</div>

<?php
get_footer();
