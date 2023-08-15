<div class= 'flex-initial grid grid-cols-2 gap-5 w-5/6 p-2 justify-items-center text-justify'>
	
	<div class = "">
		<?php foreach($user as $item): ?>
		<span>
			Usuário : <?php echo $item->name; ?><br>
			E-Mail : <?php echo $item->email; ?></span>

		<?php endforeach;?>
	</div>
	
	<form class = 'flex-start text-center w-full' action = '<?php echo "{$action}";?>' method= "POST">

		<?php foreach($cores as $cor): ?>
		<?php $resposta = in_array($cor->name, $check) ? "Checked": null; ?>
		
		<input class = 'baseline' type="checkbox" <?php echo "name = cores[{$cor->id}] id = {$cor->name}_{$cor->id} value = '{$cor->name}' {$resposta}";?>/>
		<label for = "<?php echo "{$cor->name}_{$cor->id}"; ?>"><?php echo $cor->name;?> </label>
		<br>

		<?php 
		endforeach; ?>

		<span class = 'flex-end pt-5'><button class = 'w-full bg-green-300 shadow rounded-xl' type = 'submit'>Enviar</button></span>
	</form>
</div>