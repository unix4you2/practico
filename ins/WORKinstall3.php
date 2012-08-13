<?php 
// Rem this if your server admin has register_globals turned on.
// It just converts global variables into local variables
foreach($HTTP_POST_VARS as $postvar => $postval){ ${$postvar} = $postval; }
foreach($HTTP_GET_VARS as $getvar => $getval){ ${$getvar} = $getval; }		  


define( "_VALID_LM", 1 );
$lm_absolute_path=$cabsolute_path;
$lm_db=$cdb;
$lm_prefix=$cprefix;
$lm_dbhost=$cdbhost;
$lm_dbname=$cdbname;
$lm_dbusername=$cdbusername;
$lm_dbpassword=$cdbpassword;
	
					  
$classes_dir=$lm_absolute_path."classes/";
$includes_dir=$lm_absolute_path."includes/";
include($lm_absolute_path."admin/includes/admin_functions.php");	  					  
include($lm_absolute_path."includes/functions.php");
include($lm_absolute_path."includes/dblayer.php");
				
if(!$conn->connect){
		echo "<script> alert('"._INSTALL_3_DB_ERROR."'); window.history.go(-1); </script>\n";
    	exit();
}					  
					
?>      <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
              
        <tr bgcolor="f7f7f7"> 
                
          <td width="44%" class="menuheader">config.php 
                </td>
          <td width="56%">&nbsp;</td>
        </tr>
              
        <tr> 
                
          <td colspan="2"><div align="left" class="f8"><font color="#CCCCCC"><font color="#999999"><?php echo _INSTALL_3_CONFIG_EXP;?></font></font></div></td>
        </tr>
              
        <tr> 
                
          <td width="60%"><?php echo _INSTALL_3_CONFIG_WRITE;?></td>
          <td width="40%">
		              
<?php  


	$rand="";
	$salt = "abchefghjkmnpqrstuvwxyz0123456789";
	srand((double)microtime()*1000000);
	$i = 0;
	while ($i <= 10) {
		$num = rand() % 33;
		$tmp = substr($salt, $num, 1);
		$rand = $rand . $tmp;
		$i++;
		}
		
//---------Uses ADODB to perform Database connectivity 
$out=sprintf("<?php
\$lm_website='%s';
\$lm_absolute_path='%s';
\$lm_title='%s';
\$lm_online='1';
\$lm_offline_msg='This site is down for maintenance.
Please check back again soon.';
\$lm_hideauthor='0';
\$lm_hidecreate='0';
\$lm_hidemodified='0';
\$lm_hideprint='0';
\$lm_hideemail='0';
\$lm_db='%s';
\$lm_prefix='%s';
\$lm_dbhost='%s';
\$lm_dbname='%s';
\$lm_dbusername='%s';
\$lm_dbpassword='%s';
\$lm_cache='1';
\$lm_qcache='1';
\$lm_name='%s';
\$lm_username='%s';
\$lm_password='%s';
\$lm_email='%s';
\$lm_event='1';
\$lm_adminlang='english.php';
\$lm_language='english';
\$lm_template='247portal';
\$lm_keywords='No key words ';
\$lm_desc='Welcome to php website';
\$lm_gzip='0';
\$lm_seo='0';
\$lm_error_level='0';
\$lm_locale='en_GB';
\$lm_show_count='20';
\$lm_offset='0';
\$lm_userregistration='0';
\$lm_useractivation='0';
\$lm_emailpass='0';
\$lm_htmledit='tiny_mce';
\$lm_updates='http://www.limbo-cms.com/addons/updates.php';
\$lm_version_num='1.0.4.2';
\$lm_rand='%s';
?>",$cwebsite,$cabsolute_path,$ctitle,$cdb,$cprefix,$cdbhost,$cdbname,$cdbusername,$cdbpassword,$cname,$cusername,$cpassword,$cemail,$rand);

	$write_errror=false;
	$fp=fopen($cabsolute_path."config.php","w");
	if($fp==null)
	{
	$write_errror=true;
	}
	else {
	 fwrite($fp,$out,strlen($out)); 
	 fclose($fp);
	 }
	 if(!is_dir($cabsolute_path."data/cache"))mkdir($cabsolute_path."data/cache",0777);
  ?>
              <?php 
				if(!$write_errror)
				{echo '<b><font color="green">'._INSTALL_3_SUCCESS.'</font></b>'; }
				else {echo  '<b><font color="red">'._INSTALL_3_CONFIG_ERROR.'</font></b>';
				}

				?>
</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><?php echo _INSTALL_3_CONFIG_CONTENT;?><br>
            <textarea name="textarea" cols="40" rows="10"><?php echo $out;?></textarea></td>
        </tr>
            
      </table>
      <br>
      <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
              
        <tr bgcolor="f7f7f7"> 
                
          <td colspan="2" class="menuheader"><?php echo _INSTALL_3_DB;?></td>
        </tr>
              
        <tr> 
                
          <td colspan="2"><div align="left" class="f8"><font color="#999999"><?php echo _INSTALL_3_DB_EXP;?></font></div></td>
        </tr>
              
        <tr> 
                
          <td width="60%"><?php echo _INSTALL_3_DB_WRITE;?></td>
          <td width="40%">
		              
            <?php			  
					  
					  $fp=fopen($cabsolute_path."install/install.sql","r");
					  $query= fread($fp,filesize($cabsolute_path."install/install.sql"));
					  fclose($fp);
 
					  $query_arr = split_sql($query);
					  foreach($query_arr as $query)
					  	{
						$conn->Execute($query);
						}
					$conn->Execute("INSERT INTO #__users (id,name,username,email,password,usertype,registerDate,gid) 
									VALUES (1,'$cname','$cusername','$cemail','".md5($cpassword)."','Administrator','$time',5)");						
							
					  ?>
            <b><font color="green"><?php echo _INSTALL_3_SUCCESS;?></font></b></td>
        </tr>
            
      </table>
      <br>
      <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
              
        <tr bgcolor="f7f7f7"> 
                
          <td width="58%" class="menuheader"><?php echo _INSTALL_3_DELETE;?></td>
          <td width="42%">&nbsp;</td>
        </tr>
              
        <tr> 
                
          <td colspan="2"><div align="left" class="f8"><font color="#CCCCCC"><font color="#999999"><?php echo _INSTALL_3_DELETE_EXP;?></font></font></div></td>
        </tr>
            
      </table>
      <br>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                
        <tr>
                  
          <td><div align="right"><a href="../index.php" class="menulink"><?php echo _INSTALL_3_FRONT;?></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="../admin.php" class="menulink"><?php echo _INSTALL_3_ADMIN;?></a>&nbsp;&nbsp;</div></td>
        </tr>
              </table>