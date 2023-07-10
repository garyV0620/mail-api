<?php
class Database
{
    protected $connection = null;
 
    public function __construct()
    {
        try {
            $this->connection = new PDO(DNS, DB_USERNAME, DB_PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            if ( !$this->connection ) {
                throw new Exception("Could not connect to database.");   
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());   
        }           
    }
 
    public function select($query = "" , $params = array())
    {
        try {
            $stmt = $this->executeStatement( $query , $params );
            $result = $stmt->fetchAll() ;               
            
            return $result;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }
        return false;
    }
 
    private function executeStatement($query = "" , $params = array())
    {
        try {
            $stmt = $this->connection->prepare( $query );
 
            if($stmt === false) {
                throw New Exception("Unable to do prepared statement: " . $query);
            }
 
            
            foreach($params as $key => &$value){
                if(is_int($value)){
                    $stmt->bindParam($key, $value, PDO::PARAM_INT);
                }else{
                    $stmt->bindParam($key, $value, PDO::PARAM_STR);
                }
                
            }
 
            $stmt->execute();
 
            return $stmt;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }   
    }
}