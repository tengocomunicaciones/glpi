<?php
/*
 * @version $Id$
 -------------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2009 by the INDEPNET Development Team.

 http://indepnet.net/   http://glpi-project.org
 -------------------------------------------------------------------------

 LICENSE

 This file is part of GLPI.

 GLPI is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 GLPI is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with GLPI; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 --------------------------------------------------------------------------
 */

// ----------------------------------------------------------------------
// Original Author of file:
// Purpose of file:
// ----------------------------------------------------------------------



$NEEDED_ITEMS=array('cartridge','computer','contract','document','enterprise','group','infocom',
   'link','networking','ocsng','peripheral','phone','printer','reservation','tracking','user');

define('GLPI_ROOT', '..');
include (GLPI_ROOT . "/inc/includes.php");
header("Content-Type: text/html; charset=UTF-8");
header_nocache();


if(!isset($_POST["id"])) $_POST["id"] = "";
if(!isset($_POST["sort"])) $_POST["sort"] = "";
if(!isset($_POST["order"])) $_POST["order"] = "";

if(!isset($_POST["withtemplate"])) $_POST["withtemplate"] = "";

checkRight("printer","r");

	if (!empty($_POST["withtemplate"])) {

		if ($_POST["id"]>0){
			switch($_POST['glpi_tab']){
				case 3 :
					if ($_POST["withtemplate"]!=2)	showPortsAdd($_POST["id"],PRINTER_TYPE);
					showPorts($_POST["id"], PRINTER_TYPE,$_POST["withtemplate"]);
					break;

				case 4 :
					showInfocomForm($CFG_GLPI["root_doc"]."/front/infocom.form.php",PRINTER_TYPE,$_POST["id"],1,$_POST["withtemplate"]);
					showContractAssociated(PRINTER_TYPE,$_POST["id"],$_POST["withtemplate"]);
					break;
				case 5 :
					showDocumentAssociated(PRINTER_TYPE,$_POST["id"],$_POST["withtemplate"]);
					break;
				default :
					displayPluginAction(PRINTER_TYPE,$_POST["id"],$_SESSION['glpi_tab'],$_POST["withtemplate"]);
					break;
			}
		}
	} else {
		switch($_POST['glpi_tab']){
			case -1:
				showCartridgeInstalled($_POST["id"]);
				showCartridgeInstalled($_POST["id"],1);
				showConnect($_POST['target'],$_POST["id"],PRINTER_TYPE);
				showPortsAdd($_POST["id"],PRINTER_TYPE);
				showPorts($_POST["id"], PRINTER_TYPE,$_POST["withtemplate"]);
				showInfocomForm($CFG_GLPI["root_doc"]."/front/infocom.form.php",PRINTER_TYPE,$_POST["id"]);
				showContractAssociated(PRINTER_TYPE,$_POST["id"]);
				showDocumentAssociated(PRINTER_TYPE,$_POST["id"]);
				showJobListForItem(PRINTER_TYPE,$_POST["id"]);
				showLinkOnDevice(PRINTER_TYPE,$_POST["id"]);
				displayPluginAction(PRINTER_TYPE,$_POST["id"],$_SESSION['glpi_tab'],$_POST["withtemplate"]);
				break;
			case 3 :
				showConnect($_POST['target'],$_POST["id"],PRINTER_TYPE);
				showPortsAdd($_POST["id"],PRINTER_TYPE);
				showPorts($_POST["id"], PRINTER_TYPE,$_POST["withtemplate"]);
				break;
			case 4 :
				showInfocomForm($CFG_GLPI["root_doc"]."/front/infocom.form.php",PRINTER_TYPE,$_POST["id"]);
				showContractAssociated(PRINTER_TYPE,$_POST["id"]);
				break;
			case 5 :
				showDocumentAssociated(PRINTER_TYPE,$_POST["id"]);
				break;
			case 6 :
				showJobListForItem(PRINTER_TYPE,$_POST["id"]);
				break;
			case 7 :
				showLinkOnDevice(PRINTER_TYPE,$_POST["id"]);
				break;
				case 10 :
				showNotesForm($_POST['target'],PRINTER_TYPE,$_POST["id"]);
				break;
			case 11 :
				showDeviceReservations($_POST['target'],PRINTER_TYPE,$_POST["id"]);
				break;
			case 12 :
				showHistory(PRINTER_TYPE,$_POST["id"]);
				break;
			default :
				if (!displayPluginAction(PRINTER_TYPE,$_POST["id"],$_SESSION['glpi_tab'],$_POST["withtemplate"])){
					showCartridgeInstalled($_POST["id"]);
					showCartridgeInstalled($_POST["id"],1);
				}
				break;
		}
	}

	ajaxFooter();
?>
