<?php

namespace App\Controllers;

use App\Models\ActivitiesModel;


class Activities extends BaseController
{

    public function save()
    {
        $session = session();
        $model = model(ActivitiesModel::class);

            $kcal_per_hour_men_60kg = [
                'walk3' => 182,
                'walk6' => 293,
                'run8' => 480,
                'run10' => 624,
                'run13' => 768,
                'run15' => 912,
                'bike' => 317,
                'swim' => 600,
                'fit' => 453,
                'body' => 325,
            ];

                $data = $this->request->getPost();

                $table = new \CodeIgniter\View\Table();
                $table->setHeading('Activity', 'Practice time (min)');

                $kcal = 0;
                foreach($data as $key => $element){
                    $table->addRow($key, $element);
                
            switch($key)
            {
                case 'walking_time_3km':
                    $kcal = ( $kcal_per_hour_men_60kg['walk3'] / 60 ) * $element;
                    break;
                case 'walking_time_6km':
                    $kcal += ( $kcal_per_hour_men_60kg['walk6'] / 60 ) * $element;
                    break;
                case 'running_time_8km':
                    $kcal += ( $kcal_per_hour_men_60kg['run8'] / 60 ) * $element;
                    break;
                case 'running_time_10km':
                    $kcal += ( $kcal_per_hour_men_60kg['run10'] / 60 ) * $element;
                    break;
                case 'running_time_13km':
                    $kcal += ( $kcal_per_hour_men_60kg['run13'] / 60 ) * $element;
                    break;
                case 'running_time_15km':
                    $kcal += ( $kcal_per_hour_men_60kg['run15'] / 60 ) * $element;
                    break;
                case 'bike_time':
                    $kcal += ( $kcal_per_hour_men_60kg['bike'] / 60 ) * $element;
                    break;
                case 'swimming_time':
                    $kcal += ( $kcal_per_hour_men_60kg['swim'] / 60 ) * $element;
                    break;
                case 'fitness_time':
                    $kcal += ( $kcal_per_hour_men_60kg['fit'] / 60 ) * $element;
                    break;
                case 'bodybuilding_time':
                    $kcal += ( $kcal_per_hour_men_60kg['body'] / 60 ) * $element;
                    break;
                case 'current_weight':
                    break;
                
            }
                }
                $template = [
                    'table_open' => '<table border="1" cellpadding="4" cellspacing="0" border-radius="10">',
                
                    'thead_open'  => '<thead style="background: #E3EBEE; font-size: 15px;">',
                    'thead_close' => '</thead>',
                
                    'row_start'  => '<tr style="background: #E3EBEE; font-size: 15px;">',
                
                    'row_alt_start'  => '<tr style="background: #E3EBAA; font-size: 15px;">',
                
                    'table_close' => '</table>',
                ];
                
                $table->setTemplate($template);
                $myAct = $table->generate();

                if ($this->request->getMethod() == 'post') {
                    $model->save([
                        'date' => date("Y-m-d"),
                        'walking_time_3km' => $this->request->getPost('walking_time_3km'), 
                        'walking_time_6km' => $this->request->getPost('walking_time_6km'), 
                        'running_time_8km' => $this->request->getPost('running_time_8km'), 
                        'running_time_10km' => $this->request->getPost('running_time_10km'),	
                        'running_time_13km' => $this->request->getPost('running_time_13km'),
                        'running_time_15km' => $this->request->getPost('running_time_15km'),
                        'bike_time' => $this->request->getPost('bike_time'),
                        'swimming_time' => $this->request->getPost('swimming_time'),
                        'fitness_time' => $this->request->getPost('fitness_time'),
                        'bodybuilding_time' => $this->request->getPost('bodybuilding_time'),
                        'current_weight' => $this->request->getPost('current_weight'),
                        'fk_user_id' => $session->id_user,
                        'total_kcal' => $kcal
                    ]);

                return view('templates/header', [
                    "arrayAct" => $myAct,
                    "kcal_lost" => $kcal
                ])
                    . view('neoness/detail')
                    . view('templates/footer'); 
            } else {
                echo "error";
            }
        }
    }