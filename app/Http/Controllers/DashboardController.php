<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\PetDiseasesChart;
use App\Charts\PetGroomedChart;
use DB;
use Carbon;
use App\Models\Pet;
use App\Models\Serviceinfo;
use App\Models\Consultation;
use App\Models\Groomingtransaction;
use App\Models\Grooming;

class DashboardController extends Controller
{
    public function __construct(){
        $this->bgcolor = collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#EAF1F5"]);
    }
    
    public function index(Request $request)
    {
        $petdiseases = DB::table('checkups')
        ->join('serviceinfos','serviceinfos.id','checkups.serviceinfos_id')
        ->join('pets','pets.id','checkups.pet_id')
        ->groupBy('diseases_injuries')
        ->orderBy('total')
        ->pluck(DB::raw('count(diseases_injuries) as total'),'diseases_injuries')
        ->all();
        $petdiseasesChart = new PetDiseasesChart;
        $dataset = $petdiseasesChart->labels(array_keys($petdiseases));
        $dataset= $petdiseasesChart->dataset('Diseases/ Injuries Suffered by Pets Demographics', 'doughnut', array_values($petdiseases));
        $dataset= $dataset->backgroundColor($this->bgcolor);
        $petdiseasesChart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            // 'maintainAspectRatio' =>true,
            // 'title' => 'test',
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                            'display'=>false,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> false],
                            ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            //'barThickness' => 100,
                            'barPercentage' => 1,
                            'ticks' => ['beginAtZero' => false],
                            'gridLines' => ['display' => false],
                            'display' => false
                            ]],
            ],
        ]);

     //Pets Groomed - Quiz 4 
        $startdates = '2022-08-05';
        $enddates = '2022-08-15';
        $petgroomed = DB::table('serviceinfos_groomings')
                        ->join('groomings', 'groomings.id', 'serviceinfos_groomings.groomings_id')
                        ->join('pets', 'pets.id', 'serviceinfos_groomings.pet_id')
                        ->join('serviceinfos', 'serviceinfos.id', 'serviceinfos_groomings.serviceinfos_id')
                        ->join('users', 'users.id', 'serviceinfos.user_id')
                        ->join('pet_user', 'pet_user.pet_id', 'pets.id')
                        ->groupBy('serviceinfos.date_serviced')
                        ->whereBetween('serviceinfos.date_serviced', [$startdates, $enddates])
                        ->pluck(DB::raw('count(pets.id) as total'), 'serviceinfos.date_serviced')
                        ->toArray();
        $petgroomedChart = new PetGroomedChart;
        $dataset = $petgroomedChart->labels(array_keys($petgroomed));
        $dataset= $petgroomedChart->dataset('Number of Pets Groomed', 'line', array_values($petgroomed));
        $dataset= $dataset->backgroundColor($this->bgcolor);
        $petgroomedChart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            'aspectRatio' => 1,
            'scaleBeginAtZero' =>true,
            'scales' => [
                'yAxes'=> [[
                    'display'=>true,
                    'type'=>'linear',
                    'scaleLabel'=> [
                                'display'=> true,
                                'labelString'=> 'Number of Pets'
                            ],
                    'ticks'=> [
                        'beginAtZero'=> true,
                        // 'autoSkip' => true,
                        // 'maxTicksLimit' =>200,
                        'suggestedMin'=>0,
                        // 'max'=>100,
                        'steps' => 2,
                        'stepValue' => 10
                    ]]],
                    'gridLines'=> ['display'=> false],
                ],
                'xAxes'=> [
                    'categoryPercentage'=> 0.8,
                    'barPercentage' => 1,
                    'gridLines' => ['display' => false],
                    'display' => true,
                    'ticks' => [
                        'beginAtZero' => true,
                        'min'=> 0,
                        'stepSize'=> 10,
                    ],
                ]

        ]);
        return view('home',compact('petdiseasesChart', 'petgroomedChart'));
    }

    public function search(Request $request){
        //Pet Diseases - Quiz 5 
        $petdiseases = DB::table('checkups')
        ->join('serviceinfos','serviceinfos.id','checkups.serviceinfos_id')
        ->join('pets','pets.id','checkups.pet_id')
        ->groupBy('diseases_injuries')
        ->orderBy('total')
        ->pluck(DB::raw('count(diseases_injuries) as total'),'diseases_injuries')
        ->all();
        $petdiseasesChart = new PetDiseasesChart;
        $dataset = $petdiseasesChart->labels(array_keys($petdiseases));
        $dataset= $petdiseasesChart->dataset('Diseases/ Injuries Suffered by Pets Demographics', 'doughnut', array_values($petdiseases));
        $dataset= $dataset->backgroundColor($this->bgcolor);
        $petdiseasesChart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            // 'maintainAspectRatio' =>true,
            // 'title' => 'test',
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                            'display'=>false,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> false],
                            ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            //'barThickness' => 100,
                            'barPercentage' => 1,
                            'ticks' => ['beginAtZero' => false],
                            'gridLines' => ['display' => false],
                            'display' => false
                            ]],
            ],
        ]);

     //Pets Groomed - Quiz 4 
        $start = $request->startDate;
        $end = $request->endDate;
        $petgroomed = DB::table('serviceinfos_groomings')
                        ->join('groomings', 'groomings.id', 'serviceinfos_groomings.groomings_id')
                        ->join('pets', 'pets.id', 'serviceinfos_groomings.pet_id')
                        ->join('serviceinfos', 'serviceinfos.id', 'serviceinfos_groomings.serviceinfos_id')
                        ->join('users', 'users.id', 'serviceinfos.user_id')
                        ->join('pet_user', 'pet_user.pet_id', 'pets.id')
                        ->groupBy('serviceinfos.date_serviced')
                        ->whereBetween('serviceinfos.date_serviced', [$start, $end])
                        ->pluck(DB::raw('count(pets.id) as total'), 'serviceinfos.date_serviced')
                        ->toArray();
        $petgroomedChart = new PetGroomedChart;
        $dataset = $petgroomedChart->labels(array_keys($petgroomed));
        $dataset= $petgroomedChart->dataset('Number of Pets Groomed', 'line', array_values($petgroomed));
        $dataset= $dataset->backgroundColor($this->bgcolor);
        $petgroomedChart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            'aspectRatio' => 1,
            'scaleBeginAtZero' =>true,
            'scales' => [
                'yAxes'=> [[
                    'display'=>true,
                    'type'=>'linear',
                    'scaleLabel'=> [
                                'display'=> true,
                                'labelString'=> 'Number of Pets'
                            ],
                    'ticks'=> [
                        'beginAtZero'=> true,
                        // 'autoSkip' => true,
                        // 'maxTicksLimit' =>200,
                        'suggestedMin'=>0,
                        // 'max'=>100,
                        'steps' => 2,
                        'stepValue' => 10
                    ]]],
                    'gridLines'=> ['display'=> false],
                ],
                'xAxes'=> [
                    'categoryPercentage'=> 0.8,
                    'barPercentage' => 1,
                    'gridLines' => ['display' => false],
                    'display' => true,
                    'ticks' => [
                        'beginAtZero' => true,
                        'min'=> 0,
                        'stepSize'=> 10,
                    ],
                ]

        ]);
        return view('home',compact('petdiseasesChart', 'petgroomedChart'));
    }
}
