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

	$query = 'SELECT C.idCompte
					 , C.libelleCompte
					 , SUM( O.montant ) totalCompte
					FROM compte C
						INNER JOIN compteutilisateur CU ON CU.idCompte = C.idCompte
						INNER JOIN utilisateur U ON U.id = CU.idUtilisateur
						INNER JOIN operations O ON O.idCompte = C.idCompte
					WHERE identifiant = \''.$user.'\'
					GROUP BY C.idCompte';
	$execQuery = sql_query($query);

?>

	<div class="col_9">
		<table cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th>Comptes de <?php echo $user; ?></th>
					<th>Montant</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$totalCompte = 0;
				
				while($synthese = sql_fetch_assoc($execQuery))
				{
				?>
				<tr>
					<th><a href="index.php?action=compte&id=<?php echo $synthese['idCompte']; ?>"><?php echo	$synthese['libelleCompte']; ?></th>
					<td<?php echo $negatifSynthese = ($synthese['totalCompte'] < 0) ? ' class="rouge"' : ''; ?>><?php echo $synthese['totalCompte']; ?>&euro;<?php ?></td>
				</tr>			
				<?php
					$totalCompte = $totalCompte + $synthese['totalCompte'];
				}	
			?>
				<tr>
					<th>Total des comptes</th>
					<td><?php echo number_format($totalCompte, 2, ',', ' '); ?>&euro;</td>
				<tr>			
			</tbody>
		</table>	
	</div>
	<div class="col_3">
		<div class="col_12 visible column">
			<div class="inner">
			fd
			</div>
		</div>
	</div>