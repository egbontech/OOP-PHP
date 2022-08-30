<?php


class Session{

    public function  __construct()
    {
                
    }

    //start session
    private function start_session()
    {
        if(!isset($_SESSION))
        {
            session_start();
        }
    }
    
    //delete session variables
    public function  flush()
    {
        $this->start_session();
        session_destroy();         
    }

    //set session variables
    public function  set($mykey, $myvalue = '')
    {
        $this->start_session();

       if(is_string($mykey))
       {
          $_SESSION[$mykey] = $myvalue;
       }        
       elseif (is_array($mykey))
       {
            foreach ($mykey as $key => $value)
            {
                $_SESSION[$key] = $value;
            }        
       }
    }

    /*public function  append($arr, $myvalue = '')
    {
        $this->start_session();         
       
            foreach ($arr as $key => $value)
            {
                $_SESSION[$key] = $value;
            }        

    }*/

    public function get($key)
    {
        $this->start_session();

        if(isset($_SESSION[$key]))
        {
           return $_SESSION[$key];
        }
        
        return null;
    }  

    public function exists($key)
    {
        $this->start_session();

        if(isset($_SESSION[$key]))
        {
           return true;
        }
        
        return false;
    }   

    public function destroy($key)
    {
        $this->start_session();

        if(isset($_SESSION[$key]))
        {
           unset($_SESSION[$key]);
           return true;
        }
        
        return false;
    }    

    public function regenerate()
    {
        session_regenerate_id();
    }
   
}


