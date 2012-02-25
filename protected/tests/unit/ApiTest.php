<?php

class SiteTest extends CTestCase {

	public function testTalks() {
		$this->assertNotEquals(NULL, Yii::app()->db);
	}

}