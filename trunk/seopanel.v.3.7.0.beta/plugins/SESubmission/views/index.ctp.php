<?
$enable_form_validate= FALSE;
?>
<style>
	.CheckBoxClass,.RadioClass{
		display: none;
	}
	.CheckBoxLabelClass{
		background: url("http://submitia.com/ses/images/UnCheck.png") no-repeat;
		padding-left: 30px;
		padding-top: 3px;
		margin: 5px;
		height: 28px;	
		width: 150px;
		display: block;
	}
	.CheckBoxLabelClass:hover, .RadioLabelClass:hover{
		text-decoration: underline;
	}
	.LabelSelected{
		background: url("http://submitia.com/ses/images/Check.png") no-repeat;
	}
	.RadioLabelClass{
		background: url("http://submitia.com/ses/images/RUnCheck.png") no-repeat;
		padding-left: 30px;
		padding-top: 3px;
		margin: 5px;
		height: 28px;	
		width: 70px;
		display: block;	
		float: left;
	}
	.RadioSelected{
		background: url("http://submitia.com/ses/images/RCheck.png") no-repeat;
	}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$(".CheckBoxClass").change(function(){
		if($(this).is(":checked")){
			$(this).next("label").addClass("LabelSelected");
		}else{
			$(this).next("label").removeClass("LabelSelected");
		}
	});
	$(".RadioClass").change(function(){
		if($(this).is(":checked")){
			$(".RadioSelected:not(:checked)").removeClass("RadioSelected");
			$(this).next("label").addClass("RadioSelected");
		}
	});	
});
</script>
<center>
<?php echo showSectionHead($sectionHead); ?>
<form id="seform" action="?sec=show" method="post">
<table width="56%" border="0" cellspacing="0" cellpadding="0" class="search">
	<tr>				
		<th>Website URL: </th>
		<td>
			<input type="text" id="url" name="url" value="<?=stripslashes($info['url'])?>" size="42">
		</td>
	</tr>
	<tr>				
		<th>E-mail: </th>
		<td>
			<input type="text" id="email" name="email" value="<?=stripslashes($info['email'])?>" size="42">
		</td>
	</tr>	
	
            <?
	$engine_file = dirname(dirname(__FILE__) ) . "/engines.dat";
	
	$engines_temp = @file($engine_file);
	$temp_engine = array();
	$engines     = array();


$index=0; //index of filtered array
while(list($key,$val)=each($engines_temp))
	{
	 $temp_engine = explode('#',$val);
	 $temp_engine[0] = trim($temp_engine[0]);
	 if(!empty($temp_engine[0])) $engines[$index++]=$temp_engine[0];	 
	}
	
	echo '<div>
				<table width="85%" border="0" align="center" cellpadding="2" cellspacing="10">
				<tr>
							<td><!------start engine list------->
						<TABLE>	
						<tr>
	';
	
	$num_of_cols = 7;		
	for($i=0,$j=1;$i<sizeof($engines);$i++,$j++)	
	{
		$temp=explode(',',$engines[$i]);
		echo " <TD>\n\t<input type=\"checkbox\" id=\"CheckBox$i\" name=\"selected_engines[$i]\" value=\"".trim($temp[0])."\"  checked>\n<label id=\"Label$i\" for=\"CheckBox$i\">".ucwords(trim($temp[0]))."</label></TD>";
		
		if($j==$num_of_cols) 
			{
				$j=0;
				echo "</tr>\n<tr>";
			}		
	}
	
	echo '
	</tr>
		</TABLE>
		<!----end engine list----->&nbsp;</td>
		  </tr>
		</table>	
		</div>
	';
	?>
	
	<tr>
		<th></th>
		<td align='center'>
			<a onclick="showDiv('submitnote');<?php echo pluginPOSTMethod('seform', 'subcontent', 'action=submit'); ?>" href="javascript:void(0);"><img border="0" alt="" src="<?=SP_IMGPATH?>/submit.gif"/></a>
         </td>
	</tr>
</table>
</form>
<div id='submitnote' style="display: none;">
	<p class='note'>Please standby and relax, this process may take several minutes to submit to all search engines...</p>
</div>
<div id='subcontent'>
	<p class='note'>Please provide the <i>website</i> to <i>submit</i> 400+ search engines.</p>
</div>
</center>