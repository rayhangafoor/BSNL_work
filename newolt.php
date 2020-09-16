<?php
        // Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: /index.php');
}
if (!($_SESSION['user_group'] < 2)) {
header('Location: /index.php');
}

require("db.php");
$query = "select * from lco_koz order by lco_code";
$rpr="select distinct parent_switch from dslam_enk";
$reslt = mysql_query($query);
$reslt2 = mysql_query($query);
$reslt_rpr = mysql_query($rpr);

if(isset($_POST['save']))
{
        $lco_code_save = $_POST['lco_code'];
        $location_save = $_POST['location'];
        $project_save = $_POST['project'];
        $vendor_save = $_POST['vendor'];
        //$capacity_save = $_POST['capacity'];
        $bng_save = $_POST['bng'];
        //$ring_save = $_POST['ring'];
        //$bng_port_save = $_POST['bng_port'];
        $parent_switch_save = $_POST['parent_switch'];
        $switch_type_save = $_POST['switch_type'];
        $switch_port_save = $_POST['switch_port'];
        $olt_ip_save = $_POST['olt_ip'];
        $o_vlan_save = $_POST['o_vlan'];
        $nw_save = $_POST['nw'];
        $doi_save = $_POST['doi'];
        $status_save = $_POST['status'];
        $fiber_details_save = mysql_real_escape_string($_POST['fiber_details']);
        //$contact_no_save = $_POST['contact_no'];

 $user = $_SESSION['username'];
        $user_ip = $_SESSION['user_ip'];
        $act = "NEW_OLT";
        $remark = "NEW OLT INSTALLED AT ".$lco_code_save." ON ".$doi_save;

        mysql_query("INSERT INTO olt_koz (eqp_desc,lco_code,location,project,vendor, bng, parent_switch, switch_type,switch_port,olt_ip,o_vlan,nw,status,fiber_details,doi) VALUES ('OLT','$lco_code_save','$location_save','$project_save','$vendor_save','$bng_save','$parent_switch_save','$switch_type_save','$switch_port_save','$olt_ip_save','$o_vlan_save','$nw_save','$status_save','$fiber_details_save','$doi_save')") or die(mysql_error());
        #mysql_query("insert into log_book (user,user_ip,olt,activity,remarks) values ('$user','$user_ip','$olt_ip_save','$act','$remark')")
                        #or die(mysql_error());
        header("Location: list.php?exch=$lco_code_save&submit=submit");



}
if(isset($_POST['back']))
{
header('Location: /index.php');
}
//mysql_close($conn);
include ($_SERVER['DOCUMENT_ROOT']."/header.php");
include ($_SERVER['DOCUMENT_ROOT']."/menu.php");
?>
<link rel="stylesheet" type="text/css" media="all" href="/date/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="/date/jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
        window.onload = function(){
                new JsDatePick({
                        useMode:2,
                        target:"inputField",
                        dateFormat:"%Y-%m-%d"
                        /*selectedDate:{                                This is an example of what the full configuration offers.
                                day:5,                                          For full documentation about these settings please see the full version of the code.
                                month:9,
                                year:2006
                        },
                        yearsRange:[1978,2020],
                        limitToToday:false,
                        cellColorScheme:"beige",

 dateFormat:"%m-%d-%Y",
                        imgPath:"img/",
                        weekStartDay:1*/
                });
        };
</script>
<center>
<?php echo "<h3> Enter Details for New OLT <br /></h3>";?>
<form method="post" >
<table>
        <tr>
                <td>LCO Code</td>
                <td><select name="lco_code"><option value="none">Select</option>
        <?php   while ($row = mysql_fetch_array($reslt)){?>
        <option value='<?php echo $row['lco_code'];?>'><?php echo $row['lco_code'];}?></option>
        </select></td>
        </tr>
        <tr>
                <td>Location</td>
                <td><input type="text" name="location" /></td>
        </tr>
        <tr>
                <td>Project</td>
           <td><select name="project"><option value="<?php echo $project; ?>"><?php echo $project; ?></option><option value='P2.2'>P2.2</option><option value='PH_1'>PH_1</option><option value='PH_2'>PH_2</option><option value='STL_L1'>STL_L1</option><option value='STL_L3'>STL_L3</option><option value='RUR'>RURAL</option><option value='ZTE_L2'>ZTE_L2</option></select></td --!>
                <td><select name="project"><option value="<?php echo $project; ?>"><?php echo $project; ?></option><option value='UTS-P1'>UTS-P1</option><option value='UTS-GENEW-P1'>UTS-GENEW-P1</option><option value='UTS-GENEW-P2'>UTS-GENEW-P2</option><option value='LCO'>LCO</option></select></td>
        </tr>

        <tr>
                <td>OLT Make</td>
                <td><select name="vendor"><option value="none">Select</option><option value='UTSTAR'>UTSTAR</option><option value='NSN'>NSN</option><option value='STERLITE'>STERLITE</option><option value='HUAWEI'>HUAWEI</option><option value='ZTE'>ZTE</option></select></td>
        </tr>
        <tr>
                <td>OLT IP</td>
                <td><input type="text" name="olt_ip" /></td>
 </tr>
        <tr>
                <td>OUTER VLAN</td>
                <td><input type="text" name="o_vlan" /></td>
        </tr>

        <tr>
                <td>BNG Connected</td>
                <td><select name="bng"><option value="none">Select</option><option value='BNG1'>BNG 1</option><option value='BNG2'>BNG 2</option><option value='BNG3'>BNG 3</option></select></td>
        </tr>

        <tr>
                <td>Parent Switch</td>
                <td><select name="parent_switch"><option value="none">Select</option>
        <?php   while ($row = mysql_fetch_array($reslt_rpr)){?>
        <option value='<?php echo $row['parent_switch'];?>'><?php echo $row['parent_switch'];}?></option>
        </td></select>
        </tr>
        <tr>
                <td>Parent Switch Type</td>
                <td><select name="switch_type"><option value="none">Select</option><option value='RPR'>RPR</option><option value='OCLAN'>OCLAN</option><option value='TIER2'>TIER 2</option><option value='MNGPAN'>MNGPAN</option><option value='DSLAM'>DSLAM</option></select></td>
        </tr>
        <tr>
                <td>Switch Port</td>
                <td><input type="text" name="switch_port" /></td>
        </tr>
        <tr>
                <td>Network Type</td>
                <td><select name="nw"><option value="none">Select</option><option value='P3'>P3</option><option value='P2'>P2</option></select></td>
        </tr>
                <tr>
                <td>Planned or Working ?</td>
                <td><select name="status"><option value="none">Select</option><option value=1>Working</option><option value=2>Planned</option></select></td>
        </tr>
        <tr>
                <td>Fiber Details</td>
                <td><textarea name="fiber_details" rows="3" columns="10"><?php echo $fiber_details; ?></textarea></td>
 </tr>
        <tr>
                <td>Installation Date</td>
                <td><input type="text" name="doi" size="12" id="inputField"/></td>
        </tr>
                <tr>
                <td><input type="submit" name="save" value="save" /></td>
                <td><input type="submit" name="back" value="back" /></td>
        </tr>
</table>
</form>
<?php echo $msg; ?>
</center>
<?php
include($_SERVER['DOCUMENT_ROOT']."/footer.php");
?>
