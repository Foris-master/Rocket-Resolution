<?php

/**
 * Created by PhpStorm.
 * User: evari
 * Date: 24/11/2015
 * Time: 10:47
 */
class json_serializer_helper
{

    function categorySerialize(Category $c)
    {
        return array('id'=>$c->getIdcategory(),
            'name'=> $c->getName(),
            'description'=>$c->getDescription()
        );
    }

    function coachSerialize(Coach $c)
    {
        return array('id'=>$c->getIdcoach(),
            'grade'=> $c->getGrade(),
            'start_date'=>$c->getStartDate(),
            'user'=>$c->getUseruser()
        );
    }

    function milestoneSerialize(Milestone $m)
    {
        return array('id'=>$m->getIdmilestone(),
            'title'=> $m->getTitle(),
            'description'=>$m->getDescription(),
            'start_date'=>$m->getStartDate(),
            'end_date'=>$m->getEndDate(),
            'status'=>$m->getStatus(),
            'icon'=>$m->getIcon(),
            'dead)line'=>$m->getDeadLine(),
            'resolution'=>$m->getResolutionresolution()
        );
    }

    function prioritySerialize(Priority $p)
    {
        return array('id'=>$p->getIdpriority(),
            'name'=> $p->getName(),
            'value'=>$p->getValue()
        );
    }

    function resolutionSerialize(Resolution $r)
    {
        return array('id'=>$r->getIdresolution(),
            'title'=> $r->getTitle(),
            'description'=>$r->getDescription(),
            'start_date'=>$r->getStartDate(),
            'end_date'=>$r->getEndDate(),
            'status'=>$r->getStatus(),
            'create_date'=>$r->getCreateDate(),
            'category'=>$r->getCategorycategory(),
            'user'=>$r->getUseruser(),
            'priority'=>$r->getPrioritypriority()
        );
    }

    function userSerialize(User $u)
    {
        return array('id'=>$u->getIduser(),
            'email'=> $u->getEmail(),
            'first_name'=>$u->getFirtsName(),
            'last_name'=>$u->getLastName(),
            'phone'=>$u->getPhone(),
            'localization'=>$u->getLocalization(),
            'password'=>$u->getPassword(),
            'create_date'=>$u->getCreateDate()
        );
    }



}