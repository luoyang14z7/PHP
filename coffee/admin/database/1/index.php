<!DOCTYPE html>
<html lang="en">
<?php
header("Content-Type: text/html;charset=utf-8");
/*
    +--------------------------------------------------------------------------
    |   B-Check v0.05.5
    |   ========================================
    |   �Ϸ���������
    |   http://www.rubyfans.com
    |   ========================================
    |   ̽��ٷ�: ��
    |   ������: 2011.4.6  19:30
    |   QQ:307292967
    +---------------------------------------------------------------------------
    |
    |   �ڱ�д�����У�ѧϰ����˺ܶ����������̽��
    |   �����������������˺ܶ��޸ĺ��Ż����͵�ǰ���ԣ�����̽����Ϣ��ȫ���PHP̽���ˣ�
    |   ����ִ�п�ܣ������뵽�ľ�д���ģ���û�н��к���Ĺ滮�����룬���Ժ�����ʱ���ʱ����һ������
    |
    +--------------------------------------------------------------------------
*/

//�������еĴ�����Ϣ
ini_set('display_errors', 'off');

//����ҳ������ʱ�亯��
function getmicrotime(){
    list($usec, $sec) = explode(" ",microtime());
    return ((float)$usec + (float)$sec);
}
$pagestartime=getmicrotime();

//��ʾ����
define("on", "<font color=\"green\"><b>Yes</b></font>");
define("off", "<font color=\"red\"><b>No</b></font>");
define("version", "v0.05.5");//�汾��
define("overtime","2011.4.6&nbsp;&nbsp;19:30");//���ʱ��

//��ʾ����
$mysqlReShow = "none";

//������Ϣ���ˢ��
$ts_int = (false == empty($_POST['tsint']))?$_POST['tsint']:test_int();
$ts_float = (false == empty($_POST['tsfloat']))?$_POST['tsfloat']:test_float();
$ts_io = (false == empty($_POST['tsio']))?$_POST['tsio']:test_io();
if(isset($_POST['speed']))
{
    $speed=round(100/($_POST['speed']/1000),2);
}
elseif($_GET['speed']=="0")
{
    $speed=6666.67;
}
elseif(isset($_GET['speed']) and $_GET['speed']>0)
{
    $speed=round(100/($_GET['speed']/1000),2);
}
else
{
    $speed="<font color=red>&nbsp;δ̽��&nbsp;</font>";
}
//phpinfo()��Ϣ�о�
switch ($_GET['action']){
    case "phpinfo_GENERAL":
        phpinfo(INFO_GENERAL+INFO_ENVIRONMENT+INFO_VARIABLES);
        exit;
    case "phpinfo_CONFIGURATION":
        phpinfo(INFO_CONFIGURATION);
        exit;
    case "phpinfo_MODULES":
        phpinfo(INFO_MODULES);
        exit;
    case "phpinfo":
        phpinfo();
        exit;
    default:
        break;
}
//������
if(isset($_POST['Buginfo']) and $_POST['act']=="�ύ"){//Bug�ύ!
    $message=$message."\n\n ����:".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
    $to="307292967@qq.com";
    $subject="�Ƹ������ˣ�";
    $jg=@mail($to, $subject, $message);
    $jgprint= (true==$jg)?"<font color=\"green\">�ϱ��ɹ���лл�㣡</font>":"<font color=\"red\">�ϱ�ʧ�ܣ�д�Ÿ��Ұɣ�307292967@qq.com</font>";
}
elseif($_POST['action']=="��������")
{
    $ts_int=test_int();
}
elseif($_POST['action']=="��������")
{
    $ts_float=test_float();
}
elseif($_POST['action']=="IO����")
{
    $ts_io=test_io();
}
elseif($_POST['action']=="��ʼ����")//���ٲ��ԣ����������ơ�
{
?>
<script language="javascript" type="text/javascript">
    var acd1;
    acd1 = new Date();
    acd1ok=acd1.getTime();
</script>
<?php
for($i=1;$i<=1000;$i++){
    echo "<!--567890#########0#########0#########0#########0#########0#########0#########0#########012345-->";
}
?>
<script language="javascript" type="text/javascript">
    var acd2;
    acd2 = new Date();
    acd2ok=acd2.getTime();
    window.location = '?speed=' +(acd2ok-acd1ok)+'#bottom';
</script>
<?php
}
elseif($_POST['action'] == "����Mysql")
{
    $mysqlReShow = "show";
    $mysqlRe = "MYSQL���Ӳ��Խ����";
    $mysqlRe .= (false !==mysql_connect($_POST['mysqlhost'], $_POST['mysqluser'], $_POST['mysqlpsd']))?"<font color=\"#009900\">MYSQL��������������</font>��":"<font color=\"red\">MYSQL����������ʧ�ܣ�</font>, ";
    $mysqlRe .= "���ݿ� <b>".$_POST['mysqldb']."</b>&nbsp; ";
    $mysqlRe .= (false != @mysql_select_db($_POST['mysqldb']))?"<font color=\"#009900\">��������</font>":"<font color=\"red\">����ʧ�ܣ�</font>";
    if(false !==mysql_connect($_POST['mysqlhost'], $_POST['mysqluser'], $_POST['mysqlpsd']))
    {
        $mysql_version=mysql_get_server_info();
    }
    else
    {
        $mysql_version="<font color=red>��ȡʧ�ܣ�</font>";
    }
    $mysqlRe .= "��Mysql�������汾��";
    $mysqlRe .= $mysql_version;
}
elseif($_POST['action'] == "����")
{
    $mailRe = (false !== @mail($_POST["mailReceiver"], "̽���ʼ�����", "�ɹ����ͣ�"))?"<font color=\"#090\">�������</font>":"<font color=red>����ʧ��!</font>";
}
elseif($_POST['action']=="���")
{
    $funre=$_POST['funame']."&nbsp;��֧�������".getfunexists($_POST['funame']);
}
elseif($_POST['action']=="���1")
{
    $pmre=$_POST['pm']."&nbsp;��֧�������".getvar($_POST['pm']);
}
//��ȡZend Optimizer�汾,�����ο��˷����PHP̽��
function checkoptimizer()
{
    $url= "http://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']."?action=phpinfo";
    $htmlct=file_get_contents($url);
    eregi("Optimizer&nbsp;v(.*),&nbsp;Copyright", $htmlct, $regs);
    $optimizerversion=$regs[1];
    $optimizerversion=(''!=$optimizerversion)?$optimizerversion:"<font color=red>��ȡʧ�ܣ�</font>";
    return $optimizerversion;
}
//��ȡphp.ini���ò���,�ο�iProber
function getvar($varname)
{
    switch($var=get_cfg_var($varname)?get_cfg_var($varname):ini_get($varname))
    {
        case 0:
            return off;
            break;
        case 1:
            return on;
            break;
        default:
            return $var;
            break;
    }
}
//�жϺ����������
function getfunexists($funame)
{
    return (false !== function_exists($funame))?on:off;
}
//�����������
function test_int()
{
    $startime=getmicrotime();
    for($i = 0; $i < 3000000; $i++);
    {
        $t = 1+1;
    }
    $endtime=getmicrotime();
    $time=round($endtime-$startime,4);
    return $time;
}
//�������������
function test_float()
{
    $startime=getmicrotime();
    for($i = 0; $i < 3000000; $i++);
    {
        sqrt($t);
    }
    $endtime=getmicrotime();
    $time=round($endtime-$startime,4);
    return $time;
}
//IO��������
function test_io()
{
    $fp = fopen($_SERVER['PHP_SELF'], "r");
    $startime=getmicrotime();
    for($i = 0; $i < 300000; $i++);
    {
        fread($fp, 10240);
        rewind($fp);
    }
    $endtime=getmicrotime();
    $time=round($endtime-$startime,4);
    return $time;
}
//��ȡ������Ϣ��disk_x_space("y")�Ĳ��������ñ���,@�����ﲻ������
$diskct=0;
$disk=array();
/*if(@disk_total_space("A:")!=NULL) *Ϊ��ֹӰ������������������ - ����˵��
{
	$diskct=1;
	$disk["A"]=round((@disk_free_space("A:")/(1024*1024*1024)),2)."G&nbsp;/&nbsp;".round((@disk_total_space("A:")/(1024*1024*1024)),2).'G';
}*/
$diskz=0; //����������
$diskk=0; //����ʣ������
if(@disk_total_space("B:")!=NULL)
{
    $diskct++;
    $disk["B"][0]=round(@disk_free_space("B:")/(1024*1024*1024),2).'G';
    $disk["B"][1]=round(@disk_total_space("B:")/(1024*1024*1024),2).'G';
    $disk["B"][2]=round(((@disk_free_space("B:")/(1024*1024*1024))/(@disk_total_space("B:")/(1024*1024*1024)))*100,2).'%';
    $diskk+=round((@disk_free_space("B:")/(1024*1024*1024)),2);
    $diskz+=round((@disk_total_space("B:")/(1024*1024*1024)),2);
}
if(@disk_total_space("C:")!=NULL)
{
    $diskct++;
    $disk["C"][0]=round((@disk_free_space("C:")/(1024*1024*1024)),2).'G';
    $disk["C"][1]=round((@disk_total_space("C:")/(1024*1024*1024)),2).'G';
    $disk["C"][2]=round(((@disk_free_space("C:")/(1024*1024*1024))/(@disk_total_space("C:")/(1024*1024*1024)))*100,2).'%';
    $diskk+=round((@disk_free_space("C:")/(1024*1024*1024)),2);
    $diskz+=round((@disk_total_space("C:")/(1024*1024*1024)),2);
}
if(@disk_total_space("D:")!=NULL)
{
    $diskct++;
    $disk["D"][0]=round((@disk_free_space("D:")/(1024*1024*1024)),2).'G';
    $disk["D"][1]=round((@disk_total_space("D:")/(1024*1024*1024)),2).'G';
    $disk["D"][2]=round(((@disk_free_space("D:")/(1024*1024*1024))/(@disk_total_space("D:")/(1024*1024*1024)))*100,2).'%';
    $diskk+=round((@disk_free_space("D:")/(1024*1024*1024)),2);
    $diskz+=round((@disk_total_space("D:")/(1024*1024*1024)),2);
}
if(@disk_total_space("E:")!=NULL)
{
    $diskct++;
    $disk["E"][0]=round((@disk_free_space("E:")/(1024*1024*1024)),2).'G';
    $disk["E"][1]=round((@disk_total_space("E:")/(1024*1024*1024)),2).'G';
    $disk["E"][2]=round(((@disk_free_space("E:")/(1024*1024*1024))/(@disk_total_space("E:")/(1024*1024*1024)))*100,2).'%';
    $diskk+=round((@disk_free_space("E:")/(1024*1024*1024)),2);
    $diskz+=round((@disk_total_space("E:")/(1024*1024*1024)),2);
}
if(@disk_total_space("F:")!=NULL)
{
    $diskct++;
    $disk["F"][0]=round((@disk_free_space("F:")/(1024*1024*1024)),2).'G';
    $disk["F"][1]=round((@disk_total_space("F:")/(1024*1024*1024)),2).'G';
    $disk["F"][2]=round(((@disk_free_space("F:")/(1024*1024*1024))/(@disk_total_space("F:")/(1024*1024*1024)))*100,2).'%';
    $diskk+=round((@disk_free_space("F:")/(1024*1024*1024)),2);
    $diskz+=round((@disk_total_space("F:")/(1024*1024*1024)),2);
}
if(@disk_total_space("G:")!=NULL)
{
    $diskct++;
    $disk["G"][0]=round((@disk_free_space("G:")/(1024*1024*1024)),2).'G';
    $disk["G"][1]=round((@disk_total_space("G:")/(1024*1024*1024)),2).'G';
    $diskk+=round((@disk_free_space("G:")/(1024*1024*1024)),2);
    $diskz+=round((@disk_total_space("G:")/(1024*1024*1024)),2);
}
if(@disk_total_space("H:")!=NULL)
{
    $diskct++;
    $disk["H"][0]=round((@disk_free_space("H:")/(1024*1024*1024)),2).'G';
    $disk["H"][1]=round((@disk_total_space("H:")/(1024*1024*1024)),2).'G';
    $diskk+=round((@disk_free_space("H:")/(1024*1024*1024)),2);
    $diskz+=round((@disk_total_space("H:")/(1024*1024*1024)),2);
}
if(@disk_total_space("I:")!=NULL)
{
    $diskct++;
    $disk["I"][0]=round((@disk_free_space("I:")/(1024*1024*1024)),2).'G';
    $disk["I"][1]=round((@disk_total_space("I:")/(1024*1024*1024)),2).'G';
    $diskk+=round((@disk_free_space("I:")/(1024*1024*1024)),2);
    $diskz+=round((@disk_total_space("I:")/(1024*1024*1024)),2);
}
if(@disk_total_space("J:")!=NULL)
{
    $diskct++;
    $disk["J"][0]=round((@disk_free_space("J:")/(1024*1024*1024)),2).'G';
    $disk["J"][1]=round((@disk_total_space("J:")/(1024*1024*1024)),2).'G';
    $diskk+=round((@disk_free_space("J:")/(1024*1024*1024)),2);
    $diskz+=round((@disk_total_space("J:")/(1024*1024*1024)),2);
}
if(@disk_total_space("K:")!=NULL)
{
    $diskct++;
    $disk["K"][0]=round((@disk_free_space("K:")/(1024*1024*1024)),2).'G';
    $disk["K"][1]=round((@disk_total_space("K:")/(1024*1024*1024)),2).'G';
    $diskk+=round((@disk_free_space("K:")/(1024*1024*1024)),2);
    $diskz+=round((@disk_total_space("K:")/(1024*1024*1024)),2);
}
if(@disk_total_space("L:")!=NULL)
{
    $diskct++;
    $disk["L"][0]=round((@disk_free_space("L:")/(1024*1024*1024)),2).'G';
    $disk["L"][1]=round((@disk_total_space("L:")/(1024*1024*1024)),2).'G';
    $diskk+=round((@disk_free_space("L:")/(1024*1024*1024)),2);
    $diskz+=round((@disk_total_space("L:")/(1024*1024*1024)),2);
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP̽��_B-Check</title>
<style type="text/css">
body {background-color: #ffffff; color: #000000; font-size:12px; font-family:Arial, Helvetica, sans-serif;}
pre {margin: 0px;}
a {text-decoration: none; color: #000000;}
a:hover {text-decoration: none; background-color:#888888; color:#99FF00;}
table {border-collapse: collapse;margin: auto;}
td,th { border: 1px solid #000000; padding-left:4px; padding-right:4px; padding-top:3px; padding-bottom:1px; height: 22px; vertical-align:middle; text-align:left;}
span { font-weight:normal; padding-right:4px; }
.e {background-color: #ccccff; color: #000000;}
.h {background-color: #9999cc; font-weight: bold; color: #000000; font-size:14px; text-align:left;}
.vr {background-color: #cccccc; text-align: center; color: #000000;}
.vr2 {background-color: #cccccc; color: #000000;}
img {border: 0px;}
hr {width: 600px; background-color: #cccccc; border: 0px; height: 1px; color: #000000;}
.notice {color: #CC3300;}
.center {text-align:center;}
.gbutton {background-color: #ccccff;border-color:#003333;border-width:1px;}
.textborder {border-top-width: 1px;border-right-width: 1px;border-bottom-width: 1px;border-left-width: 1px;border-top-color: #9999cc;border-right-color: #9999cc;border-bottom-color: #9999cc;
border-left-color: #9999cc;}
.td1 {BORDER-top: rgb(0,0,0) 1px groove; BORDER-bottom: rgb(0,0,0) 1px groove; BORDER-left: rgb(0,0,0) 1px groove; BORDER-right: rgb(0,0,0) 1px groove}
.td2 {BORDER-top: rgb(0,0,0) 1px groove; BORDER-bottom: rgb(0,0,0) 1px groove; BORDER-right: rgb(0,0,0) 1px groove}
</style>
<script type="text/javascript">
function ShowHide(item1){
	var itemtable=document.getElementById(item1);
	if(itemtable.style.display=='')
		itemtable.style.display='none';
	else
		itemtable.style.display='';
}
</script>
</head>

<body>
<div style="margin:auto; width:700px;">
<div style="float:left; width:348px"><span style="font-size:55px; color:#3366FF; font-weight:bold; font-style:italic;">B-Check</span>&nbsp;<?php echo version; ?></div>
<div style="float:right;width:348px; text-align:right;">
<script src="http://www.rubyfans.com/b-check/js/language.js" type="text/javascript"></script>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://www.rubyfans.com/b-check/b-check.rar">�������°�</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://www.rubyfans.com">�ٷ�</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://www.rubyfans.com">RoR����</a></div>
</div>
<table width="700" border="0" cellpadding="0" cellspacing="1">
  <tr>
    <td align="center" bgcolor="#9999cc"><a href="#tx">����������</a></td>
    <td align="center" bgcolor="#9999cc"><a href="#pz">PHP��������</a></td>
    <td align="center" bgcolor="#9999cc"><a href="#zj">PHP���֧��</a></td>
    <td align="center" bgcolor="#9999cc"><a href="#bottom">���ܲ���</a></td>
    <td align="center" bgcolor="#9999cc"><a href="#bottom">Bug�ϱ�</a></td>
    <td align="center" bgcolor="#9999cc"><a href="<?php echo $_SERVER['PHP_SELF'] ?>">ˢ��</a>
    </td>
  </tr>
</table>
<div style="margin:auto;">
 <img src="" alt="" name="xuhao" width="1" height="5" id="xuhao" />
</div>
<table width="700" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td colspan="2" class="h">
    <a name="tx" id="tx"></a>
    <div style="float:left;width:49%">
    <font face="Webdings, sans-serif">8</font>����������    </div>
    <div style="float:right;width:50%;text-align:right;"><a href="<?php $_SERVER['PHP_SELF']?>?action=phpinfo_GENERAL" target="_blank">phpinfo()�еķ�������Ϣ</a></div>    </td>
  </tr>
  <tr>
    <td width="126" class="e">����������/IP��</td>
    <td width="571"><?php echo $_SERVER['SERVER_NAME']."&nbsp;(".$_SERVER['REMOTE_ADDR'].")"; ?></td>
  </tr>
  <tr>
    <td class="e">Web����˿ڣ�</td>
    <td><?php echo $_SERVER['SERVER_PORT']; ?></td>
  </tr>
  <tr>
    <td class="e">����������/�汾��</td>
    <td><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
  </tr>
  <tr>
    <td class="e">����������ϵͳ��</td>
    <td><?php echo PHP_OS."&nbsp;(".php_uname().")"; ?></td>
  </tr>
  <tr>
    <td class="e">��վ��Ŀ¼��</td>
    <td><?php echo $_SERVER['DOCUMENT_ROOT']; ?></td>
  </tr>
  <tr>
    <td class="e">��ǰ�ļ�λ�ã�</td>
    <td><?php echo $_SERVER['SCRIPT_FILENAME']; ?></td>
  </tr>
  <!-- ���ϵͳ����WINNT�ģ�����ʾ������Ϣ -->
  <?php if (PHP_OS=="WINNT"){?>
  <tr>
    <td class="e">ϵͳĿ¼��</td>
    <td><?php echo getenv('SystemRoot')?getenv('SystemRoot'):"<font color=red>��ȡʧ�ܣ�</font>"; ?>&nbsp;<a href="javascript:ShowHide('sysroot');" title="����˴��鿴��ʾ��Ϣ"><img src="http://mobdown.maifou.net/admin/images/notice.gif"  width="16" height="16" alt="����˴��鿴��ʾ��Ϣ" border="0"/></a>
      <div id="sysroot" class="notice" style="display:none;">
        <div style="border-bottom:1px dashed #ccc"></div>
    <strong>Path��</strong><?php echo getenv('Path')?getenv('Path'):"<font color=red>��ȡʧ�ܣ�</font>"; ?><br />
<strong>TEMP��</strong><?php echo getenv('TEMP')?getenv('TEMP'):"<font color=red>��ȡʧ�ܣ�</font>"; ?><br>
<strong>PATHEXT��</strong><?php echo getenv('PATHEXT')?getenv('PATHEXT'):"<font color=red>��ȡʧ�ܣ�</font>"; ?></div></td>
  </tr>
  <tr>
    <td class="e">������(CPU)��Ϣ��</td>
    <td><?php echo getenv('PROCESSOR_IDENTIFIER')?getenv('PROCESSOR_IDENTIFIER'):"<font color=red>��ȡʧ�ܣ�</font>"; ?>&nbsp;<a href="javascript:ShowHide('cpu');" title="����˴��鿴��ʾ��Ϣ"><img src="http://mobdown.maifou.net/admin/images/notice.gif"  width="16" height="16" alt="����˴��鿴��ʾ��Ϣ" border="0"/></a>
      <div id="cpu" class="notice" style="display:none;">
        <div style="border-bottom:1px dashed #ccc;"></div>
   �������ҷֱ��ʾType�����ͣ���Family��ϵ�У���Mode���ͺţ���Stepping��������ţ���Brand ID��Ʒ�ֱ�ʶ����һ��CPU����Brand ID�����CPU���Ƿǳ��ϵĻ��������ͨ��Brand ID��Ʒ�ֱ�ʶ�����жϷ�����CPU��ʲô�ͺŵ��εģ�������ô�ж������ȥ�ٶȻ�ٶ�֪���������ڴ˲�ϸ˵����</div></td>
  </tr>
   <tr>
    <td class="e">������(CPU)������</td>
    <td><?php echo getenv('NUMBER_OF_PROCESSORS')?getenv('NUMBER_OF_PROCESSORS'):"��ȡʧ�ܣ�"; ?>&nbsp;<a href="javascript:ShowHide('cpunm');" title="����˴��鿴��ʾ��Ϣ"><img src="http://mobdown.maifou.net/admin/images/notice.gif"  width="16" height="16" alt="����˴��鿴��ʾ��Ϣ" border="0"/></a>
      <div id="cpunm" class="notice" style="display:none;">
        <div style="border-bottom:1px dashed #ccc;"></div>
   �߼�������������IDC�ͷ��Ļ��Ŀ��Ŷ�û������������ֵĿ��Ŷȸߡ���������������16�����Ժ�ļ���������ñ�����������ġ������... 32...��������Ц��</div></td>
  </tr>
  <?php }?>
  <tr>
    <td class="e">������ʱ�䣺</td>
    <td><?php echo date("y��n��j�� g:i:s a");?></td>
  </tr>
 <!-- ���ϵͳ����WINNT�ģ�����ʾ������Ϣ -->
  <?php if (PHP_OS=="WINNT"){?>
  <tr>
    <td class="e">���̿ռ���Ϣ��</td>
    <td>
	<?php if($diskct>0) {?>
	<table width="100%">
	<tr><th width="50">�̷�</th><th width="80">�ܿռ�</th><th width="80">ʣ��ռ�</th><th>ʣ��ٷֱ�</th></tr>
	<?php foreach($disk as $key=>$value){ ?>
	<tr>
	<td><?php echo $key.'��'; ?></td>
	<td><?php echo $value[1]; ?></td>
	<td><?php echo $value[0]; ?></td>
	<td>
	<div style="border:1px solid #999">
	<div style="width:<?php echo $value[2]; ?>;background-color:green; color:#FFF;"> <?php echo $value[2]; ?></div>
	</div>
	</td>
	</tr>
	<?php } ?>
	<tr style="background-color: #E5E5E5">
	<th>�ܼ�</th>
	<td><?PHP
	// if(abs($diskz-80)<50)
	// {
		// echo '80G';
	// }
	// elseif(abs($diskz-160)<30)
	// {
		// echo '160G';
	// }
	// elseif(abs($diskz-250)<30)
	// {
		// echo '250G';
	// }
	// elseif(abs($diskz-320)<30)
	// {
		// echo '320G';
	// }
	// elseif(abs($diskz-500)<30)
	// {
		// echo '500G';
	// }
	// elseif(abs($diskz-640)<30)
	// {
		// echo '640G';
	// }
	// elseif(abs($diskz-750)<30)
	// {
		// echo '750G';
	// }
	// elseif(abs($diskz-1024)<30)
	// {
		// echo '1TB';
	// }
	// elseif(abs($diskz-1024)<30)
	// {
		// echo '1TB';
	// }
	// elseif(abs($diskz-1536)<30)
	// {
		// echo '1.5TB';
	// }
	// elseif(abs($diskz-2048)<30)
	// {
		// echo '2TB';
	// }
	echo $diskz; ?>G</td>
	<td><? echo $diskk.'G'; ?></td>
	<td>
		<div style="border:1px solid #999">
	<div style="width:<?php echo round(($diskk/$diskz)*100,2) ?>%;background-color:green; color:#FFF;"> <?php echo round(($diskk/$diskz)*100,2) ?>%</div>
	</div>
	</td>
	</tr>
	</table>
	<?php }else{echo '̽��ʧ�ܣ�';} ?>
	<br />
	������ֻ��̽���̷�Ϊ��д��ĸA-L�Ĵ��̣�����Ȩ�޻�ȡ��
	</td>
  </tr>
<?php }?>
</table>
<div style="margin:auto;">
 <img src="" alt="" name="xuhao" width="1" height="5" id="xuhao" />
</div>
<table width="700" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td colspan="2" class="h">
    <a name="pz" id="pz"></a>
    <div style="float:left;width:49%">
    <font face="Webdings, sans-serif">8</font>PHP������������(php.ini)</div>
    <div style="float:right;width:50%;text-align:right;"><a href="<?php $_SERVER['PHP_SELF']?>?action=phpinfo_CONFIGURATION" target="_blank">phpinfo()�еĻ���������Ϣ</a></div>    </td>
  </tr>
  <tr>
    <td width="256" class="e">���з�ʽ��</td>
    <td width="441"><?php echo strtoupper(php_sapi_name()); ?></td>
  </tr>
  <tr>
    <td class="e">PHP�汾��</td>
    <td><?php echo phpversion(); ?></td>
  </tr>
  <tr>
    <td class="e">Zend�汾��</td>
    <td><?php echo zend_version(); ?></td>
  </tr>
  <!-- ���ϵͳ����WINNT�ģ�����ʾ������Ϣ -->
  <?php if (PHP_OS=="WINNT"){?>
  <tr>
    <td class="e">Zend Optimizer�汾��</td>
    <td><?php echo checkoptimizer(); ?>&nbsp;<a href="javascript:ShowHide('optimizer');" title="����˴��鿴��ʾ��Ϣ"><img src="http://mobdown.maifou.net/admin/images/notice.gif"  width="16" height="16" alt="����˴��鿴��ʾ��Ϣ" border="0"/></a>
      <div id="optimizer" class="notice" style="display:none;">
        <div style="border-bottom:1px dashed #ccc;"></div>
  Zend Optimizer��ϸ����������� Zend �����������Ĵ��룬���������Ż����������еø��졣��������ȷʵ������߳��������ٶȳ���60%�����ҽ����˳����ϵͳ��Դ�ĺ��á� </div></td>
  </tr>
<?php }?>
  <tr>
    <td class="e">Mysql�ͻ��˿�汾��</td>
    <td><?php echo (false!=mysql_get_client_info())?mysql_get_client_info():"��ȡʧ�ܣ�";?>&nbsp;<a href="javascript:ShowHide('sqlcl');" title="����˴��鿴��ʾ��Ϣ"><img src="http://mobdown.maifou.net/admin/images/notice.gif"  width="16" height="16" alt="����˴��鿴��ʾ��Ϣ" border="0"/></a>
      <div id="sqlcl" class="notice" style="display:none;">
        <div style="border-bottom:1px dashed #ccc;"></div>
    ���ɹ���ȡ����Ҫ����Ƿ������˵�Mysql�汾�ˣ���������Mysql���Ӳ���ʱ��̽���������Mysql�汾�ġ� </div></td>
  </tr>
  <tr>
    <td class="e">ZEND�������У�</td>
    <td><?php echo (get_cfg_var("zend_optimizer.optimization_level")||get_cfg_var("zend_extension_manager.optimizer_ts")||get_cfg_var("zend_extension_ts")) ?on:off; //�ο�iProber?></td>
  </tr>
  <tr>
    <td class="e">�����ڰ�ȫģʽ��(safe_mode)</td>
    <td><?php echo getvar("safe_mode"); ?></td>
  </tr>
  <tr>
    <td class="e">���� URL ����(allow_url_fopen)</td>
    <td><?php echo getvar("allow_url_fopen"); ?></td>
  </tr>
  <tr>
    <td class="e">ע��ȫ�ֱ�����(register_globals)</td>
    <td><?php echo getvar("register_globals"); ?></td>
  </tr>
  <tr>
    <td class="e">ħ�����ſ�����(magic_quotes_gpc)</td>
    <td><?php echo getvar("magic_quotes_gpc"); ?></td>
  </tr>
  <tr>
    <td class="e">�̱��֧�֣�(short_open_tag)</td>
    <td><?php echo getvar("short_open_tag"); ?>&nbsp;<a href="javascript:ShowHide('shortag');" title="����˴��鿴��ʾ��Ϣ"><img src="http://mobdown.maifou.net/admin/images/notice.gif"  width="16" height="16" alt="����˴��鿴��ʾ��Ϣ" border="0"/></a>
      <div id="shortag" class="notice" style="display:none;">
        <div style="border-bottom:1px dashed #ccc;"></div>
  ����ʹ�� PHP ���뿪ʼ��־����д��ʽ��&lt;? ?&gt;�����ܶ�PHP����ʹ�ö̱�ǣ���������Discuz!�������Ŀռ䲻֧������Ļ���Ҫ���ķ�DZ��̳Ŷ��</div></td>
  </tr>
  <tr>
    <td class="e">�Զ�ת������ַ���(magic_quotes_runtime)</td>
    <td><?php echo getvar("magic_quotes_runtime"); ?></td>
  </tr>
  <tr>
    <td class="e">����̬�������ӿ⣺(enable_dl)</td>
    <td><?php echo getvar("enable_dl"); ?></td>
  </tr>
  <tr>
    <td class="e">��ʾ������Ϣ��(display_errors)</td>
    <td><?php echo getvar("display_errors"); ?></td>
  </tr>
  <tr>
    <td class="e">post�����������(post_max_size)</td>
    <td><?php echo getvar("post_max_size"); ?></td>
  </tr>
  <tr>
    <td class="e">�ϴ��ļ�������С��(upload_max_filesize)</td>
    <td><?php echo getvar("upload_max_filesize"); ?></td>
  </tr><strong></strong>
  <tr>
    <td class="e">�ű�����ڴ�ʹ������(memory_limit)</td>
    <td><?php echo getvar("memory_limit"); ?></td>
  </tr>
  <tr>
    <td class="e">�鿴phpinfo()��</td>
    <td><a href="<?php $_SERVER['PHP_SELF']?>?action=phpinfo" target="_blank">PHPINFO</a></td>
  </tr>
</table>
<div style="margin:auto;">
 <img src="" alt="" name="xuhao" width="1" height="5" id="xuhao" />
</div>
<table width="700" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td colspan="4" class="h"><a name="zj" id="zj"></a>
      <div style="float:left;width:49%"> <font face="Webdings, sans-serif">8</font>PHP���֧����� </div>
        <div style="float:right;width:50%;text-align:right;"><a href="<?php $_SERVER['PHP_SELF']?>?action=phpinfo_MODULES" target="_blank">phpinfo()�����֧����Ϣ</a></div></td>
  </tr>
  <tr>
    <td width="259" class="e">MySQL���ݿ⣺</td>
    <td width="87"><?php echo getfunexists("mysql_close"); ?></td>
    <td width="270" class="e">ͼ�δ��� GD �⣺</td>
    <td width="79"><?php echo getfunexists("gd_info"); ?></td>
  </tr>
  <tr>
    <td class="e">SQL Server���ݿ⣺</td>
    <td><?php echo getfunexists("mssql_close"); ?></td>
    <td class="e">PDF�ĵ�֧�֣�</td>
    <td><?php echo getfunexists("pdf_close"); ?></td>
  </tr>
  <tr>
    <td class="e">Oracle���ݿ⣺</td>
    <td><?php echo getfunexists("ora_close"); ?></td>
    <td class="e">FDF�ĵ�֧�֣�</td>
    <td><?php echo getfunexists("fdf_get_ap"); ?></td>
  </tr>
  <tr>
    <td class="e">Oracle 8 ���ݿ⣺</td>
    <td><?php echo getfunexists("OCILogOff"); ?></td>
    <td class="e">Session֧�֣�</td>
    <td><?php echo getfunexists("session_start"); ?></td>
  </tr>
  <tr>
    <td class="e">mSQL���ݿ⣺</td>
    <td><?php echo getfunexists("msql_close"); ?></td>
    <td class="e">Socket֧�֣�</td>
    <td><?php echo getfunexists("socket_accept"); ?></td>
  </tr>
  <tr>
    <td class="e">SyBase���ݿ⣺</td>
    <td><?php echo getfunexists("sybase_close"); ?></td>
    <td class="e">XML����֧�֣�</td>
    <td><?php echo getfunexists("xml_set_object"); ?></td>
  </tr>
  <tr>
    <td class="e">Postgre SQL���ݿ⣺</td>
    <td><?php echo getfunexists("pg_close"); ?></td>
    <td class="e">FTP֧�֣�</td>
    <td><?php echo getfunexists("ftp_login"); ?></td>
  </tr>
  <tr>
    <td class="e">Informix���ݿ⣺</td>
    <td><?php echo getfunexists("ifx_close"); ?></td>
    <td class="e">ODBC���ݿ����ӣ�</td>
    <td><?php echo getfunexists("odbc_close"); ?></td>
  </tr>
  <tr>
    <td class="e">Hyperwave���ݿ⣺</td>
    <td><?php echo getfunexists("hw_close"); ?></td>
    <td class="e">ѹ���ļ�֧��(Zlib)��</td>
    <td><?php echo getfunexists("gzclose"); ?></td>
  </tr>
  <tr>
    <td class="e">FilePro���ݿ⣺</td>
    <td><?php echo getfunexists("filepro_fieldcount"); ?></td>
    <td class="e">Yellow Pageϵͳ��</td>
    <td><?php echo getfunexists("yp_match"); ?></td>
  </tr>
  <tr>
    <td class="e">DBM���ݿ⣺</td>
    <td><?php echo getfunexists("dbmclose"); ?></td>
    <td class="e">SNMP�������Э�飺</td>
    <td><?php echo getfunexists("snmpget"); ?></td>
  </tr>
  <tr>
    <td class="e">DBA���ݿ⣺</td>
    <td><?php echo getfunexists("dba_close"); ?></td>
    <td class="e">WDDX֧�֣�</td>
    <td><?php echo getfunexists("wddx_add_vars"); ?></td>
  </tr>
  <tr>
    <td class="e">dBase���ݿ⣺</td>
    <td><?php echo getfunexists("dbase_close"); ?></td>
    <td class="e">ƴд��� ASpell Library��</td>
    <td><?php echo getfunexists("aspell_check_raw"); ?></td>
  </tr>
  <tr>
    <td class="e">IMAP�����ʼ�ϵͳ��</td>
    <td><?php echo getfunexists("imap_close"); ?></td>
    <td class="e">�������� Calendar��</td>
    <td><?php echo getfunexists("cal_days_in_month"); ?></td>
  </tr>
  <tr>
    <td class="e">VMailMgr�ʼ�����</td>
    <td><?php echo getfunexists("vm_adduser"); ?></td>
    <td class="e">LDAPĿ¼Э�飺</td>
    <td><?php echo getfunexists("ldap_close"); ?></td>
  </tr>
  <tr>
    <td class="e">MCrypt���ܴ���</td>
    <td><?php echo getfunexists("mcrypt_cbc"); ?></td>
    <td class="e">PREL�����﷨ PCRE��</td>
    <td><?php echo getfunexists("preg_match"); ?></td>
  </tr>
  <tr>
    <td class="e">�߾�����ѧ���� BCMath��</td>
    <td><?php echo getfunexists("bcadd"); ?></td>
    <td class="e">��ϡ���� MHash��</td>
    <td><?php echo getfunexists("mhash_count"); ?></td>
  </tr>
  <tr>
    <td colspan="4" class="e">�����ѱ���ģ�飺 <br />
	<?php
	$able=get_loaded_extensions();
	foreach ($able as $key=>$value) {
		if ($key!=0 && $key%13==0) {
			echo '<br />';
		}
		echo "$value&nbsp;&nbsp;&nbsp;";
	}
	?></td>
  </tr>
</table>
<div style="margin:auto;">
 <img src="" alt="" name="xuhao" width="1" height="5" id="xuhao" />
</div>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#bottom" style="margin:0;">
    <input name="tsint" type="hidden" value="<?php echo $ts_int;?> " />
    <input name="tsfloat" type="hidden" value="<?php echo $ts_float;?> " />
    <input name="tsio" type="hidden" value="<?php echo $ts_io;?> " />
    <input name="speed" type="hidden" value="<?php echo $speed;?> " />
  <table width="700" border="0" cellspacing="1" cellpadding="0">

    <tr>
      <td colspan="4" class="h"><a name="xn" id="xn"></a><font face="Webdings, sans-serif">8</font>���������ܲ���</td>
    </tr>
    <tr>
      <td width="250" class="vr">������</td>
      <td width="148" class="vr">����������������<br />
      (1+1����300���)</td>
      <td width="148" class="vr">����������������<br />
(��ƽ��300���)</td>
      <td width="148" class="vr">����I/O��������<br />
(��ȡ<font color="red"><?php echo (round(filesize("xuhao.php")/1024)!=0)?round(filesize("xuhao.php")/1024):"44";?>K</font>�ļ�30���)</td>
    </tr>
    <tr>
      <td class="center">�Ϸ������ĵ���(AMD4000+  1G)</td>
      <td class="center">0.3502 ��</td>
      <td class="center">0.3591 ��</td>
      <td class="center">0.0394 ��</td>
    </tr>
    <tr>
      <td class="center">92�����㽭���10�˺���ռ�</td>
      <td class="center">0.2112 ��</td>
      <td class="center">0.2240 ��</td>
      <td class="center">0.0225 ��</td>
    </tr>
    <tr>
      <td class="center">����ʹ�õ���̨������</td>
      <td class="center"><?php echo "<font color=\"#006600\"><b>".$ts_int."</b></font>"; ?> ��<br /><input name="action" type="submit" class="gbutton" value="��������" /></td>
      <td class="center"><?php echo "<font color=\"#006600\"><b>".$ts_float."</b></font>"; ?> ��<br /><input name="action" type="submit" class="gbutton" value="��������" /></td>
      <td class="center"><?php echo "<font color=\"#006600\"><b>".$ts_io."</b></font>"; ?> ��<br /><input name="action" type="submit" class="gbutton" value="IO����" /></td>
    </tr>
    <tr>
      <td class="center">�����ٶȲ��ԣ�
        <input name="action" type="submit" class="gbutton" value="��ʼ����" />
        <br />
	(��ͻ��˴��� 100k �ֽ�����)
</td>
      <td colspan="3">
  <table style="margin:0px;border:none;" align="center" width="500" border="0" cellspacing="0" cellpadding="0">
    <tr style="border-bottom:none;"><td height="15" width="32" style="border-bottom:none;">1M</td>
    <td height="15" width="231" style="border-bottom:none;"> 2M ADSL</td>
    <td height="15" width="237" style="border-bottom:none;"> 10M LAN</td>
    </tr>
  </table>
  <table style="margin:0px" align="center" width="500" border="0" cellspacing=0 cellpadding=0>
    <tr>
      <td bgcolor="#009900" style="padding:0;margin:0;height:10px;" width="<?php
	if(preg_match("/[^\d-., ]/",$speed))
		{
			echo "0";
		}
	else{
			echo 500*$speed/(1024*4);
		}
		?>"></td>
      <td height="10" width="<?php
	if(preg_match("/[^\d-., ]/",$speed))
		{
			echo "500";
		}
	else{
			echo 500-500*$speed/(1024*4);
		}
		?>"><?php echo $speed; ?> kb/s</td>
    </tr>
  </table>
  <?php echo (isset($_GET['speed']))?"��ͻ��˴���100k�ֽ�����ʹ��<font color=\"red\">".$_GET['speed']."</font>����":"<font color=red>&nbsp;δ̽��&nbsp;</font>" ?></td>
    </tr>
  </table>
  <div style="margin:auto;"> <img src="" alt="" name="xuhao" width="5" height="5" id="xuhao2" /> </div>
  <table width="700" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td colspan="4" class="h"><font face="Webdings, sans-serif">8</font>�Զ��������Ŀ</td>
    </tr>
    <?php if(getfunexists("mysql_close")==on){?>
    <tr>
      <td colspan="4" class="e">Myslq���ݿ����Ӳ���</td>
    </tr>
    <tr>
      <td width="111">Mysql��������</td>
      <td width="152"><label>
        <input name="mysqlhost" type="text" class="textborder" id="mysqlhost" size="15" />
      </label></td>
      <td width="116">Mysql�û�����</td>
      <td width="316"><label>
        <input name="mysqluser" type="text" class="textborder" id="mysqluser" size="15" />
      </label></td>
    </tr>
    <tr>
      <td>Mysql���룺</td>
      <td><label>
        <input name="mysqlpsd" type="text" class="textborder" id="mysqlpsd" size="15" />
      </label></td>
      <td>Mysql���ݿ����ƣ�</td>
      <td><label>
        <input name="mysqldb" type="text" class="textborder" id="mysqldb" size="15" />
      </label>
      &nbsp;
      <label>
      <input name="action" type="submit" class="gbutton" id="button2" value="����Mysql" />
      </label></td>
    </tr>
    <?php
	}
	if("show"==$mysqlReShow){
	?>
			<tr>
				<td colspan="4" class="vr2"><?php echo $mysqlRe; ?>&nbsp;<a href="javascript:ShowHide('mysql');" title="����˴��鿴��ʾ��Ϣ"><img src="http://mobdown.maifou.net/admin/images/notice.gif"  width="16" height="16" alt="����˴��鿴��ʾ��Ϣ" border="0"/></a>
      <div id="mysql" class="notice" style="display:none;">
        <div style="border-bottom:1px dashed #ccc;"></div>
      ������Mysql�汾��<?php echo $mysql_version; ?> &nbsp;&nbsp;������ݿ�����ʧ�ܣ����޷�̽����</div></td>
			</tr>
    <?php } ?>
    <tr>
      <td colspan="4" class="e">MAIL�ʼ����Ͳ���</td>
    </tr>
    <tr>
      <td>�����ʼ����͵���</td>
      <td colspan="3"><label>
        <input name="to" type="text" class="textborder" id="textfield" />
      &nbsp;
      <input name="action" type="submit" class="gbutton" id="button3" value="����" />
      </label>&nbsp;<?php echo $mailRe; ?></td>
    </tr>
    <tr>
      <td colspan="4" class="e">����֧�ּ��</td>
    </tr>
    <tr>
      <td>̽��ĺ�������</td>
      <td colspan="3"><label>
        <input name="funame" type="text" class="textborder" id="textfield2" />
      &nbsp;
      <input name="action" type="submit" class="gbutton" id="button4" value="���" />
      &nbsp;</label><?php echo $funre; ?></td>
    </tr>
    <tr>
      <td colspan="4" class="e">PHP����(php.ini)���</td>
    </tr>
    <tr>
      <td>̽��Ĳ�������</td>
      <td colspan="3"><label>
        <input name="pm" type="text" class="textborder" id="textfield2" />
      &nbsp;
      <input name="action" type="submit" class="gbutton" id="button4" value="���1" />
      &nbsp;</label><?php echo $pmre; ?></td>
    </tr>
  </table>
   <div style="margin:auto;"> <img src="" alt="" name="xuhao" width="5" height="5" id="xuhao2" /> </div>
  <table width="700" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td valign="middle" class="vr2">Bug�ϱ���
        <input name="Buginfo" type="text" class="textborder" id="textarea" value="" size="80" />
        &nbsp;&nbsp;
      <input name="act" type="submit" class="gbutton" id="button" value="�ύ" />
      <?php echo $jgprint; ?>
      </td>
    </tr>
  </table>
        </form>
<div style="margin:auto;">
 <img src="" alt="" name="xuhao" width="1" height="5" id="xuhao" />
</div>
<table width="700" border="0" cellspacing="1" cellpadding="0">
  <tr>
<?php
$pagendtime=getmicrotime();
$pagetime=round($pagendtime-$pagestartime,5);
?>
    <td align="center" class="e">
    <div style="float:left;width:40%; text-align:right;">
    <img src="<?php echo $_SERVER['PHP_SELF']."?=" . php_logo_guid(); ?>" alt="PHP Logo !" />&nbsp;&nbsp;&nbsp;
    <img src="<?php echo $_SERVER['PHP_SELF']."?=" . zend_logo_guid(); ?>" alt="Zend Logo !" />&nbsp;&nbsp;
    </div>
    <div style="float:right;width:59%; text-align:left; line-height:18px;">
    <a href="http://www.rubyfans.com">�Ϸ�����</a>����&nbsp;&nbsp;&nbsp;��ӭ����Ruby���ã�<a href="http://www.rubyfans.com/" target="_blank">www.rubyfans.com</a>&nbsp;&nbsp;<a href="http://www.rubyfans.com/" target="_blank">Ruby on Rails����</a><br />
    ����ƽ̨��WinXP&nbsp;&nbsp;&nbsp;Apache&nbsp;v2.0.63&nbsp;&nbsp;PHP&nbsp;v5.2.6&nbsp;&nbsp;&nbsp;Mysql&nbsp;v5.0.51b&nbsp;&nbsp;��ѧ����<br />
    �汾��<?php echo version; ?>&nbsp;&nbsp;&nbsp;���ʱ�䣺<?php echo overtime; ?> <br />
    ҳ��ִ��ʱ��<?php echo $pagetime; ?>��
    <a name="bottom" id="bottom"></a></div>
    </td>
  </tr>
</table>
<div style="margin:auto;">
 <img src="" alt="" name="xuhao" width="1" height="5" id="xuhao" />
</div>
<table width="700" cellspacing="0" cellpadding="0">
<tr align="center">
<td class="td1" width="173"><a href="http://www.php.net/downloads.php" target="_blank">����PHP</a></td>
<td class="td2" width="173"><a href="http://dev.mysql.com/downloads/mysql/5.1.html" target="_blank">����MySQL</a></td>
<td class="td2" width="173"><a href="http://www.zend.com/en/products/guard/downloads" target="_blank">����Zend Optimizer</a></td>
<td class="td1" width="173"><a href="http://httpd.apache.org/download.cgi" target="_blank">����Apache</a></td>
</tr>
</table>
</body>
</html>