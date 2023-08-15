<td>
	<span class = 'grid grid-cols-2 gap-0'>
	<a class = 'editarBtn' href= 'index.php?<?php echo "{$caminho}&action=editar&id={$cnt->id}";?>'>
		Editar
	</a>
	<form method = 'POST' action = 'index.php?<?php echo "{$caminho}&action=excluir&id={$cnt->id}";?>' onSubmit = 'return window.confirm("Excluir <?php echo $cnt->name ;?> ?")'>
				<input class = 'excluirBtn' type = 'submit' value = "Excluir">
		</form>
	</span>
</td>