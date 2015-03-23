<?
		require(dirname(dirname(__FILE__) ) . '/SubmitForce.class.php');
		$engine_file = dirname(dirname(__FILE__) ) . "/engines.dat";
		
		define("DEBUG", 0);
		define("ONLINE", 1); 
		
		print '
			<center><table><tr><td align="left">
		';
		
		$SF_mode = ONLINE;	
		$addit = new SubmitForce;						
		$addit->set_mode($SF_mode);	
		$addit->queue_engines($engine_file);
		$addit->init($url,$email,$user=null,$selected_engines);
		
		$addit->submit_page();
		
		//$engines = $addit->getEnginesArray();
		/*
		for($i=0;$i<sizeof($engines);$i++) {
			$temp=explode(',',$engines[$i]);		
			$addit->submit($temp[0], $temp[1], $temp[2], $temp[3], $temp[4], $temp[5]);
			echo '<script>sprogress(' . $i . ');</script>';
			flush();
		}			
		*/
		print '</td></tr></table></center>';
?>