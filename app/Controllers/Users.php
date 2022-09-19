<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\ActivitiesModel;


class Users extends BaseController
{
    protected $helpers = ['users'];

    public function login()
    {
        $model = new UsersModel();

        // encryption password
        $pass = $this->request->getPost('password');
        $password = hash('sha256', $pass);

        // data from the login form
        $dataUserByForm = [
            'email' => $this->request->getPost('email'),
            'password' => $password
        ];
        
        // data from database
        $dataUser = $model->getUser($dataUserByForm['email']);

        $checkUser = [
            'email' => $dataUser['email'],
            'password' => $dataUser['password'],
        ];


        // connection requirement
        if($dataUserByForm['email'] == $checkUser['email'] && $dataUserByForm['password'] == $checkUser['password']){
            $session = session();

            $dataSession = [
                'email' => $dataUser['email'],
                'name' => $dataUser['name'],
                'phone' => $dataUser['phone'],
                'firstname' => $dataUser['firstname'],
                'BMI' => $dataUser['BMI'],
                'id_user' => $dataUser['id_user'],
                'is_admin' => $dataUser['is_admin'],
                'logged_in' => TRUE,
                'is_online_today' => date('Y-m-d')
            ];

            $session->set($dataSession);


            return $this->checkSession()
                . view('templates/header')
                . view('neoness/index')
                . view('templates/footer');


        } else {
            return $this->checkSession()
            . view('templates/header', ['data' => 'connection refused.'])
            . view('neoness/index')
            . view('templates/footer');
        }
    }

        // function check session 
    public function checkSession() 
    {
            $session = session();
            var_dump($session->logged_in);
            if($session->logged_in != TRUE)
            {
                header("Location: /home/disconnect");
                echo "You have been disconnected";
                die();

            } else {
                // text
            }
    }
        //$db = \Config\Database::connect();
        //$query = $db->query('SELECT * FROM users');
        //$results = $query->getResultArray();
        // $table = new \CodeIgniter\View\Table();
        // $template = [
        //     'table_open' => '<table border="0.5" cellpadding="4" cellspacing="10">',
        // ];
        
        // $table->setTemplate($template);

        // $data = [
        //     'user' => $model->getUser('coco@coco.fr')
        // ];

        // echo $table->generate($data);

    public function home()
    {
                if(uri_string() == "home/signOut" || uri_string() == "home/disconnect"){
                    return view('templates/header', ['data' => 'You have been disconnected'])
                    . view('neoness/index')
                    . view('templates/footer');
                } else {
                    
                    $data = Dashboard::Weekly();
                    return view('templates/header', ['arrayWeekly' => $data])
                        . view('neoness/index')
                        . view('templates/footer');
                }
    }



    public function signUp()
    {   // redirect from registration link
        if($this->request->getMethod() === 'get'){
            return view('templates/header')
                . view('neoness/signUp')
                . view('templates/footer');


        // redirect if valid registration
        } else if ($this->request->getMethod() === 'post' && $this->validate([
            'email' => 'required|min_length[3]|max_length[255]|valid_email|is_unique[users.email]',
            'password' => 'required',
            'pass_confirm' => 'required|matches[password]',
            'firstname' => 'required|alpha_dash',
            'name' => 'required|alpha_dash',
            'phone' => 'required|is_unique[users.phone]|numeric',
            'sex' => 'required',
            'birthday' => 'required',
            'size' => 'required|numeric',
            'weight' => 'required|numeric',
            'Tweight' => 'required|numeric'
        ])) {

            $model = model(UsersModel::class);
    
            $weight = $this->request->getPost('weight');
            $size = $this->request->getPost('size') / 100;
            var_dump($size);
            //poid / taille²;
            $pass = $this->request->getPost('password');
            // encryption password
            $password = hash('sha256', $pass);
            $BMI = $weight / ($size**2);
            var_dump($BMI);

            // save data in db
            $model->save([
                'email' => $this->request->getPost('email'),
                'password' => $password,
                'firstname'  => $this->request->getPost('firstname'),
                'name'  => $this->request->getPost('name'),
                'phone'  => $this->request->getPost('phone'),
                'sex'  => $this->request->getPost('sex'),
                'birthday'  => $this->request->getPost('birthday'),
                'size'  => $this->request->getPost('size'),
                'weight'  => $this->request->getPost('weight'),
                'target_weight'  => $this->request->getPost('Tweight'),
                'BMI' => $BMI,
                'registration_date' => date("Y-m-d")
            ]);
         
            return view('templates/header', ['data' => 'Registered with success !'])
            . view('neoness/index')
            . view('templates/footer');

            // redirect if registration failed
        } else {

            return view('templates/header', ['registration' => 'Registration Failed'])
            . view('neoness/signUp')
            . view('templates/footer');
        }
    }

    public function create() 
    {
        if(uri_string() == 'create'){
            return $this->checkSession()
                . view('templates/header')
                . view('neoness/create')
                . view('templates/footer');


        } else if(uri_string() == 'create/form') {

            $mydata = $this->request->getPost();

            $arrayData = [
                'data' => $mydata
            ];

            return  $this->checkSession()
            . view('templates/header', $arrayData)
            . view('neoness/create')
            . view('templates/footer');
        } else {

        }
    }


    public function signOut()
    {
        $session = session();
        $session->destroy();

        header("Location: /signOut");
        die();

    } 

    public function profil()
    {
        $session = session();
        $model = new UsersModel;
        $profil = [
            'user' => $session->firstname . " " . $session->name,
            'email' => $session->email,
            'phone' => $session->phone
        ];

        return  $this->checkSession()
            . view('templates/header', $profil)
            . view('neoness/profil')
            . view('templates/footer');
    }

    public function delete()
    {
        $session = session();

        $db = \Config\Database::connect();
        $model_user = new UsersModel;
        $builder_user = $db->table('users');
        $builder_activities = $db->table('activities');


        $dataUser = $model_user->getUser($session->email);

        $builder_user->delete(['id_user' => $dataUser['id_user']]);
        $builder_activities->delete(['fk_user_id' => $dataUser['id_user']]);

        $session->destroy();

        header("Location: /home");
        die();
    }
}