<?php

require_once('startup.php');

class EntriesController extends Controller
{

    // members
    var $layout = 'backend';
    

    // methods

    public function getEntries()
    {
        $q = Model::query("select * from mi_entries order by id DESC limit 10");
        return $q;
    }

    public function index()
    {
        $entries = $this->getEntries();

        $this->set('entries', $entries);
    }

    public function show()
    {
        #$id = $this->getPrimaryKey();
        $id=10;

        $entries = Model::query("select * from mi_entries where id = $id");

        $this->set('entries', $entries);
    }

    public function create()
    {
    }

    public function edit()
    {
        #$id = $this->getPrimaryKey();
        $id=10;
 
        $entries = Model::query("select * from mi_entries where id = $id");

        $this->set('primary_key', $id);
        $this->set('entries', $entries);
    }
    
    public function save()
    {
        $save_response = $this->Entry->save($_POST);

        $this->flash('Success!');

        $this->redirect('entries/index');
    }

    public function destroy()
    {
        $id = $this->getEditId();
        
        $this->Entry->destroy($id);

        $this->flash('Entry was successfully destroyed!');

        $this->redirect('entries/index');

    }

}

?>
