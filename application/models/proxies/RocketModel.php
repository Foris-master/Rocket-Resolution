<?php

/**
 * Created by PhpStorm.
 * User: evari
 * Date: 13/11/2015
 * Time: 10:42
 */

require_once(APPPATH."models/Entities/Category.php");
require_once(APPPATH."models/Entities/Coach.php");
require_once(APPPATH."models/Entities/Resolution.php");
require_once(APPPATH."models/Entities/User.php");
require_once(APPPATH."models/Entities/Priority.php");
require_once(APPPATH."models/Entities/Milestone.php");
require_once(APPPATH."models/Entities/Atout.php");
require_once(APPPATH."models/Entities/Group.php");
require_once(APPPATH."models/Entities/CoachDemand.php");
use \Category;

class RocketModel extends CI_Model
{

    var $em;

    public function __construct() {
        parent::__construct();
        $d = new Doctrine();
        $this->em = $d->em;
       // $this->em = $this->doctrine->em;

    }

    /**
     * @param $categorie
     * @return bool
     */
    function  save_category(Category $c){


        try {
            //save to database
          //  $c = new Category();
            $id =$c->getIdcategory();
            if(isset($id)){
               $this->em->merge($c);
            }else{
                $this->em->persist($c);
            }

            $this->em->flush();

        }
        catch(Exception $err){

            die($err->getMessage());
        }
        return $c;
    }

    function get_category($id){
        try{

           return $this->em->find('Category',$id);

        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    function delete_category($id){
        try{

            $c = $this->em->find('Category',$id);
            $this->em->remove($c);
            $this->em->flush();

        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    function filter_category($name=""){
        try{

            if(empty($name)){

                $records = $this->em->getRepository("Category")->findAll();
            }else{

                $records = $this->em->getRepository("Category")->findOneBy(array('name'=>$name));
            }

           return $records;
        }catch (Exception $e){
            die($e->getMessage());
        }
    }


    function  save_priority(Priority $p){


        try {
            //save to database
            //  $c = new Category();
            $id =$p->getIdpriority();
            if(isset($id)){
                $this->em->merge($p);
            }else{
                $this->em->persist($p);
            }

            $this->em->flush();

        }
        catch(Exception $err){

            die($err->getMessage());
        }
        return $p;
    }

    function get_priority($id){
        try{

            return $this->em->find('Priority',$id);

        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    function delete_priority($id){
        try{

            $p = $this->em->find('Priority',$id);
            $this->em->remove($p);
            $this->em->flush();

        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    function filter_priority($name=""){
        try{

            if(empty($name)){

                $records = $this->em->getRepository("Priority")->findAll();
            }else{

                $records = $this->em->getRepository("Priority")->findOneBy(array('name'=>$name));
            }

            return $records;
        }catch (Exception $e){
            die($e->getMessage());
        }
    }


    function  save_group(Group $g){


        try {
            //save to database
            //  $c = new Category();
            $id =$g->getIdgroup();
            if(isset($id)){
                $this->em->merge($g);
            }else{
                $this->em->persist($g);
            }

            $this->em->flush();

        }
        catch(Exception $err){

            die($err->getMessage());
        }
        return $g;
    }

    function get_group($id){
        try{

            return $this->em->find('Group',$id);

        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    function delete_group($id){
        try{

            $g = $this->em->find('Group',$id);
            $this->em->remove($g);
            $this->em->flush();

        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    function filter_group($name="",$tag=""){
        try{

            if(empty($name)){
                if(empty($tag)){
                    $records = $this->em->getRepository("Group")->findOneBy(array('tag'=>$name));

                }else{
                    $records = $this->em->getRepository("Group")->findAll();
                }

            }else{

                $records = $this->em->getRepository("Group")->findOneBy(array('name'=>$name));
            }

            return $records;
        }catch (Exception $e){
            die($e->getMessage());
        }
    }


    function  save_user(User $u){


        try {
            //save to database
            //  $c = new Category();
            $id =$u->getIduser();
            if(isset($id)){
                $this->em->merge($u);
            }else{
                $u->setCreateDate( new \DateTime('now'));
                $this->em->persist($u);
            }

            $this->em->flush();

        }
        catch(Exception $err){

            die($err->getMessage());
        }
        return $u;
    }

    function get_user($id,$user_name="",$email=""){
        try{
          if($user_name!=""){

              return $this->em->getRepository("User")->findOneBy(array('userName'=>$user_name));
          }elseif($email!="") {

              return $this->em->getRepository("User")->findOneBy(array('email'=>$email));
          }else
          {

              return $this->em->find('User',$id);
          }


        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    function delete_user($id){
        try{

            $u = $this->em->find('User',$id);
            $this->em->remove($u);
            $this->em->flush();

        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    function filter_user(array $fi=array()){
        try{

            if(count($fi)==0){

                $records = $this->em->getRepository("User")->findAll();
            }else{

                $records = $this->em->getRepository("User")->findBy($fi);
            }

            return $records;
        }catch (Exception $e){
            die($e->getMessage());
        }
    }




    function  save_coach(Coach $c){


        try {
            //save to database
            //  $c = new Category();
            $id = $c->getIdcoach();
            if(isset($id)){
                $this->em->merge($c);
            }else{
                $c->setStartDate( new \DateTime('now'));
                $c->setGrade('new');
                $this->em->persist($c);
            }

            $this->em->flush();

        }
        catch(Exception $err){

            die($err->getMessage());
        }
        return $c;
    }

    function get_coach($id){
        try{

            return $this->em->find('Coach',$id);

        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    function delete_coach($id){
        try{

            $c = $this->em->find('Coach',$id);
            $this->em->remove($c);
            $this->em->flush();

        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    function filter_coach(array $fi=array()){
        try{



            if(count($fi)==0){

                $records = $this->em->getRepository("Coach")->findAll();
            }else{

                $records = $this->em->getRepository("Coach")->findBy($fi);
            }

            return $records;
        }catch (Exception $e){
            die($e->getMessage());
        }
    }


    function save_coach_demand(CoachDemand $cd){


        try {
            //save to database
            //  $c = new Category();
            $id = $cd->getIdcoachDemand();
            if(isset($id)){
                $this->em->merge($cd);
            }else{
                $cd->setCreateDate( new \DateTime('now'));
                $cd->setStatus('new');
                $this->em->persist($cd);
            }

            $this->em->flush();

        }
        catch(Exception $err){

            die($err->getMessage());
        }
        return $cd;
    }

    function get_coach_demand($id){
        try{

            return $this->em->find('CoachDemand',$id);

        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    function delete_coach_demand($id){
        try{

            $cd = $this->em->find('CoachDemand',$id);
            $this->em->remove($cd);
            $this->em->flush();

        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    function filter_coach_demand(array $fi=array()){
        try{



            if(count($fi)==0){

                $records = $this->em->getRepository("CoachDemand")->findAll();
            }else{

                $records = $this->em->getRepository("CoachDemand")->findBy($fi);
            }

            return $records;
        }catch (Exception $e){
            die($e->getMessage());
        }
    }



    function  save_atout(Atout $a){


        try {
            //save to database
            //  $c = new Category();
            $id =$a->getIdatout();
            if(isset($id)){
                $this->em->merge($a);
            }else{
                $this->em->persist($a);
            }

            $this->em->flush();

        }
        catch(Exception $err){

            die($err->getMessage());
        }
        return $a;
    }

    function get_atout($id){
        try{

            return $this->em->find('Atout',$id);

        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    function delete_atout($id){
        try{

            $a = $this->em->find('Atout',$id);
            $this->em->remove($a);
            $this->em->flush();

        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    function filter_atout(array $fi=array()){
        try{

            if(count($fi)==0){

                $records = $this->em->getRepository("Atout")->findAll();
            }else{

                $records = $this->em->getRepository("Atout")->findBy($fi);
            }

            return $records;
        }catch (Exception $e){
            die($e->getMessage());
        }
    }


    function save_resolution(Resolution $r){


        try {
            //save to database
            //  $c = new Category();
            $id = $r->getIdresolution();
            if(isset($id)){
                $this->em->merge($r);
            }else{
                $r->setCreateDate( new \DateTime('now'));
                $r->setStatus('new');
                $this->em->persist($r);
            }

            $this->em->flush();

        }
        catch(Exception $err){

            die($err->getMessage());
        }
        return $r;
    }

    function get_resolution($id){
        try{

            return $this->em->find('Resolution',$id);

        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    function delete_resolution($id){
        try{

            $r = $this->em->find('Resolution',$id);
            $this->em->remove($r);
            $this->em->flush();

        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    function filter_resolution(array $fi=array()){
        try{



            if(count($fi)==0){

                $records = $this->em->getRepository("Resolution")->findAll();
            }else{

                $records = $this->em->getRepository("Resolution")->findBy($fi);
            }

            return $records;
        }catch (Exception $e){
            die($e->getMessage());
        }
    }



    function save_milestone(Milestone $m){


        try {
            //save to database
            //  $c = new Category();
            $id = $m->getIdmilestone();
            if(isset($id)){
                $this->em->merge($m);
            }else{

                $m->setStatus('new');
                $this->em->persist($m);
            }

            $this->em->flush();

        }
        catch(Exception $err){

            die($err->getMessage());
        }
        return $m;
    }

    function get_milestone($id){
        try{

            return $this->em->find('Milestone',$id);

        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    function delete_milestone($id){
        try{

            $m = $this->em->find('Milestone',$id);
            $this->em->remove($m);
            $this->em->flush();

        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    function filter_milestone(array $fi=array()){
        try{



            if(count($fi)==0){

                $records = $this->em->getRepository("Milestone")->findAll();
            }else{

                $records = $this->em->getRepository("Milestone")->findBy($fi);
            }

            return $records;
        }catch (Exception $e){
            die($e->getMessage());
        }
    }






}