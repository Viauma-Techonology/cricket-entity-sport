<?php

class Entity_cricket extends Entity
{
    function __construct(){
        parent::__construct();
    }

    #If you do not send the id than u get all data other perticular id info.

    #for get data for all season call get_seasons_data()
    #for get data for perticular season call get_seasons_data($sid,$args)...$sid eg- 2018,201819 etc.
    public static function get_seasons_data($sid=0 ,$args=array()){
        if(!empty($sid)){
            $path = "season/$sid/competitions";
        }else{
            $path = "seasons";
        }
        $calling = new Entity();
        return $calling->api_request($path,$args);
    }

    #for get data for all competitions call get_competitions_data($cid=0,$args)
    #here args use for filter data you get. Like paged,per_page,status with those variables.
    #status status code 1 = upcoming, 2 = result, 3 = live.
    #yearmonth=2018-02 parameter to list competitions from specific month. example - 2018-02(yyyy-mm)
    public static function get_competitions_data($cid=0 ,$args=array()){
        if(!empty($cid)){
            $path = "competitions/$cid";
        }else{
            $path = "competitions";
        }
        $calling = new Entity();
        return $calling->api_request($path,$args);
    }

    #get perticular competitions info with stats ,squads , matches call get_competitions_data($cid,$args)
    #this  get_competition_squad($cid) ,get_competition_matches($cid), get_competition_statstic($cid)
    public static function get_competition_squad($cid,$args=array()){
        $path = "competitions/$cid/squads";

        $calling = new Entity();
        return $calling->api_request($path,$args);
    }

    public static function get_competition_matches($cid,$args=array()){
        $path = "competitions/$cid/matches";
        
        $calling = new Entity();
        return $calling->api_request($path,$args);
    }

    public static function get_competition_teams($cid,$args=array()){
        $path = "competitions/$cid/teams";
        
        $calling = new Entity();
        return $calling->api_request($path,$args);
    }

    public static function get_competition_standings($cid,$args=array()){
        $path = "competitions/$cid/standings";
        
        $calling = new Entity();
        return $calling->api_request($path,$args);
    }

    public static function get_competition_statstic($cid,$args=array(),$stats=''){
        $path = "competitions/$cid/stats";
        if(!empty($stats)){
            $path = "competitions/$cid/stats/$stats";
        }
        
        $calling = new Entity();
        return $calling->api_request($path,$args);
    }

    /*for get data for all metches call get_matches_data($mid=0,$args=array())
    here args use for filter data you get. Like paged,per_page,status with those variables.
    here you can filter matches between dates start_date and end_date with formate yyyy-mm-dd; 
    status status code 1 = upcoming, 2 = result, 3 = live.  
    formate filter matches by format (ie: odi, test). see properties reference for match format codes */ 
    public static function get_matches_data($mid=0 ,$args=array()){
        if(!empty($mid)){
            $path = "matches/$mid/info";
        }else{
            $path = "matches";
        }
        if(!empty($args['start_date']) || !empty($args['end_date'])){
            $return_error = new stdClass ;
            $return_error->status = 'error';
            $start = $args['start_date'];
            $end = $args['end_date'];
            if($start > $end || $start == $end){
                $return_error->response = 'start date should be less than end date.';
                return $return_error;
            }else{
                $args['date'] = $args['start_date'].'_'.$args['end_date'];
                unset($args['start_date']);
                unset($args['end_date']);
            }
        }
        
        $calling = new Entity();
        return $calling->api_request($path,$args);
    }

    #get perticular metches info with scorecard  , fantacy call get_matches_scorecard($mid,$args) get_matches_fantasy($mid,$args) ,get_matches_live($mid,$args)
    public static function get_matches_scorecard($mid,$args=array()){
        $path = "matches/$mid/scorecard";
        
        $calling = new Entity();
        return $calling->api_request($path,$args);
    }

    public static function get_matches_fantasy($mid,$args=array()){
        $path = "matches/$mid/point";
        
        $calling = new Entity();
        return $calling->api_request($path,$args);
    }

    public static function get_matches_live($mid,$args=array()){
        $path = "matches/$mid/live";
        
        $calling = new Entity();
        return $calling->api_request($path,$args);
    }

    public static function get_matches_squads($mid,$args=array()){
        $path = "matches/$mid/squads";
        
        $calling = new Entity();
        return $calling->api_request($path,$args);
    }

    public static function get_matches_statistics($mid,$args=array()){
        $path = "matches/$mid/statistics";
        
        $calling = new Entity();
        return $calling->api_request($path,$args);
    }

    public static function get_matches_wagons($mid,$args=array()){
        $path = "matches/$mid/wagons";
        
        $calling = new Entity();
        return $calling->api_request($path,$args);
    }

    #get perticular Match Innings Commentary API
    public static function get_matches_inning_commentry($mid,$inning_num,$args=array()){
        $path = "matches/$mid/innings/$inning_num/commentary";
        
        $calling = new Entity();
        return $calling->api_request($path,$args);
    }

    #get perticular Fantasy Match Roaster API
    public static function get_matches_fantacy_roaster($cid,$mid,$args=array()){
        $path = "competitions/$cid/squads/$mid";
        
        $calling = new Entity();
        return $calling->api_request($path,$args);
    }

    #for get data for team data call get_teams_data($tid=0,$args)
    public static function get_teams_data($tid,$args=array()){
        $path = "teams/$tid";

        $calling = new Entity();
        return $calling->api_request($path,$args);
    }

    #for get data for all teams maches call get_teams_maches($tid,$args)
    public static function get_teams_maches($tid ,$args=array()){
        $path = "teams/$tid/matches";

        $calling = new Entity();
        return $calling->api_request($path,$args);
    }

    #for get data for all players call get_players_data($pid=0,$args)
    #for get data for plater profile call get_players_data($pid,$args)
    public static function get_players_data($pid=0 ,$args=array()){
        if(!empty($pid)){
            $path = "players/$pid";
        }else{
            $path = "players";
        }
        $calling = new Entity();
        return $calling->api_request($path,$args);
    }

    public static function get_players_stats($pid,$args=array()){
        $path = "players/$pid/stats";
        
        $calling = new Entity();
        return $calling->api_request($path,$args);
    }

    # get icc ranking for player iccranks
    public static function get_cricket_iccranks($args=array()){
        $path = "iccranks";
        
        $calling = new Entity();
        return $calling->api_request($path,$args);
    }
}