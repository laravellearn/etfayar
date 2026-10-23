<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SimpleButton extends Component {

    public $permission;
    public $title;
    public $url;
    public $target;


    public function __construct($title, $url, $permission = null, $target = null) {
        $this->permission = $permission;
        $this->title = $title;
        $this->url = is_null($url)
            ? null
            : html_entity_decode($url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $this->target = $target;
    }


    public function render() {
        return view('components.simple-button');
    }
}
