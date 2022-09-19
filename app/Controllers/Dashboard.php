<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\ActivitiesModel;

class Dashboard extends BaseController
{
    public static function Weekly()
    {
        $session = session();
        $model = new ActivitiesModel();
        $activities = $model->getActivity(0);
        $db = \Config\Database::connect();

        $table = new \CodeIgniter\View\Table();
        $table->setHeading('Date', 'kcal lost');

        $query = $db->query('SELECT `total_kcal`, `date` FROM activities WHERE `fk_user_id` = 0 && `date` >= (NOW() - INTERVAL 7 DAY)');
        $result = $query->getResultArray();

        $total = 0;
        for($i=0;$i<count($result);$i++)
        {
            $table->addRow($result[$i]['date'], $result[$i]['total_kcal']);
            $total += $result[$i]['total_kcal'];
        }
        $table->setFooting('Subtotal', $total);
        $template = [
            'table_open' => '<table border="1" cellpadding="4" cellspacing="0" border-radius="10">',
            'thead_open'  => '<thead style="background: #E3EBEE; font-size: 15px;">',
            'thead_close' => '</thead>',
            'row_start'  => '<tr style="background: #E3EBEE; font-size: 15px;">',
            'row_alt_start'  => '<tr style="background: #E3EBAA; font-size: 15px;">',
            'table_close' => '</table>',
        ];    
                    
        $table->setTemplate($template);
        return $table->generate();
    }

    public static function monthly()
    {
        $session = session();
        $model = new ActivitiesModel();
        $activities = $model->getActivity(0);
        $db = \Config\Database::connect();

        $table = new \CodeIgniter\View\Table();
        $table->setHeading('Date', 'kcal lost');

        $query = $db->query('SELECT `total_kcal`, `date` FROM activities WHERE `fk_user_id` = 0 && `date` >= (NOW() - INTERVAL 1 MONTH)');
        $result = $query->getResultArray();

        for($i=0;$i<count($result);$i++)
        {
            $table->addRow($result[$i]['date'], $result[$i]['total_kcal']);
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
        echo $table->generate();
    }
}