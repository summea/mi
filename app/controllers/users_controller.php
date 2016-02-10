<?php

require_once('startup.php');

class UsersController extends Controller
{

    // members
    var $layout = 'backend';
    

    // methods

    public function getUsers()
    {
        $q = Model::query("select * from mi_users order by id DESC limit 10");
        return $q;
    }

    public function index()
    {
        $users = $this->getUsers();

        $this->set('users', $users);
    }

    public function show()
    {
        $id = $_GET['id'];

        $users = Model::query("select * from mi_users where id = $id");

        $this->set('users', $users);
    }

    public function create()
    {
    }

    public function edit()
    {
        $id = $this->Clean->numbersOnly($_GET['id']);

        $users = Model::query("select * from mi_users where id = $id");

        $this->set('users', $users);
    }
    
    public function save()
    {
        $save_response = $this->Entry->save($_POST);

        if ($save_response['edit_type'] == 0)
            $this->flash('Entry was created successfully!');
        else
            $this->flash('Entry was successfully updated!');

        $this->redirect('users/index');
    }

}

?>
