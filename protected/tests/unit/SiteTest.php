<?php

class SiteTest extends CTestCase {

	public function testDbConnection() {
		$this->assertNotEquals(NULL, Yii::app()->db);
	}

}
