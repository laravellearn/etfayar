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
        $this->url = $url;
        $this->target = $target;
    }


    public function render() {
        return view('components.simple-button');
    }
}
