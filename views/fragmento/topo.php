<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdn.tailwindcss.com">
			tailwind.config  = {
		  theme: {
		    extend: {
		      colors: {,
		      },
		    }
		  }
		}
	</script>
  <style type="text/tailwindcss">
    @layer utilities {
      :root{
      	@apply text-xl text-[#333333];
      }

      .input_text {
        @apply text-center border rounded-xl shadow ;
      }

      a{
      	@apply underline text-[#0D98BA];
      }
      table{
      	@apply border rounded-xl shadow;
      }
      th{
      	@apply min-h-fit text-sm;
      }
      tr{
      	@apply bg-blue-200 odd:bg-gray-200; 
      }
      td{
      	@apply p-1 md:text-sm text-sm;
      }
      .excluirBtn{
      	@apply text-base bg-red-400 p-0 border rounded-xl shadow w-full h-fit mx-0;
      }
      .editarBtn{
      	@apply text-base underline text-black bg-yellow-300 p-0 border rounded-xl shadow mx-0 w-full h-fit;
      }

    }
  </style>
	
	<title></title>
<script>

function MSG(element){
	console.log(element)
	let txt = window.confirm("Tem certeza que deseja excluir o usuario?" );

	if(!txt){
		this.href = '/';
		window.location = 'index';
	}else{
		window.location = 'index.php?controller=user&action=excluir&id='
	}

}

</script>
</head>