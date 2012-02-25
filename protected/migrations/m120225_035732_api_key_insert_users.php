<?php

class m120225_035732_api_key_insert_users extends CDbMigration {

    public function safeUp() {
        $this->update('{{users}}', array(
            'api_key' => '10380b4c41b6d052ee39cece043e9d9a',
        ), 'user_id = 1');
    }

    public function safeDown() {
        $this->update('{{users}}', array(
            'api_key' => null,
        ), 'user_id = 1');
    }

}