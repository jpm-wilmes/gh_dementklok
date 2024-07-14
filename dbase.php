<?php
    /*
    * DO NOT ALTER THIS PROGRAM. ONLY CREDENTIALS STARTING LINE 18 CAN BE MODIFIED
    * Use like this:Create a new file. In this file you start with
    * *********************** SAMPLE CODE **************************************
    * <?php
    *   require_once(databaseconnection.inc.php);
    *   $sql = "SELECT * FROM tb_pokemon WHERE uuid = ?"; //Just an example, adjust for yourself
    *   $data = array('Er459-GsoIu789-3564GSZXXH'); //Just an example, adjust for yourself
    *   $result = getData($sql, $data);
    *   foreach($result[0] as $key => $value) {
    *        echo $value['name'];
    *        //here some more code
    *    }
    * ?>
    ************************** END SAMPLE CODE ************************************

    CREDENTIALS FOR DATABASE TO BE USED:    
*/

        define("DBHOST", "localhost"); // hostname (mostly localhost)
        define("DBNAME", "wimtabel"); // name of the database
        define("DBUSER", "root"); // name of the databaseuser ie. root
        define("DBPASS", ""); // password of the databaseuser

    // DO NOT MODIFY BELOW THIS LINE

    function dbConnect() {
        // We start with declaration and initialise some variables
        $dbhost		= DBHOST;
        $dbname		= DBNAME;
        $dbuser		= DBUSER;
        $dbpass		= DBPASS;
        $charset    = 'utf8mb4'; // Also allow storage of symbols, not only characters

        // Building connectionstring
        $conn = "mysql:host=" . $dbhost . "; dbname=" . $dbname . ";charset=". $charset;

        // define options for PDO connection
        $options = [ 
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,	// give error in case of issue
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,   	// get row indexed by column name
            PDO::ATTR_EMULATE_PREPARES   => false
        ];

        // Here we're gonna try to execute database query
        try {
            $pdo = new PDO($conn, $dbuser, $dbpass, $options); // create connection
            return $pdo; // give it back to the place where it's been called
        } // end of try
        catch (\PDOException $e) {
            //only when above goes wrong
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        } // end of catch

    } //

    // Easy to use function to call database. getData is the only function required outside of this document
    // Connection is handled and kept inside
   function getData($p_sSql, $p_aData = "") {
        // execute query on Mysql server
        // $p_sSQL contains MySql query string
        // $p_aData contains array with query parameters

        $pdo    = dbConnect();              // connect to DB
        $stmt   = $pdo->prepare($p_sSql);   // prepare the query
        if(is_array($p_aData)) {		    
            $stmt->execute($p_aData);	    // add the data and execute the query
        } else {
            $stmt->execute();			    // execute without data
        }
        
        $result = $stmt->fetchAll(); // fetch result
        return $result; // return query result
    }

    // Use this if you need json
    function jsonParse($p_sValue) {
        if(is_array($p_sValue)) { // array to string
            return json_encode($p_sValue);
        }
        if(is_string($p_sValue)) { // string to array
            return json_decode($p_sValue);
        }
    }