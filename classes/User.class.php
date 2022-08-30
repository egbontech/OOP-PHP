<?php

class User{

    protected static $instance;

    function __construct()
    {

    }

    public static function action()
    {
        if(!self::$instance)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function create($POST)
    {
        $errors = [];
        $arr['name'] =  ucwords(trim($POST['name']));
        $email = $arr['email'] = trim($POST['email']);
        $arr['password'] = $POST['password'];
        $arr['gender'] = trim($POST['gender']);

        //check if email is already registered

        $data = DB::table('users')->select()->where("email = '$email'"); 

        if(is_array($data))
        {
            $errors[] = "This email is already registered";
        }

       
        //validation

        if(empty($arr['name']) || !preg_match("/^[a-zA-Z]+$/", $arr['name']))
        {
            $errors[] = "Name can only have letters and spaces";
        }

        if(empty($arr['email']) || !filter_var($arr['email'],FILTER_VALIDATE_EMAIL))
        {
            $errors[] = "Please enter a valid email";
        }

        if(empty($arr['password']) || strlen($arr['password']) < 4)
        {
            $errors[] = "Please enter a valid password";
        }

        if(empty($arr['gender']))
        {
            $errors[] = "Please enter a valid gender";
        }

        if(count($errors) == 0)
        {
            return DB::table('users')->insert($arr);            
        }

        return $errors;

        //save to database
    }  
    public function login($POST)
    {
        $errors = [];      
        $arr['email'] = trim($POST['email']);
        $password = $POST['password'];
      
     //check for user
       $data = DB::table('users')->select()->where("email = :email",$arr);         
       if(is_array($data))
       {
        $data = $data[0];

        if($data->password == $password)
        {
            
            $session = new Session();

            $session->regenerate();
            
            $array['name'] = $data->name;          
            $array['email'] = $data->password;
            $array['email'] = $data->email;
            $array['LOGGED_IN'] = 1;


            $session->set('Auth',$array);
            return true;
            
        }

       }
        $errors[] = "Invalid Credentials";
        return $errors;

       
    }  
    public function auth()
    {
        $session = new Session();
        if($session->exists('Auth'))
        {
            $data = $session->get('Auth');
            $arr['email'] = $data['email'];
            $data = $this->get_by_email($arr['email']);      
            if(is_array($data))
            {             
                return true;
            }
       
        }
       return false;
   }

    public function update_by_id($values,$id)
    {
        return DB::table('users')->update($values)->where("id = :id" , ["id" => $id]);
    }

    /*
     get all data from database
    */
    public function get_all()
    {
        return DB::table('users')->select()->all();
    }

 
    /*
    get data using column name
    */

    public function __call($function, $params)
    {
        $value = $params[0];

        $column = str_replace("get_by_","",$function);
        $column = addslashes($column);

        $check = DB::table('users')->query('show columns from users');
     
        $all_columns = (array_column($check, "Field"));
        
        if(in_array($column, $all_columns))
        {
            return DB::table('users')->select()->where($column." = :". $column,[$column => $value]);
        }
        return false;
        
    }
    
    
}
