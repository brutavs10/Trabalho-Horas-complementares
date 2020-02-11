<?php

class myPDO
{    
    protected $instance = false;
    
    private $db_drive;
    private $db_host;
    private $db_user;
    private $db_pass;
    private $db_base;
    
    
    public function __construct($db, $new_instance=false)
    {
        if($new_instance !== false)
        {
            $this->closeConnection();
        }

        $this->db_drive = $db['drive'];
        $this->db_host  = $db['host'];
        $this->db_user  = $db['user'];
        $this->db_pass  = $db['pass'];
        $this->db_base  = $db['base'];
    }
    
    protected function openConnection() 
    {
        if($this->instance === false)
        {
            try 
            {
                $this->instance = new PDO($this->db_drive.":host=".$this->db_host.";dbname=".$this->db_base, $this->db_user, $this->db_pass);
                $this->instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } 
            catch (PDOException $e)
            {
                $description = "PDO Exception: " . $e->getMessage();
                
                trigger_error($description, E_USER_NOTICE);
                
                exit;
            }
            catch (Exception $e) 
            {
                $description = "DB Exception: " . $e->getMessage();
                
                trigger_error($description, E_USER_NOTICE);
                
                exit;
            }
        }
    }
    
    public function closeConnection() 
    {
        $this->instance = false;
    }
    
    protected function executeSql($sql, $parameters) 
    {
        try 
        {
            $this->instance->exec("USE " . $this->db_base);
            $executeSql = $this->instance->prepare($sql);
            
            if($executeSql->execute($parameters) !== false)
            {
                return $executeSql;
            }
            else
            {
                return false;
            }
        }  
        catch (PDOException $e)
        {
            $description = "SQL PDOException: " . $e->getMessage() . '. SQL-Prs: ' . $sql . '. Parameters: ' . json_encode($parameters);
            
            trigger_error($description, E_USER_NOTICE);
            
            return false;
        }
        catch (Exception $e) 
        {
            $description = "SQL Exception: " . $e->getMessage() . '. SQL-Prs: ' . $sql . '. Parameters: ' . json_encode($parameters);
            
            trigger_error($description, E_USER_NOTICE);
            
            return false;
        }
    }
    
    protected function returnAllSqlLines($sqlReturned)
    {
        return $sqlReturned->fetchAll(PDO::FETCH_ASSOC);
    }
    
    protected function returnAffectedSqlLines($sqlReturned)
    {
        return $sqlReturned->rowCount();
    }

    ######################################
    ##############   CRUD   ##############
    ######################################
    
    public function select($sql, $parameters=array())
    {
        $this->openConnection();
        
        $retorno = $this->executeSql($sql, $parameters);
            
        if($retorno !== false)
        {
            return $this->returnAllSqlLines($retorno);
        }
        else
        {
            return false;
        }
    }
    
    public function insert($sql, $parameters=array())
    {
        $this->openConnection();
        
        $retorno = $this->executeSql($sql, $parameters);
            
        if($retorno !== false)
        {
            return $this->instance->lastInsertId();
        }
        else
        {
            return false;
        }
    }
    
    public function update($sql, $parameters=array())
    {
        $this->openConnection();
        
        $retorno = $this->executeSql($sql, $parameters);
            
        if($retorno !== false)
        {
            return $this->returnAffectedSqlLines($retorno);
        }
        else
        {
            return false;
        }
    }
    
    public function delete($sql, $parameters=array())
    {
        $this->openConnection();
        
        $retorno = $this->executeSql($sql, $parameters);
            
        if($retorno !== false)
        {
            return $this->returnAffectedSqlLines($retorno);
        }
        else
        {
            return false;
        }
    }
}