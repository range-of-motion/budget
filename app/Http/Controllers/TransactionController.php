<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller {
    public function create() {
        $tags = [];

        foreach (session('space')->tags as $tag) {
            $tags[] = ['key' => $tag->id, 'label' => '<div class="row"><div class="row__column row__column--compact row__column--middle mr-1"><div style="width: 15px; height: 15px; border-radius: 2px; background: #' . $tag->color . ';"></div></div><div class="row__column row__column--middle">' . $tag->name . '</div></div>'];
        }

        return view('transactions.create', compact('tags'));
    }
}
