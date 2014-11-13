<?php
	
	class dataBase {
		
		private $conn = 'link/link.php';
		//devuelve un array asociativo de uno o mas items basado en una condicion
		public function query_($table, $index, $condition){
			include $this->conn;
			$query = "SELECT * FROM ".$table." WHERE ".$index."=".$condition;
			$resultado = $mysqli->query($query);
			while($resultado->fetch_assoc()){
				return $resultado;
			}
		
			
		}
		
		function query_table($table, $extra){
			include $this->conn;
			$query = "SELECT * FROM ".$table." ".$extra;
			$resultado = $mysqli->query($query);
			$array = $resultado->fetch_all(MYSQL_ASSOC);
			return $array;
		
			
		}
		
		//devuelve un array asociativo de uno o mas items basado en una o varias condiciones. 
		//Se debe pasar la condicion(es)(indice=condicion AND OR)
		function query_multi_condition($table, $index, $condition){
			include $this->conn;
			$query = "SELECT * FROM ".$table." WHERE ".$condition;
			$resultado = $mysqli->query($query);
			while($resultado->fetch_assoc()){
				return $resultado;
			}
		
			
		}
		
		
		//retorna un resultado de uno o varios campos de  reigstros pasando la tabla, campos,indice y condition 
		function query_field_($table, $field, $index, $condition){
			include $this->conn;
			$fields="";
			if(is_array($field)){
				foreach ($field as $value){
					$fields = $value.",".$fields;
				}
				$fields = substr($fields, 0, strlen($fields)-1);
			}else{
				$fields = $field;
			}
			
			$query = "SELECT ".$fields." FROM ".$table." WHERE ".$index."=".$condition;
			$var ="";
			$resultado = $mysqli->query($query);
			$array = $resultado->fetch_all(MYSQLI_ASSOC);
			return $array;
		}
		
		
		//actualiza un campo de un registro pasando la tabla, idice a buscar, campo a actualizar, nuevo valor y condicion
		function update_($table, $index, $field, $newValue, $condition){
			include $this->conn;
			$query = "UPDATE ".$table." SET ".$field."=".$newValue." WHERE ".$index."=".$condition;
			if($mysqli->query($query)){
				if($mysqli->affected_rows>=1){
					return TRUE;
				}else{
					return FALSE;
				}
					
			}
		}	
		
		
		//Elimina un registro pasando la tabla, idice a buscar, y condicion
		function delete_($table, $index, $condition){
			include $this->conn;
			$query = "DELETE FROM ".$table." WHERE ".$index."=".$condition;
			if($mysqli->query($query)){
				if($mysqli->affected_rows>=1){
					return TRUE;
				}else{
					return FALSE;
				}
					
			}
		}
	}