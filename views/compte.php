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

$idCompte = $_GET['id'];



if($_POST)
{
	$releve = $_POST['releve'] == 'on' ? "b'1'" : "b'0'";
	
	$sqlAjoutOperation = 'INSERT INTO `operations` (`idOperation`, `idCompte`, `motif`, `idCode`, `montant`, `releve`, `dateOperation`, `supprime`) VALUES
							(NULL, '.$_POST['idCompte'].', \''.$_POST['motif'].'\', '.$_POST['code'].', \''.$_POST['montant'].'\', '.$releve.', \''.$_POST['date'].'\', b\'0\');';
	
	if(sql_query($sqlAjoutOperation))
		$messageInfo = '';
	else
		$messageInfo = '';
}

if($_GET['releveOperation'] == 1) 
{
	$updateReleveOperation = "UPDATE `operations` SET `releve` = b'".$_GET['value']."' WHERE `idOperation` = ".$_GET['operation']." AND `idCompte` = ".$_GET['id'].";";
	
	if(sql_query($updateReleveOperation))
		$messageInfo = '';
	else
		echo $updateReleveOperation;	
}


?>
	<div class="col_12">
		<div class="inner">
			<form id="formAjoutOperation" action="index.php?action=compte&id=<?php echo $idCompte; ?>" method="post">
				<fieldset>
					<legend>Ajouter une op&eacute;ration</legend>
					<input id="idCompte" name="idCompte" type="hidden" value="<?php echo $idCompte; ?>" /> 
					<input id="date" name="date" type="text" placeholder="Date" required />
					<input id="motif" name="motif" type="text" placeholder="Motif (A-Z, 0-9)" required />	
					<select id="codePere" name="codePere" class="fancy chzn-done">
						<option>-- Code --</option>
						<?php
							$reqCode = sql_query('SELECT idCode, libelleCode FROM code WHERE idCode <> -1 ORDER BY libelleCode');
							while($code = sql_fetch_assoc($reqCode)) 
							{
								echo '<option value="'.$code['idCode'].'">'.$code['libelleCode'].'</option>';
							}
						
						?>
					</select>			
					<input id="montant" name="montant" type="text" placeholder="19,80&euro;" required />		
					<input type="checkbox" name="releve" id="releve" class="checkbox"> <label for="releve">Relev&eacute;</label>
					<button type="submit" id="validAjoutOperation" class="small blue">Valider</button>
				</fieldset>		
			</form>
		</div>
	</div>
	<div class="col_9">
		<div class="message"></div>
		<table cellspacing="0" cellpadding="0" class="striped">
			<thead><tr>
				<th>Date</th>
				<th>Motif</th>
				<th>Code</th>
				<th>Somme / Euros</th>
				<th>Reste / Euros</th>
				<th>Relev&eacute;</th>
			</tr></thead>
			<tbody>
			<?php
				$reqOperation = sql_query('SELECT O.idOperation
											, O.motif
											, C.libelleCode
											, O.idCode
											, O.montant
											, O.releve
											,DATE_FORMAT(O.dateOperation, \'%d/%m/%Y\') dateOperation
											FROM operations O
												INNER JOIN code C ON C.idCode = O.idCode
												WHERE O.idCompte = '.$idCompte.' ORDER BY O.dateOperation, O.idOperation');
				$totalOperation = 0.00;								
				while($operation = sql_fetch_assoc($reqOperation)) 
				{
					if($operation['idCode'] == -1) 
					{
						$totalOperation = $operation['montant']; 
						continue;
					}
						
					
					$totalOperation = $operation['montant'] + $totalOperation;
				?>
			<tr>
				<td><?php echo $operation['dateOperation']; ?></td>
				<td><?php echo $operation['motif']; ?></td>
				<td><?php echo $operation['libelleCode']; ?></td>
				<td><?php echo $operation['montant']; ?>&euro;</td>
				<td<?php echo $negatifOperation = ($totalOperation < 0) ? ' class="rouge"' : ''; ?>><?php echo number_format($totalOperation, 2, ',', ' '); ?>&euro;</td>
				<td><a href="index.php?action=compte&id=<?php echo $idCompte; ?>&operation=<?php echo $operation['idOperation']; ?>&releveOperation=1&value=<?php echo $value = $operation['releve'] == true ? 0:1; ?>" title="Relever cette op&eacute;ration"><span class="icon medium<?php echo $check = $operation['releve'] == true ? ' green' : ' red'; ?>" data-icon="C"></span></a></td>
			</tr>				
				<?php
				}		
			?>
			</tbody>
		</table> 	
	</div>
	<div class="col_3">
		<table cellspacing="0" cellpadding="0" class="striped tight sortable">
			<thead><tr>
				<th>Code</th>
				<th>Montant</th>
			</tr></thead>
			<tbody>
			<?php
				$reqRepartition = sql_query('SELECT SUM( O.montant ) montant , C.libelleCode
												FROM operations O
												INNER JOIN code C ON C.idCode = O.idCode
												WHERE O.idCompte = '.$idCompte.' AND O.idCode <> -1
												GROUP BY C.libelleCode');
				
				while($repartition = sql_fetch_assoc($reqRepartition)) 
				{
					
				?>
			<tr>
				<td><?php echo $repartition['libelleCode']; ?></td>	
				<td<?php echo $negatifRepartition = ($repartition['montant'] < 0) ? ' class="rouge"' : ''; ?>><?php echo $repartition['montant']; ?>&euro;</td>
			</tr>				
				<?php
				}
			?>
			</tbody>
		</table> 			
	</div>
