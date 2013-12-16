<?php
class Print_Model extends CI_Model
{
		public function solve($table1, $table2)
		{
		 	$this-> db -> select('employee_id');
		 	$this-> db -> from('employees');
		 	$query = $this-> db -> get();
		 	$num_of_employee = $query -> num_rows;
		 	$query_employee = $query->result_array();
		 	$index = 0;

		 	while( $num_of_employee-- )
		 	{
				$employee_id = $query_employee[ $index ][ 'employee_id' ];
				//get current employee_id;
				$this-> db -> select('timecard_id,start_time,end_time');
				$this-> db -> from('employees natural join dayworks natural join timecards');
				$this-> db -> where('employee_id',$employee_id);
				$query = $this -> db -> get();
				$num_of_timecard = $query-> num_rows;
				if( $query-> num_rows == 0 )
				{
					return false;
				}
				$result[0] = $query -> result_array();
				//获取当前用户的所有的timecard
				//Timecard 多条记录
				$this-> db -> select('employee_id,name,type_id,bank_account,pay_type,wage,position');
				$this-> db -> from('employees natural join types');
				$this-> db -> where('employee_id',$employee_id);
				$query = $this -> db -> get();
				$result[1] = $query -> result_array();
				//获取当前用户的相关信息
				$data[ 'name' ] = $result[1][0]['name'];//name
				$data[ 'employee_id' ] = $employee_id;
				$data[ 'position' ] = $result[1][0]['position'];
				$data[ 'wage' ] = 0;//wage
				$data[ 'bank_account' ] = $result[1][0]['bank_account'];//bank acount
				//data为即将要插入print的数据
				$num_of_timecard --;
				if( $result[1][0]['pay_type']=='daily' ){
					while( $num_of_timecard>=0 )
					{
						if( $result[0][$num_of_timecard]['end_time']-$result[0][$num_of_timecard]['start_time']>=8 )
						{
							$data[ 'wage' ] += $result[1][0]['wage'];
							//wage
						}
						$num_of_timecard = $num_of_timecard - 1;
					}
				}
				else if( $result[1][0]['pay_type']=='hourly' )
				{
					while( $num_of_timecard>=0 )
					{
						$data[ 'wage' ] += $result[1][0]['wage']*($result[0][$num_of_timecard]['end_time']-$result[0][$num_of_timecard]['start_time']);
						//wage
						$num_of_timecard = $num_of_timecard - 1;
					}
				}

				$this-> db ->select('employee_id');
				$this-> db ->from('print');
				$temp_query = $this-> db ->get();
				$temp_query_result = $temp_query->result_array();
				$temp_index = 0;
				$temp_cnt = $temp_query->num_rows;
				$insert_or_not = false;
				while( $temp_cnt -- ){
					if( $data['employee_id']==$temp_query_result[ $temp_index ]['employee_id'] ){
						$insert_or_not = true;
						break;
					}
					$temp_index ++;
				}
				//验证当前用户是否在print已经出现
				if( $insert_or_not==false ){
					$this-> db ->insert('print',$data);
				}
				$index ++;
			}
		}
}
?>