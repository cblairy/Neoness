<?php namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
 
 
class GoogleCharts extends Controller
{
 
    public function index() {
 
        $db = \Config\Database::connect();
        $builder = $db->table('users');   
        print_r($builder);
        $query = $builder->query("SELECT COUNT(id_user) as count,DAY(birthday) as day_date FROM users WHERE `BMI` > '15'");
 
      $data['coucou'] = $query->getResult();
         
        return view('home',$data);
    }
 
}