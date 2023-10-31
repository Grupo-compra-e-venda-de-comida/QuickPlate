<?php
	if(isset($msgErro) and (trim($msgErro) != "")){
		echo("<div id='divMsgErro' class='alert alert-danger'>" . $msgErro . "</div>");
	}

	if(isset($msgSucesso) and (trim($msgSucesso) != "")){
		echo("<div id='divMsgSucesso' class='alert alert-success'>" . $msgSucesso . "</div>");
	}
?>