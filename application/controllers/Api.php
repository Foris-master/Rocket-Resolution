<?php

/**
 * Created by PhpStorm.
 * User: evari
 * Date: 13/11/2015
 * Time: 16:28
 */

require APPPATH.'/libraries/REST_Controller.php';
require APPPATH.'/libraries/Usual.php';
require_once APPPATH.'../vendor/autoload.php';
use Stichoza\GoogleTranslate\TranslateClient;

class Api extends  REST_Controller
{


    private  $similar_val=array();


    public function translate_post()
    {


        if(! $this->post('cible'))
        {
            $this->response(array('error' => 'Missing Translate data: cible'), 400);

        }if(! $this->post('text'))
        {
            $this->response(array('error' => 'Missing Translate data: text'), 400);

        } else {

            $tr = new TranslateClient(null, $this->post('cible'));
           $text =$this->post('text');
           if(is_array($text)){

               if(count($text)<=1){
                   array_push($text,"ok");
                   $res =$tr->translate($text);
                   $res = $res[0];
               }else{
                  $res= $tr->translate($text);
               }
               $this->response($res, 200);
           }else{
               $this->response(array('error' => 'Text must be  an array'), 400);

           }
        }


    }
    public function category_get()
    {

        //$this->load->model('proxies/CategoryModel');

        $cm =new RocketModel();

        if(! $this->get('id'))
        {
            $tasks = json_encode($cm->filter_category()) ;// return all record

        } else {

            $tasks = $cm->get_category($this->get('id'));
        }

        if($tasks)
        {
            $this->response($tasks, 200); // return success code if record exist
        } else {
            $this->response([], 404); // return empty
        }
    }

    public function category_post()
    {

        if(! ($this->post('name')))
        {
            $this->response(array('error' => 'Missing Category data: name'), 400);
        }

        if(! $this->post('description'))
        {
            $this->response(array('error' => 'Category description  is required'), 400);
        }
        else{

            $c = new Category();
            $c->setName($this->post('name'));
            $c->setDescription($this->post('description'));
        }
        $cm =new RocketModel();
        $c =$cm->save_category($c);
        $id =$c->getIdcategory();
        if(isset($id))
        {
           //$message = array('id' => $this->db->insert_id(), 'title' => $this->post('title'));
            $this->response(json_encode(array($c)), 200);
        }
    }

    public function category_put()
    {
        if(! $this->put('id'))
        {
            $this->response(array('error' => 'Category id  is required'), 400);
        }
        if(! $this->put('name'))
        {
            $this->response(array('error' => 'Category name  is required'), 400);
        }
        if(! $this->put('description'))
        {
            $this->response(array('error' => 'Category description  is required'), 400);
        }
        $cm =new RocketModel();
        $c =$cm->get_category($this->put('id'));
        $c->setName($this->put('name'));
        $c->setDescription($this->put('description'));
        $cm->save_category($c);

        $message = array('success' => $this->put('title').' Updated!');
        $this->response(json_encode(array($message,$c)), 200);
    }

    public function category_delete($id=NULL)
    {
        if($id == NULL)
        {
            $message = array('error' => 'Missing delete data: id');
            $this->response($message, 400);
        } else {
            $cm = new RocketModel();
            $cm->delete_category($id);
            $message = array('id' => $id, 'message' => 'DELETED!');
            $this->response($message, 200);
        }
    }


    public function priority_get()
    {

        //$this->load->model('proxies/CategoryModel');

        $cm =new RocketModel();

        if($this->get('id'))
        {

            $tasks = $cm->get_priority($this->get('id'));

        } else {
            if($this->get('name')){
                $tasks = json_encode($cm->filter_priority($this->get('name'))) ;// return all record

            }else{
                $tasks = json_encode($cm->filter_priority()) ;// return all record

            }

        }

        if($tasks)
        {
            $this->response($tasks, 200); // return success code if record exist
        } else {
            $this->response([], 404); // return empty
        }
    }

    public function priority_post()
    {

        if(! ($this->post('name')))
        {
            $this->response(array('error' => 'Missing Priority data: name '), 400);
        }
        elseif(! ($this->post('value')))
        {
            $this->response(array('error' => 'Missing Priority data: value'), 400);
        }

        else{

            $p = new Priority();
            $p->setName($this->post('name'));
            $p->setValue($this->post('value'));
        }
        $cm =new RocketModel();
        $p =$cm->save_priority($p);
        $id =$p->getIdpriority();
        if(isset($id))
        {
            //$message = array('id' => $this->db->insert_id(), 'title' => $this->post('title'));
            $this->response(json_encode(array($p)), 200);
        }
    }

    public function priority_put()
    {
        if(! $this->put('id'))
        {
            $this->response(array('error' => 'Priority id  is required'), 400);
        }
        if(! $this->put('name'))
        {
            $this->response(array('error' => 'Priority name  is required'), 400);
        }
        if(! $this->put('value'))
        {
            $this->response(array('error' => 'Priority value  is required'), 400);
        }
        $rm =new RocketModel();
        $p =$rm->get_priority($this->put('id'));
        $p->setName($this->put('name'));
        $p->setValue($this->put('value'));
        $rm->save_priority($p);

        $message = array('success' => $this->put('title').' Updated!');
        $this->response(json_encode(array($message,$p)), 200);
    }

    public function priority_delete($id=NULL)
    {
        if($id == NULL)
        {
            $message = array('error' => 'Missing delete data: id');
            $this->response($message, 400);
        } else {
            $rm = new RocketModel();
            $rm->delete_priority($id);
            $message = array('id' => $id, 'message' => 'DELETED!');
            $this->response($message, 200);
        }
    }



    public function group_get()
    {

        //$this->load->model('proxies/CategoryModel');

        $cm =new RocketModel();

        if($this->get('id'))
        {

            $tasks = $cm->get_group($this->get('id'));

        } else {
            if($this->get('name')){
                $tasks = json_encode($cm->filter_group($this->get('name'))) ;// return all record

            }elseif($this->get('tag')) {
                $tasks = json_encode($cm->filter_group("",$this->get('tag'))) ;// return all record
            }else
            {
                $tasks = json_encode($cm->filter_group()) ;// return all record

            }

        }

        if($tasks)
        {
            $this->response($tasks, 200); // return success code if record exist
        } else {
            $this->response([], 404); // return empty
        }
    }

    public function group_post()
    {

        if(! ($this->post('name')))
        {
            $this->response(array('error' => 'Missing Group data: name '), 400);
        }
        elseif(! ($this->post('tag')))
        {
            $this->response(array('error' => 'Missing Group data: tag'), 400);
        }elseif(! ($this->post('description')))
        {
            $this->response(array('error' => 'Missing Group data: description'), 400);
        }

        else{

            $g = new Group();
            $g->setName($this->post('name'));
            $g->setTag($this->post('tag'));
            $g->setDescription($this->post('description'));

        }
        $cm =new RocketModel();
        $g =$cm->save_priority($g);
        if($this->post('user')){
            foreach($this->post('user') as $ca){
                $u = $cm->get_user($ca);
                //$u = new User();
                $u->addGroupgroup($g);
                $cm->save_user($u);

            }
        }
        $id =$g->getIdpriority();
        if(isset($id))
        {
            //$message = array('id' => $this->db->insert_id(), 'title' => $this->post('title'));
            $this->response(json_encode(array($g)), 200);
        }
    }

    public function group_put()
    {
        if(! $this->put('id'))
        {
            $this->response(array('error' => 'Group id  is required'), 400);
        }
        if(! $this->put('name'))
        {
            $this->response(array('error' => 'Group name  is required'), 400);
        }
        if(! $this->put('tag'))
        {
            $this->response(array('error' => 'Group tag  is required'), 400);
        }
        if(! $this->put('description'))
        {
            $this->response(array('error' => 'Group description  is required'), 400);
        }
        $rm =new RocketModel();
        $g =$rm->get_group($this->put('id'));
        //$g= new Group();
        $g->setName($this->put('name'));
        $g->setTag($this->put('tag'));
        $g->setDescription($this->put('description'));
        $rm->save_priority($g);
        if($this->put('user')){
            foreach($this->put('user') as $ca){
                $u = $rm->get_user($ca);
                //$u = new User();
                $u->addGroupgroup($g);
                $rm->save_user($u);

            }
        }

        $message = array('success' => $this->put('name').' Updated!');
        $this->response(json_encode(array($message,$g)), 200);
    }

    public function group_delete($id=NULL)
    {
        if($id == NULL)
        {
            $message = array('error' => 'Missing delete data: id');
            $this->response($message, 400);
        } else {
            $rm = new RocketModel();
            $rm->delete_group($id);
            $message = array('id' => $id, 'message' => 'DELETED!');
            $this->response($message, 200);
        }
    }


    public function user_get()
    {

        //$this->load->model('proxies/CategoryModel');

        $cm =new RocketModel();

        if($this->get('id'))
        {

            $tasks = $cm->get_user($this->get('id'));

        } else {
            $filter = array();
            if($this->get('first_name')){
                $filter['first_name'] =$this->get('first_name');
            }
            if($this->get('last_name')){
                $filter['last_name'] =$this->get('last_name');
            }
            if($this->get('phone')){
                $filter['phone'] =$this->get('phone');
            }
            if($this->get('email')){
                $filter['email'] =$this->get('email');
            }
            if($this->get('user_name')){
                $filter['user_name'] =$this->get('user_name');
            }
            if($this->get('localization')){

                $filter['localization'] =$this->get('localization');
            }

            if(count($filter)!=0){
                $tasks = json_encode($cm->filter_user($filter)) ;// return all record
            }
            else{
                $tasks = json_encode($cm->filter_user()) ;// return all record

            }

        }

        if($tasks)
        {
            $this->response($tasks, 200); // return success code if record exist
        } else {
            $this->response([], 404); // return empty
        }
    }

    public function user_post()
    {

        if(! ($this->post('user_name')))
        {
            $this->response(array('error' => 'Missing User data: user_name '), 400);
        }
        if(! ($this->post('first_name')))
        {
            $this->response(array('error' => 'Missing User data: first_name '), 400);
        }
        elseif(! ($this->post('email')))
        {
            $this->response(array('error' => 'Missing User data: email'), 400);
        }
        elseif(! ($this->post('phone')))
        {
            $this->response(array('error' => 'Missing User data: phone'), 400);
        }elseif(! ($this->post('password')))
        {
            $this->response(array('error' => 'Missing User data: password'), 400);
        }elseif(! ($this->post('localization')))
        {
            $this->response(array('error' => 'Missing User data: localization'), 400);
        }

        else{

            $u = new User();
            $u->setUserName($this->post('user_name'));
            $u->setFirtsName($this->post('first_name'));
            if($this->post('last_name')){
                $u->setLastName($this->post('last_name'));
            }

            if($_FILES['picture']){
                $prefix='assets/img/user';
                $this->upload($prefix,'picture');
                $u->setPicture($prefix.$_FILES['picture']['name']);
            }

            $u->setEmail($this->post('email'));
            $u->setPhone($this->post('phone'));
            $u->setLocalization($this->post('localization'));
            $this->load->helper('phpass');
            $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
            $u->setPassword( $hasher->HashPassword($this->post('password')));
//            $check = $this->PasswordHash->CheckPassword($password, $actualPassword);
        }
        $cm =new RocketModel();
        if($this->post('group')){
            foreach($this->post('group') as $ca){
                $g = $cm->get_group($ca);
                //$u = new User();
                $u->addGroupgroup($g);
            }
        }
        $u =$cm->save_user($u);

        $id =$u->getIduser();
        if(isset($id))
        {
            //$message = array('id' => $this->db->insert_id(), 'title' => $this->post('title'));
            $this->response(json_encode(array($u)), 200);
        }
    }

    public function user_put()
    {
        if(! $this->put('id'))
        {
            $this->response(array('error' => 'User id  is required'), 400);
        }
        if(! $this->put('user_name'))
        {
            $this->response(array('error' => 'User user_name  is required'), 400);
        }
        if(! $this->put('first_name'))
        {
            $this->response(array('error' => 'User first_name  is required'), 400);
        }
        if(! $this->put('email'))
        {
            $this->response(array('error' => 'User email  is required'), 400);
        }if(! $this->put('phone'))
        {
            $this->response(array('error' => 'User phone  is required'), 400);
        }if(! $this->put('localization'))
        {
            $this->response(array('error' => 'User localization  is required'), 400);
        }
        $rm =new RocketModel();
        $u =$rm->get_user($this->put('id'));
        //$u = new User();
        $u->setUserName($this->put('user_name'));
        $u->setFirtsName($this->put('firts_name'));
        $u->setEmail($this->put('email'));
        $u->setPhone($this->put('phone'));
        $u->setLocalization($this->put('localization'));
        if($this->put('last_name')){
            $u->setLastName($this->put('last_name'));
        }
        if($_FILES['picture']){
            $prefix='assets/img/user';
            $this->upload($prefix,'picture');
            $u->setPicture($prefix.$_FILES['picture']['name']);
        }
        if($this->put('password')){

            $this->load->helper('phpass');
            $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
            $u->setPassword( $hasher->HashPassword($this->put('password')));
        }
        if($this->put('group')){
            foreach($this->put('group') as $ca){
                $g = $rm->get_group($ca);
                //$u = new User();
                $u->addGroupgroup($g);
            }
        }

        $rm->save_user($u);

        $message = array('success' => $this->put('first_name').' Updated!');
        $this->response(json_encode(array($message,$u)), 200);
    }

    public function user_delete($id=NULL)
    {
        if($id == NULL)
        {
            $message = array('error' => 'Missing delete data: id');
            $this->response($message, 400);
        } else {
            $rm = new RocketModel();
            $rm->delete_user($id);
            $message = array('id' => $id, 'message' => 'DELETED!');
            $this->response($message, 200);
        }
    }

    public  function  login_post(){
        $rm =new RocketModel();
        if(! ($this->post('password')))
        {
            $this->response(array('error' => 'Missing User data: password '), 400);
        }
        if($this->post('user_name'))
        {

           $u = $rm->get_user(0,$user_name=$this->post('user_name'));
            $u = new User();
            if(is_a($u,'User')){
                $this->load->helper('phpass');
                $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
                if( $hasher->CheckPassword($this->post('password'),$u->getPassword())){
                    $sess_array = array(
                        'id' => $u->getIduser(),
                        'username' => $u->getUserName(),
                        'email'=>$u->getEmail(),
                        'phone'=>$u->getPhone(),
                        'localization'=>$u->getLocalization(),
                        'firts_name'=>$u->getFirtsName(),
                        'last_name'=>$u->getLastName()
                    );
                    $this->session->set_userdata('logged_in', $sess_array);

                }else{
                    $this->response(array('error' => 'Wrong Password !'), 403);

                }
            }else{
                $this->response(array('A user with this username  does not exist'), 404); // return empty
            }
        }
        elseif(($this->post('email')))
        {
            $u = $rm->get_user(0,"",$this->post('email'));
            //$u =new User();
            if(is_a($u,'User')){

                $this->load->helper('phpass');
                $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
                if( $hasher->CheckPassword($this->post('password'),$u->getPassword())){
                    $sess_array = array(
                        'id' => $u->getIduser(),
                        'username' => $u->getUserName(),
                        'email'=>$u->getEmail(),
                        'phone'=>$u->getPhone(),
                        'localization'=>$u->getLocalization(),
                        'firts_name'=>$u->getFirtsName(),
                        'last_name'=>$u->getLastName()
                    );
                    $this->session->set_userdata('logged_in', $sess_array);
                }else{
                    $this->response(array('error' => 'Wrong Password !'), 403);

                }

            }else{
                $this->response(array('A user with this email  does not exist'), 404); // return empty
            }


        }else{
            $this->response(array('error' => 'Missing User data: need email or user_name'), 400);
        }

        if($u)
        {
            $this->response($u, 200); // return success code if record exist
        } else {
            $this->response(array('This user does not exist'), 404); // return empty
        }

    }

    public  function logout_post()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
    }

    public function  test_post(){

        if($_FILES['picture']){
            $prefix='assets/img/user';
            $config['upload_path']          = $prefix;
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1000;
            //$config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);
            //$this->response($_FILES['picture']);

            if ( ! $this->upload->do_upload('picture'))
            {
                $error = array('error' => $this->upload->display_errors());
                $this->response($error);
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());

//            $this->response($data, 200);

            }

           // $this->response(array($u->upload_img($prefix,'picture')));
        }

    }

    protected function upload($prefix,$id){

        $config['upload_path']          = $prefix;
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000;
        //$config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);
        //$this->response($_FILES['picture']);

        if ( ! $this->upload->do_upload($id))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->response($error);
        }
        else {
            $data = array('upload_data' => $this->upload->data());
        }
    }

    protected function  required_login()
    {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            return true;

        }
        else
        {
            //If no session, redirect to login page
           return false;
        }
    }



    public function coach_get()
    {

        //$this->load->model('proxies/CategoryModel');

        $cm =new RocketModel();

        if($this->get('id'))
        {

            $tasks = $cm->get_coach($this->get('id'));

        } else {
            $filter = array();
            if($this->get('start_date')){
                $filter['start_date'] =$this->get('start_date');
            }
            if($this->get('grade')){
                $filter['grade'] =$this->get('grade');
            }
            if($this->get('user')){
                $filter['user'] =$this->get('user');
            }



            if(count($filter)!=0){
                $tasks = json_encode($cm->filter_coach($filter)) ;// return all record
            }
            else{
                $tasks = json_encode($cm->filter_coach()) ;// return all record

            }

        }

        if($tasks)
        {
            $this->response($tasks, 200); // return success code if record exist
        } else {
            $this->response([], 404); // return empty
        }
    }

    public function coach_post()
    {

        if(! ($this->post('user')))
        {
            $this->response(array('error' => 'Missing Coach data: user'), 400);
        }

        else{

            $c = new Coach();
        }
        $rm =new RocketModel();
        $c->setUseruser($rm->get_user($this->post('user')));
        if($this->post('category')){
            foreach($this->post('category') as $ca){
                $c->addCategorycategory($rm->get_category($ca));

            }
        }


        $c =$rm->save_coach($c);
        $id =$c->getIdcoach();
        if(isset($id))
        {
            //$message = array('id' => $this->db->insert_id(), 'title' => $this->post('title'));
            $this->response(json_encode(array($c)), 200);
        }
    }

    public function coach_put()
    {
        if(! $this->put('id'))
        {
            $this->response(array('error' => 'Coach id  is required'), 400);
        }
        if(! ($this->put('user')))
        {
            $this->response(array('error' => 'Missing Coach data: user '), 400);
        }
        elseif(! ($this->put('grade')))
        {
            $this->response(array('error' => 'Missing Coach data: grade'), 400);
        }

        $rm =new RocketModel();
        //$r = new Resolution();
        $c = $rm->get_coach($this->put('id'));

        $c->setGrade($this->put('grade'));
        $c->setUseruser($rm->get_user($this->put('user')));
        if($this->put('category')){
            foreach($this->put('category') as $ca){
                $c->addCategorycategory($rm->get_category($ca));

            }
        }

        $rm->save_coach($c);

        $message = array('success' => $this->put('grade').' Updated!');
        $this->response(json_encode(array($message,$c)), 200);
    }

    public function coach_delete($id=NULL)
    {
        if($id == NULL)
        {
            $message = array('error' => 'Missing delete data: id');
            $this->response($message, 400);
        } else {
            $rm = new RocketModel();
            $rm->delete_coach($id);
            $message = array('id' => $id, 'message' => 'DELETED!');
            $this->response($message, 200);
        }
    }



    public function coach_demand_get()
    {

        //$this->load->model('proxies/CategoryModel');

        $cm =new RocketModel();

        if($this->get('id'))
        {

            $tasks = $cm->get_coach_demand($this->get('id'));

        } else {
            $filter = array();
            if($this->get('category')){
                $filter['category'] =$this->get('category');
            }
            if($this->get('create_date')){
                $filter['create_date'] =$this->get('create_date');
            }
            if($this->get('user')){
                $filter['user'] =$this->get('user');
            }
            if($this->get('status')){
                $filter['status'] =$this->get('status');
            }



            if(count($filter)!=0){
                $tasks = json_encode($cm->filter_coach_demand($filter)) ;// return all record
            }
            else{
                $tasks = json_encode($cm->filter_coach_demand()) ;// return all record

            }

        }

        if($tasks)
        {
            $this->response($tasks, 200); // return success code if record exist
        } else {
            $this->response([], 404); // return empty
        }
    }

    public function coach_demand_post()
    {

        if(! ($this->post('user')))
        {
            $this->response(array('error' => 'Missing CoachDemand data: user'), 400);
        }
        if(! ($this->post('category')))
        {
            $this->response(array('error' => 'Missing CoachDemand data: category'), 400);
        }

        else{

            $cd = new CoachDemand();
        }
        $rm =new RocketModel();
        $cd->setUseruser($rm->get_user($this->post('user')));
        $cd->setCategorycategory($rm->get_category($this->post('category')));
       /* if($this->post('category')){
            foreach($this->post('category') as $ca){
                $c->addCategorycategory($rm->get_category($ca));

            }
        }*/


        $cd =$rm->save_coach_demand($cd);
        $id =$cd->getIdcoachDemand();
        if(isset($id))
        {
            //$message = array('id' => $this->db->insert_id(), 'title' => $this->post('title'));
            $this->response(json_encode(array($cd)), 200);
        }
    }

    public function coach_demand_put()
    {
        if(! $this->put('id'))
        {
            $this->response(array('error' => 'CoachDemand id  is required'), 400);
        }
        if(! ($this->put('user')))
        {
            $this->response(array('error' => 'Missing CoachDemand data: user '), 400);
        }
        elseif(! ($this->put('status')))
        {
            $this->response(array('error' => 'Missing CoachDemand data: status'), 400);
        }elseif(! ($this->put('category')))
        {
            $this->response(array('error' => 'Missing CoachDemand data: category'), 400);
        }

        $rm =new RocketModel();
        $cd = $rm->get_coach($this->put('id'));
        //$cd = new CoachDemand();
        $cd->setStatus($this->put('status'));
        $cd->setUseruser($rm->get_user($this->put('user')));
        $cd->setCategorycategory($rm->get_category($this->put('category')));
        /*if($this->put('category')){
            foreach($this->put('category') as $ca){
                $c->addCategorycategory($rm->get_category($ca));

            }
        }*/

        $rm->save_coach_demand($cd);

        $message = array('success' => $this->put('status').' Updated!');
        $this->response(json_encode(array($message,$cd)), 200);
    }

    public function coach_demand_delete($id=NULL)
    {
        if($id == NULL)
        {
            $message = array('error' => 'Missing delete data: id');
            $this->response($message, 400);
        } else {
            $rm = new RocketModel();
            $rm->delete_coach_demand($id);
            $message = array('id' => $id, 'message' => 'DELETED!');
            $this->response($message, 200);
        }
    }



    public function atout_get()
    {

        //$this->load->model('proxies/CategoryModel');

        $cm =new RocketModel();

        if($this->get('id'))
        {

            $tasks = $cm->get_atout($this->get('id'));

        } else {
            $filter = array();
            if($this->get('atout')){
                $filter['atout'] =$this->get('atout');
            }
            if($this->get('coach_demand')){
                $filter['coach_demand'] =$this->get('coach_demand');
            }


            if(count($filter)!=0){
                $tasks = json_encode($cm->filter_atout($filter)) ;// return all record
            }
            else{
                $tasks = json_encode($cm->filter_atout()) ;// return all record

            }

        }

        if($tasks)
        {
            $this->response($tasks, 200); // return success code if record exist
        } else {
            $this->response([], 404); // return empty
        }
    }

    public function atout_post()
    {

        if(! ($this->post('coach_demand')))
        {
            $this->response(array('error' => 'Missing Atout data: coach_demand'), 400);
        }
        if(! ($this->post('atout')))
        {
            $this->response(array('error' => 'Missing Atout data: Atout'), 400);
        }

        else{


        }
        $a = new Atout();
        $rm =new RocketModel();
        $a->setCoachDemandcoachDemand($rm->get_coach_demand($this->post('coach_demand')));
        $a->setAtout($this->post('atout'));
        /*if($this->post('category')){
            foreach($this->post('category') as $ca){
                $c->addCategorycategory($rm->get_category($ca));

            }
        }*/


        $a =$rm->save_atout($a);
        $id =$a->getIdatout();
        if(isset($id))
        {
            //$message = array('id' => $this->db->insert_id(), 'title' => $this->post('title'));
            $this->response(json_encode(array($a)), 200);
        }
    }

    public function atout_put()
    {
        if(! $this->put('id'))
        {
            $this->response(array('error' => 'Atout id  is required'), 400);
        }
        if(! ($this->put('atout')))
        {
            $this->response(array('error' => 'Missing Atout data: atout '), 400);
        }
        elseif(! ($this->put('coach_demand')))
        {
            $this->response(array('error' => 'Missing Atout data: coach_demand'), 400);
        }

        $rm =new RocketModel();

        $a = $rm->get_atout($this->put('id'));
        //$a = new Atout();
        $a->setAtout($this->put('atout'));
        $a->setCoachDemandcoachDemand($rm->get_coach_demand($this->put('coach_demand')));
        /*if($this->put('category')){
            foreach($this->put('category') as $ca){
                $c->addCategorycategory($rm->get_category($ca));

            }
        }*/

        $rm->save_atout($a);

        $message = array('success' => $this->put('atout').' Updated!');
        $this->response(json_encode(array($message,$a)), 200);
    }

    public function atout_delete($id=NULL)
    {
        if($id == NULL)
        {
            $message = array('error' => 'Missing delete data: id');
            $this->response($message, 400);
        } else {
            $rm = new RocketModel();
            $rm->delete_atout($id);
            $message = array('id' => $id, 'message' => 'DELETED!');
            $this->response($message, 200);
        }
    }



    public function resolution_get()
    {

        //$this->load->model('proxies/CategoryModel');

        $cm =new RocketModel();

        if($this->get('id'))
        {

            $tasks = $cm->get_resolution($this->get('id'));

        } else {
            $filter = array();
            if($this->get('start_date')){
                $filter['start_date'] =$this->get('start_date');
            }
            if($this->get('end_date')){
                $filter['end_date'] =$this->get('end_date');
            }
            if($this->get('user')){
                $filter['user'] =$this->get('user');
            }
            if($this->get('priority')){
                $filter['priority'] =$this->get('priority');
            }
            if($this->get('category')){
                $filter['category'] =$this->get('category');
            }
            if($this->get('title')){
                $filter['title'] =$this->get('title');
            }if($this->get('status')){
                $filter['status'] =$this->get('status');
            }if($this->get('create_date')){
                $filter['create_date'] =$this->get('create_date');
            }

            if(count($filter)!=0){
                $tasks = json_encode($cm->filter_resolution($filter)) ;// return all record
            }
            else{
                $tasks = json_encode($cm->filter_resolution()) ;// return all record

            }

        }

        if($tasks)
        {
            $this->response($tasks, 200); // return success code if record exist
        } else {
            $this->response([], 404); // return empty
        }
    }

    public function resolution_post()
    {

        if(! ($this->post('title')))
        {
            $this->response(array('error' => 'Missing Resolution data: title '), 400);
        }
        elseif(! ($this->post('description')))
        {
            $this->response(array('error' => 'Missing Resolution data: description'), 400);
        }
        elseif(! ($this->post('user')))
        {
            $this->response(array('error' => 'Missing Resolution data: user'), 400);
        }elseif(! ($this->post('priority')))
        {
            $this->response(array('error' => 'Missing Resolution data: priority'), 400);
        }/*elseif(! ($this->post('category')))
        {
            $this->response(array('error' => 'Missing Resolution data: category'), 400);
        }*/elseif(! ($this->post('start_date')))
        {
            $this->response(array('error' => 'Missing Resolution data: start_date'), 400);
        }

        else{

            $r = new Resolution();
            $r->setStartDate(DateTime::createFromFormat('Y-m-d H:i:s',$this->post('start_date')));
            //$r->setStartDate(new \DateTime('now'));
            $r->setDescription($this->post('description'));
            $r->setTitle($this->post('title'));

        }
        $cm =new RocketModel();
        $r->setCategorycategory($cm->get_category($this->post('category')));
        $r->setPrioritypriority($cm->get_priority($this->post('priority')));
        $r->setUseruser($cm->get_user($this->post('user')));

        $r =$cm->save_resolution($r);
        if($this->post('coach')){
            foreach($this->post('coach') as $c){
                $c =$cm->get_coach($c);
                $c->addResolutionresolution($r);
                $cm->save_coach($c);
            }
        }
        $id =$r->getIdresolution();
        if(isset($id))
        {
            //$message = array('id' => $this->db->insert_id(), 'title' => $this->post('title'));
            $this->response(json_encode(array($r)), 200);
        }
    }

    public function resolution_put()
    {
        if(! $this->put('id'))
        {
            $this->response(array('error' => 'Resolution id  is required'), 400);
        }
        if(! ($this->put('title')))
        {
            $this->response(array('error' => 'Missing Resolution data: title '), 400);
        }
        elseif(! ($this->put('description')))
        {
            $this->response(array('error' => 'Missing Resolution data: description'), 400);
        }
        elseif(! ($this->put('user')))
        {
            $this->response(array('error' => 'Missing Resolution data: user'), 400);
        }elseif(! ($this->put('priority')))
        {
            $this->response(array('error' => 'Missing Resolution data: priority'), 400);
        }elseif(! ($this->put('category')))
        {
            $this->response(array('error' => 'Missing Resolution data: category'), 400);
        }elseif(! ($this->put('start_date')))
        {
            $this->response(array('error' => 'Missing Resolution data: start_date'), 400);
        }
        $rm =new RocketModel();
        //$r = new Resolution();
        $r = $rm->get_resolution($this->put('id'));
        $r->setStartDate($this->put('start_date'));
        $r->setDescription($this->put('description'));
        $r->setTitle($this->put('title'));
        $r->setCategorycategory($rm->get_category($this->put('category')));
        $r->setPrioritypriority($rm->get_priority($this->put('priority')));
        $r->setUseruser($rm->get_user($this->put('user')));
        if($this->put('status')){
            $r->setStatus($this->put('status'));
        }

        $rm->save_resolution($r);
        if($this->post('coach')){
            foreach($this->post('coach') as $c){
                $c =$rm->get_coach($c);
                $c->addResolutionresolution($r);
                $rm->save_coach($c);
            }
        }

        $message = array('success' => $this->put('title').' Updated!');
        $this->response(json_encode(array($message,$r)), 200);
    }

    public function resolution_delete($id=NULL)
    {
        if($id == NULL)
        {
            $message = array('error' => 'Missing delete data: id');
            $this->response($message, 400);
        } else {
            $rm = new RocketModel();
            $rm->delete_resolution($id);
            $message = array('id' => $id, 'message' => 'DELETED!');
            $this->response($message, 200);
        }
    }

    protected function can_translate($text){
        try{
            $tr = new TranslateClient(null, 'fr');
            $text2 = $tr->translate($text);
            $srclang = $tr->getLastDetectedSource();
            if($srclang!='en'){
                return $text2;
            }else{
                return $text;
            }

        }catch (Exception $e){
            return $text;
        }


    }

    private function similarity(Resolution $sr,Resolution $r){

        $tit1=$this->can_translate($sr->getTitle());
        $des1=$this->can_translate($sr->getDescription());
        $tit2=$this->can_translate($r->getTitle());
        $des2=$this->can_translate($r->getDescription());


        similar_text(strtolower($tit1),strtolower($tit2),$val1);
        similar_text(strtolower($des1),strtolower($des2),$val2);
        $val1=0.6*$val1+0.4*$val2;
        return $val1;
    }

    public function similar_resolution_get($id=NULL){

        if($id == NULL)
        {
            $message = array('error' => 'Missing Similarity data: id');
            $this->response($message, 400);
        }
        else {
            $rm = new RocketModel();
            $sr = $rm->get_resolution($id);
            $c = $sr->getCategorycategory();
            //$sr =new Resolution();
            $all = $rm->filter_resolution(array('categorycategory'=>$c->getIdcategory()));
            $this->similar_val =array();
            foreach($all as $r){
                $this->similar_val[$r->getIdresolution()]= $this->similarity($sr,$r);
            }
             usort($all,array($this,"lcomp"));

            $this->response(array('resolution'=>array_splice($all,1),'valeur'=>$this->similar_val), 200);
        }

    }
    protected function lcomp(Resolution $r1,Resolution $r2){

        return $this->similar_val[$r1->getIdresolution()]<$this->similar_val[$r2->getIdresolution()];
    }



    public function milestone_get()
    {

        //$this->load->model('proxies/CategoryModel');

        $cm =new RocketModel();

        if($this->get('id'))
        {

            $tasks = $cm->get_milestone($this->get('id'));

        } else {
            $filter = array();
            if($this->get('start_date')){
                $filter['start_date'] =$this->get('start_date');
            }
            if($this->get('end_date')){
                $filter['end_date'] =$this->get('end_date');
            }
            if($this->get('resolution')){
                $filter['resolutionresolution'] =$this->get('resolution');
            }
            if($this->get('priority')){
                $filter['priority'] =$this->get('priority');
            }
            if($this->get('title')){
                $filter['title'] =$this->get('title');
            }if($this->get('status')){
                $filter['status'] =$this->get('status');
            }if($this->get('dead_line')){
                $filter['dead_line'] =$this->get('dead_line');
            }

            if(count($filter)!=0){
                $tasks = json_encode($cm->filter_milestone($filter)) ;// return all record
            }
            else{
                $tasks = json_encode($cm->filter_milestone()) ;// return all record

            }

        }

        if($tasks)
        {
            $this->response($tasks, 200); // return success code if record exist
        } else {
            $this->response([], 404); // return empty
        }
    }

    public function milestone_post()
    {

        if(! ($this->post('title')))
        {
            $this->response(array('error' => 'Missing Milestone data: title '), 400);
        }
        elseif(! ($this->post('description')))
        {
            $this->response(array('error' => 'Missing Milestone data: description'), 400);
        }
        elseif(! ($this->post('resolution')))
        {
            $this->response(array('error' => 'Missing Milestone data: resolution'), 400);
        }elseif(! ($this->post('dead_line')))
        {
            $this->response(array('error' => 'Missing Milestone data: dead_line'), 400);
        }

        else{

            $m = new Milestone();
            $m->setDeadLine(DateTime::createFromFormat('Y-m-d H:i:s',$this->post('dead_line')));
            $m->setDescription($this->post('description'));
            $m->setTitle($this->post('title'));

        }
        $rm =new RocketModel();
        $m->setResolutionresolution($rm->get_resolution($this->post('resolution')));

        $m =$rm->save_milestone($m);
        $id =$m->getIdmilestone();
        if(isset($id))
        {
            //$message = array('id' => $this->db->insert_id(), 'title' => $this->post('title'));
            $this->response(json_encode(array($m)), 200);
        }
    }

    public function milestone_put()
    {
        if(! $this->put('id'))
        {
            $this->response(array('error' => 'Milestone id  is required'), 400);
        }
        if(! ($this->put('title')))
        {
            $this->response(array('error' => 'Missing Milestone data: title '), 400);
        }
        elseif(! ($this->put('description')))
        {
            $this->response(array('error' => 'Missing Milestone data: description'), 400);
        }
        elseif(! ($this->put('resolution')))
        {
            $this->response(array('error' => 'Missing Milestone data: resolution'), 400);
        }elseif(! ($this->put('dead_line')))
        {
            $this->response(array('error' => 'Missing Resolution data: dead_line'), 400);
        }elseif(! ($this->put('status')))
        {
            $this->response(array('error' => 'Missing Milestone data: status'), 400);
        }
        $rm =new RocketModel();

        $m = $rm->get_milestone($this->put('id'));
        //$m = new Milestone();
        $m->setTitle($this->put('title'));
        $m->setDescription($this->put('description'));
        $m->setStatus($this->put('status'));
        $m->setResolutionresolution($rm->get_resolution($this->put('resolution')));
        $m->setDeadLine(DateTime::createFromFormat('Y-m-d H:i:s',$this->put('dead_line')));

        $rm->save_milestone($m);

        $message = array('success' => $this->put('title').' Updated!');
        $this->response(json_encode(array($message,$m)), 200);
    }

    public function milestone_delete($id=NULL)
    {
        if($id == NULL)
        {
            $message = array('error' => 'Missing delete data: id');
            $this->response($message, 400);
        } else {
            $rm = new RocketModel();
            $rm->delete_milestone($id);
            $message = array('id' => $id, 'message' => 'DELETED!');
            $this->response($message, 200);
        }
    }






}