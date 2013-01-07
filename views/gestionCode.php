<?php
/***************************************************************************
application : Budget
Description: Permet de gerer son budget de façon tres simple
Auteur: Johan VIVIEN
Date de creation: 31 octobre 2012
Version: 0.1
Auteur URI: http://www.hotfirenet.com
Copyright (c) 2002-2008 par Johan VIVIEN
***************************************************************************/

if($_POST)
{
	$reqInsert = "INSERT INTO code (idCode, idCodePere, libelleCode) VALUES (NULL, '".$_POST['codePere']."', '".$_POST['code']."');";
	
	if(sql_query($reqInsert))
		$messageInfo = '';
	else
		$messageInfo = '';	
}

if($_GET['supp'] == 1)
{
	$reqDelete = 'DELETE FROM code WHERE idCode='.$_GET['idCode'];
	
	if(sql_query($reqDelete))
		$messageInfo = '';
	else
		$messageInfo = '';
}

$reqCode = sql_query('SELECT idCode, libelleCode FROM code WHERE idCode <> -1');
	$tabCode = array();
	while($code = sql_fetch_assoc($reqCode)) 
	{
		$tabCode[] = array($code['idCode'],$code['libelleCode']);
	}

?>
	<div class="col_12">
		<form id="ajoutCode" method="post" action="">
			<fieldset>
				<legend>Ajouter une code</legend>	
				<input id="code" name="code" type="text" placeholder="Ajouter un code" required />
				<label for="codePere">Code p&egrave;re:</label>
				<select id="codePere" name="codePere" class="fancy chzn-done">
					<option value="0">Pas de p&egrave;re</option>
				<?php
					
					foreach($tabCode as $code)
					{
						echo '<option value="'.$code[0].'">'.$code[1].'</option>';
					}
				?>
				</select>
				<button type="submit" id="validAjoutOperation" class="small blue">Valider</button>
			</fieldset>	
		</form>
	</div>
	<div class="col_3"></div>
	<div class="col_9">
		<div class="col_8">
			<table cellspacing="0" cellpadding="0" class="striped">
			<thead><tr>
				<th>Code</th>
				<th>Action</th>
			</tr></thead>
			<tbody>
			<?php				
				foreach($tabCode as $code)
				{
				?>
				<tr>				
					<td><?php echo $code[1]; ?></td>
					<td><a href="?action=gestionCode&supp=1&idCode=<?php echo $code[0]; ?>" title="Supprimer le code <?php echo $code[1]; ?>"><span class="icon gray small" data-icon="T"></span></a></td>
				<?php
				}		
			?>
				</tr>
			</tbody>
			</table>
		</div>
		<div class="col_4"></div>
	</div>