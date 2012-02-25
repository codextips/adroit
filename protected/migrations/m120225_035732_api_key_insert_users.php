<?php

class m120225_035732_api_key_insert_users extends CDbMigration {

    public function safeUp() {
        $this->update('{{users}}', array(
            'api_key' => md5('phpfour@gmail.com' . time()),
        ), 'user_id = 1');
    }

    public function safeDown() {
        $this->update('{{users}}', array(
            'api_key' => null,
        ), 'user_id = 1');
    }

}