<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model {
    use HasFactory;

    public static function menus() {
        $menus = DB::table('menus')
            ->where('parent_id', null)
            ->where('status', '=', 1)
            ->orderBy('position')->get();
        foreach ($menus as $item) {
            $item->childs = self::subMenus($item->id);
        }

        return $menus;


    }

    private static function subMenus($parent_id) {
        $childs = DB::table('menus')
            ->where('parent_id', '=', $parent_id)
            ->where('status', '=', 1)
            ->orderBy('position')->get();
        if (!is_null($childs)) {
            return $childs;

        } else {
            return null;
        }
    }


}
