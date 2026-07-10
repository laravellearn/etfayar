<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormButton extends Component {

    public $permission;
    public $icon;
    public $url;
    public $click;
    public $title;
    public $target;
    public $type;

    public function __construct($url, $icon, $permission = null, $click = null, $title = null, $target = null, $type = null) {
        $this->permission = $permission;
        $this->icon = $icon;
        $this->url = $url;
        $this->title = $title;
        $this->click = $click;
        $this->target = $target;
        $this->type = $type;
    }


    public function render() {

        /*dd($this->click);*/
        return view('components.form-button');
    }
}
