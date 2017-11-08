<?php

require_once(__DIR__ . '/ApiView.php');

class JsonView extends ApiView {

    public function render($content) {
        echo json_encode($content);
        return json_encode($content);
    }
}

