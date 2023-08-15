<div class = 'flex-initial w-full h-auto grid gap-5 justify-items-center text-justify p-1'>
	<table class = "table-auto w-full h-auto text-center" >

		<?php echo $tabela;?>
		
		<?php foreach($conteudo as $cnt):
				$data = get_object_vars($cnt);
				foreach($data as $key=>$item):
		?>
			<?php if($link): ?>
			<td class = "celula"><a href='<?php echo "{$href}{$cnt->id}";?>'><?php echo $cnt->$key; ?></a></td>
		<?php else: ?> 
			<td class = "celula"><?php echo $cnt->$key; ?></td>

		<?php 
			endif;
		endforeach;?>

		<?php if($colunaActs){

			require 'views/fragmento/tabelaActs.php';
			}else{
				'';
			};?>
		<tr>
		<?php endforeach;?>
	</table>
</div>