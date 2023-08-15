	<div class = 'flex-initial w-1/4 h-fit max-w-1/3 max-h-auto px-5 space-y-2 p-2 bg-white border border-[#A2D9CE] rounded-xl shadow'>
		
		<ul class = 'flex-initial font-medium text-center'>
			<a href = "index.php">Home</a>
		</ul>

		<ul class = 'flex-initial space-y-2 mx-auto'>
			<li class = 'font-medium text-[#4CAF50]'>Usuários</li>
			
			<li class = 'text-sm text-center mx-1'>
				<a href = "index.php?controller=user&action=cadastro">Novo</a>
			</li>

			<li class = 'text-sm text-center mx-1'>
				<a href = "index.php?controller=user&action=index">Listar</a>
			</li>

		</ul>

		<ul class = 'flex-initial space-y-2 mx-auto'>
			<span><li class = 'font-medium text-[#4CAF50]'>Cores</li></span>
			
			<li class = 'text-sm text-center mx-1'>
				<a href = "index.php?controller=cores&action=cadastro">Novo</a>
			</li>

			<li class = 'text-sm text-center mx-1'>
				<a href = "index.php?controller=cores&action=index">Listar</a>
			</li>			
			
			<li class = 'text-sm text-center mx-1'>
				<a href = "index.php?controller=user&action=atribuidas">Cores Atribuídas</a>
			</li>
		
		</ul>
	</div>
	<!-- Fim do Navbar -->