<?php
class Print_Model extends CI_Model
{
		public function get_minutes( $date_to_calculate )
		{
			$minutes = 0;
			$minutes = $date_to_calculate[14]*10+$date_to_calculate[15];
			$minutes += $date_to_calculate[11]*60*10+60*$date_to_calculate[12];
			return $minutes;
		}

		public function solve($table1, $table2)
		{
			//delete all tables in print

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
				$this-> db -> select('employee_id,timecard_id,start_time,end_time,paid');
				$this-> db -> from('employees natural join dayworks natural join timecards');
				$this-> db -> where('employee_id',$employee_id);
				$this-> db -> where('paid',0);
				$query = $this -> db -> get();
				$num_of_timecard = $query-> num_rows;
				if( $num_of_timecard == 0 )
				{
					$index = $index + 1;
					continue;
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
				$num_of_timecard = $num_of_timecard - 1;
				if( $result[1][0]['pay_type']=='daily' )
				{
					while( $num_of_timecard>=0 )
					{
						$start_work_time = $this->get_minutes( $result[0][$num_of_timecard]['start_time'] );
						$end_work_time = $this->get_minutes( $result[0][$num_of_timecard]['end_time'] );
						if( $result[0][$num_of_timecard]['paid']==0 && ($end_work_time-$start_work_time)>=240 )
						{
							$data[ 'wage' ] += $result[1][0]['wage'];
						}
						$result[0][$num_of_timecard]['paid'] = 1;

						$temp_timecard['timecard_id'] = $result[0][$num_of_timecard]['timecard_id'];
						$temp_timecard['start_time'] = $result[0][$num_of_timecard]['start_time'];
						$temp_timecard['end_time'] = $result[0][$num_of_timecard]['end_time'];
						$temp_timecard['submitted'] = '0';
						$temp_timecard['paid'] = '1';
						$this-> db ->where('timecard_id',$temp_timecard['timecard_id']);
						$this-> db ->update('timecards',$temp_timecard);
						//update timecards

						$num_of_timecard = $num_of_timecard - 1;
					}
				}
				else if( $result[1][0]['pay_type']=='hourly' )
				{
					while( $num_of_timecard>=0 )
					{
						$start_work_time = $this->get_minutes( $result[0][$num_of_timecard]['start_time'] );
						$end_work_time = $this->get_minutes( $result[0][$num_of_timecard]['end_time'] );
						if( $result[0][$num_of_timecard]['paid']==0 ){
							$data[ 'wage' ] += $result[1][0]['wage']*(($end_work_time-$start_work_time)/60);
						}
						$result[0][$num_of_timecard]['paid'] = 1;
						
						$temp_timecard['timecard_id'] = $result[0][$num_of_timecard]['timecard_id'];
						$temp_timecard['start_time'] = $result[0][$num_of_timecard]['start_time'];
						$temp_timecard['end_time'] = $result[0][$num_of_timecard]['end_time'];
						$temp_timecard['submitted'] = '0';
						$temp_timecard['paid'] = '1';
						$this-> db ->where('timecard_id',$temp_timecard['timecard_id']);
						$this-> db ->update('timecards',$temp_timecard);
						//update timecards

						$num_of_timecard = $num_of_timecard - 1;
					}
				}

				$this-> db ->select('employee_id');
				$this-> db ->from('print');
				$query = $this-> db -> get();
				$print_result = $query -> result_array();
				$print_result_num = $query -> num_rows - 1;
				$flag = false;
				echo $print_result_num;
				echo ";";
				while( $print_result_num>=0 )
				{
					if( $print_result[$print_result_num]['employee_id']==$data['employee_id'] )
					{
						$flag = true;
						$print_result[$print_result_num]['wage'] = $data['wage'];
						$this-> db ->where('employee_id',$data['employee_id']);
						$this-> db ->update('print',$print_result[$print_result_num]);
						break;
					}
					$print_result_num = $print_result_num -1;
				}
				if( $flag==false )
				{
					echo "data1 = ";
					echo $data['wage'];*/
					$this-> db ->insert('print',$data);
				}
				$index ++;
			}
		}

}
?>