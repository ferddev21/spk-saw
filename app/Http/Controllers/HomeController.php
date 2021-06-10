<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Criteria;
use App\Models\Alternative;
use Illuminate\Http\Request;
use App\Models\Criteriavariabel;
use App\Models\Alternativecriteria;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->provider = new Alternative();
        $this->criteria = new Criteria();
        $this->criteriaVariabel = new Criteriavariabel();
        $this->alternativeCriteria = new Alternativecriteria();
    }

    public function index()
    {
        $data = [
            'user' => User::first(),
            'criterias' => $this->criteria,
            'selections' => $this->alternativeCriteria->selections(),
            'alternativeCriteria' => $this->alternativeCriteria,
            'criteriaVariabel' => $this->criteriaVariabel
        ];
        return view('pages.home', $data);
    }
}
