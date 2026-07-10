<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LatestPreinvoiceList extends Component {

    public $permission;
    public $list;

    public function __construct($permission = null,$list = null) {
        $this->permission = $permission;
        $this->list = $list;
    }

    public function render() {
        return view('components.dashboard.latest-preinvoice-list');
    }
}
